<?php if(!defined("IN_ESOTALK")) exit;
/**
 * OpauthConnect
 * 
 * @copyright Copyright © 2012 Oleksandr Golubtsov
 * @license   GPLv2 License
 * @package   OpauthСonnect
 * 
 * This file is part of OpauthСonnect plugin. Please see the included license file for usage information
 */

class OCSettings {
    const SECURITY_SALT      = "security_salt";
    const ALLOW_UNLINK       = "allow_unlink";
    const CONFIRM_EMAIL_SUBJ = "confirmation_email_title";
    const PASS_EMAIL_SUBJ    = "password_email_title";

    private $_values = array();
    private $_defaults = array(
        self::SECURITY_SALT      => "9XN2LTFHGXYsTgLW33Fb",
        self::CONFIRM_EMAIL_SUBJ => "Wellcome to [forumName], [socialName]! Please, confirm your email address",
        self::PASS_EMAIL_SUBJ    => "Your new account for [forumName]",
    );
    
    public function get($name) {       
        $value = ET::getInstance("ocSettingsModel")->getById($name);
        
        if(!$value && isset($this->_defaults[$name])) {
            $value = $this->_defaults[$name];
        }
        else {
            $value = $value['value'];
        }        
        
        return $value;
    }
    
    public function set($key, $value) {
        $this->_values[$key] = $value;
    }
    
    public function save() {
        ET::getInstance("OcSettingsModel")->saveArray($this->_values);
        $this->_values = array();
    }
    
    public function setAndSave($key, $value) {
        $this->set($key, $value);
        $this->save();
    }
}