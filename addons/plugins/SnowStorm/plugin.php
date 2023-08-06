<?php
// Copyright 2013 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.
// Uses: DHTML Snowstorm! JavaScript-based Snow for web pages http://www.schillmania.com/projects/snowstorm/

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["SnowStorm"] = array(
	"name" => "SnowStorm",
	"description" => "JavaScript-based Snow for web pages.",
	"version" => ESOTALK_VERSION,
	"author" => "andrewks",
	"authorEmail" => "forum330@gmail.com",
	"authorURL" => "http://forum330.com",
	"license" => "GPLv2",
	"dependencies" => array(
		"esoTalk" => "1.0.0g4"
	)
);


/**
 * SnowStorm Plugin
 *
 * Snowing for main page. Also adds button to stop snowing.
 */
class ETPlugin_SnowStorm extends ETPlugin {



protected function addResources($sender)
{
	$groupKey = 'SnowStorm';
	$sender->addJSFile($this->resource("vendor/snowstorm-min.js"), false, $groupKey);
	$sender->addJSFile($this->resource("snowstorm.js"), false, $groupKey);
	$sender->addCSSFile($this->resource("snowstorm.css"), false, $groupKey);
	$sender->addJSVar("snowStorm_snowColor", C("plugin.SnowStorm.snowColor"));
	$sender->addJSVar("snowStorm_snowCharacter", C("plugin.SnowStorm.snowCharacter"));
	$sender->addJSVar("snowStorm_flakesMaxActive", C("plugin.SnowStorm.flakesMaxActive"));
	$sender->addJSVar("snowStorm_useTwinkleEffect", C("plugin.SnowStorm.useTwinkleEffect"));
	$sender->addJSVar("snowStorm_enableSnowman", C("plugin.SnowStorm.enableSnowman"));
	$sender->addJSLanguage("plugin.SnowStorm.message.stopSnowing");
	
}


/**
 * Add an event handler to the initialization of the conversation controller to add CSS and JavaScript
 * resources.
 *
 * @return void
 */
public function handler_conversationController_renderBefore($sender)
{
	//$this->addResources($sender);
}

public function handler_conversationsController_init($sender)
{
	$this->addResources($sender);
}

public function handler_memberController_renderBefore($sender)
{
	//$this->addResources($sender);
}

// Construct and process the settings form.
public function settings($sender)
{
	// Set up the settings form.
	$form = ETFactory::make("form");
	$form->action = URL("admin/plugins/settings/SnowStorm");
	$form->setValue("snowColor", C("plugin.SnowStorm.snowColor"));
	$form->setValue("snowCharacter", C("plugin.SnowStorm.snowCharacter"));
	$form->setValue("flakesMaxActive", C("plugin.SnowStorm.flakesMaxActive"));
	$form->setValue("useTwinkleEffect", (bool)C("plugin.SnowStorm.useTwinkleEffect"));
	$form->setValue("enableSnowman", (bool)C("plugin.SnowStorm.enableSnowman"));

	// If the form was submitted...
	if ($form->validPostBack("snowStormSave")) {

		// Construct an array of config options to write.
		$config = array();
		$config["plugin.SnowStorm.snowColor"] = $form->getValue("snowColor");
		$config["plugin.SnowStorm.snowCharacter"] = $form->getValue("snowCharacter");
		$config["plugin.SnowStorm.flakesMaxActive"] = $form->getValue("flakesMaxActive");
		$config["plugin.SnowStorm.useTwinkleEffect"] = (bool)$form->getValue("useTwinkleEffect");
		$config["plugin.SnowStorm.enableSnowman"] = (bool)$form->getValue("enableSnowman");

		if (!$form->errorCount()) {

			// Write the config file.
			ET::writeConfig($config);

			$sender->message(T("message.changesSaved"), "success autoDismiss");
			$sender->redirect(URL("admin/plugins"));

		}
	}

	$sender->data("snowStormSettingsForm", $form);
	$sender->addCSSFile("core/js/lib/farbtastic/farbtastic.css");
	$sender->addJSFile("core/js/lib/farbtastic/farbtastic.js");
	return $this->view("settings");
}

}
