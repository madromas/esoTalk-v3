<?php
// Copyright 2014 sda553
// This file is plugin controller for esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * This controller handles the management of plugins.
 *
 * @package esoTalk
 */
class ETAbccAdminController extends ETAdminController {

private $plugin_key_name;
    
public function GetPluginName()
{
    if (!$this->plugin_key_name)
        $this->plugin_key_name = "AdvancedBBCode";
    return $this->plugin_key_name;
}
    
private function GetBBClass()
{
    $ret =  ET::getInstance("ETAcp_bbcodes");
    if (!$ret->admincontroller)
        $ret->admincontroller = $this;
    return $ret;
}

public function action_index()
{
	$this->title = T("AdvancedBBCode.DefaultMenuItem");
        
        $model = $this->GetModel();
        $result = $model->getBBcodes();
        $this->data("bblist", $result->allRows());
	$this->render("admin/".strtolower($this->GetPluginName()));
}

public function action_create()
{
	$this->title = T("AdvancedBBCode.DefaultMenuItem");                
        $form = ETFactory::make("form");	
        $this->data("form", $form);	
        $BBcodes = $this->GetBBClass();   
        if ($form->validPostBack("save")) 
        {
            $BBcodeData = array(
                    "bbcode_id" => $form->getValue("bbcode_id")                 
                    );            
            $BBcodeData["action"] = ($BBcodeData["bbcode_id"])? "modify" : "create";
            $BBcodes->main($BBcodeData);
            return;
        }
        if ($form->validPostBack("cancel")) {
            $this->action_index();
            return;
        }        
        $BBcodes->main(array("action" => "add","bbcode_id" => ""));
}

public function action_modify($bbcode_id)
{
        
    $form = ETFactory::make("form");	
    $this->data("form", $form);	
    $BBcodes = $this->GetBBClass();   
                 
    $BBcodeData = array(
            "bbcode_id" => $bbcode_id,
            "action" => "edit"                    
            );                      
    $BBcodes->main($BBcodeData);        
}

public function action_delete($bbcode_id)
{
        
    $BBcodes = $this->GetBBClass();                   
    $BBcodeData = array(
            "bbcode_id" => $bbcode_id,
            "action" => "delete"                    
            );                      
    $BBcodes->main($BBcodeData);        
}

public function GetModel()
{
    return ET::getInstance($this->GetPluginName()."Model");
}

}
