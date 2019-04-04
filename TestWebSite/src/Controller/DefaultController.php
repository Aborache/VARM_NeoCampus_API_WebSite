<?php

// src/Controller/DefaultController.php
namespace App\Controller;

class DefaultController
{
	public function menuAction(){
		return this->render('TestWebSite:templates:menu.html.twig', array);
	}
}