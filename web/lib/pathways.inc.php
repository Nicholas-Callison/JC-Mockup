<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../lib' . PATH_SEPARATOR . '../template');
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sun, 02 Jul 1995 20:00:00 GMT');
header('Pragma: no-cache');

/* TODO: Make this a part of the config */
date_default_timezone_set('UTC');

include_once("DB.class.php");
include_once("version.inc.php");
include_once("confparser.inc.php");
include_once("routing.inc.php");
include_once("account.inc.php");
include_once("permissions.inc.php");

/**
 * Check if viewer is logged in via a cookie
 * 
 * @global $_COOKIE array User cookie
 * 
 * @return void
 */
function check_sid() {
    global $_COOKIE;
    
    if (isset($COOKIE['PSID'])) {
        $fail = 0;
        $timeout = config_get_int('options', 'login_timeout');

        $dbh = DB::connect();
        $q = "SELECT ts, UNIX_TIMESTAMP() FROM Sessions ";
        $q.= "WHERE sid = " . $dbh->quote($_COOKIE["PSID"]);
        $result = $dbh->query($q);
        $row = $result->fetch(PDO::FETCH_NUM);

        if (!$row[0]) {
            $fail = 1;
        } else {
            $last_update = $row[0];
            if ($last_update + $timeout <= $row[1]) {
                $fail = 2;
            }
        }

        if ($fail == 1) {
            setcookie("PSID", "", 1, "/", null, !empty($_SERVER['HTTPS']), true);
            unset($_COOKIE["PSID"]);
        } elseif ($fail == 2) {
            del_session_id($_COOKIE["PSID"]);
            setcookie("PSID", "", 1, "/", null, !empty($_SERVER['HTTPS']), true);
            unset($_COOKIE["PSID"]);
        } else {
            if ($last_update < time() + $timeout) {
                $q = "UPDATE Sessions SET ts = UNIX_TIMESTAMP() ";
                $q.= "WHERE sid = " . $dbh->quote($_COOKIE["PSID"]);
                $dbh->exec($q);
            }
        }
    }

    return;
}

/**
 * Determine a user's id based on username
 *
 * @param $username string User's username
 *
 * @return int User's id or 0 on failure
 */
function uid_from_username($username="") {
    if (!$username) {
        return 0;
    }

    $dbh = DB::connect();
    $q = "SELECT Users.id ";
    $q.= "FROM Users ";
    $q.= "WHERE Users.username = " . $dbh->quote($username);
    $result = $dbh->query($q);

    if (!$result) {
        return 0;
    }

    $row = $result->fetch(PDO::FETCH_NUM);
    return $row[0];
}

/**
 * Determine a user's id from a session id
 *
 * @param $sid string User's session id
 *
 * @return int User's id or 0 on failure
 */
function uid_from_sid($sid="") {
    if (!sid) {
        return 0;
    }

    $dbh = DB::connect();
    $q = "SELECT Users.id ";
    $q.= "FROM Users, Sessions ";
    $q.= "WHERE Users.id = Sessions.uid ";
    $q.= "AND Sessions.sid = " . $dbh->quote($sid);
    $result = $dbh->query($q);

    if (!$result) {
        return 0;
    }

    $row = $result->fetch(PDO::FETCH_NUM);
    return $row[0];
}

/**
 * Determine whether a user is suspended
 *
 * @param $uid int User id of user to check
 *
 * @return bool true if user is suspended or false if not
 */
function user_suspended($uid) {
    $dbh = DB::connect();
    $q = "SELECT Users.suspended ";
    $q.= "FROM Users ";
    $q.= "WHERE Users.id = " . $dbh->quote($uid);
    $result = $dbh->query($q);

    if (!$result) {
        /* if there's no result, there's no suspended user */
        return false;
    }

    $row = $result->fetch(PDO::FETCH_NUM);

    if ($row[1]) {
        return true;
    } else {
        return false;
    }
}

/**
 * Generate a new session ID
 *
 * @return string MD5 hash of IP, random integer, and current time
 */
function new_sid() {
    return md5($_SERVER['REMOTE_ADDR'] . uniqid(mt_rand(), true));
}

/**
 * Common header displayed on all pages.
 *
 * @param $title string Name of page to be displayed
 *
 * @return void
 */
function html_header($title="") {
    include 'header.php';
    return;
}

/**
 * Get username from a session id
 *
 * @param $sid string SID of session
 *
 * @return string Username associated with SID
 */
function username_from_sid($sid) {
    if (!sid) {
        return 0;
    }

    $dbh = DB::connect();
    $q = "SELECT Users.username ";
    $q.= "FROM Users, Sessions ";
    $q.= "WHERE Users.id = Sessions.uid ";
    $q.= "AND Sessions.sid = " . $dbh->quote($sid);
    $result = $dbh->query($q);

    if (!$result) {
        return 0;
    }

    $row = $result->fetch(PDO::FETCH_NUM);
    return $row[0];
}

/**
 * Common footer displayed on all pages
 *
 * @return void
 */
function html_footer() {
    include 'footer.php';
    return;
}

/**
 * Get URL of root from config
 *
 * @return string URL of root.
 */
function pw_location() {
    $loc = config_get('options', 'location');
    if (substr($loc, -1) != '/') {
        $loc .= '/';
    }
    return $loc;
}

/**
 * Determine if a _REQUEST index is set
 *
 * @param $name string The index to test
 *
 * @return string Return value under that index or an empty string
 */
function in_request($name) {
    if (isset($_REQUEST[$name])) {
        return $_REQUEST[$name];
    }

    return "";
}

/**
 * Get the user's account type from an sid
 *
 * @param $sid string Client's sid
 *
 * @return int Account type
 */
function account_from_sid($sid="") {
    if (!$sid) {
        return "";
    }

    $dbh = DB::connect();
    $q = "SELECT type ";
    $q.= "FROM Users, Sessions ";
    $q.= "WHERE Users.id = Sessions.uid ";
    $q.= "AND Sessions.sid = " . $dbh->quote($sid);

    $result = $dbh->query($q);
    if (!$result) {
        return "";
    }

    $row = $result->fetch(PDO::FETCH_NUM);

    return $row[0];
}