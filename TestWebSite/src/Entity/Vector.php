<?php

namespace App\Entity;

class Vector{
	
    private $dateDebut;
    private $dateFin;
    private $typeLieu;
    private $lieu;
    private $listTypeDonnee;
    private $methode;
    private $taille;

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


    public function setListTypeDonnee($listTypeDonnee)
    {
        $this->listTypeDonnee = $listTypeDonnee;

        return $this;
    }

    public function getListTypeDonnee()
    {
        $listTypeDonnee = $this->listTypeDonnee;
         var_dump($listTypeDonnee);
        if ($listTypeDonnee != NULL) {
            return explode(" ",implode(" ",$listTypeDonnee));
        }else {
           return $this->listTypeDonnee;
        }
    }

    public function setMethode($methode)
    {
        $this->methode = $methode;

        return $this;
    }

    public function getMethode()
    {
        return $this->methode;
    }

    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    public function getTaille()
    {
        return $this->taille;
    }
}