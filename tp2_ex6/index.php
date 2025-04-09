<?php

include_once "ConnexionDB.php";
include_once "Repository.php";


$userRepo = new Repository("utilisateur");


$user = $userRepo->findById(1);
if ($user) {
    echo "Utilisateur trouvé avec l'ID 1: " . $user["email"];
} else {
    echo "Utilisateur avec l'ID 1 non trouvé";
}
echo "<br>";


$allUsers = $userRepo->findAll();
if (count($allUsers) > 0) {
    echo "Premier utilisateur de la liste: " . $allUsers[0]["email"];
} else {
    echo "Aucun utilisateur trouvé";
}
echo "<br>";


$newUserId = $userRepo->create([
    "username" => "youssef", 
    "email" => "youssef@gmail.ucar.tn", 
    "password" => "na3ne3", 
    "role" => "admin"
]);
echo "Nouvel utilisateur créé avec l'ID: " . $newUserId;
echo "<br>";


$deletedRows = $userRepo->delete(2);
echo "Nombre de lignes supprimées: " . $deletedRows;
echo "<br><br>";


echo "<h3>Tests avec la table section</h3>";
$sectionRepo = new Repository("section");


echo "<strong>Toutes les sections:</strong><br>";
$sections = $sectionRepo->findAll();
foreach ($sections as $section) {
    echo "Section ID: " . $section["id"] . ", Nom: " . $section["nom"] . "<br>";
}
echo "<br>";

$sectionId = 1; 
$section = $sectionRepo->findById($sectionId);
if ($section) {
    echo "Section trouvée avec l'ID $sectionId: " . $section["nom"] . "<br>";
} else {
    echo "Section avec l'ID $sectionId non trouvée<br>";
}
echo "<br>";


$newSectionId = $sectionRepo->create([
    "nom" => "Nouvelle Section",
    "description" => "Description de la nouvelle section"
]);
echo "Nouvelle section créée avec l'ID: " . $newSectionId;
echo "<br>";


$deletedRows = $sectionRepo->delete(3);
echo "Nombre de sections supprimées: " . $deletedRows;