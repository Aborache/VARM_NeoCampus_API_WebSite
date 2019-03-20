<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Utils\DatabaseConnector;

class CollectorController extends Controller
{
    protected $db = Null;
    
    
    
    function InformationsSalle($id_salle){
        
        
    }
    
    function meteo($date_debut,$date_fin, $prevision, $listetypeMeteo ){
        
    }
    
    function DonneeBase($date_debut, $date_fin, $type_lieu, $lieu, $typeDonne){
        
    }
    
    function VectorSimple ($dateDebut, $dateFin, $type_lieu, $lieu, $liste_Types_Donne,$liste_Previsions, $liste_Type_Meteos, $methode_Regroupe, $taille_Plage ){
    }
      

    
}

