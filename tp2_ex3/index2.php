<?php
include_once "./class/Pokemon.php";
include_once "./class/PokemonEau.php";
include_once "./class/PokemonFeu.php";
include_once "./class/PokemonPlante.php";

include 'includes/header.php';
session_start();


?>

<style>
    .image{
        height: 200px;
        width: 200px;
    }

</style>

<!DOCTYPE html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<html>
    <body>

    
    <div class="container text-center alert alert-info" role="alert">
        <h1>choose Second Fighter</h1>
    </div>
    <div class="container text-center">
        <div class="row">
            <div class="col alert alert-secondary">
            <a href="./SecondFighter.php?name=Lockpin" style="text-decoration: none; color: inherit;" >
                <div>Lockpin</div>
                <img src="./images/lockpin.png" class="image">
            </a>
            </div>
            
            <div class="col alert alert-secondary">
            <a href="./SecondFighter.php?name=Arceus" style="text-decoration: none; color: inherit;" >
                <div>Arceus</div>
                <img src="./images/arceus.jpg" class="image">
            </a>
            </div>
        </div>
        <div class="row">
        <div class="col alert alert-secondary">
            <a href="./SecondFighter.php?name=Charizard" style="text-decoration: none; color: inherit;" >
                <div>Charizard</div>
                <img src="./images/charizard.jpg" class="image">
            </a>
            </div>
            <div class="col alert alert-secondary">
            <a href="./SecondFighter.php?name=Blastoise" style="text-decoration: none; color: inherit;" >
                <div>Blastoise</div>
                <img src="./images/blastoise.jpg" class="image">
            </a>
            </div>
            <div class="col alert alert-secondary">
            <a href="./SecondFighter.php?name=Venusaur" style="text-decoration: none; color: inherit;" >
                <div>Venusaur</div>
                <img src="./images/Venusaur.png" class="image">
            </a>
            </div>
        </div>
    </div>
    
<?php
    include 'includes/footer.php';
?>