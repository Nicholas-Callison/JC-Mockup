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
define("USER_ADMIN", 2);
define("USER_EDITOR", 3);

/**
 * Determine if a user has the required permissions to perform an action
 *
 * @param credential int The type of action to perform
 * @param approved_users array Additional users to allow
 *
 * @return bool Return true if user has permission, otherwise false
 */
function has_permission($credential, $approved_users=array()) {
    if (!isset($_COOKIE['ID'])) {
        return false;
    }


}