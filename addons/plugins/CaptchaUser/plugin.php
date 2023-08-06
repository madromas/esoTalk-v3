<?php
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.
// Uses: Securimage http://www.phpcaptcha.org/

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["CaptchaUser"] = array(
	"name" => "CaptchaUser",
	"description" => "Add Captcha to 'user' controller.",
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
 * CaptchaUser Plugin
 *
 * Add Captcha to 'user' controller.
 */
class ETPlugin_CaptchaUser extends ETPlugin {

	protected function scriptsLocation()
	{
		return 'securimage/';
	}

	protected function resourcesURL()
	{
		return str_replace('\\', '/', getResource(pathinfo(__FILE__, PATHINFO_DIRNAME) . "/")) . 'securimage';
	}

	// Setup: create the tables in the database.
	public function setup($oldVersion = "")
	{

		return true;
	}


	// Register model/controller.
	public function __construct($rootDirectory)
	{
		parent::__construct($rootDirectory);
		ETFactory::registerController("captcha", "CaptchaUserController", dirname(__FILE__)."/CaptchaUserController.class.php");
	}


	protected function addResources($sender)
	{
		$groupKey = 'CaptchaUser';
		
	}


	/**
	 * Add an event handler to the initialization of the controller to add CSS and JavaScript
	 * resources.
	 *
	 * @return void
	 */

	public function handler_userController_init($sender)
	{
		$this->addResources($sender);
	}

	public function handler_userController_renderView($sender, $view, &$content, $data)
	{
		if ((C("plugin.CaptchaUser.joinSheet") && $view == 'user/join') || (C("plugin.CaptchaUser.forgotSheet") && $view == 'user/forgot')) {
			$data['captchaResURL'] = $this->resourcesURL();
			$captcha = $sender->getViewContents($this->view("captcha"), $data);
			$content = preg_replace("/<ul class='form'>(.*?)(?=<\/ul>)/si", "$0\n$captcha\n", $content);
		}
	}

	protected function checkCaptcha(&$form)
	{
		$php_name = $this->scriptsLocation() . 'securimage.php';
		require_once $php_name;
		
		$img = new Securimage();
		$img->check($form->getValue("captcha"));
		if (!$img->correct_code) {
			$form->error("captcha", T("plugin.CaptchaUser.message.wrongCode"));
		}
	}
	
	public function handler_userController_joinValidPostBack($sender, &$form)
	{
		if (C("plugin.CaptchaUser.joinSheet")) $this->checkCaptcha($form);
	}

	public function handler_userController_forgotValidPostBack($sender, &$form)
	{
		if (C("plugin.CaptchaUser.forgotSheet")) $this->checkCaptcha($form);
	}
	
	// Construct and process the settings form.
	public function settings($sender)
	{
		// Set up the settings form.
		$form = ETFactory::make("form");
		$form->action = URL("admin/plugins/settings/CaptchaUser");
		$form->setValue("joinSheet", C("plugin.CaptchaUser.joinSheet"));
		$form->setValue("forgotSheet", C("plugin.CaptchaUser.forgotSheet"));

		// If the form was submitted...
		if ($form->validPostBack("captchaUserSave")) {

			// Construct an array of config options to write.
			$config = array();
			$config["plugin.CaptchaUser.joinSheet"] = $form->getValue("joinSheet");
			$config["plugin.CaptchaUser.forgotSheet"] = $form->getValue("forgotSheet");

			if (!$form->errorCount()) {

				// Write the config file.
				ET::writeConfig($config);

				$sender->message(T("message.changesSaved"), "success autoDismiss");
				$sender->redirect(URL("admin/plugins"));

			}
		}

		$sender->data("captchaUserSettingsForm", $form);
		return $this->view("settings");
	}

}
