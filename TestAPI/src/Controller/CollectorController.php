<?php
namespace App\Controller;


class CollectorController extends BaseAPIController {       
    
    function InformationsSalle($id_salle){
        return $this->simpleRequest("SELECT * FROM salle WHERE id = ".$id_salle);
        
    }
    
    function meteo($date_debut,$date_fin, $prevision, $listetypeMeteo ){}
         
    
    function DonneeBase($date_debut, $date_fin, $type_lieu, $lieu, $typeDonne){
        /*http://localhost:8000/Data/2017-09-12%20::23::41/2017-09-12%20::23::45/Cluster/24377/1 */
        /*http://localhost:8000/Data/2017-09-12%20::23::41/2017-09-12%20::23::45/All/24377/1 */
        switch ($type_lieu) {
            case "Cluster":               
                /*return $this->simpleRequest("SELECT valeur,date FROM mesure WHERE
                    date > '".$date_debut."' AND date < '".$date_fin."' AND typeMesure = ".$typeDonne." AND ilot =". $lieu);*/
                return $this->simpleRequest("SELECT valeur, date FROM v_m".$typeDonne." WHERE
                    date > '".$date_debut."' AND date <  '".$date_fin."'  and ilot =  '". $lieu."'" );  
                break;
            case "Building":
                return $this->simpleRequest("SELECT valeur,date FROM v_m".$typeDonne.", ilot, salle WHERE
                    date > '".$date_debut."'
                    AND date < '".$date_fin."' AND v_m".$typeDonne.".ilot = ilot.id 
                    AND ilot.salle = salle.id AND salle.batiment = '". $lieu."'");
                break;
            case "Room":
                return $this->simpleRequest("SELECT valeur,date FROM v_m".$typeDonne.", ilot WHERE
                    date > '".$date_debut."' 
                    AND date < '".$date_fin."' AND v_m".$typeDonne.".ilot = ilot.id AND ilot.salle = '". $lieu."'");
                break;
            case "All":
                return $this->simpleRequest("SELECT valeur,date FROM v_m".$typeDonne." WHERE
                    date > '".$date_debut."'
                    AND date < '".$date_fin."' ");
                break;
        }
        
    }
    
    function VectorSimple ($dateDebut, $dateFin, $type_lieu, $lieu, $liste_Types_Donne, $methode_Regroupe, $taille_Plage ){
        switch ($taille_Plage){
            case "sec":
                $interv = 0;
                break;
            case "min":
                $interv = -2;
                break;
            case "hour":
                $interv = -4;
                break;
            case "day":
                $interv = -6;
                break;
            case "mounth":
                $interv = -8;
                break;
            case "year":
                $interv = -10;
                break;
        }
        switch ($type_lieu){
            case "Cluster":
                $position = " WHERE ilot =  '". $lieu."' AND " ;
                break;
            case "Room":
                $position = " ilot WHERE ilot = ilot.id AND ilot.salle = '". $lieu."' AND " ;
                break;
            case "Building":
                $position = " ilot, salle WHERE ilot = ilot.id AND ilot.salle = salle.id AND salle.batiment = '". $lieu."' AND ";
                break;
            
            case "All":
                $position = " WHERE ";
                break;
            
        }
        
        $dates = "date > '".$dateDebut."'AND date < '".$dateFin."' ";
            
        
        $cpt = 1;
        $part1 =  "SELECT t1.temps periode ";
        $part2 = "";
        $part3 = " ";
        foreach (explode(" ",$liste_Types_Donne) as $value){
            $part1 = $part1.", t".$cpt.".regroupeVar";
            
            if ($cpt != 1){                
                $part2 = $part2.", ";
            
                if ($cpt == 2){
                    $part3 = $part3."WHERE t".$cpt.".temps = t1.temps ";
                }
                if ($cpt > 2){
                    $part3 = $part3."AND t".$cpt.".temps = t1.temps ";
                }
                    
            }
            $part2 = $part2."(SELECT ".$methode_Regroupe."(valeur) regroupeVar, ROUND(date,".$interv.
            ") temps FROM  v_m".$value.$position.$dates."GROUP BY (ROUND(date,".$interv.
            ") )) as t".$cpt." ";
            
            
            $cpt++;            
        }
        return $this->simpleRequest($part1.$part2.$part3);
        
        
            
    }
      

    
}

