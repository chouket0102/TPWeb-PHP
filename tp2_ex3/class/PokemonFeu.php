<?php
include_once "AttackPokemon.php";
include_once "Pokemon.php";
include_once "PokemonEau.php";
include_once "PokemonFeu.php";
include_once "PokemonPlante.php";
class PokemonFeu extends Pokemon {
    public function __construct($name, $url, $hp, $attackPokemon,$type="Feu") {
        parent::__construct($name, $url, $hp, $attackPokemon);
        
    }

    public function getTypeMultiplier($defendingPokemon) {
        switch ($defendingPokemon->getType()) {
            case "Plante":
                return 2.0; 
            case "Feu":
            case "Eau":
                return 0.5; 
            default:
                return 1.0; 
        }
    }
}
?>