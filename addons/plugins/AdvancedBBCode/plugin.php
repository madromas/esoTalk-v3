<?php
// Copyright 2014 sda553
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

define('BBCODE_LIMIT', 1511);

ET::$pluginInfo["AdvancedBBCode"] = array(
	"name" => "AdvancedBBCode",
	"description" => "Allow to modify BB codes via admin settings page.",
	"version" => ESOTALK_VERSION,
	"author" => "sda553",
	"authorEmail" => "support@esotalk.org",
	"authorURL" => "http://esotalk.org",
	"license" => "GPLv2",
	"dependencies" => array(
		"esoTalk" => "1.0.0g4"
	)
);


/**
 * Advanced BBCode Formatter Plugin
 *
 * Interprets BBCode in posts and converts it to HTML formatting when rendered. Also adds BBCode formatting
 * buttons to the post editing/reply area.
 * Allow to modify BB codes via Admin.Settings page
 */
class ETPlugin_AdvancedBBCode extends ETPlugin {

private $plugin_key_name;
    
public function __construct($path)
{
    if (!$path)
        $path = "addons/plugins/AdvancedBBCode";
    parent::__construct($path);
    ETFactory::register($this->GetPluginName()."Model", "ETAdvancedBBCodeModel",$this->file("models/ETAdvancedBBCodeModel.class.php",true));    
    ETFactory::register("ETAcp_bbcodes", "ETAcp_bbcodes",$this->file("ETAcp_bbcodes.class.php",true));    
    ETFactory::register("ETAbccController", "ETAbccController", $this->file("controllers/ETAbccController.class.php",true));
}

protected function addResources($sender)
{
	$groupKey = strtolower($this->GetPluginName());
	$sender->addCSSFile($this->resource($groupKey.".css"), false, $groupKey);
        $sender->addJSFile($this->resource($groupKey.".js"), false, $groupKey);
        $sender->addJSLanguage("message.tplBBWarning");
        $sender->addJSLanguage("AdvancedBBCode.BBCODE_INVALID");
        $sender->addJSLanguage("AdvancedBBCode.BBCODE_INVALID_TAG_NAME");        
        $sender->addJSLanguage("AdvancedBBCode.BBCODE_HELPLINE_TOO_LONG");
        $sender->addJSLanguage("AdvancedBBCode.BBCODE_OPEN_ENDED_TAG");
        $sender->addJSLanguage("AdvancedBBCode.BBCODE_TAG_TOO_LONG");
        $sender->addJSLanguage("AdvancedBBCode.BBCODE_TAG_DEF_TOO_LONG");        
        $sender->addJSLanguage("AdvancedBBCode.TOO_MANY_BBCODES");
        $sender->addJSLanguage("AdvancedBBCode.BBCODE_SAVED");
        $sender->addJSLanguage("message.confirmDelete");
}

protected function addLocalResources($sender)
{
	$groupKey = strtolower($this->GetPluginName())."local";
	$sender->addCSSFile($this->resource($groupKey.".css"), false, $groupKey);
        $sender->addJSFile($this->resource($groupKey.".js"), false, $groupKey);
        $sender->addJSLanguage("AdvancedBBCode.abbcode");
}

public function GetPluginName()
{
    if (!$this->plugin_key_name)
        $this->plugin_key_name = preg_replace("/.+\/([^\/]+)$/","$1",$this->path);
    return $this->plugin_key_name;
}

public function handler_initAdmin($sender)
{
        $keyname=strtolower($this->GetPluginName());
        $sender->defaultMenu->add($keyname, "<a href='".URL("admin/".$keyname)."'><i class='icon-bold'></i> ".T("AdvancedBBCode.DefaultMenuItem")."</a>");
        if (ET::$controller->className == $keyname."AdminController")
        {
            $sender->defaultMenu->highlight(ET::$controllerName);
            $sender->menu->highlight(ET::$controllerName);        
        }
}

public function handler_advancedbbcodeAdminController_renderBefore($sender)
{
	$this->addResources($sender);
}

public function handler_conversationController_renderBefore($sender)
{
	$this->addLocalResources($sender);
}

public function handler_conversationsController_init($sender)
{
	$this->addLocalResources($sender);
}

public function handler_formatPostForTemplate($sender,&$formatted, $post, $conversation)
{
	//to do make formating to join bb codes
   //     $p=0;
    ET::getInstance("ETAbccController")->Replace($formatted, $post);
}

public function handler_format_afterFormat($sender)
{
        ET::getInstance("ETAbccController")->Replace($sender->content);
}

public function handler_conversationModel_addReplyAfter($sender, $conversation, $postId, $content)
{
    ET::getInstance("ETAbccController")->Parse(array("postId" => $postId, "content" => $content));
}

public function handler_conversationModel_createAfter($sender,$conversation, $postId, $content)
{
    ET::getInstance("ETAbccController")->Parse(array("postId" => $postId, "content" => $content));
}

public function handler_postModel_editPostAfter($sender, $parameters)
{
    ET::getInstance("ETAbccController")->Parse($parameters);
}

public function boot()
{
    ETFactory::registerAdminController(strtolower($this->GetPluginName()), "ETAbccAdminController", $this->file("controllers/admin/ETAbccAdminController.class.php",true));        
}

public function setup($oldVersion = "")
{
    $model = ET::getInstance($this->GetPluginName()."Model");
    $model->setup();
    return true;
}

public function uninstall()
{
    $model = ET::getInstance($this->GetPluginName()."Model");
    $model->uninstall();
    return true;    
}

public function handler_conversationController_getEditControls($sender, &$controls, $id)
{
    $model = ET::getInstance($this->GetPluginName()."Model");
    $controlhtml = "<span class='abbcode'><ul class='abbcodelist' data-id='$id'>";      
    $result = $model->getBBcodes()->allRows();
    foreach ($result as $k => $v){
        $controlhtml = $controlhtml.'<li><a href="#">'.$v["bbcode_tag"].'</a></li>';
    }        
    $controlhtml = $controlhtml."</ul><a href='#' title='".T("AdvancedBBCode.abbcode")."' class='control-advbbcode'><i class='icon-bitcoin'></i></a></span>";
    addToArrayString($controls, "abbcodes", $controlhtml, 0);
}

}
