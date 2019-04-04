<?php

// src/Controller/ControllerSalle.php
namespace App\Controller;

use App\Entity\Salle;
use App\Form\SalleForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ControllerSalle extends Controller
{
	public function formSalle(){
		$salle = new Salle();
		$salleForm = $this->createForm(SalleForm::class, $salle);

		return $this->render('salle.html.twig', [
            'salleForm' => $salleForm->createView()
        ]);
	}
}