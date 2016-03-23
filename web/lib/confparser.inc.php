<?php

/**
 * Loads config file into $CONFIG
 *
 * @return void
 */
function config_load() {
    global $CONFIG;

    if (!isset($CONFIG)) {
        $CONFIG = parse_ini_file("../../pathways.conf", true, INI_SCANNER_RAW);
    }
}

/**
 * Get desired value from config file
 *
 * @param $section section of config file
 * @param $key key value of section
 *
 * @return mixed value stored under that key
 */
function config_get($section, $key) {
    global $CONFIG;
    config_load();
    return $CONFIG[$section][$key];
}

/**
 * Get desired value from config file as type boolean
 *
 * @param $section section of config file
 * @param $key key value of section
 *
 * @return bool value stored under that key
 */
function config_get_bool($section, $key) {
    $val = strtolower(config_get($section, $key));
    return ($val == 'yes' || $val == 'true' || $val == '1');
}