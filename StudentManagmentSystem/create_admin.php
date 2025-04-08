<?php
require_once 'config/database.php';

$pdo = getDBConnection();

$username = 'yasserchouket';
$email = 'yasserchouket2101@gmail.com';
$plain_password = 'bor3i123'; 
$role = 'admin';


$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);


$stmt = $pdo->prepare("
    INSERT INTO users (username, email, password_hash, role)
    VALUES (?, ?, ?, ?)
");
$stmt->execute([$username, $email, $hashed_password, $role]);

echo "user créé avec succès !";