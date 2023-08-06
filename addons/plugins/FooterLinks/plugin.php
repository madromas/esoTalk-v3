<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["FooterLinks"] = array(
	"name" => "FooterLinks",
	"description" => "Adds links to footer.",
	"version" => ESOTALK_VERSION,
	"author" => "MadRomas",
	"authorEmail" => "madromas@yahoo.com",
	"authorURL" => "https://madway.net",
	"license" => "GPLv2"
);


/**
 * Debug Plugin
 *
 * Shows useful debugging information, such as SQL queries, to administrators.
 */
class ETPlugin_FooterLinks extends ETPlugin {

/**
 * On all controller initializations, add the debug CSS file to the page.
 *
 * @return void
 */
public function handler_init($sender)
{
	
	$sender->addToMenu("meta", "madway", "<a href='http://madway.net'>".T("MADWAY")."</a>");

}

}