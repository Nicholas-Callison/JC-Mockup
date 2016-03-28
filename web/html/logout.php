<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../lib');

include_once("pathways.inc.php");
include_once("account.inc.php");

if (isset($_COOKIE["PSID"])) {
    delete_session_id($_COOKIE["PSID"]);
    setcookie("PSID", "", 1, "/", NULL, !empty($_SERVER["HTTPS"]), true);
    unset($_COOKIE["PSID"]);
    clear_expired_sessions();
}

header("Location: /");