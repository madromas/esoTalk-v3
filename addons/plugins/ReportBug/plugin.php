<?php

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["ReportBug"] = array(
	"name" => "Report Bug",
	"description" => "Adds a 'Report Bug' email link to the footer.",
	"version" => ESOTALK_VERSION,
	"author" => "felli",
	"authorEmail" => "fell-sama@asia.com",
	"authorURL" => "https://www.dreamhearth.tv/member/37-felli",
	"license" => "MIT"
);


/**
 * Report Bug Plugin
 *
 * Allows members or guests to report bugs or issues via email.
 */
 
class ETPlugin_ReportBug extends ETPlugin {

public function handler_init($sender)
{
	$sender->addToMenu("meta", "reportBug", "<a href='mailto:madwaynet@gmail.com' target='_top'>".T("Contact Us")."</a>");
}

}
