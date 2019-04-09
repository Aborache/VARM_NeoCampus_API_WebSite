<?php

// src/Controller/ControllerSalle.php
namespace App\Controller;

use App\Entity\Donnees;
use App\Form\DonneesForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ControllerDonnees extends Controller
{
	public function formDonnees(Request $request){
		$donnees = new Donnees();
		$donneesForm = $this->createForm(DonneesForm::class, $donnees);

		if($request->isMethod('POST')){
            $donneesForm->handleRequest($request);
            $adresseAPI = 'http://localhost:8000/Data';
            $dateDebut = $donnees->getDateDebut()->format('Y-m-d%H::i::s');
            $dateFin = $donnees->getDateFin()->format('Y-m-d%H::i::s');
            $typeLieu = $donnees->getTypeLieu();
            $lieu = $donnees->getLieu();
            $typeDonnee = $donnees->getTypeDonnee();
            $lienURL = $adresseAPI.'/'.$dateDebut.'/'.$dateFin.'/'.$typeLieu.'/'.$lieu.'/'.$typeDonnee;

            return $this->redirect($lienURL);
        }

		return $this->render('donnees.html.twig', [
            'donneesForm' => $donneesForm->createView()
        ]);
	}
}