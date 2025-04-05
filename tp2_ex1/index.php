<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats</title>
</head>
<body>
    
    <?php 
    
    include("etudiant.php"); 
    $etudiants = [

        new Etudiant("Aymen", [11,13,18,7,10,13,2,5,1]),
        new Etudiant("Skander", [15,9,8,16]),
        new Etudiant("Youssef", [15,9,8,16,18,20,9,3,5])
        
    ];

    foreach ($etudiants as $etudiant){
        $etudiant->afficherNotes();
        
    }
    ?>
</body>
</html>