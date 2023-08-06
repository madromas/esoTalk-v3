<?php
// Copyright 2013 andrewks
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

function tzOffsetGMT($offset)
{
	$offsetHours = (int)floor(abs($offset) / 3600);
	$offsetMinutes = (int)floor((abs($offset) - $offsetHours * 3600) / 60);
	return 'GMT'.($offset < 0 ? '-' : '+') . ($offsetHours < 10 ? '0' : '') . $offsetHours.':' . ($offsetMinutes < 10 ? '0' : '') . $offsetMinutes;  
}

function tzOffset($zoneId)
{
	$tz = new DateTimeZone($zoneId);
	$dateTime = new DateTime("now", $tz);
	return $tz->getOffset($dateTime);
}

function tzTransition($zoneId)
{
	$now = time();
	$tz = new DateTimeZone($zoneId);
	$tr_list = $tz->getTransitions($now, $now);
	return $tr_list ? $tr_list[0] : $tr_list;
}

class TimeZones {
	/**
	 * An array of time zones definitions.
	 * @var array
	 */
	public static $zones = array();
	
	/**
	 * An array of language definitions.
	 * @var array
	 */
	public static $definitions = array();

	
	public static function initZones() {
	
		//self::$zones['Etc/GMT-12'] = array(); // (GMT-12:00)
		self::$zones['Pacific/Midway'] = array(); // (GMT-11:00)
		self::$zones['Pacific/Honolulu'] = array(); // (GMT-10:00)
		self::$zones['America/Adak'] = array(); // (GMT-10:00)
		self::$zones['America/Anchorage'] = array(); // (GMT-09:00)
		self::$zones['America/Los_Angeles'] = array(); // (GMT-08:00)
		self::$zones['America/Phoenix'] = array(); // (GMT-07:00)
		self::$zones['America/Denver'] = array(); // (GMT-07:00)
		self::$zones['America/Chihuahua'] = array(); // (GMT-07:00)
		self::$zones['America/Mexico_City'] = array(); // (GMT-06:00)
		self::$zones['America/Regina'] = array(); // (GMT-06:00)
		self::$zones['America/Managua'] = array(); // (GMT-06:00)
		self::$zones['America/Chicago'] = array(); // (GMT-06:00)
		self::$zones['America/Bogota'] = array(); // (GMT-05:00)
		self::$zones['America/New_York'] = array(); // (GMT-05:00)
		self::$zones['America/Indianapolis'] = array(); // (GMT-05:00)
		self::$zones['America/Halifax'] = array(); // (GMT-04:00)
		self::$zones['America/Caracas'] = array(); // (GMT-04:30)
		self::$zones['America/La_Paz'] = array(); // (GMT-04:00)
		self::$zones['America/Santiago'] = array(); // (GMT-04:00)
		self::$zones['America/St_Johns'] = array(); // (GMT-03:30)
		self::$zones['America/Godthab'] = array(); // (GMT-03:00)
		self::$zones['America/Buenos_Aires'] = array(); // (GMT-03:00)
		self::$zones['America/Sao_Paulo'] = array(); // (GMT-03:00)
		self::$zones['America/Noronha'] = array(); // (GMT-02:00)
		self::$zones['Atlantic/Azores'] = array(); // (GMT-01:00)
		self::$zones['Atlantic/Cape_Verde'] = array(); // (GMT-01:00)
		self::$zones['Europe/London'] = array(); // (GMT)
		self::$zones['Africa/Casablanca'] = array(); // (GMT)
		self::$zones['Europe/Belgrade'] = array(); // (GMT+01:00)
		self::$zones['Africa/Lagos'] = array(); // (GMT+01:00)
		self::$zones['Europe/Paris'] = array(); // (GMT+01:00)
		self::$zones['Europe/Berlin'] = array(); // (GMT+01:00)
		self::$zones['Europe/Sarajevo'] = array(); // (GMT+01:00)
		self::$zones['Asia/Jerusalem'] = array(); // (GMT+02:00)
		self::$zones['Europe/Bucharest'] = array(); // (GMT+02:00)
		self::$zones['Europe/Istanbul'] = array(); // (GMT+02:00)
		self::$zones['Africa/Johannesburg'] = array(); // (GMT+02:00)
		self::$zones['Europe/Helsinki'] = array(); // (GMT+02:00)
		self::$zones['Europe/Kiev'] = array(); // (GMT+02:00)
		self::$zones['Africa/Cairo'] = array(); // (GMT+02:00)
		self::$zones['Asia/Riyadh'] = array(); // (GMT+03:00)
		self::$zones['Asia/Baghdad'] = array(); // (GMT+03:00)
		self::$zones['Africa/Nairobi'] = array(); // (GMT+03:00)
		self::$zones['Europe/Minsk'] = array(); // (GMT+03:00)
		self::$zones['Asia/Tehran'] = array(); // (GMT+03:30)
		self::$zones['Asia/Muscat'] = array(); // (GMT+04:00)
		self::$zones['Asia/Tbilisi'] = array(); // (GMT+04:00)
		self::$zones['Europe/Moscow'] = array(); // (GMT+04:00)
		self::$zones['Asia/Kabul'] = array(); // (GMT+04:30)
		self::$zones['Asia/Aqtobe'] = array(); // (GMT+05:00)
		self::$zones['Asia/Karachi'] = array(); // (GMT+05:00)
		self::$zones['Asia/Calcutta'] = array(); // (GMT+05:30)
		self::$zones['Asia/Katmandu'] = array(); // (GMT+05:45)
		self::$zones['Asia/Dhaka'] = array(); // (GMT+06:00)
		self::$zones['Asia/Yekaterinburg'] = array(); // (GMT+06:00)
		self::$zones['Asia/Almaty'] = array(); // (GMT+06:00)
		self::$zones['Asia/Colombo'] = array(); // (GMT+06:00)
		self::$zones['Asia/Rangoon'] = array(); // (GMT+06:30)
		self::$zones['Asia/Bangkok'] = array(); // (GMT+07:00)
		self::$zones['Asia/Novosibirsk'] = array(); // (GMT+07:00)
		self::$zones['Asia/Hong_Kong'] = array(); // (GMT+08:00)
		self::$zones['Australia/Perth'] = array(); // (GMT+08:00)
		self::$zones['Asia/Krasnoyarsk'] = array(); // (GMT+08:00)
		self::$zones['Asia/Singapore'] = array(); // (GMT+08:00)
		self::$zones['Asia/Taipei'] = array(); // (GMT+08:00)
		self::$zones['Asia/Irkutsk'] = array(); // (GMT+09:00)
		self::$zones['Asia/Tokyo'] = array(); // (GMT+09:00)
		self::$zones['Asia/Seoul'] = array(); // (GMT+09:00)
		self::$zones['Australia/Darwin'] = array(); // (GMT+09:30)
		self::$zones['Australia/Adelaide'] = array(); // (GMT+09:30)
		self::$zones['Australia/Brisbane'] = array(); // (GMT+10:00)
		self::$zones['Pacific/Guam'] = array(); // (GMT+10:00)
		self::$zones['Asia/Yakutsk'] = array(); // (GMT+10:00)
		self::$zones['Australia/Hobart'] = array(); // (GMT+10:00)
		self::$zones['Australia/Sydney'] = array(); // (GMT+10:00)
		self::$zones['Asia/Vladivostok'] = array(); // (GMT+11:00)
		self::$zones['Asia/Magadan'] = array(); // (GMT+12:00)
		self::$zones['Pacific/Fiji'] = array(); // (GMT+12:00)
		self::$zones['Pacific/Auckland'] = array(); // (GMT+12:00)
		self::$zones['Pacific/Tongatapu'] = array(); // (GMT+13:00)
		self::$zones['Pacific/Samoa'] = array(); // (GMT+13:00)
		self::$zones['Pacific/Majuro'] = array(); // (GMT+12:00)
		
		foreach (self::$zones as $zoneId => $zoneVal) {
			$tz = new DateTimeZone($zoneId);
			$dateTime = new DateTime("now", $tz);
			$now = time();
			$tr_list = $tz->getTransitions($now, $now);
			$tr_list = $tr_list ? $tr_list[0] : $tr_list;
			self::$zones[$zoneId] = array('offset' => $tz->getOffset($dateTime), 'isdst' => $tr_list ? $tr_list['isdst'] : false,'location' => $tz->getLocation());
		}
	}
	
	public static function getZones()
	{
		return self::$zones;
	}

	public static function translate($string)
	{
		$keystr = 'plugin.TimeZones.zone.' . $string;
		return ET::translate($keystr, $string);
	}
	
}

TimeZones::initZones();