<?php include_once('config.php'); include('Classes/PHPExcel.php');
 
$objPHPExcel    =   new PHPExcel();

 
$objPHPExcel->setActiveSheetIndex(0);
 
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Country Code');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Country Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Capital');
 
$objPHPExcel->getActiveSheet()->getStyle("A1:C1")->getFont()->setBold(true);
 
$rowCount   =   2;

    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, mb_strtoupper($row['countryCode'],'UTF-8'));
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, mb_strtoupper($row['countryName'],'UTF-8'));
    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, mb_strtoupper($row['capital'],'UTF-8'));

 
 
$objWriter  =   new PHPExcel_Writer_Excel2007($objPHPExcel);
 
 
header('Content-Type: application/vnd.ms-excel'); //mime type
header('Content-Disposition: attachment;filename="you-file-name.xlsx"'); //tell browser what's the file name
header('Cache-Control: max-age=0'); //no cache
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
$objWriter->save('php://output');
?>