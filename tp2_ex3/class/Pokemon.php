<?php
include_once "AttackPokemon.php";
class Pokemon {
    private $name;
    private $url;
    private $hp;
    private $attackPokemon;
    private $type;

    public function __construct($name, $url, $hp ,$attackPokemon, $type = "Normal") {
        $this->name= $name;
        $this->url= $url;
        $this->hp= $hp;
        $this->attackPokemon= $attackPokemon;
        $this->type= $type;

    }

    public function getName(){
        return $this->name;
    }
    public function getUrl(){
        return $this->url;
    }
    public function getHp(){
        return $this->hp;
    }
    public function getAttackPokemon(){
        return $this->attackPokemon;
    }
    public function getType(){
        return $this->type;
    }

    public function getTypeMultiplier($defendingPokemon) {
        return 1.0; // Default multiplier for normal type
    }
    public function setName($name){
        $this->name= $name;
    }
    public function setUrl($url){
        $this->url= $url;
    }
    public function setHp($hp){
        $this->hp= $hp;
    }
    public function setAttackPokemon($attackPokemon){
        $this->attackPokemon= $attackPokemon;
    }
   
    public function isDead(){
        return $this->hp <= 0;
    }

    public function attack(Pokemon $p){
        echo "\n{$this->name} attaque {$p->name}!\n";
        
        
        $baseAttackPoints = $this->attackPokemon->calculerAttack();
        
        
        $attackPoints = $baseAttackPoints;
        
        $isSpecial = $this->attackPokemon->isSpecialAttack();
        if ($isSpecial) {
            $specialMultiplier = $this->attackPokemon->getSpecialAttack();
            $attackPoints *= $specialMultiplier;
            
        }
        
        
        $typeMultiplier = $this->getTypeMultiplier($p);
        $beforeTypePoints = $attackPoints;
        $attackPoints *= $typeMultiplier;
        
        
        
        
       
        $attackPoints = round($attackPoints);
        
        
        $previousHp = $p->hp;
        $p->hp = max(0, $p->hp - $attackPoints);
        
        
        
        return $attackPoints;
    
    }

    public function whoAmI()
    {
        echo $this->name;
    }

}

?>