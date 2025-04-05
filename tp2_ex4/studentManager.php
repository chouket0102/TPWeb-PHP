<?php
require_once 'connexionDB.php';


function createDatabase() {
    
    $tempConnection = new PDO("mysql:host=" . ConnexionDB::$_host, ConnexionDB::$_user, ConnexionDB::$_pwd);
    
   
    $sql = "CREATE DATABASE IF NOT EXISTS " . ConnexionDB::$_dbname;
    $tempConnection->exec($sql);
    
   

}

// Fonction pour créer la table des étudiants
function createStudentTable() {

    $db = ConnexionDB::getInstance();
    $sql = "CREATE TABLE IF NOT EXISTS student (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        birthday DATE NOT NULL
    )";
    $db->exec($sql);
 

}


function insertSampleData() {

    $db = ConnexionDB::getInstance();
    
    
    $reponse = $db->query("SELECT COUNT(*) as count FROM student");
    $row = $reponse->fetch(PDO::FETCH_ASSOC);
    
    if ($row['count'] == 0) {
        $sql = "INSERT INTO student (name, birthday) VALUES
            ('Aymen', '1982-02-07'),
            ('Skander', '2018-07-11')";
        $db->exec($sql);
        
    }

}


function getAllStudents() {

    $db = ConnexionDB::getInstance();
    $sql = $db->query("SELECT * FROM student");
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
?>