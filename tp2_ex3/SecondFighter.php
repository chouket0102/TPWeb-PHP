<?php 
include_once "./class/Pokemon.php";
include_once "./class/PokemonEau.php";
include_once "./class/PokemonFeu.php";
include_once "./class/PokemonPlante.php";
session_start();

if(isset($_SESSION['choice2']))
{
    unset($_SESSION['choice2']);
}

if(!isset($_SESSION['choice2']))
{
    if($_GET['name']=='Lockpin')
    {
        $_SESSION['choice2']=new Pokemon("Lockpin",
        "./images/lockpin.png",
        800,new AttackPokemon(50,150,2,50),"Normal");
    }
   
    else if($_GET['name']=='Arceus')
    {
        $_SESSION['choice2']=new Pokemon("Arceus",
        "./images/arceus.jpg",
        1000,new AttackPokemon(20,80,3,50),"Normal");
    }
    else if($_GET['name']=='Charizard')
    {
        $_SESSION['choice2']=new PokemonFeu("Charizard",
        "./images/charizard.jpg",
        600,new AttackPokemon(80,180,2,50), "Feu");
    }
    else if($_GET['name']=='Blastoise')
    {
        $_SESSION['choice2']=new PokemonEau("Blastoise",
        "./images/blastoise.jpg",
        750,new AttackPokemon(30,110,4,50), "Eau");
    }
    else if($_GET['name']=='Venusaur')
    {
        $_SESSION['choice2']=new PokemonPlante("Venusaur",
        "./images/Venusaur.png",
        900,new AttackPokemon(20,120,3,50), "Plante");
    }
}

header("Location: ./FightArena.php");
exit; // Ajouté pour assurer que le script s'arrête après la redirection
?>