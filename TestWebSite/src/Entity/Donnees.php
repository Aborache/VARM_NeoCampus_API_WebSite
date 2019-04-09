<?php

namespace App\Entity;

class Donnees{
	
    private $dateDebut;
    private $dateFin;
    private $typeLieu;
    private $lieu;
    private $typeDonnee;

    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateDebut()
    {
        return $this->dateDebut;
    }


    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDateFin()
    {
        return $this->dateFin;
    }


    public function setTypeLieu($typeLieu)
    {
        $this->typeLieu = $typeLieu;

        return $this;
    }

    public function getTypeLieu()
    {
        return $this->typeLieu;
    }


    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getLieu()
    {
        return $this->lieu;
    }


    public function setTypeDonnee($typeDonnee)
    {
        $this->typeDonnee = $typeDonnee;

        return $this;
    }

    public function getTypeDonnee()
    {
        return $this->typeDonnee;
    }
}