<?php



class dbConection
{


    public static function get()
    {
        $params = include(ROOT . '/config/db_params.php');

        $dsn = "mysql:host={$params['location']};dbname={$params['name']}";
        $db = new PDO($dsn, $params['user'], $params['pwd']);

        $db->exec("set names utf8");

        return $db;
    }
}
