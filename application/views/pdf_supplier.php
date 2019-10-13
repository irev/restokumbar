<?php

require('com_pdf.php');
$pdf=new table('L','mm','A4');
$pdf->AddPage();

$gambar = base_url()."assets/img/header.png";
$pdf->Cell(0,12,$pdf->Image($gambar, 103,null, 96),0,0,'C');

$pdf->ln(5);
$pdf->Cell(0,0,'',1,0,'C');
$pdf->ln(5);

$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,12,'DAFTAR MENU',0,0,'C');
$pdf->ln(16);


$pdf->SetFont('Arial','',12);
$pdf->Cell(0,12,'Total Data : '.$jml_data,0,0,'L');
$pdf->ln(10);
$pdf->SetWidths(array(25,85,70,98));
$pdf->Row(array(
	'No Supplier',
	'Nama Supplier',
	'No Telepon',
	'Alamat'
));

$i = 1;
if($data){

	foreach($data as $data){
		$pdf->Row(array(
			$data->no_supplier,
			$data->nama,
			$data->telp,
			$data->alamat
		));
		$i++;
	}

}



$pdf->Output();
?>
