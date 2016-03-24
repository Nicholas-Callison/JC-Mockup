<?php

/**
 * Determine if a password is empty
 * 
 * @param $uid string User id to check
 * 
 * @return bool True if empty, false otherwise
 */
function passwd_is_empty($uid) {
    $dbh = DB::connect();

    $q = "SELECT passwd ";
    $q.= "FROM Users ";
    $q.= "WHERE id = " . $dbh->quote($uid);
    $result = $dbh->query($q);

    if (!$result) {
        return false;
    }

    $row = $result->fetch(PDO::FETCH_NUM);

    if ($row[0] == '') {
        return true;
    } else {
        return false;
    }
}

/**
 * Check if password is valid!
 *
 * @param $uid int User id to check
 * @param $passwd string Password to check
 *
 * @return bool True if valid, otherwise false
 */
function valid_passwd($uid, $passwd) {
    $dbh = DB::connect();

    $q = "SELECT salt, passwd ";
    $q.= "FROM Users ";
    $q.= "WHERE id = " . $dbh->quote($uid);
    $result = $dbh->query($q);

    if (!$result) {
        return false;
    }

    $row = $result->fetch(PDO::FETCH_NUM);
    $salted_hash = hash("sha256", $row[0] . $passwd);

    if ($salted_hash == $row[1]) {
        return true;
    } else {
        return false;
    }
}

/**
 * Attempt login and create session
 *
 * @return array Session ID for user or error message
 */
function try_login() {
    $error = '';
    $new_sid = '';
    $uid = null;
    
    if (!isset($_REQUEST["user"]) && !isset($_REQUEST["passwd"])) {
        return array(
            'sid' => '',
            'error' => NULL,
        );
    }
    
    $dbh = DB::connect();
    $uid = uid_from_username($_REQUEST["user"]);
    
    if (user_suspended($uid)) {
        $error = "Account suspended";
        return array(
            'SID' => '',
            'error' => $error,
        );
    } elseif (passwd_is_empty($uid)) {
        $error = "Password is either reset, or new account was created and email confirmation link was not clicked!";
        return array(
            'SID' => '',
            'error' => $error,
        );
    } elseif (!valid_passwd($uid, $_REQUEST["passwd"])) {
        $error = "Bad username or password";
        return array(
            'SID' => '',
            'error' => $error,
        );
    }

    $logged_in = 0;
    $num_tries = 0;
}