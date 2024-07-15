<?php

namespace App\Entity;
class Training{
    private $_id;
    private $_code;
    private $_descriptions;
    private $_price;
    private $_durations;
    private $_modified;
    private $_level;
    private $_levelAvailabilities;
    private $_levelName;
    private $_level_id;
    private $_training_id;
    public function __construct(array $trainingData = []) {
      
        if (!empty($trainingData)) {
            $this->_id = $trainingData['id'] ?? null;
            $this->_code= $trainingData['code'] ?? null;
            $this->_descriptions = $trainingData['descriptions'] ?? null;
            $this->_price = $trainingData['price'] ?? null;
            $this->_durations = $trainingData['durations'] ?? null;
            $this->_modified = $trainingData['modified'] ?? null;
            $this->_level = $trainingData['level'] ?? null;
            $this->_levelAvailabilities = $trainingData['levelAvailabilities'] ?? null;
            $this->_levelName = $trainingData['levelName'] ?? null;
        
           
        }
    }
    // definition des getters
    public function getId() {
        return $this->_id;
    }
    public function getCode() {
        return $this->_code;
    }
    public function getDescriptions() {
        return $this->_descriptions;
    }
    public function getPrice() {
        return $this->_price;
    }
    public function getDurations() {
        return $this->_durations;
    }
    public function getModified() {
        return $this->_modified;
    }
    // definition des setters
    public function setId($_id) {
        $this->_id = $_id;
    }
    public function setCode($_code) {
        $this->_code = $_code;
    }
    public function setDescription($_descriptions) {
        $this->_descriptions = $_descriptions;
    }
    public function setPrice($_price) {
        $this->_price = $_price;
    }
    public function setDurations($_durations) {
        $this->_durations = $_durations;
    }
    public function setModified($_modified) {
        $this->_modified = $_modified;
    }

    

    /**
     * Get the value of _level
     */ 
    public function getLevel()
    {
        return $this->_level;
    }

    /**
     * Set the value of _level
     *
     * @return  self
     */ 
    public function setLevel($_level)
    {
        $this->_level = $_level;

        return $this;
    }

    /**
     * Get the value of _levelAvailabilities
     */ 
    public function getLevelAvailabilities()
    {
        return $this->_levelAvailabilities;
    }

    /**
     * Set the value of _levelAvailabilities
     *
     * @return  self
     */ 
    public function setLevelAvailabilities($_levelAvailabilities)
    {
        $this->_levelAvailabilities = $_levelAvailabilities;

        return $this;
    }

    /**
     * Get the value of _levelName
     */ 
    public function getLevelName()
    {
        return $this->_levelName;
    }

    /**
     * Set the value of _levelName
     *
     * @return  self
     */ 
    public function setLevelName($_levelName)
    {
        $this->_levelName = $_levelName;

        return $this;
    }

    /**
     * Get the value of _level_id
     */ 
    public function getLevel_id()
    {
        return $this->_level_id;
    }

    /**
     * Set the value of _level_id
     *
     * @return  self
     */ 
    public function setLevel_id($_level_id)
    {
        $this->_level_id = $_level_id;

        return $this;
    }

    /**
     * Get the value of _training_id
     */ 
    public function getTraining_id()
    {
        return $this->_training_id;
    }

    /**
     * Set the value of _training_id
     *
     * @return  self
     */ 
    public function setTraining_id($_training_id)
    {
        $this->_training_id = $_training_id;

        return $this;
    }
}