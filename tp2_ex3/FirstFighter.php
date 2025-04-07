<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once __DIR__ . "/class/Pokemon.php";
include_once __DIR__ . "/class/PokemonEau.php";

if (class_exists('PokemonEau')) {
    echo "PokemonEau class loaded successfully!";
} else {
    echo "Class PokemonEau NOT FOUND.";
}

include_once __DIR__. "/class/PokemonFeu.php";

include_once __DIR__. "/class/PokemonPlante.php";


session_start();

if(isset($_SESSION['choice1']))
{
    unset($_SESSION['choice1']);
}

if(!isset($_SESSION['choice1']))
{
    if($_GET['name']=='Lockpin')
    {
        $_SESSION['choice1']=new Pokemon("Lockpin",
        "./images/lockpin.png", 
        800,new AttackPokemon(50,150,2,50),"Normal");
    }
    
    else if($_GET['name']=='Arceus')
    {
        $_SESSION['choice1']=new Pokemon("Arceus",
        "./images/arceus.jpg",
        1000,new AttackPokemon(20,80,3,50),"Normal");
    }
    else if($_GET['name']=='Charizard')
    {
        $_SESSION['choice1']=new PokemonFeu("Charizard","./images/charizard.jpg",600,new AttackPokemon(80,180,2,50),"Feu");
        

    }
    else if($_GET['name']=='Blastoise')
    {
        $_SESSION['choice1']=new PokemonEau("Blastoise",
        "./images/blastoise.jpg",
        750,new AttackPokemon(30,110,4,50),"Eau");
        
    }
    else if($_GET['name']=='Venusaur')
    {
        $_SESSION['choice1']=new PokemonPlante("Venusaur","./images/Venusaur.png",900,new AttackPokemon(20,120,3,50),"Plante");
    }
}


header("Location: index2.php");
exit; 
?>