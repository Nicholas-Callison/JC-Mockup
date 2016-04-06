<?php
/* list of permissions */
define("PERM_ACCOUNT_CHANGE_TYPE", 1);
define("PERM_ACCOUNT_ADD", 2);
define("PERM_ACCOUNT_EDIT", 3);
define("PERM_ACCOUNT_LAST_LOGIN", 4);
define("PERM_PATHWAYS_ADD", 5);
define("PERM_PATHWAYS_EDIT", 6);
define("PERM_PATHWAYS_DELETE", 7);
define("PERM_DEGREE_ADD", 8);
define("PERM_DEGREE_EDIT", 9);
define("PERM_DEGREE_DELETE", 10);

/* list of user types */
define("USER_GENERIC", 1);
define("USER_EDITOR", 2);
define("USER_ADMIN", 3);

/**
 * Determine if a user has the required permissions to perform an action
 *
 * @param $permission int The type of action to perform
 * @param $approved_users array Additional users to allow
 *
 * @return bool Return true if user has permission, otherwise false
 */
function has_permission($permission, $approved_users=array()) {
    if (!isset($_COOKIE['ID'])) {
        return false;
    }

    $uid = uid_from_sid($_COOKIE['PSID']);
    if (in_array($uid, $approved_users)) {
        return true;
    }

    $account_type = account_from_sid($_COOKIE['PSID']);
    
    switch ($permission) {
        case PERM_ACCOUNT_CHANGE_TYPE:
        case PERM_ACCOUNT_LAST_LOGIN:
        case PERM_PATHWAYS_DELETE:
        case PERM_DEGREE_DELETE:
            return ($account_type == USER_ADMIN);
        case PERM_PATHWAYS_ADD:
        case PERM_PATHWAYS_EDIT:
        case PERM_DEGREE_ADD:
        case PERM_DEGREE_EDIT:
        case PERM_ACCOUNT_ADD:
        case PERM_ACCOUNT_EDIT:
            return ($account_type == USER_EDITOR || $account_type == USER_ADMIN);
    }

    return false;
}