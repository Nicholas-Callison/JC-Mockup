<?php

/*
 * This is if you're using apache and you want to use mod_rewrite to make "pretty" URLs.
 *
 * Please use the statements in the sample.htaccess in conf/ in your .htaccess in this
 * directory. You will also want to modify the location key under [options] in conf/pathways.conf.
 */

$_SERVER['PATH_INFO'] = !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : $_SERVER['REDIRECT_ORIGINAL_PATH'];