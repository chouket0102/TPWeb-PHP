<?php
class ConnexionDB
{
    public static $_dbname = "student_db";
    public static $_user = "root";
    public static $_pwd = "?@joseph008@?";
    public static $_host = "localhost";

    private static $_bdd = null;

    private function __construct()
    {
        try {
            self::$_bdd = new PDO("mysql:host=" . self::$_host . ";dbname=" . self::$_dbname . ";charset=utf8", self::$_user, self::$_pwd, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
            self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
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
?>