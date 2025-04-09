<?php
// ConnexionDB.php
class ConnexionDB
{
    private static $_dbname = "bd_ex6";
    private static $_user = "root";
    private static $_pwd = "";
    private static $_host = "localhost";

    private static $_bdd = null;

    private function __construct()
    {
        try {
            self::$_bdd = new PDO("mysql:host=localhost;port=3307;dbname=bd_ex6;charset=utf8", self::$_user, self::$_pwd, [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
            ]);
            
            self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getInstance(): ?PDO
    {
        if (!self::$_bdd) {
            new ConnexionDB();
        }
        return (self::$_bdd);
    }
}