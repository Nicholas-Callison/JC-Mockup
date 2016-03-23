<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../lib' . PATH_SEPARATOR . '../template');
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Tue, 11 Oct 1988 22:00:00 GMT'); // quite a special day
header('Pragma: no-cache');

/* TODO: Make this a part of the config */
date_default_timezone_set('UTC');

include_once("DB.class.php");
include_once("version.inc.php");
include_once("confparser.inc.php");