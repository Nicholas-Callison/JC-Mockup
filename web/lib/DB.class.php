<?php

include_once("confparser.inc.php");

class DB {

    /**
     * Database object
     */
    private static $dbh = null;

    /**
     * Return database object
     *
     * @return PDO Database connection
     */
    public static function connect() {
        if (self::$dbh === null) {
            try {
                $dsn_prefix = config_get('database', 'dsn_prefix');
                $host = config_get('database', 'host');
                $socket = config_get('database', 'socket');
                $name = config_get('database', 'name');
                $user = config_get('database', 'user');
                $pass = config_get('database', 'password');

                $dsn = $dsn_prefix . ':host=' . $host;
                
                /* special consideration for unix users */
                if ($socket != 'none') {
                    $dsn .= ';unix_socket=' . $socket;
                }
                $dsn .= ';dbname=' . $name;

                self::$dbh = new PDO($dsn, $user, $pass);
                self::$dbh->exec("SET NAMES 'utf8' COLLATE 'utf8_general_ci");
            } catch (PDOException $e) {
                die("Error - Could not connect to database!");
            }
        }

        return self::$dbh;
    }
}