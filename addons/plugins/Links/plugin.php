<?php

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["Links"] = array(
	"name" => "Links",
	"description" => "Adds internal or external links to the footer and header",
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
class ETPlugin_Links extends ETPlugin {

/**
 * On all controller initializations, add the debug CSS file to the page.
 *
 * @return void
 */
public function handler_init($sender)
{

// Type of a manu placement = "user", "statistics" or "meta". Add  'top' at the and to make it appear first inline.

$sender->addToMenu("user", "Links", '<a href="https://madway.net/conversations/off-topic" target="_self">Chat</a>');

}

}