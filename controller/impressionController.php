<?php
include_once "../class/Note.php";

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

date_default_timezone_set('Europe/Paris');

/** PHPExcel_IOFactory */
require_once ('../ressources/PHPExcel_1.8.0_doc/Classes/PHPExcel/IOFactory.php');

echo date('H:i:s') , " Load from Excel5 template" , EOL;
$objReader = PHPExcel_IOFactory::createReader('Excel5');
$objPHPExcel = $objReader->load("../ressources/PHPExcel_1.8.0_doc/Examples/templates/30template.xls");

$CloneNote = Note::getNoteById($bdd,1);
$allFraisFromThisNote = $CloneNote->getListFrais($bdd);
//$data = array(array('title'=> 'Excel for dummies',
//			'price'		=> 17.99,
//			'quantity'	=> 2
//                    ),  
//			  array('title'		=> 'PHP for dummies',
//					'price'		=> 15.99,
//					'quantity'	=> 1
//				   ),
//			  array('title'		=> 'Inside OOP',
//					'price'		=> 12.95,
//					'quantity'	=> 1
//				   )
//			 );
$objPHPExcel->getActiveSheet()->setCellValue('D1', PHPExcel_Shared_Date::PHPToExcel(time()));

$baseRow = 3;

foreach($allFraisFromThisNote as $r => $fraisFromNote) {
	$row = $baseRow + $r;
	$objPHPExcel->getActiveSheet()->insertNewRowBefore($row,1);

	$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, $fraisFromNote['id'])
	                              ->setCellValue('B'.$row, $fraisFromNote['description'])
	                              ->setCellValue('C'.$row, $fraisFromNote['montant']);
}

$objPHPExcel->getActiveSheet()->removeRow($baseRow-1,1);


echo date('H:i:s') , " Write to Excel5 format" , EOL;
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save(str_replace('.php', '.xls', __FILE__));
echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;

// Echo memory peak usage
echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

// Echo done
echo date('H:i:s') , " Done writing file" , EOL;
echo 'File has been created in ' , getcwd() , EOL;