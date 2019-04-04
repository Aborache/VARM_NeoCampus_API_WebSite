<?php

// src/Controller/DefaultController.php
namespace App\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
	public function menuAction(){
		return $this->render('menu.html.twig', array());
	}
}