<?php
// Copyright 2014 Toby Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["GoogleAnalytics"] = array(
	"name" => "Google Analytics",
	"description" => "Adds a Google Analytics tracking script to every page.",
	"version" => ESOTALK_VERSION,
	"author" => "esoTalk Team",
	"authorEmail" => "support@esotalk.org",
	"authorURL" => "http://esotalk.org",
	"license" => "GPLv2",
	"dependencies" => array(
		"esoTalk" => "1.0.0g5"
	)
);


class ETPlugin_GoogleAnalytics extends ETPlugin {

	public function init()
	{
		ET::define("message.trackingIdHelp", "Get your Measurement Id by going into the <em>Administration</em> section for your Google Analytics Property. Select <em>Data Stream</em> and <em>Your custom Stream name</em>.");
	}

	/**
	 * Add the Google Analytics tracking code to the <head> of every page.
	 *
	 * @return void
	 */
	public function handler_init($sender)
	{
		if ($trackingId = C("GoogleAnalytics.trackingId")) {
			$sender->addToHead("<script async src='https://www.googletagmanager.com/gtag/js?id=$trackingId'></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '$trackingId');
</script>");
		}
	}

// Construct and process the settings form.
	public function settings($sender)
	{
		// Set up the settings form.
		$form = ETFactory::make("form");
		$form->action = URL("admin/plugins/settings/GoogleAnalytics");
		$form->setValue("trackingId", C("GoogleAnalytics.trackingId"));

		// If the form was submitted...
		if ($form->validPostBack()) {

			// Construct an array of config options to write.
			$config = array();
			$config["GoogleAnalytics.trackingId"] = $form->getValue("trackingId");

			// Write the config file.
			ET::writeConfig($config);

			$sender->message(T("message.changesSaved"), "success autoDismiss");
			$sender->redirect(URL("admin/plugins"));

		}

		$sender->data("googleAnalyticsSettingsForm", $form);
		return $this->view("settings");
	}

}
