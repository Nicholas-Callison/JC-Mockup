<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../lib');

include_once("pathways.inc.php");

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

if (get_route($path) !== NULL){
    include get_route($path);
} else {

    /*
     * This is for serving static files (images, css, javascript, pdf, etc)
     *
     * There is a certain format that needs to be used and it is as follows...
     *
     * case "filename.ext":
     *     header("Content-Type: mime/type");
     *     readfile("./$path");
     *     break;
     */
    switch ($path) {
        default:
            header("HTTP/1.0 404 Not Found");
            include "./404.php";
            break;
    }
}