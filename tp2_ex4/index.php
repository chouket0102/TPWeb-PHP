<?php
// Inclusion des fichiers nécessaires
require_once 'connexionDB.php';
require_once 'studentManager.php';

// Initialisation
try {
    // Création de la base de données d'abord
    createDatabase();
    
    // Création de la table et insertion des données
    createStudentTable();
    insertSampleData();
    
    // Récupération des étudiants pour l'affichage
    $students = getAllStudents();
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des étudiants</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            
        }
        h1 {
            color: #336699;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
        }
        
        
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des étudiants</h1>
        
    
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Date de naissance</th>
            </tr>
            <?php
            if (!empty($students)) {
                foreach($students as $student) {
                    echo "<tr>
                        <td>" . $student["id"] . "</td>
                        <td>" . $student["name"] . "</td>
                        <td>" . $student["birthday"] . "</td>
                    </tr>";
                }
            }
           
            ?>
        </table>
    </div>
</body>
</html>