<?php
// Copyright 2013 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

require_once 'timezones.class.php';

ET::$pluginInfo["TimeZones"] = array(
	"name" => "Time Zones",
	"description" => "Add Time Zone support.",
	"version" => ESOTALK_VERSION,
	"author" => "andrewks",
	"authorEmail" => "forum330@gmail.com",
	"authorURL" => "http://forum330.com",
	"license" => "GPLv2"
);

class ETPlugin_TimeZones extends ETPlugin {

	public static function getZoneDescription($zoneId, $zoneVal = false)
	{
		if ($zoneVal) $offset = $zoneVal['offset']; else $offset = tzOffset($zoneId);
		if ($zoneVal) $isdst = $zoneVal['isdst']; else { $tr_list = tzTransition($zoneId); $isdst = $tr_list ? $tr_list['isdst'] : false; }
		
		return '(' . tzOffsetGMT($offset) . ($isdst ? ' DST' : '') . ') ' . TimeZones::translate($zoneId);
	}
	
	public function handler_init()
	{
		$tz = ET::$session->preference("timeZone");
		if ($tz == 'none') $tz = false;
		if ($tz) {
			date_default_timezone_set($tz);
		}
	}
	
	public function handler_settingsController_initGeneral($sender, $form)
	{
		
		$pos = array('after' => 'language');
		$form->addSection("timeZone", T("plugin.TimeZones.timeZone.label"), $pos);
		$tz = ET::$session->preference("timeZone");
		if (!$tz) $tz = 'none';
		$form->setValue("timeZone", $tz);
		$form->addField("timeZone", "timeZone", array(__CLASS__, "fieldTimeZone"), array(__CLASS__, "saveTimeZone"));
		
	}

	public static function cmpGMT($z1, $z2)
	{
		if ($z1 == $z2) {
			return 0;
		}
		$z1plus = preg_match('/(?i)GMT\+.+/', $z1);
		$z2plus = preg_match('/(?i)GMT\+.+/', $z2);
		if ($z1plus && $z2plus) {
			return ($z1 < $z2) ? -1 : 1;
		} else
		if (!$z1plus && !$z2plus) {
			return ($z1 > $z2) ? -1 : 1;
		} else {
			return ($z1plus < $z2plus) ? -1 : 1;
		}
	}
	
	public static function fieldTimeZone($form)
	{
		$options = array();
		foreach (TimeZones::getZones() as $zoneId => $zoneVal) $options[$zoneId] = self::getZoneDescription($zoneId, $zoneVal);
		uasort($options, 'self::cmpGMT');
		$options = array_merge(array('none' => T('plugin.TimeZones.none')), $options);
		
		return $form->select("timeZone", $options)."<br><small>".T("plugin.TimeZones.timeZone.desc")."</small>";;
	}

	public static function saveTimeZone($form, $key, &$preferences)
	{
		$timeZone = $form->getValue($key);
		if (!array_key_exists($timeZone, TimeZones::getZones())) $timeZone = null;
		$preferences["timeZone"] = $timeZone;
		
	}

}
