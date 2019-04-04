<?php

// src/Controller/ControllerSalle.php
namespace App\Controller;

use App\Entity\Donnees;
use App\Form\DonneesForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ControllerDonnees extends Controller
{
	public function formDonnees(){
		$donnees = new Donnees();
		$donneesForm = $this->createForm(DonneesForm::class, $donnees);

		return $this->render('donnees.html.twig', [
            'donneesForm' => $donneesForm->createView()
        ]);
	}
}