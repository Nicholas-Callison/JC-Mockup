<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../lib');

$path = $_SERVER['PATH_INFO'];
$tokens = explode('/', $path);

/*
 * If maintenance mode is enabled in the conf, make sure that unauthorized users cannot access
 */
if (config_get_bool('options', 'maintenance') && (empty($tokens))) {
    if (!in_array($_SERVER['REMOTE_ADDR'], explode(" ", config_get('options', 'maintenance-exceptions')))) {
        header("HTTP/1.0 503 Service Unavailable");
        include "./503.php";
        return;
    }
}

/* TODO: Write crap here for what page should be displayed based on URL */