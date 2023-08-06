<?php

// INI
define("IN_ESOTALK", 1);
define("PAGE_START_TIME", microtime(true));
define("PATH_ROOT", dirname(__FILE__));
define("PATH_CORE", PATH_ROOT."/core");
define("PATH_CACHE", PATH_ROOT."/cache");
define("PATH_CONFIG", PATH_ROOT."/config");
define("PATH_LANGUAGES", PATH_ROOT."/addons/languages");
define("PATH_PLUGINS", PATH_ROOT."/addons/plugins");
define("PATH_SKINS", PATH_ROOT."/addons/skins");
define("PATH_UPLOADS", PATH_ROOT."/uploads");
if (ini_get("date.timezone") == "") date_default_timezone_set("GMT");
if (!defined("PATH_CONTROLLERS")) define("PATH_CONTROLLERS", PATH_CORE."/controllers");
if (!defined("PATH_LIBRARY")) define("PATH_LIBRARY", PATH_CORE."/lib");
if (!defined("PATH_MODELS")) define("PATH_MODELS", PATH_CORE."/models");
if (!defined("PATH_VIEWS")) define("PATH_VIEWS", PATH_CORE."/views");

// INCLUDE
require PATH_LIBRARY."/functions.general.php";
require PATH_LIBRARY."/ET.class.php";

// SETTINGS
ET::loadConfig(PATH_CORE."/config.defaults.php");
if (PATH_CONFIG != PATH_ROOT."/config" and file_exists($file = PATH_ROOT."/config/config.php")) ET::loadConfig($file);
if (file_exists($file = PATH_CONFIG."/config.php")) ET::loadConfig($file);
if (C("esoTalk.debug")) error_reporting(E_ALL & ~E_STRICT);
ET::loadLanguage(C("esoTalk.language"));


// SEND TEST MAIL
$type = 'confirmEmail';
#$type = 'approved';
#$type = 'forgotPassword';
#/*
if(sendEmail(
    'internmail@gmail.com', 
    sprintf( T("email.".$type.".subject"), 'Max Mustermann' ),
    sprintf( T("email.".$type.".body"), C("esoTalk.forumTitle"), C("esoTalk.baseURL").'user/login' ), 
    C("esoTalk.baseURL").'user/login',
    TRUE)
)echo '<h1><tt>OK '.time();else echo '<h1><tt>ERROR';
#*/

// SEND TEST MAIL
$type = 'mention';
$type = 'privateAdd';
$type = 'post';
if(sendEmail(
    'internmail@gmail.com', 
    sprintf( T("email.".$type.".subject"), 'Max Mustermann', 'WTF' ),
    sprintf( T("email.".$type.".body"), C("esoTalk.forumTitle"), C("esoTalk.baseURL").'user/login', 'WTF' ), 
    C("esoTalk.baseURL").'user/login',
    TRUE)
)echo '<h1><tt>OK '.time();else echo '<h1><tt>ERROR';
