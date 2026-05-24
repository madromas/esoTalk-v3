<?php
/**
 * Google strategy for Opauth
 * based on https://developers.google.com/accounts/docs/OAuth2
 * 
 * More information on Opauth: http://opauth.org
 * 
 * @copyright    Copyright © 2012 U-Zyn Chua (http://uzyn.com)
 * @link         http://opauth.org
 * @package      Opauth.GoogleStrategy
 * @license      MIT License
 */

/**
 * Google strategy for Opauth
 * based on https://developers.google.com/accounts/docs/OAuth2
 * 
 * @package			Opauth.Google
 */
class GoogleStrategy extends OpauthStrategy {

    public $expects = array('client_id', 'client_secret');
    public $optionals = array('redirect_uri', 'scope', 'state', 'access_type', 'approval_prompt');
    
    public $defaults = array(
        'redirect_uri' => '{complete_url_to_strategy}oauth2callback',
        'scope' => 'openid profile email' // Updated to modern OIDC scopes
    );

    public function request() {
        $url = 'https://accounts.google.com/o/oauth2/v2/auth';
        $params = array(
            'client_id' => $this->strategy['client_id'],
            'redirect_uri' => $this->strategy['redirect_uri'],
            'response_type' => 'code',
            'scope' => $this->strategy['scope']
        );

        foreach ($this->optionals as $key) {
            if (!empty($this->strategy[$key])) $params[$key] = $this->strategy[$key];
        }
        
        $this->clientGet($url, $params);
    }

    public function oauth2callback() {
        if (array_key_exists('code', $_GET) && !empty($_GET['code'])) {
            $url = 'https://oauth2.googleapis.com/token';
            $params = array(
                'code' => $_GET['code'],
                'client_id' => $this->strategy['client_id'],
                'client_secret' => $this->strategy['client_secret'],
                'redirect_uri' => $this->strategy['redirect_uri'],
                'grant_type' => 'authorization_code'
            );

            $response = $this->serverPost($url, $params, null, $headers);
            $results = json_decode($response);

            if (!empty($results) && !empty($results->id_token)) {
                // Decode the modern JWT ID Token directly
                $parts = explode('.', $results->id_token);
                $userinfo = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $parts[1])), true);

                $this->auth = array(
                    'uid' => $userinfo['sub'], // 'sub' is the unique ID in OIDC
                    'info' => array(
                        'name' => $userinfo['name'] ?? '',
                        'email' => $userinfo['email'] ?? '',
                        'first_name' => $userinfo['given_name'] ?? '',
                        'last_name' => $userinfo['family_name'] ?? '',
                        'image' => $userinfo['picture'] ?? ''
                    ),
                    'credentials' => array(
                        'token' => $results->access_token,
                        'expires' => date('c', time() + ($results->expires_in ?? 3600))
                    ),
                    'raw' => $userinfo
                );

                $this->callback();
            } else {
                $this->errorCallback(array('code' => 'token_error', 'raw' => $response));
            }
        } else {
            $this->errorCallback(array('code' => 'oauth2callback_error', 'raw' => $_GET));
        }
    }
}