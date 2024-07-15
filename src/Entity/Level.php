<?php

namespace App\Entity;

class Level {
    private $_id;
    private $_gradeLevel;
    private $_availabilities;
    public function __construct(array $LevelData = [])
    {
        if (!empty($LevelData)) {
            $this->_id = $LevelData['_id'] ?? null;
            $this->_gradeLevel = $LevelData['_gradeLevel'] ?? null;
            $this->_availabilities = $LevelData['_availabilities'] ?? null;
        }
    }
    public function getId(): ?int { return $this->_id; }
    public function getGradeLevel(): ?string { return $this->_gradeLevel; }
    public function getAvailabilities(): ?string { return $this->_availabilities; } 
    public function setId($_id){
        $this->_id = $_id;
    }
    public function setGradeLevel( $_gradeLevel){
        $this->_gradeLevel = $_gradeLevel;
    }
    public function setAvailabilities(string $_availabilities){
        $this->_availabilities = $_availabilities;
    }


}