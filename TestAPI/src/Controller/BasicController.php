<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use PDO;
use PDOException;

class BasicController extends Controller
{
    public function allCSV()
    {
       
        #$number = random_int(0, 100);
        
        #return new Response(
        #    '<html><body>Lucky number: '.$number.'</body></html>'
        #    );
        # ceci est un test
        $publicResourcesFolderPath = $this->get('kernel')->getRootDir() . '/../public/';
        $filename = "All-All-2017-09-01_2018-09-01.csv";
        return new BinaryFileResponse($publicResourcesFolderPath.$filename);
    }
    public function parser($typeData){
        $publicResourcesFolderPath = $this->get('kernel')->getRootDir() . '/../public/';
        $filename = "All-All-2017-09-01_2018-09-01.csv";
        $temps = "tempo/temps.csv";
        if (($f = fopen($publicResourcesFolderPath.$temps, "w+")) !== FALSE){
            if (($handle = fopen($publicResourcesFolderPath.$filename, "r")) !== FALSE) {
                $cpt = 0;
                while ((($data = fgetcsv($handle,1000, ";")) !== FALSE)&&($cpt++ < 100000)) {
                    //$num = count($data);
                    if ($data[0] == $typeData){
                        fputcsv($f,$data,";");
                    }
                    //echo "<p> $num champs � la ligne $row: <br /></p>\n";
                    //$row++;
                    //for ($c=0; $c < $num; $c++) {
                    //    echo $data[$c] . "<br />\n";
                    //}
                }
                fclose($handle);
            }
            fclose($f);
            return new BinaryFileResponse($publicResourcesFolderPath.$temps);;
        }
        
    }
    
    
    
    public function parserLieu($typeData){
        $publicResourcesFolderPath = $this->get('kernel')->getRootDir() . '/../public/';
        $filename = "All-All-2017-09-01_2018-09-01.csv";
        $temps = "tempo/temps.csv";
        if (($f = fopen($publicResourcesFolderPath.$temps, "w+")) !== FALSE){
            if (($handle = fopen($publicResourcesFolderPath.$filename, "r")) !== FALSE) {
                $cpt = 0;
                while ((($data = fgetcsv($handle,1000, ";")) !== FALSE)&&($cpt++ < 1000)) {
                    //$num = count($data);
                    if ((substr_count ($data[1], $typeData)) > 0){
                        fputcsv($f,$data,";");
                    }
                    //echo "<p> $num champs � la ligne $row: <br /></p>\n";
                    //$row++;
                    //for ($c=0; $c < $num; $c++) {
                    //    echo $data[$c] . "<br />\n";
                    //}
                }
                fclose($handle);
            }
            fclose($f);
            return new BinaryFileResponse($publicResourcesFolderPath.$temps);;
        }
        
    }
    public function improved($typeData){
        $publicResourcesFolderPath = $this->get('kernel')->getRootDir() . '/../public/';
        $filename = "All-All-2017-09-01_2018-09-01.csv";
            if (($handle = fopen($publicResourcesFolderPath.$filename, "r")) !== FALSE) {
                $cpt = 0;
                $tab = array();
                $pos = 0;
                $leg = "type".  ";" . "place" . ";" . "value" . ";" . "date" . ";" . "unit" . ";" . "ilot";
                while ((($data = fgetcsv($handle,1000, ";")) !== FALSE)&&($cpt++ < 1000)) {
                    //$num = count($data);
                    if ((substr_count ($data[1], $typeData)) > 0){
                        $ligne = '';
                        foreach ($data as $elem){
                            $ligne = $ligne . $elem . ";" ;
                        }
                        $tab[$pos] = $ligne;
                        $pos++;
                        //fputcsv($f,$data,";");
                    }
                    //echo "<p> $num champs � la ligne $row: <br /></p>\n";
                    //$row++;
                    //for ($c=0; $c < $num; $c++) {
                    //    echo $data[$c] . "<br />\n";
                    //}
                }
                fclose($handle);
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
    public function testBDD(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=neocampusapi", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT id, valeur, date FROM mesure");
            $stmt->execute();
            $leg = "id".  ";" . "valeur" . ";" . "date";
            $pos = $stmt->rowCount();
            $res = $stmt->fetchAll();
            
            $tab = array();
            $pos = 0;
            foreach ($res as $row){
                $ligne = "";
                $bug = true;
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
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
        return "no";
    }
    
    
    
}