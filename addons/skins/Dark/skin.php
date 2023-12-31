<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Dark skin file.
 * 
 * @package esoTalk
 */

ET::$skinInfo["Dark"] = array(
	"name" => "Dark",
	"description" => "The Dark esoTalk skin.",
	"version" => ESOTALK_VERSION,
	"author" => "MadRomas",
	"authorEmail" => "madromas@yahoo.com",
	"authorURL" => "https://madway.net",
	"license" => "GPLv2"
);

class ETSkin_Dark extends ETSkin {

/**
 * Initialize the skin.
 * 
 * @param ETController $sender The page controller.
 * @return void
 */
public function handler_init($sender)
{
	$sender->addCSSFile((C("esoTalk.https") ? "https" : "http")."://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500&display=swap");
	$sender->addCSSFile("core/skin/base.css", true);
	$sender->addCSSFile("core/skin/font-awesome.css", true);
	$sender->addCSSFile($this->resource("styles.css"), true);
	$sender->addCSSFile($this->resource("styles-dark.css"), true);

	// If we're viewing from a mobile browser, add the mobile CSS and change the master view.
	if ($isMobile = isMobileBrowser()) {
		$sender->addCSSFile($this->resource("mobile.css"), true);
		$sender->masterView = "mobile.master";
		$sender->addToHead("<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0'>");
		$sender->addToHead("<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.15.4/css/all.css'>");
		$sender->addToHead("<link rel='manifest' href='http://madway.net/manifest.json'>");
		$sender->addToHead("<link rel='shortcut icon' href='../favicon.png' />");
	}
	
	if (!C("skin.Dark.primaryColor")) $this->writeColors("#364159");
}


/**
 * Write the skin's color configuration and CSS.
 * 
 * @param string $primary The primary color.
 * @return void
 */
protected function writeColors($primary)
{
	ET::writeConfig(array("skin.Dark.primaryColor" => $primary));

	$rgb = colorUnpack($primary, true);
	$hsl = rgb2hsl($rgb);

	$primary = colorPack(hsl2rgb($hsl), true);

	$hsl[1] = max(0, $hsl[1] - 0.3);
	$secondary = colorPack(hsl2rgb(array(2 => 0.6) + $hsl), true);
	$tertiary = colorPack(hsl2rgb(array(2 => 0.92) + $hsl), true);

	
	$css = str_replace(array("{primary}", "{secondary}", "{tertiary}"), array($primary, $secondary, $tertiary), $css);
	       
}


/**
 * Construct and process the settings form for this skin, and return the path to the view that should be 
 * rendered.
 * 
 * @param ETController $sender The page controller.
 * @return string The path to the settings view to render.
 */
public function settings($sender)
{
	// Set up the settings form.
	$form = ETFactory::make("form");
	$form->action = URL("admin/appearance");
	$form->setValue("primaryColor", C("skin.Dark.primaryColor"));

	// If the form was submitted...
	if ($form->validPostBack("save")) {
		$this->writeColors($form->getValue("primaryColor"));

		$sender->message(T("message.changesSaved"), "success autoDismiss");
		$sender->redirect(URL("admin/appearance"));
	}

	$sender->data("skinSettingsForm", $form);
	$sender->addJSFile("core/js/lib/farbtastic.js");
	return $this->view("settings");
}


}
