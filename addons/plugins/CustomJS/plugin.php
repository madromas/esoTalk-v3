<?php
// Copyright 2013 ciruz
if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["CustomJS"] = array(
	"name" => "Custom JavaScript",
	"description" => "Adds Custom JavaScript Code.",
	"version" => "0.1",
	"author" => "Mandeep Singh",
	"authorEmail" => "mandeep@websterfolks.com",
	"authorURL" => "http://www.websterfolks.com",
	"license" => "MIT"
);

class ETPlugin_CustomJS extends ETPlugin{

	public function handler_init($sender){
		$CustomJS = C('plugin.CustomJS.customjscode');

		if($CustomJS)
			$CustomJSCode = "<script type=\"text/javascript\">\n".$CustomJS."\n</script>";

		$sender->addToHead($CustomJSCode);
	}

	public function settings($sender){
		$form = ETFactory::make('form');
		$form->action = URL('admin/plugins');
		$form->setValue("customjscode", C("plugin.CustomJS.customjscode"));

		if ($form->validPostBack('CustomJSSave')){
			$config = array();
			$config['plugin.CustomJS.customjscode'] = trim($form->getValue('customjscode'));

			ET::writeConfig($config);

			$sender->message(T('message.changesSaved'), 'success');
			$sender->redirect(URL('admin/plugins'));
		}

		$sender->data('CustomJSForm', $form);
		return $this->View('settings');
	}

}
