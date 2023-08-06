<?php
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["UserScripts"] = array(
	"name" => "User Scripts",
	"description" => "Add support for user scripts .js and styles .css.",
	"version" => ESOTALK_VERSION,
	"author" => "andrewks",
	"authorEmail" => "forum330@gmail.com",
	"authorURL" => "http://forum330.com",
	"license" => "GPLv2",
	"dependencies" => array(
		"esoTalk" => "1.0.0g5"
	)
);


class ETPlugin_UserScripts extends ETPlugin {


	// Register model/controller.
	public function __construct($rootDirectory)
	{
		parent::__construct($rootDirectory);
		ETFactory::register("UserScriptsModel", "UserScriptsModel", dirname(__FILE__)."/UserScriptsModel.class.php");
		ETFactory::registerController("scripts", "UserScriptsController", dirname(__FILE__)."/UserScriptsController.class.php");
	}

	
	protected function addPanes($panes)
	{
		$panes->add("scripts", "<a href='".URL("scripts/settings")."'>".T("settings.userScripts.label")."</a>");

	}
	
	
	public function handler_settingsController_initProfile($sender, $panes, $controls, $actions)
	{
		$this->addPanes($panes);
	}
	
	
	public function handler_scriptsController_initProfile($sender, $panes, $controls, $actions)
	{
		$sender->trigger("settingsController_initProfile", array($panes, $controls, $actions));
		$this->addPanes($panes);
	}
	
	
	protected function addPluginResources($sender)
	{
		$groupKey = 'UserScripts';
		$sender->addCSSFile($this->resource("userscripts.css"), false, $groupKey);
	}
	

	public function handler_scriptsController_init($sender)
	{
		$this->addPluginResources($sender);
	}
	
	
	protected function addResources($sender)
	{
		if (ET::$session->userId) {
			$model = ET::getInstance("UserScriptsModel");
			$isMobile = isMobileBrowser();
			if (ET::$session->preference("usePersonalCSS", false) and !$isMobile) if ($model->isResourceExists('css')) {
				$url = getResource($model->getUrlUserCSS());
				$sender->addToHead("<link rel='stylesheet' href='$url'>\n");
			}
			
			if (ET::$session->preference("usePersonalCSSmob", false) and $isMobile) if ($model->isResourceExists('css-mob')) {
				$url = getResource($model->getUrlUserCSSmob());
				$sender->addToHead("<link rel='stylesheet' href='$url'>\n");
			}
			
			if (ET::$session->preference("usePersonalJS", false)) if ($model->isResourceExists('js')) 
			{
				$url = getResource($model->getUrlUserJS());
				$sender->addToHead("<script src='$url'></script>\n");
			}
		}
	}


	/**
	 * Add an event handler to the initialization of the controller to add CSS and JavaScript
	 * resources.
	 *
	 * @return void
	 */

	public function handler_init($sender)
	{
		$this->addResources($sender);
	}


}
