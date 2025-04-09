<?php

class Student {
    private $id;
    private $name;
    private $birthday;
    private $image;
    private $section_id;

    public function __construct($id, $name, $birthday, $image, $section_id) {
        $this->id = $id;
        $this->name = $name;
        $this->birthday = $birthday;
        $this->image = $image;
        $this->section_id = $section_id;
    }

    
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getBirthday() { return $this->birthday; }
    public function getImage() { return $this->image; }
    public function getSectionId() { return $this->section_id; }
}  
?>