<?php

namespace src\Entity;

class Salle{

	private $salle;

	public function setSalle($salle)
    {
        $this->salle = $salle;

        return $this;
    }

    public function getSalle()
    {
        return $this->salle;
    }

}