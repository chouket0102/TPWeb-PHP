<?php
include_once "AttackPokemon.php";
include_once "Pokemon.php";
include_once "PokemonEau.php";
include_once "PokemonFeu.php";
include_once "PokemonPlante.php";

class PokemonPlante extends Pokemon {
    public function __construct($name, $url, $hp, $attackPokemon,$type="Plante") {
        parent::__construct($name, $url, $hp, $attackPokemon);
        
    }

    public function getTypeMultiplier($defendingPokemon) {
        switch ($defendingPokemon->getType()) {
            case "Eau":
                return 2.0; 
            case "Plante":
            case "Feu":
                return 0.5; 
            default:
                return 1.0; 
        }
    }
}
?>