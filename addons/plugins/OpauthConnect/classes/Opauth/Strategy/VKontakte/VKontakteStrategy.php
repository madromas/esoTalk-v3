<?php
/**
 * VKontakte strategy for Opauth
 * based on http://vk.com/developers.php?oid=-17680044&p=Authorizing_Sites
 */

class VKontakteStrategy extends OpauthStrategy{
	
	/**
	 * Compulsory config keys, listed as unassociative arrays
	 */
	public $expects = array('app_id', 'app_secret');
	
	/**
	 * Optional config keys with respective default values, listed as associative arrays
	 */
	public $defaults = array(
		'redirect_uri' => '{complete_url_to_strategy}int_callback',
		'scope' => 'friends',  // Check http://vk.com/developers.php?oid=-17680044&p=Application_Access_Rights
	);

	/**
	 * Auth request
	 */
	public function request(){
		$url = 'https://oauth.vk.com/authorize';
		$params = array(
			'client_id' => $this->strategy['app_id'],
			'scope' => $this->strategy['scope'],
			'redirect_uri' => $this->strategy['redirect_uri'],
			'response_type' => 'code',
		);

		$this->clientGet($url, $params);
	}
	
	/**
	 * Internal callback to get the code and request que authorization token, after VKontakte's OAuth
	 */
	public function int_callback(){
		if (array_key_exists('code', $_GET) && !empty($_GET['code'])){
			$url = 'https://oauth.vk.com/access_token'; //DGB 2012-11-06 Notice VK documentation is wrong, because they DO require HTTPS
			$params = array(
				'client_id' =>$this->strategy['app_id'],
				'client_secret' => $this->strategy['app_secret'],
				'code' => $_GET['code'],       
				'redirect_uri'=> $this->strategy['redirect_uri'],
			);
			$response = $this->serverGet($url,$params,false,$headers);
			if (empty($response)){
				$error = array(
					'code' => 'Get access token error',
					'message' => 'Failed when attempting to get access token',
					'raw' => array(
						'headers' => $headers
					)
				);
				exit();
				$this->errorCallback($error);
			}
			$results=json_decode($response,true);	
			$vkuser_ = $this->getuser($results['access_token'],$results['user_id']); 
			$vkuser = $vkuser_['response']['0'];
				$this->auth = array(
					'provider' => 'VKontakte',
					'uid' => $vkuser['uid'],
					'info' => array(
					),
					'credentials' => array(
						'token' => $results['access_token'],
						'expires' => date('c', time() + $results['expires_in'])
					),
					'raw' => $vkuser
				);
			
				if (!empty($vkuser['first_name'])) $this->auth['info']['name'] = $vkuser['first_name'];
				if (!empty($vkuser['screen_name'])) $this->auth['info']['nickname'] = $vkuser['screen_name'];
				if (!empty($vkuser['sex']) and ($vkuser['sex']!='0')) $this->auth['info']['gender']=($vkuser['sex']=='1')?'female':'male';
				if (!empty($vkuser['photo_big'])) $this->auth['info']['image'] = $vkuser['photo_big'];

         $this->callback();

				 // If the data doesn't seem to be written to the session, it is probably because your sessions are
				// stored in the database and your session table is not encoded in UTF8. 
				// The following lines will jump over the security but will allow you to use
				 // the plugin without utf8 support in the database.

         // $completeUrl = Configure::read('Opauth._cakephp_plugin_complete_url');
         // if (empty($completeUrl)) $completeUrl = Router::url('/opauth-complete');
         // $CakeRequest = new CakeRequest('/opauth-complete');
         // $data['auth'] = $this->auth;
         // $CakeRequest->data = $data;
         // $Dispatcher = new Dispatcher();
         // $Dispatcher->dispatch( $CakeRequest, new CakeResponse() );
         // exit();
		}
		else
		{
			$error = array(
				'code' => isset($_GET['error'])?$_GET['error']:0,
				'message' => isset($_GET['error_description'])?$_GET['error_description']:'',
				'raw' => $_GET
			);
			
			$this->errorCallback($error);
		}
	}
	
	private function getuser($access_token,$uid){
			$fields='uid, first_name, last_name, nickname, screen_name, sex, bdate, photo, photo_medium, photo_big, rate, contacts';
			$vkuser = $this->serverget('https://api.vk.com/method/users.get', array('access_token' => $access_token,'uid'=>$uid,'fields'=>$fields));
			if (!empty($vkuser))
			{
				return json_decode($vkuser,true);
			}
			else{
			$error = array(
				'code' => 'Get User error',
				'message' => 'Failed when attempting to query for user information',
				'raw' => array(
					'access_token' => $access_token,	
					'headers' => $headers
				)
			);
			$this->errorCallback($error);
		}
	} 
}
