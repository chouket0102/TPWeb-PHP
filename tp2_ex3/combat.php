<?php
include_once __DIR__ . "/class/Pokemon.php";
include_once __DIR__ . "/class/PokemonEau.php";
include_once __DIR__ . "/class/PokemonFeu.php";
include_once __DIR__ . "/class/PokemonPlante.php";
session_start();

// Perform attacks
$_SESSION['DamageDoneToChoice2'] = $_SESSION['choice1']->attack($_SESSION['choice2']);
$_SESSION['DamageDoneToChoice1'] = $_SESSION['choice2']->attack($_SESSION['choice1']);
$_SESSION['round'] = isset($_SESSION['round']) ? $_SESSION['round'] + 1 : 1;

// Check if either Pokemon is dead
if ($_SESSION['choice1']->isDead() || $_SESSION['choice2']->isDead()) {
    // Determine the winner
    if ($_SESSION['choice1']->isDead()) {
        // If choice1 is dead (HP <= 0), choice2 wins
        $_SESSION['winner'] = 'choice2';
    } else {
        // If choice2 is dead (HP <= 0), choice1 wins
        $_SESSION['winner'] = 'choice1';
    }
    
    // Redirect to winner page
    header("Location: ./Winner.php");
    exit;
} else {
    // Continue the battle - no winner yet
    header("location: ./FightArena.php");
    exit;
}
?>