<?php
// Copyright 2014 sda553
// This file is plugin controller for esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * This controller handles the management of plugins.
 *
 * @package esoTalk
 */
class ETAbccController extends ETController {

private $plugin_key_name;
    
public function GetPluginName()
{$plugin_key_name=false;
    if (!$plugin_key_name)
        $plugin_key_name = "AdvancedBBCode";
    
	
	return $plugin_key_name;
}

private function GetBBClass()
{
    $ret =  ET::getInstance("ETAcp_bbcodes");
    if (!$ret->controller)
        $ret->controller = $this;
    return $ret;
}

public function GetModel()
{
    return ET::getInstance($this->GetPluginName()."Model");
}

public function Parse($post)
{
    $this->GetBBClass()->Parse($post);
}

public function Replace(&$formated,$post = null)
{
    if (is_array($formated))
    {
        $this->GetBBClass()->bbcode_second_pass($formated,$post);
    }
    else
    {
        $parameters = array("body"=>$formated);
        $this->GetBBClass()->bbcode_second_pass($parameters,$post);//preview
        $formated = $parameters["body"];
    }
}

}
