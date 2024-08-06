<?php

namespace App\Entity;

class Sessions {

    private $id;
    private $accademic_year;
    private $statut;
    private $created_date;
    private $mois;
    private $duree;
    private $date_de_debut;
    private $date_de_fin;
    public function __construct(array $sessionsData = [])
    {
        if (!empty($sessionsData)) {
            $this->id = $sessionsData['id'] ?? null;
            $this->accademic_year = $sessionsData['accademic_year'] ?? null;
            $this->statut = $sessionsData['statut'] ?? null;
            $this->created_date = $sessionsData['created_date'] ?? null;
            $this->mois = $sessionsData['mois'] ?? null;
            $this->duree = $sessionsData['duree'] ?? null;
            $this->date_de_debut = $sessionsData['date_de_debut'] ?? null;
            $this->date_de_fin = $sessionsData['date_de_fin'] ?? null;
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
     * Get the value of accademic_year
     */ 
    public function getAccademic_year()
    {
        return $this->accademic_year;
    }

    /**
     * Set the value of accademic_year
     *
     * @return  self
     */ 
    public function setAccademic_year($accademic_year)
    {
        $this->accademic_year = $accademic_year;

        return $this;
    }

    /**
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get the value of created_date
     */ 
    public function getCreated_date()
    {
        return $this->created_date;
    }

    /**
     * Set the value of created_date
     *
     * @return  self
     */ 
    public function setCreated_date($created_date)
    {
        $this->created_date = $created_date;

        return $this;
    }

    /**
     * Get the value of mois
     */ 
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set the value of mois
     *
     * @return  self
     */ 
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get the value of duree
     */ 
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set the value of duree
     *
     * @return  self
     */ 
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get the value of date_de_debut
     */ 
    public function getDate_de_debut()
    {
        return $this->date_de_debut;
    }

    /**
     * Set the value of date_de_debut
     *
     * @return  self
     */ 
    public function setDate_de_debut($date_de_debut)
    {
        $this->date_de_debut = $date_de_debut;

        return $this;
    }

    /**
     * Get the value of date_de_fin
     */ 
    public function getDate_de_fin()
    {
        return $this->date_de_fin;
    }

    /**
     * Set the value of date_de_fin
     *
     * @return  self
     */ 
    public function setDate_de_fin($date_de_fin)
    {
        $this->date_de_fin = $date_de_fin;

        return $this;
    }
}