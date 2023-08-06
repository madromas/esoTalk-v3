<?php

if (!defined("IN_ESOTALK")) exit;

/**
 * DefaultRTL skin file.
 */

ET::$skinInfo["DefaultRTL"] = array(
	"name" => "DefaultRTL",
	"description" => "RTL skin.",
	"version" => "1.0.0",
	"author" => "Ammar Alakkad",
	"authorEmail" => "am.alakkad@gmail.com",
	"authorURL" => "https://aalakkad.github.io",
	"license" => "MIT"
);

class ETSkin_DefaultRTL extends ETSkin {


/**
 * Initialize the skin.
 *
 * @param ETController $sender The page controller.
 * @return void
 */
public function handler_init($sender)
{
	$sender->addCSSFile((C("esoTalk.https") ? "https" : "http")."://fonts.googleapis.com/earlyaccess/droidarabickufi.css");
	$sender->addCSSFile("core/skin/base.css", true);
	$sender->addCSSFile("core/skin/font-awesome.css", true);
    $sender->addCSSFile($this->resource("styles.css"), true);
	$sender->addCSSFile($this->resource("rtl.css"), true);

    // Default view, copied from core/views
	$sender->masterView = "default.master";
    // If we're viewing from a mobile browser, add the mobile CSS and change the master view.
    if ($isMobile = isMobileBrowser()) {
        $sender->addCSSFile($this->resource("mobile.css"), true);
        $sender->masterView = "mobile.master";
		$sender->addToHead("<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0'>");
	}

	$sender->addCSSFile("config/colors.css", true);

	if (!C("skin.DefaultRTL.primaryColor")) $this->writeColors("#364159");
}


/**
 * Write the skin's color configuration and CSS.
 *
 * @param string $primary The primary color.
 * @return void
 */
protected function writeColors($primary)
{
	ET::writeConfig(array("skin.DefaultRTL.primaryColor" => $primary));

	$rgb = colorUnpack($primary, true);
	$hsl = rgb2hsl($rgb);

	$primary = colorPack(hsl2rgb($hsl), true);

	$hsl[1] = max(0, $hsl[1] - 0.3);
	$secondary = colorPack(hsl2rgb(array(2 => 0.6) + $hsl), true);
	$tertiary = colorPack(hsl2rgb(array(2 => 0.92) + $hsl), true);

	$css = file_get_contents($this->resource("colors.css"));
	$css = str_replace(array("{primary}", "{secondary}", "{tertiary}"), array($primary, $secondary, $tertiary), $css);
	file_put_contents(PATH_CONFIG."/colors.css", $css);
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
	$form->setValue("primaryColor", C("skin.DefaultRTL.primaryColor"));

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
