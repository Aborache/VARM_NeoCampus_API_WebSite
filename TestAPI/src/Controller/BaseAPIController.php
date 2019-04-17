<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Utils\DatabaseConnector;
use Symfony\Component\HttpFoundation\File\File;
/**
 *Controleur de haut niveau
 *propose des service de BD
 * 
 */
class BaseAPIController extends AbstractController
{
    protected $db = Null;

    public function __construct(){ 
        $this->db = new DatabaseConnector();
        
    }
    /**
     * fonction produisant le fichier résultat
     * à partir d'une requete 
     * @param string $req la requete sql
     * @return File $response le fichier à retourner
     */
    protected function simpleRequest($req){
        
        $stmt = $this->db->request($req);
        if (empty($stmt)){
            $leg = "result is empty";
        }else{

            $attributlist = array_keys($stmt[0]);
            $leg = ""; //"id".  ";" . "valeur" . ";" . "date";
            $bug = true;
            
            foreach ($attributlist as $attribut){
                if ($bug) {
                    $leg = $leg . $attribut . ";" ;
                }
                $bug = ! $bug;
            }
            }
        $tab = array();
        $pos = 0;
        foreach ($stmt as $row){
            $ligne = "";
            foreach ($row as $elem){
                if ($bug) {
                    $ligne = $ligne . $elem . ";" ;
                }
                $bug = ! $bug;
            }
            $tab[$pos] = $ligne;
            $pos++;
        }
        $response = $this->render('retour.csv.twig',[
            'tableau' => $tab,
            'nbLigne' => $pos,
            'legende' => $leg
        ]);
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="export.csv"');
        return $response;
        
    }
}

