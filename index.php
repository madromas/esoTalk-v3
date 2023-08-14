<?php

// Copyright 2013 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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
require PATH_CORE."/bootstrap.php";
