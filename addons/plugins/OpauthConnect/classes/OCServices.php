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

class OCServices implements Iterator {
    
    private $services = array();
    
    public function __construct() {
        $services = new SimpleXMLElement(PATH_PLUGINS."/OpauthConnect/resources/ocservices.xml", 0, true);
        foreach($services as $service) {
            $attributes = $service->attributes();
            $service_obj = new stdClass();
            $service_obj->machine_name = (string)$attributes->{'machine-name'};
            $service_obj->name = (string)$attributes->name;
            $service_obj->icon = "images/".$service->icon;
            $service_obj->key = (string)$service->settings->key;
            $service_obj->secret = (string)$service->settings->secret;
            
            $service_obj->settings = new stdClass();
            $service_obj->settings->enabled = $service_obj->machine_name."_enabled";
            $service_obj->settings->key = $service_obj->machine_name."_".$service_obj->key;
            $service_obj->settings->secret = $service_obj->machine_name."_".$service_obj->secret;
            
            $service_obj->static = new stdClass();
            foreach($service->{'static-settings'}->children() as $name => $value) {
                $service_obj->static->$name = (string)$value;
            }
            
            $this->services[] = $service_obj;
        }
    }
    
//    public function getSettingsSchemaQuery($prefix) {
//        $names = array();
//        foreach($this->services as $service) {
//            foreach($service->settings as $setting) {
//                $names[] = "('".$setting."')";
//            }
//        }
//        
//        return "INSERT IGNORE INTO ".$prefix."oc_settings(name) VALUES ".implode(",", $names);
//    }

    public function isServiceExists($_service) {
        $exists = false;
        foreach($this->services as $service) {
            if($service->machine_name == $_service) {
                $exists = true;
                break;
            }
        }
        return $exists;
    }
    
    public function current() {
        return current($this->services);
    }

    public function key() {
        return key($this->services);
    }

    public function next() {
        return next($this->services);
    }

    public function rewind() {
        reset($this->services);
    }

    public function valid() {
        return false !== current($this->services);
    }
    
}