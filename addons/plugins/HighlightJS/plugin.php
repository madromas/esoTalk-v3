<?php
// Copyright 2015 Andrew Bagshaw
if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["HighlightJS"] = array(
	"name" => "HighlightJS Script",
	"description" => "Adds code highlighting to discussions.",
	"version" => "0.1",
	"author" => "Andrew Bagshaw",
	"authorEmail" => "",
	"authorURL" => "",
	"license" => "MIT"
);

class ETPlugin_HighlightJS extends ETPlugin{

	public function handler_conversationController_init($sender){
		$HighlightJS = C('plugin.HighlightJS.customstyle');

		if($HighlightJS)
			$CustomHighlightCSS= "<link rel=\"stylesheet\" href=\"//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.0/styles/".$HighlightJS.".min.css\">";
		else
			$CustomHighlightCSS= "<link rel=\"stylesheet\" href=\"//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.0/styles/default.min.css\">";
			
		$JSHeader = "<script src=\"//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.0/highlight.min.js\"></script>";
		
		$codeToRun = "<script type=\"text/javascript\">$(document).ready(function() { $('pre').each(function(i, block) { hljs.highlightBlock(block); });});</script>";

		$sender->addToHead($CustomHighlightCSS);
		$sender->addToHead($JSHeader);
		$sender->addJSFile($this->resource("highlightactions.js"));
	}
	public function handler_conversationController_editPostAfter($sender)
	{
	
	}

	public function settings($sender){
		$form = ETFactory::make('form');
		$form->action = URL('admin/plugins/settings/HighlightJS');
		$form->setValue("customstyle", C("plugin.HighlightJS.customstyle"));

		if ($form->validPostBack('HighlightJSSave')){
			$config = array();
			$config['plugin.HighlightJS.customstyle'] = trim($form->getValue('customstyle'));

			ET::writeConfig($config);

			$sender->message(T('message.changesSaved'), 'success autoDismiss');
			$sender->redirect(URL('admin/plugins'));
		}

		$sender->data('HighlightJSForm', $form);
		return $this->View('settings');
	}

}
