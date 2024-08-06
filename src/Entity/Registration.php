<?php

namespace App\Entity;

class Registration
 {

    private $id;
    private $cniEtudiant;
    private $birthCertificate;
    private $entranceDegree;
    private $nomDiplome;
    private $createBy;
    private $modifiedBy;

    public function __construct(array $registrationData = [])
    {
        if (!empty($registrationData)) {
            $this->id = $registrationData['id'] ?? null;
            $this->cniEtudiant = $registrationData['cniEtudiant'] ?? null;
            $this->birthCertificate = $registrationData['birthCertificate'] ?? null;
            $this->entranceDegree = $registrationData['entranceDegree'] ?? null;
            $this->nomDiplome = $registrationData['nomDiplome'] ?? null;
            $this->createBy = $registrationData['createBy'] ?? null;
            $this->modifiedBy = $registrationData['modifiedBy'] ?? null;
        }
    }



    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of cniEtudiant
     */ 
    public function getCniEtudiant()
    {
        return $this->cniEtudiant;
    }

    /**
     * Set the value of cniEtudiant
     *
     * @return  self
     */ 
    public function setCniEtudiant($cniEtudiant)
    {
        $this->cniEtudiant = $cniEtudiant;

        return $this;
    }

    /**
     * Get the value of birthCertificate
     */ 
    public function getBirthCertificate()
    {
        return $this->birthCertificate;
    }

    /**
     * Set the value of birthCertificate
     *
     * @return  self
     */ 
    public function setBirthCertificate($birthCertificate)
    {
        $this->birthCertificate = $birthCertificate;

        return $this;
    }

    /**
     * Get the value of entranceDegree
     */ 
    public function getEntranceDegree()
    {
        return $this->entranceDegree;
    }

    /**
     * Set the value of entranceDegree
     *
     * @return  self
     */ 
    public function setEntranceDegree($entranceDegree)
    {
        $this->entranceDegree = $entranceDegree;

        return $this;
    }

    /**
     * Get the value of nomDiplome
     */ 
    public function getNomDiplome()
    {
        return $this->nomDiplome;
    }

    /**
     * Set the value of nomDiplome
     *
     * @return  self
     */ 
    public function setNomDiplome($nomDiplome)
    {
        $this->nomDiplome = $nomDiplome;

        return $this;
    }

    /**
     * Get the value of createBy
     */ 
    public function getCreateBy()
    {
        return $this->createBy;
    }

    /**
     * Set the value of createBy
     *
     * @return  self
     */ 
    public function setCreateBy($createBy)
    {
        $this->createBy = $createBy;

        return $this;
    }

    /**
     * Get the value of modifiedBy
     */ 
    public function getModifiedBy()
    {
        return $this->modifiedBy;
    }

    /**
     * Set the value of modifiedBy
     *
     * @return  self
     */ 
    public function setModifiedBy($modifiedBy)
    {
        $this->modifiedBy = $modifiedBy;

        return $this;
    }
}