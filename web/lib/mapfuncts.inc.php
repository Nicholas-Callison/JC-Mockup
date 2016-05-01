<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../lib' . PATH_SEPARATOR . '../template');

/**
 * Display list of programs and their different types
 * 
 * @return void
 */
function display_programs($pathway_name) {
    /* TODO: move this to their own function */
    $modified_name = preg_replace("/(_)/", ",", $pathway_name);
    $modified_name = preg_replace("/(-)/", " ", $modified_name);
    $modified_name = preg_replace("/(and)/", "&", $modified_name);
    $modified_name = ucwords($modified_name);

    html_header("Pathway - " . $modified_name);
    include "maplist.php";
    html_footer();
}

function request_start_semester($path) {
    html_header("Pathway - ");

    include "semselect.php";

    html_footer();
}