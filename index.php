<?php
require_once 'class/SessionManager.php';

$session = new SessionManager();

if (isset($_GET['reset'])) {
    $session->resetCount();
}

$visits = $session->incrementVisitCount();
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Gestion de Session</title>
</head>
<body>
    <div class="container-session">
        <?php if ($visits === 1): ?>
            <h2>Bienvenue à notre plateforme.</h2>
        <?php else: ?>
            <h2>Merci pour votre fidélité, c'est votre <?= $visits ?> ème visite.</h2>
        <?php endif; ?>

        
        <a href="index.php?reset=1">
            <button type="button">Réinitialiser la session</button>
        </a>
    </div>
</body>
</html>