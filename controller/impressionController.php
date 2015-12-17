<?php
include_once "/class/Note.php";
include_once '/class/CategorieFrais.php';
include_once '/class/Devise.php';

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Europe/Paris');

/** PHPExcel_IOFactory */
require_once ('/ressources/PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php');
//require_once ('/ressources/PHPExcel_1.8.0_doc/Classes/PHPExcel/Writer/PDF.php');
//require_once ('/ressources/PHPExcel_1.8.0_doc/Classes/PHPExcel/Writer/PDF/Core.php');
//require_once ('/ressources/PHPExcel_1.8.0_doc/Classes/PHPExcel/Writer/PDF/mPDF.php');
//require_once ('/ressources/PHPExcel_1.8.0_doc/Classes/PHPExcel/Writer/PDF/tcPDF.php');


echo date('H:i:s') , " Load from Excel5 template" , EOL;
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load("ressources/PHPExcel_1.8.0_doc/Examples/templates/templateEnote.xls");

$CloneNote = Note::getNoteById($bdd,1);
$allFraisFromThisNote = $CloneNote->getListFrais($bdd);

$CloneDevise = Devise::getDeviseById($bdd, $sessionUser->getDevise());

//Ecrit le nom et le login de l'utilisateur
$nomUtilisateur = str_replace(" ","",$sessionUser->getName());

$objPHPExcel->getActiveSheet()->setCellValue('B8', $nomUtilisateur);
$objPHPExcel->getActiveSheet()->setCellValue('F8', $sessionUser->getLogin());
$objPHPExcel->getActiveSheet()->setCellValue('J8', $CloneDevise->getName());


$datePremierFrais;
$dateDernierFrais;
$totalAvance = 0;
$totalCase = 0;
$totalTTC = 0;
$baseRow = 16;

foreach($allFraisFromThisNote as $r => $fraisFromNote) {
	$row = $baseRow + $r;
        $CategorieName = CategorieFrais::getCategorieById($bdd, $fraisFromNote['categorie_id']);
	$objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);
        
        //Affiche dans la bonne devise
        $deviseFrais = Devise::getDeviseById($bdd, $fraisFromNote['devise_id']);
        $montantDeviseUser = Devise::getValueOfChangedDevise($fraisFromNote['montant'], $deviseFrais->getTaux(), $CloneDevise->getTaux());
        
        //Verifie si on a ne avance
        if($fraisFromNote['categorie_id'] == 4)
        {
            $totalAvance += $montantDeviseUser;
            $tva = $montantDeviseUser;
        }else{
            $tva = $montantDeviseUser * 1.2;
        }
        
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $fraisFromNote['id'])
	                              ->setCellValue('B'.$row, $fraisFromNote['date'])
	                              ->setCellValue('C'.$row, $fraisFromNote['description'])
                                      ->setCellValue('E'.$row, $montantDeviseUser)
                                      ->setCellValue('F'.$row, $tva)
                                      ->setCellValue('H'.$row, $CategorieName->getName());
        
        $dateFrais = $fraisFromNote['date'];
        
        //On récupère la première et la dernière date
        if($row == 16)
        {
            $datePremierFrais = $fraisFromNote['date'];
            $dateDernierFrais = $fraisFromNote['date'];
        }else{
            if($dateFrais < $datePremierFrais)
            {
                $datePremierFrais = $dateFrais;
            }else if ($dateFrais > $dateDernierFrais)
            {
                $dateDernierFrais = $dateFrais;
            }
        }
        
    $totalCase = $row;    
}

echo 'F'.($totalCase).'=SOMME(F15:F'.($totalCase-1).')';
$objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
//Indique la date du premier et du dernier frais
$objPHPExcel->getActiveSheet()->setCellValue('C10', $datePremierFrais);
$objPHPExcel->getActiveSheet()->setCellValue('F10', $dateDernierFrais);

//Affiche le total sans et avec les taxes
$objPHPExcel->getActiveSheet()->setCellValue('E'.($totalCase), '=SUM(E15:E'.($totalCase-1).')');
$totalCase++;
$objPHPExcel->getActiveSheet()->setCellValue('F'.($totalCase), '=SUM(F15:F'.($totalCase-1).')');

