<?php

class Etudiant{
    private $nom;
    private $notes;

    public function __construct($nom , $notes){
        $this->nom = $nom;
        $this->notes = $notes;
    }

    public function afficherNotes(){
        echo '<div style="width: 250px; border: 1px solid #ccc; padding: 10px; margin: 10px; display: inline-block; vertical-align: top;">';
        echo "<div style=' margin-bottom: 10px;'>{$this->nom}</div>";

        foreach ($this->notes as $note){
            if($note <10){
                $color = "#ffcccc";
            }
            elseif($note ==10){
                $color = "#ffffcc";

            }
            elseif ($note >10) {
                $color = "#ccffcc";
            }
            echo "<div style='background-color: {$color}; padding: 8px; margin-bottom: 5px;'>{$note}</div>";

        }

        $moyenne = $this->calculerMoyenne();
        echo "<div style='background-color: #cce5ff; padding: 8px; margin-top: 10px;'>Votre moyenne est $moyenne </div>";
        
        echo '</div>';
    }

    public function calculerMoyenne(){
        return array_sum($this->notes) / count($this->notes);
    }

    public function estAdmis(){
        if ($this->calculerMoyenne()>=10){
            return 'Admis';
        }
        else{
            return 'Non Admis';
        }
    }

   
    
}



?>