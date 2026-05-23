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

class OcSettingsModel extends ETModel {
    
    protected $table = "oc_settings";
    protected $primaryKey = "name";
    
    public function __construct() {}
    
    public function saveArray($settings) {
        foreach($settings as $name => &$value) {
            $value = "('".$name."', '".$value."')";
        }
        
        $sql = "INSERT INTO ".C("esoTalk.database.prefix").
               "oc_settings VALUES ".implode(",", $settings).
               " ON DUPLICATE KEY UPDATE value = VALUES(value)";
        
        ET::$database->query($sql);
    }
    
}