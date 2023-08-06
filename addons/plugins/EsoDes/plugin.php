<?php
// Copyright 2015 Mustafa Bozkurt

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["EsoDes"] = array(
	"name" => "Forum Description",
	"description" => "Add simple forum description.",
	"version" => "0.1",
    "author" => "esoTalk Team",
    "authorEmail" => "5557720max@gmail.com",
    "authorURL" => "https://github.com/phpSoftware/esoTalk-v2/",
	"license" => "MIT",
	"dependencies" => array(
		"esoTalk" => "1.0.0g4"
	)
);


class ETPlugin_EsoDes extends ETPlugin {

	public function init()
	{
		ET::define("message.forumDesHelp", "You can customize view of the description via CSS.");
	}


	
	public function handler_init($sender, $menu='')
		{
			if ($forumDes = C("EsoDes.forumDes")) {
				$sender->addToMenu("main", "description", "$forumDes");
								
					}
		}	
		
		

	// Construct and process the settings form.
	public function settings($sender)
	{
		// Set up the settings form.
		$form = ETFactory::make("form");
		$form->action = URL("admin/plugins/settings/EsoDes");
		$form->setValue("forumDes", C("EsoDes.forumDes"));

		// If the form was submitted...
		if ($form->validPostBack()) {

			// Construct an array of config options to write.
			$config = array();
			$config["EsoDes.forumDes"] = $form->getValue("forumDes");

			// Write the config file.
			ET::writeConfig($config);

			$sender->message(T("message.changesSaved"), "success autoDismiss");
			$sender->redirect(URL("admin/plugins"));

		}

		$sender->data("EsoDesSettingsForm", $form);
		return $this->view("settings");
	}
	
}