afficherAvance($CloneDevise->getName(),$totalAvance, $objPHPExcel, $totalCase+1);

//Affiche la déduction des avances
$totalCase++;
$objPHPExcel->getActiveSheet()->setCellValue('F'.($totalCase), '=F'.($totalCase-1).'-'.$totalAvance);

$montantFinal = $objPHPExcel->getActiveSheet()->getCell('F'.($totalCase))->getValue();


//Affiche le du à l'interéssé ou le rendu par l'intéréssé
if($montantFinal < 0)
{
    $objPHPExcel->getActiveSheet()->setCellValue('E'.($totalCase+2), ($montantFinal*-1));
    $objPHPExcel->getActiveSheet()->setCellValue('F'.($totalCase+1), 0);
}else{
    $objPHPExcel->getActiveSheet()->setCellValue('F'.($totalCase+1), '=F'.($totalCase-1).'-'.$totalAvance);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.($totalCase+2), 0);
}

//Affiche le bénéficiare et la date
$objPHPExcel->getActiveSheet()->setCellValue('A'.($totalCase+5), $nomUtilisateur);
$objPHPExcel->getActiveSheet()->setCellValue('A'.($totalCase+7), date('d/m/y'));


//// Enregistrer en PDF, mon problème
//$objWriter  = new PHPExcel_Writer_PDF($objPHPExcel);
//$objWriter->save('NoteFrais.pdf');


echo date('H:i:s') , " Write to Excel5 format" , EOL;
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$nomFichier = $nomUtilisateur.date("d-m-Y").'A'. date('H-i-s') .'NoteFrais.xls';
$cheminComplet = 'Excel/'.$nomUtilisateur.date("d-m-Y").'A'. date('H-i-s') .'NoteFrais.xls';

$objWriter->save($cheminComplet);

forcerTelechargement($nomFichier, $cheminComplet, filesize($cheminComplet));


echo filesize($cheminComplet) . 'et le nom '.$nomFichier. ' et le chemin '. $cheminComplet;
echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;

// Echo memory peak usage
echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

// Echo done
echo date('H:i:s') , " Done writing file" , EOL;
echo 'File has been created in ' , getcwd() , EOL;
<a href="/images/myw3schoolsimage.jpg" download>
//forcerTelechargement($nomFichier, $cheminComplet, filesize($cheminComplet));

function afficherAvance($devise,$montantAvance,$objPHPExcel, $celluleAremplir)
{
    switch ($devise) {
        case 'Euro':
            $objPHPExcel->getActiveSheet()->setCellValue('H'.($celluleAremplir), $montantAvance);
            break;
        case 'Dollar':
            $objPHPExcel->getActiveSheet()->setCellValue('H'.($celluleAremplir+1), $montantAvance);
            break;
        case 'Livre':
            $objPHPExcel->getActiveSheet()->setCellValue('H'.($celluleAremplir+2), $montantAvance);
            break;
        case 'Yen':
            $objPHPExcel->getActiveSheet()->setCellValue('H'.($celluleAremplir+3), $montantAvance);
            break;
        default:
            break;
    }
}

function forcerTelechargement($nom, $situation, $poids)
  {
//    header('Content-Type: application/octet-stream');
//    header('Content-Length: '. $poids);
//    header('Content-disposition: attachment; filename='. $nom);
//    header('Pragma: no-cache');
//    header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
//    header('Expires: 0');
//    readfile($situation);
//    exit();
    
    // désactive la mise en cache
    header("Cache-Control: no-cache, must-revalidate");
    header("Cache-Control: post-check=0,pre-check=0");
    header("Cache-Control: max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");

    // force le téléchargement du fichier avec un beau nom
    header("Content-Type: application/force-download");
    header('Content-Disposition: attachment; filename="'.$nom.'"');

    // indique la taille du fichier à télécharger
    header("Content-Length: ".$poids);

    // envoi le contenu du fichier
    readfile($situation);
  }
  
  ?>