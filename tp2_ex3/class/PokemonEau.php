<?php
include_once "AttackPokemon.php";
include_once "Pokemon.php";
include_once "PokemonEau.php";
include_once "PokemonFeu.php";
include_once "PokemonPlante.php";
class PokemonEau extends Pokemon {
    

    public function __construct($name, $url, $hp, $attackPokemon,$type="Eau") {
        parent::__construct($name, $url, $hp, $attackPokemon,$type);
        
    }

    public function getTypeMultiplier($defendingPokemon) {
        switch ($defendingPokemon->getType()) {
            case "Feu":
                return 2.0; 
            case "Eau":
            case "Plante":
                return 0.5; 
            default:
                return 1.0; 
        }
    }
}
?>