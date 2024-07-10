<?php

namespace App\Entity;

class Level {
    private $_id;
    private $_gradeLevel;
    private $_availability;
    public function __construct(array $LevelData = [])
    {
        if (!empty($LevelData)) {
            $this->_id = $LevelData['_id'] ?? null;
            $this->_gradeLevel = $LevelData['_gradeLevel'] ?? null;
            $this->_availability = $LevelData['_availability'] ?? null;
        }
    }
    public function getId(): ?int { return $this->_id; }
    public function getGradeLevel(): ?string { return $this->_gradeLevel; }
    public function getAvailability(): ?string { return $this->_availability; } 
    public function setId($_id){
        $this->_id = $_id;
    }
    public function setGradeLevel( $_gradeLevel){
        $this->_gradeLevel = $_gradeLevel;
    }
    public function setAvailability(string $_availability){
        $this->_availability = $_availability;
    }


}