<?php
// Copyright 2013 ciruz
if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["Honeypot"] = array(
	"name" => "Honeypot",
	"description" => "Spam prevention with invisible form fields.",
	"version" => "1.1",
	"author" => "ciruz",
	"authorEmail" => "me@ciruz.net",
	"authorURL" => "http://www.ciruz.net",
	"license" => "MIT"
);

class ETPlugin_Honeypot extends ETPlugin {

        public function handler_renderBefore($sender)
        {

		// Hide first input with css, set second & third input to small (document ready isn't always as fast as users eye).
		$css = '<style type="text/css">.form > li.etphp1{display:none;}.form > li.etphp2,.form > li.etphp3{height:1px;}</style>';
	       	$sender->addToHead($css);

	       	// Hide second & third input with JS.
	       	$js = '<script>$(document).ready(function(){ $(".etphp2,.etphp3").css("display", "none"); });</script>';
	       	$sender->addToHead($js);
        }

        // Hook into the join function to include the Honeypot form.
        public function handler_userController_initJoin($controller, $form)
        {
         	// Add the Honeypot section.
        	$form->addSection("honeypot");

         	// Add the Honeypot field.
        	$form->addField("honeypot", "honeypot", array($this, "renderHonepotField"), array($this, "processHoneypotField"));
	}

        function renderHonepotField($form)
        {
                // Format the Honeypot form with some HTML
                return "<li class='etphp1'><label>".T('Zip Code')."</label> ".$form->input('zipcode', 'input')."</li>
			<li class='etphp2'><label>".T('Phone')."</label> ".$form->input('phone', 'input', array('value' => ET::$session->get('securityHash')))."</li>
			<li class='etphp3'><label>".T('Homepage')."</label> ".$form->input('homepage', 'input')."</li>";
        }

        function processHoneypotField($form, $key, &$data)
        {
		if($form->getValue('zipcode') != '' || ($form->getValue('phone') != ET::$session->get('securityHash')) || $form->getValue('homepage') != '')
		{
			// If one of these form fiels has a value redirect them back to the index
			redirect("/");
		}
        }
}
