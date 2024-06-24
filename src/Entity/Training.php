<?php

namespace App\Entity;
class Training{
    private $_id;
    private $_code;
    private $_description;
    private $_price;
    private $_durations;
    private $_modified;
    public function __construct($_id=null, $_code, $_description, $_price, $_durations, array $_modified = null) {
        if ($_id !== null) {
            $this->_id = $_id;
        }
        $this->_code = $_code;
        $this->_description = $_description;
        $this->_price = $_price;
        $this->_durations = $_durations;
        $this->_modified = $_modified;
    }
    // definition des getters
    public function getId() {
        return $this->_id;
    }
    public function getCode() {
        return $this->_code;
    }
    public function getDescription() {
        return $this->_description;
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
    public function setDescription($_description) {
        $this->_description = $_description;
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

    
}