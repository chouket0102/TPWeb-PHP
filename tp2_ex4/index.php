<?php
include_once 'autoloader.php';
require_once 'connexionDB.php';
require_once 'studentManager.php';


    createDatabase();
    
    
    createStudentTable();
    insertSampleData();
    
    
    $students = getAllStudents();

?>

<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
        <table class="table">
        <thead>
            <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">birthday</th>
            <th scope="col" style="width: 50px;">details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($students as $student): ?>
            <tr>
            <td> <?= $student->id  ?></td>
            <td><?= $student->name  ?></td>
            <td><?= $student->birthday  ?></td>
            <td class="text-center"><a href="detailEtudiant.php?id=<?= $student->id ?>"><i class="bi bi-info-circle-fill"></i></a></td>
            </tr>
            <?php endforeach ?>
        </tbody>
        </table>
    </div>            
</body>
</html>