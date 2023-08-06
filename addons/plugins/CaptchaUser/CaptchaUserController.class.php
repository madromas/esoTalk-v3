<?php
// Copyright 2014 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

class CaptchaUserController extends ETController {

	protected function scriptsLocation()
	{
		return 'securimage/';
	}
	
	// Management.
	public function action_index($handler = '')
	{
		/*$php_name = 'securimage/' . $handler;
		if (preg_match("/\.php$/i", $php_name)) {
			if (is_file($php_name) && $php_name[0] !== '.') {
				require_once $php_name;
			}
		}*/
	}

	// Generate a captcha.
	public function action_generate()
	{
		$php_name = $this->scriptsLocation() . 'securimage.php';
		require_once $php_name;
		
		$options = array(
			'captcha_type' => Securimage::SI_CAPTCHA_STRING,
			'charset' => '0123456789',
			'code_length' => 6,
			'expiry_time' => 300
		);
		$img = new Securimage($options);
		$img->show();
	}

	// Play audio.
	public function action_play()
	{
		$php_name = $this->scriptsLocation() . 'securimage_play.php';
		require_once $php_name;
	}

}
