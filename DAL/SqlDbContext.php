<?php
require 'config.php';

class SqlDbContext
{
    public static function connect($host, $db, $user, $password){
        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
        try {
            return new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            include realpath($_SERVER["DOCUMENT_ROOT"])."/metak/view/404.php";
            exit;
        }

    }
}
return SqlDbContext::connect($host, $db, $user, $password);
