<?php
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.
// Uses: Bug http://auz.github.io/Bug/

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["April1"] = array(
	"name" => "April 1",
	"description" => "JavaScript & CSS-based bugs for web pages.",
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
 * April1 Plugin
 *
 * Add bugs for main page.
 */
class ETPlugin_April1 extends ETPlugin {



protected function addResources($sender)
{
	$rand = rand(0, 100);
	$groupKey = 'April1';
	if ($rand <= 5) $sender->addCSSFile($this->resource("apr1_trans.css"), false, $groupKey);
	else {
		$var_name = "";
		if ($rand <= 15) $var_name = "apr1_bugs1.js";
		else if ($rand <= 30) $var_name = "apr1_bugs2.js";
		else if ($rand <= 40) $var_name = "apr1_bugs3.js";
		else if ($rand <= 45) $var_name = "apr1_bugs4.js";
		else if ($rand <= 50) $var_name = "apr1_bugs5.js";
		else if ($rand <= 55) $var_name = "apr1_bugs6.js";
		if ($var_name) {
			$sender->addJSFile($this->resource("vendor/bug-min.js"), false, $groupKey);
			$sender->addJSFile($this->resource($var_name), false, $groupKey);
		}
	}
	
}


/**
 * Add an event handler to the initialization of the conversations controller to add CSS and JavaScript
 * resources.
 *
 * @return void
 */
public function handler_conversationsController_init($sender)
{
	$this->addResources($sender);
}

}
