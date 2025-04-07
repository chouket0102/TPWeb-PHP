<?php

include_once __DIR__ . "/class/Pokemon.php";
include_once __DIR__ . "/class/PokemonEau.php";
include_once __DIR__ . "/class/PokemonFeu.php";
include_once __DIR__ . "/class/PokemonPlante.php";
session_start();




if (!isset($_SESSION['round'])) {
    $_SESSION['round'] = 1;
}
?>

<style>
    .image {
        height: 300px;
        width: 300px;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Fight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container text-center alert alert-info" role="alert">
        <h3>Les Combatants:</h3>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col alert alert-secondary" role="alert">
                <h1><?php echo $_SESSION['choice1']->whoAmI(); ?></h1>
                <img src="<?php echo $_SESSION['choice1']->getUrl(); ?>" class="image">
            </div>
            <div class="col alert alert-secondary" role="alert">
                <h1><?php echo $_SESSION['choice2']->whoAmI(); ?></h1>
                <img src="<?php echo $_SESSION['choice2']->getUrl(); ?>" class="image">
            </div>       
        </div>
        <div class="row">
            <div class="col alert alert-secondary" role="alert">
                Points: <?php echo $_SESSION['choice1']->getHp(); ?>
                <?php if (isset($_SESSION['DamageDoneToChoice1'])) {
                    echo "(Damage taken: " . $_SESSION['DamageDoneToChoice1'] . ")";
                } ?>
            </div>
            <div class="col alert alert-secondary" role="alert">
                Points: <?php echo $_SESSION['choice2']->getHp(); ?>
                <?php if (isset($_SESSION['DamageDoneToChoice2'])) {
                    echo "(Damage taken: " . $_SESSION['DamageDoneToChoice2'] . ")";
                } ?>
            </div>
        </div>
        <div class="row">
            <div class="col alert alert-secondary" role="alert">
                Minimal base damage attack: <?php echo $_SESSION['choice1']->getAttackPokemon()->getAttackMinimal(); ?>
            </div>
            <div class="col alert alert-secondary" role="alert">
                Minimal base damage attack: <?php  echo $_SESSION['choice2']->getAttackPokemon()->getAttackMinimal(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col alert alert-secondary" role="alert">
                Maximal base damage attack: <?php echo $_SESSION['choice1']->getAttackPokemon()->getAttackMaximal(); ?>
            </div>
            <div class="col alert alert-secondary" role="alert">
                Maximal base damage attack: <?php  echo $_SESSION['choice2']->getAttackPokemon()->getAttackMaximal(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col alert alert-secondary" role="alert">
                Special attack multiplier: <?php  echo $_SESSION['choice1']->getAttackPokemon()->getSpecialAttack(); ?>
            </div>
            <div class="col alert alert-secondary" role="alert">
                Special attack multiplier: <?php  echo $_SESSION['choice2']->getAttackPokemon()->getSpecialAttack(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col alert alert-secondary" role="alert">
                Special attack probability: <?php  echo $_SESSION['choice1']->getAttackPokemon()->getProbabilitySpecialAttack(); ?>
            </div>
            <div class="col alert alert-secondary" role="alert">
                Special attack probability: <?php  echo $_SESSION['choice2']->getAttackPokemon()->getProbabilitySpecialAttack(); ?>
            </div>
        </div>
        <a href="./combat.php">
            <button type="button" class="btn btn-secondary">
                <?php
                if (isset($_SESSION['FinalRound'])) {
                    echo "Winner";
                    $_SESSION['winner'] = $_SESSION['FinalRound'];
                } else {
                    echo "Round ", $_SESSION['round'];
                }
                ?>
            </button>
        </a>
        <a href="./ResetFight.php">
            <button type="button" class="btn btn-secondary">Reset Fight</button>
        </a>
    </div>
</body>
</html>
