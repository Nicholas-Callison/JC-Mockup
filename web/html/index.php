<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../lib');

include_once("pathways.inc.php");

if (isset($_SERVER['PATH_INFO'])) {
    $path = $_SERVER['PATH_INFO'];
    $tokens = explode('/', $path);
} else {
    $path = '/';
    $tokens = explode('/', $path);
}

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

if (!empty($tokens[1]) && '/' . $tokens[1] == get_pathway_route()) {
    if (empty($tokens[2])) {
        header("Location: " . get_uri('/', true));
    }

    display_programs($tokens[2]);
} else if (!empty($tokens[1]) && '/' . $tokens[1] == get_program_path()) {
    if (empty($tokens[2])) {
        header("Location: " . get_uri('/', true));
    }
    if (empty($tokens[3])) {
        /* TODO: Make this ask which one */
        header("Location: " . get_uri('/', true));
    }
    if (empty($tokens[4])) {
        request_start_semester($path);
        return;
    }
    display_full_map("");

} else if (get_route($path) !== NULL){
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
        case "/css/custom.css":
        case "/css/fonts.css":
        case "/css/header.css":
        case "/css/jc-css.css":
        case "/css/search.css":
            header("Content-Type: text/css");
            readfile("./$path");
            break;
        case "/images/headerlogo.png":
            header("Content-Type: image/png");
            readfile("./$path");
            break;
        default:
            header("HTTP/1.0 404 Not Found");
            include "./404.php";
            break;
    }
}