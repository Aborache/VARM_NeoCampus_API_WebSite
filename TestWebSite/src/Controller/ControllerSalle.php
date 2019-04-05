<?php

// src/Controller/ControllerSalle.php
namespace App\Controller;

use App\Entity\Salle;
use App\Form\SalleForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ControllerSalle extends Controller
{
	public function formSalle(Request $request){
		$salle = new Salle();
		$salleForm = $this->createForm(SalleForm::class, $salle);

		if($request->isMethod('POST')){
            $salleForm->handleRequest($request);
            $adresseAPI = 'http://localhost:8000/Room_Informations/';
            $numéroSalle = $salle->getSalle();

            return $this->redirect($adresseAPI.$numéroSalle);
        }

		return $this->render('salle.html.twig', [
            'salleForm' => $salleForm->createView()
        ]);
	}
}