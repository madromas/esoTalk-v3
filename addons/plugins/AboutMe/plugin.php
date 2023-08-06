<?php
// Copyright 2013 Toby Zerner, Simon Zerner
// Copyright 2013 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

define("ABOUT_DATE_PATTERN", "(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/(19|20)\d\d");

ET::$pluginInfo["AboutMe"] = array(
	"name" => "About Me",
	"description" => "Adds a simple 'About Me' section to user profiles.",
	"version" => ESOTALK_VERSION,
	"author" => "Toby Zerner",
	"authorEmail" => "support@esotalk.org",
	"authorURL" => "http://esotalk.org",
	"license" => "GPLv2",
	"dependencies" => array(
		"esoTalk" => "1.0.0g4"
	)
);

class ETPlugin_AboutMe extends ETPlugin {

	public function handler_memberController_initProfile($sender, $member, $panes, $controls, $actions)
	{
		$panes->add("about", "<a href='".URL(memberURL($member["memberId"], $member["username"], "about"))."'>".T("plugin.AboutMe.about.label")."</a>", 0);
	}

	public function action_memberController_index($sender, $member = "")
	{
		$this->action_memberController_about($sender, $member);
	}

	public function action_memberController_about($sender, $member = "")
	{
		if (!($member = $sender->profile($member, "about"))) return;

		$about = @$member["preferences"]["about"];
		$about = ET::formatter()->init($about)->format()->get();
		$sender->data("about", $about);
		
		$sender->data("name", sanitizeHTML(@$member["preferences"]["about_name"]));
		switch (@$member["preferences"]["about_sex"]) {
			case "m": $sender->data("sex", sanitizeHTML(T("plugin.AboutMe.sex.male"))); break;
			case "f": $sender->data("sex", sanitizeHTML(T("plugin.AboutMe.sex.female"))); break;
			default: $sender->data("sex", "");
		}
		$sender->data("birthday", sanitizeHTML(@$member["preferences"]["about_birthday"]));
		$sender->data("location", sanitizeHTML(@$member["preferences"]["about_location"]));
		$sender->data("email", sanitizeHTML(@$member["preferences"]["about_email"]));
		$sender->data("icq", sanitizeHTML(@$member["preferences"]["about_icq"]));
		$sender->data("url", sanitizeHTML(@$member["preferences"]["about_url"]));
		if (array_key_exists("TimeZones", ET::$plugins)) {
			$tz_id = @$member["preferences"]["timeZone"];
			if ($tz_id == 'none') $tz_id = null;
			
			if ($tz_id) {
				$tz = new DateTimeZone($tz_id);
				$dateTime = new DateTime("now", $tz);
				$local_time = $dateTime->format('Y-m-d H:i:s');
				
				$sender->data("timeZone", sanitizeHTML(ETPlugin_TimeZones::getZoneDescription($tz_id)));
				$sender->data("localTime", sanitizeHTML($local_time));
			}
			
		}
		
		if (ET::$session->user) $sender->addJSLanguage("Controls");
		$sender->renderProfile($this->view("about"));
	}

	public function handler_settingsController_initGeneral($sender, $form)
	{
		
		$pos = 1;
		$form->addSection("section_name-no-sep", T("plugin.AboutMe.name.label"), $pos++);
		$form->setValue("about_name", ET::$session->preference("about_name"));
		$form->addField("section_name-no-sep", "about_name", array(__CLASS__, "fieldName"), array($sender, "savePreference"));
		
		$form->addSection("section_sex-no-sep", T("plugin.AboutMe.sex.label"), $pos++);
		$form->setValue("about_sex", ET::$session->preference("about_sex"));
		$form->addField("section_sex-no-sep", "about_sex", array(__CLASS__, "fieldSex"), array($sender, "savePreference"));
		
		$form->addSection("section_birthday-no-sep", T("plugin.AboutMe.birthday.label"), $pos++);
		$form->setValue("about_birthday", ET::$session->preference("about_birthday"));
		$form->addField("section_birthday-no-sep", "about_birthday", array(__CLASS__, "fieldBirthday"), array(__CLASS__, "saveDatePreference"));
		
		$form->addSection("section_location-no-sep", T("plugin.AboutMe.location.label"), $pos++);
		$form->setValue("about_location", ET::$session->preference("about_location"));
		$form->addField("section_location-no-sep", "about_location", array(__CLASS__, "fieldLocation"), array($sender, "savePreference"));
		
		$form->addSection("section_email-no-sep", T("plugin.AboutMe.email.label"), $pos++);
		$form->setValue("about_email", ET::$session->preference("about_email"));
		$form->addField("section_email-no-sep", "about_email", array(__CLASS__, "fieldEmail"), array($sender, "savePreference"));
		
		$form->addSection("section_icq-no-sep", T("plugin.AboutMe.icq.label"), $pos++);
		$form->setValue("about_icq", ET::$session->preference("about_icq"));
		$form->addField("section_icq-no-sep", "about_icq", array(__CLASS__, "fieldICQ"), array($sender, "savePreference"));
		
		$form->addSection("section_url-no-sep", T("plugin.AboutMe.url.label"), $pos++);
		$form->setValue("about_url", ET::$session->preference("about_url"));
		$form->addField("section_url-no-sep", "about_url", array(__CLASS__, "fieldURL"), array($sender, "savePreference"));
		
		$form->addSection("about", T("plugin.AboutMe.about.label"), $pos++);
		$form->setValue("about", ET::$session->preference("about"));
		$form->addField("about", "about", array(__CLASS__, "fieldAbout"), array($sender, "savePreference"));
		
	}

	public static function fieldAbout($form)
	{
		return $form->input("about", "textarea", array("style" => "width:500px; height:150px"))."<br><small>".T("plugin.AboutMe.about.desc")."</small>";
	}

	public static function fieldName($form)
	{
		return $form->input("about_name", "text");
	}
	
	public static function fieldSex($form)
	{
		return "<table><tr><td><label>".$form->radio("about_sex", "m").T("plugin.AboutMe.sex.male")."</label></td><td style='width:10px'></td><td><label>".$form->radio("about_sex", "f").T("plugin.AboutMe.sex.female")."</label></td></tr></table>";
	}
	
	public static function fieldBirthday($form)
	{
		return $form->input("about_birthday", "text", array("pattern" => ABOUT_DATE_PATTERN, "title" => T("plugin.AboutMe.birthday.desc")));
	}
	
	public static function fieldLocation($form)
	{
		return $form->input("about_location", "text");
	}
	
	public static function fieldEmail($form)
	{
		return $form->input("about_email", "email");
	}
	
	public static function fieldICQ($form)
	{
		return $form->input("about_icq", "text");
	}
	
	public static function fieldURL($form)
	{
		return $form->input("about_url", "text");
	}
	
	public static function saveDatePreference($form, $key, &$preferences)
	{
		$val = $form->getValue($key);
		$valid = false;
		if (empty($val)) {
			$preferences[$key] = "";
			$valid = true;
		} else
		if (preg_match("/^".addcslashes(ABOUT_DATE_PATTERN, "/")."$/", $val)) {
			$dt = explode('/', $val);
			if (checkdate($dt[1], $dt[0], $dt[2])) {
				$preferences[$key] = $val;
				$valid = true;
			}
		}
		
		if (!$valid) {
			$form->error("about_birthday", T("plugin.AboutMe.birthday.desc"));
		}
		
	}

}
