<?php

// src/Controller/ControllerSalle.php
namespace App\Controller;

use App\Entity\Vector;
use App\Form\VectorForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ControllerVector extends Controller
{
	public function formVector(Request $request){
		$vector = new Vector();
		$vectorForm = $this->createForm(VectorForm::class, $vector);

		if($request->isMethod('POST')){
            $vectorForm->handleRequest($request);
            $adresseAPI = 'http://localhost:8000/Vector';
            $dateDebut = $vector->getDateDebut()->format('Y-m-d%H::i::s');
            $dateFin = $vector->getDateFin()->format('Y-m-d%H::i::s');
            $typeLieu = $vector->getTypeLieu();
            $lieu = $vector->getLieu();
            
            $listTypeDonnee = $vector->getListTypeDonnee();
            $prem = true;
            $lestypes="";
            foreach ($listTypeDonnee as $elem){
                if ($prem){
                    $lestypes = $elem;
                    $prem = false;
                }else{                   
                    $lestypes= $lestypes." ".$elem;                   
                }
            }
            
            $methode = $vector->getMethode();
            $taille = $vector->getTaille();
            $lienURL = $adresseAPI.'/'.$dateDebut.'/'.$dateFin.'/'.$typeLieu.'/'.$lieu.'/'.$lestypes.'/'.$methode.'/'.$taille;

            return $this->redirect($lienURL);
        }

		return $this->render('vector.html.twig', [
            'vectorForm' => $vectorForm->createView()
        ]);
	}
}