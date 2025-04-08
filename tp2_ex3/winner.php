<?php
    include_once __DIR__ . "/class/Pokemon.php";
    include_once __DIR__ . "/class/PokemonEau.php";
    include_once __DIR__ . "/class/PokemonFeu.php";
    include_once __DIR__ . "/class/PokemonPlante.php";
    session_start();
?>
<style>
    .image {
        height: 400px;
        width: 400px;
    }
    .winner-container {
        background-color: #d1e7dd;
        border-radius: 10px;
        padding: 20px;
        margin: 20px auto;
        max-width: 800px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .winner-title {
        color: #0f5132;
        font-size: 2.5rem;
        margin-bottom: 20px;
    }
    .winner-stats {
        background-color: #fff;
        border-radius: 8px;
        padding: 15px;
        margin-top: 20px;
        border: 1px solid #badbcc;
    }
    .stat-item {
        padding: 8px 0;
        border-bottom: 1px solid #e9ecef;
    }
    .battle-summary {
        margin-top: 20px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }
</style>

<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<html>
<body>
<div class="container text-center">
    <div class="winner-container">
        <h1 class="winner-title">
            Le vainqueur est:  
            <?php
            $winner = $_SESSION['winner'];
            echo $_SESSION[$winner]->getName();
            if($_SESSION['choice1']->getName() == $_SESSION['choice2']->getName()) {
                if ($winner == 'choice1') {
                    echo " (premier combattant)";
                } else {
                    echo " (deuxième combattant)";
                }
            }
            ?>
        </h1>
    
        <img src="<?php echo $_SESSION[$winner]->getUrl(); ?>" class="image">
        
        <div class="winner-stats">
            <div class="stat-item">
                <strong>Points de vie restants:</strong> <?php echo $_SESSION[$winner]->getHp(); ?>
            </div>
            <div class="stat-item">
                <strong>Type:</strong> <?php echo $_SESSION[$winner]->getType(); ?>
            </div>
            <div class="stat-item">
                <strong>Attaque minimale:</strong> <?php echo $_SESSION[$winner]->getAttackPokemon()->getAttackMinimal(); ?>
            </div>
            <div class="stat-item">
                <strong>Attaque maximale:</strong> <?php echo $_SESSION[$winner]->getAttackPokemon()->getAttackMaximal(); ?>
            </div>
            <div class="stat-item">
                <strong>Multiplicateur d'attaque spéciale:</strong> <?php echo $_SESSION[$winner]->getAttackPokemon()->getSpecialAttack(); ?>
            </div>
        </div>
        
        
    </div>
    <a href="./ResetFight.php">
        <button type="button" class="btn btn-primary mt-3">Nouveau combat</button>
    </a>
</div>
</body>
</html>