<?php

namespace App\Entity;

class User {
    private $_id;
    private $_name;
    private $_first_name;
    private $_mail;
    private $_phone_number;
    private $_birth_date;
    private $_photo_user;
    private $_password;
    private $_registration_number;
    private $_status;
    private $_create_by;
    private $_create_date;
    private $_modified_by;
    private $_modified_date;
    private $_deleted;
    private $_pdo;
    private $_role_id;

    // Constructeur
    public function __construct($_name = null, $_first_name = null, $_mail = null, $_phone_number = null, $_birth_date = null,   $_photo_user = null,  $_password = null,
    $_registration_number = null, $_status = null, $_create_by = null, $_create_date = null, $_modified_by = null, $_modified_date = null, $_deleted = null, 
    $_pdo = null, $_id = null, $_role_id = 1) {

    if ($_id !== null) {
        $this->_id = $_id;
    }
    if ($_name !== null) {
        $this->_name = $_name;
    }
    if ($_first_name !== null) {
        $this->_first_name = $_first_name;
    }
    if ($_mail !== null) {
        $this->_mail = $_mail;
    }
    if ($_phone_number !== null) {
        $this->_phone_number = $_phone_number;
    }
    if ($_birth_date !== null) {
        $this->_birth_date = $_birth_date;
    }
    if ($_photo_user !== null) {
        $this->_photo_user = $_photo_user;
    }
    if ($_password !== null) {
        $this->_password = $_password;
    }
    if ($_registration_number !== null) {
        $this->_registration_number = $_registration_number;
    }
    if ($_status !== null) {
        $this->_status = $_status;
    }
    if ($_create_by !== null) {
        $this->_create_by = $_create_by;
    }
    if ($_create_date !== null) {
        $this->_create_date = $_create_date;
    }
    if ($_modified_by !== null) {
        $this->_modified_by = $_modified_by;
    }
    if ($_modified_date !== null) {
        $this->_modified_date = $_modified_date;
    }
    if ($_deleted !== null) {
        $this->_deleted = $_deleted;
    }
    if ($_pdo !== null) {
        $this->_pdo = $_pdo;
    }
    // $_role_id est toujours initialisé à 1 si aucun paramètre n'est passé
    $this->_role_id = $_role_id;
}
 

    // Getters
    public function getId() {
        return $this->_id;
    }
    public function getName() {
        return $this->_name;
    }
    public function getFirst_name() {
        return $this->_first_name;
    }
    public function getMail() {
        return $this->_mail;
    }
    public function getPhone_number() {
        return $this->_phone_number;
    }
    public function getBirth_date() {
        return $this->_birth_date;
    }
    public function getPhoto_user() {
        return $this->_photo_user;
    }
    public function getPassword() {
        return $this->_password;
    }
    public function getRegistration_number() {
        return $this->_registration_number;
    }
    public function getStatus() {
        return $this->_status;
    }
    public function getCreate_by() {
        return $this->_create_by;
    }
    public function getCreate_date() {
        return $this->_create_date;
    }
    public function getModified_by() {
        return $this->_modified_by;
    }
    public function getModified_date() {
        return $this->_modified_date;
    }
    public function getDeleted() {
        return $this->_deleted;
    }
    public function getPdo() {
        return $this->_pdo;
    }
    public function getRole_id() {
        return $this->_role_id;
    }

    // Setters
    public function setId($_id) {
        $this->_id = $_id;
    }
    public function setName($_name) {
        $this->_name = $_name;
    }
    public function setFirst_name($_first_name) {
        $this->_first_name = $_first_name;
    }
    public function setMail($_mail) {
        $this->_mail = $_mail;
    }
    public function setPhone_number($_phone_number) {
        $this->_phone_number = $_phone_number;
    }
    public function setBirth_date($_birth_date) {
        $this->_birth_date = $_birth_date;
    }
    public function setPhoto_user($_photo_user) {
        $this->_photo_user = $_photo_user;
    }
    public function setPassword($_password) {
        $this->_password = $_password;
    }
    public function setRegistration_number($_registration_number) {
        $this->_registration_number = $_registration_number;
    }
    public function setStatus($_status) {
        $this->_status = $_status;
    }
    public function setCreate_by($_create_by) {
        $this->_create_by = $_create_by;
    }
    public function setCreate_date($_create_date) {
        $this->_create_date = $_create_date;
    }
    public function setModified_by($_modified_by) {
        $this->_modified_by = $_modified_by;
    }
    public function setModified_date($_modified_date) {
        $this->_modified_date = $_modified_date;
    }
    public function setDeleted($_deleted) {
        $this->_deleted = $_deleted;
    }
    public function setPdo($_pdo) {
        $this->_pdo = $_pdo;
    }
    public function setRole_id($_role_id) {
        $this->_role_id = $_role_id;
    }
}
