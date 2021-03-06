<?php
include_once "/class/Note.php";
include_once '/class/CategorieFrais.php';
include_once '/class/Devise.php';


if(isset($_GET['id']) && !empty($_GET['id']))
{
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

    date_default_timezone_set('Europe/Paris');

    /** PHPExcel_IOFactory */
    require_once ('/ressources/PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php');
    require_once ('/ressources/PHPExcel_1.8.0_doc/Classes/PHPExcel/Writer/PDF.php');
    include '/ressources/PHPExcel_1.8.0_doc/Classes/PHPExcel/Writer/Excel2007.php';


    $objReader = PHPExcel_IOFactory::createReader('Excel5');


    // Chemin d'accès à la librairie de convesion tcPDF
    $rendererLibraryPath = 'ressources/PHPExcel_1.8.0_doc/Classes/libs/tcpdf';
    PHPExcel_Settings::setPdfRenderer(PHPExcel_Settings::PDF_RENDERER_TCPDF, $rendererLibraryPath);



    $objPHPExcel = $objReader->load("ressources/PHPExcel_1.8.0_doc/Examples/templates/templateEnote.xls");

    //On fait un clone de la note pour obtenir toutes ses informations
    $CloneNote = Note::getNoteById($bdd,$_GET['id']);
    $allFraisFromThisNote = $CloneNote->getListFrais($bdd);

    //Clone de la devise pour avoir toutes ses informations
    $CloneDevise = Devise::getDeviseById($bdd, $sessionUser->getDevise());

    //Ecrit le nom et le login de l'utilisateur ainsi que sa devise
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

    //On boucle pour afficher les informations de chaques frais de la note dans le tableau excel
    foreach($allFraisFromThisNote as $r => $fraisFromNote) {
            $row = $baseRow + $r;
            $CategorieName = CategorieFrais::getCategorieById($bdd, $fraisFromNote['categorie_id']);
            $objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);

            //Affiche dans la bonne devise
            $deviseFrais = Devise::getDeviseById($bdd, $fraisFromNote['devise_id']);
            $montantDeviseUser = Devise::getValueOfChangedDevise($fraisFromNote['montant'], $deviseFrais->getTaux(), $CloneDevise->getTaux());

            //Verifie si on a une avance
            if($fraisFromNote['categorie_id'] == 4)
            {
                $totalAvance += $montantDeviseUser;
                $tva = $montantDeviseUser;
                
                $totalTTC -= $montantDeviseUser;
            }else{
                $tva = $montantDeviseUser * 1.2;
                $totalTTC += $tva;
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


    $objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);
    //Indique la date du premier et du dernier frais
    $objPHPExcel->getActiveSheet()->setCellValue('C10', $datePremierFrais);
    $objPHPExcel->getActiveSheet()->setCellValue('F10', $dateDernierFrais);

    //Affiche le total sans et avec les taxes
    $objPHPExcel->getActiveSheet()->setCellValue('E'.($totalCase), '=SUM(E15:E'.($totalCase-1).')-'.$totalAvance);
    $totalCase++;
    $objPHPExcel->getActiveSheet()->setCellValue('F'.($totalCase), '=SUM(F15:F'.($totalCase-1).')-'.$totalAvance);

    afficherAvance($CloneDevise->getName(),$totalAvance, $objPHPExcel, $totalCase+1);

    //Affiche la déduction des avances
    $totalCase++;
    $objPHPExcel->getActiveSheet()->setCellValue('F'.($totalCase), '=F'.($totalCase-1).'-'.($totalAvance));

    $montantFinal = $objPHPExcel->getActiveSheet()->getCell('F'.($totalCase))->getValue();
    
    //Affiche le du à l'interéssé ou le rendu par l'intéréssé
    if($totalTTC < 0)
    {
        $objPHPExcel->getActiveSheet()->setCellValue('E'.($totalCase+2), '=-F'.($totalCase));
        $objPHPExcel->getActiveSheet()->setCellValue('F'.($totalCase+1), 0);
    }else{
        $objPHPExcel->getActiveSheet()->setCellValue('F'.($totalCase+1), '=F'.($totalCase-1).'-'.$totalAvance);
        $objPHPExcel->getActiveSheet()->setCellValue('E'.($totalCase+2), 0);
    }

    //Affiche le bénéficiare et la date
    $objPHPExcel->getActiveSheet()->setCellValue('A'.($totalCase+5), $nomUtilisateur);
    $objPHPExcel->getActiveSheet()->setCellValue('A'.($totalCase+7), date('d/m/y'));

    //On prépare le fichier excel
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $nomFichier = $nomUtilisateur.date("d-m-Y").'A'. date('H-i-s') .'NoteFrais.xls';

    //On sauvegarde le fichier sous forme xls (pour pouvoir le télécharger par la suite si désiré)
    $cheminComplet = 'Excel/'.$nomUtilisateur.date("d-m-Y").'A'. date('H-i-s') .'NoteFrais.xls';
    $objWriter->save($cheminComplet);
    
    //Préparation du fichier PDF
    $nomFichierPdf = $nomUtilisateur.date("d-m-Y").'A'. date('H-i-s') .'NoteFrais.pdf';
    $cheminCompletPdf = 'Excel/'.$nomUtilisateur.date("d-m-Y").'A'. date('H-i-s') .'NoteFrais.pdf';

    //On sauvegarde le fichier sous format pdf (on passe en paramètre le tableau excel)
    $objWriterPdf = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
    $objWriterPdf->save($cheminCompletPdf);
    
    include_once '/views/include/impression.php';
}
else{
    //Si l'id de la note n'est pas trouvé on renvoie l'utilisateur à l'accueil
    header('Location:' . $basePath);
}


//Permet d'afficher la valeur des montants dans la bonne devise et dans les bonnes cases
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

  
  ?>