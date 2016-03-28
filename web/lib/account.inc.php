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
    $sid = '';
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

    while (!$logged_in && $num_tries < 5) {
        $session_limit = config_get_int('options', 'max_sessions_per_user');
        if ($session_limit) {
            $q = "DELETE s.* ";
            $q.= "FROM Sessions s ";
            $q.= "LEFT JOIN (SELECT sid FROM Sessions ";
            $q.= "WHERE uid = " . $uid . " ";
            $q.= "ORDER BY ts DESC ";
            $q.= "LIMIT " . ($session_limit - 1) . ") q ";
            $q.= "ON s.sid = q.sid ";
            $q.= "WHERE s.uid = " . $uid . " ";
            $q.= "AND q.sid IS NULL";
            $dbh->query($q);
        }

        $sid = new_sid();
        $q = "INSERT INTO Sessions (uid, sid, ts) ";
        $q.= "VALUES (" . $uid . ", '" . $sid . "', UNIX_TIMESTAMP())'";
        $result = $dbh->exec($q);

        if (!$result) {
            $logged_in = 1;
            break;
        }

        $num_tries += 1;
    }

    if (!$logged_in) {
        $error = "An error occurred trying to create a user session.";
        return array(
            'SID' => $sid,
            'error' => $error,
        );
    }

    $q = "UPDATE Users ";
    $q.= "SET last_login_ts = UNIX_TIMESTAMP(), last_ip = " . $dbh->quote($_SERVER['REMOTE_ADDR'] . " ");
    $q.= "WHERE uid = " . $uid;
    $dbh->exec($q);

    if (isset($_POST['remember']) && $_POST['remember'] == "yes") {
        $timeout = config_get_int('options', 'cookie_timeout');
        $cookie_time = time() + $timeout;

        $q = "UPDATE Sessions SET ts = $cookie_time ";
        $q.= "WHERE sid = '$sid'";
        $dbh->exec($q);
    } else {
        $cookie_time = 0;
    }

    setcookie('PSID', $sid, $cookie_time, "/", NULL, !empty($_SERVER['HTTPS']), true);

    $referrer = in_request('referrer');
    if (strpos($referrer, pw_location()) !== 0) {
        $referrer = "/";
    }
    header("Location: " . get_uri($referrer));
    $error = "";
}

/**
 * Clear all sessions that have been expired
 *
 * @return void
 */
function clear_expired_sessions() {
    $dbh = DB::connect();
    $timeout = config_get_int('options', 'login_timeout');
    $q = "DELETE FROM Sessions WHERE ts < (UNIX_TIMESTAMP() - " . $timeout . ")";
    $dbh->exec($q);
}

/**
 * Delete session
 *
 * @param $sid int SID to delete
 *
 * @return void
 */
function delete_session_id($sid) {
    $dbh = DB::connect();
    $q = "DELETE FROM Sessions WHERE sid = " . $dbh->quote($sid);
    $dbh->exec($q);
}