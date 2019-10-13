<?php

require('com_pdf.php');
$pdf=new table('L','mm',array(300,380));
$pdf->AddPage();

$gambar = base_url()."assets/img/header.png";
$pdf->Cell(0,12,$pdf->Image($gambar, 130,null, 96),0,0,'C');

$pdf->ln(5);
$pdf->Cell(0,0,'',1,0,'C');
$pdf->ln(5);

$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,12,'DAFTAR MENU',0,0,'C');
$pdf->ln(16);


$pdf->SetFont('Arial','',12);
$pdf->Cell(0,12,'Total Data : '.$jml_data,0,0,'L');
$pdf->ln(10);

$pdf->SetWidths(array(30,70,100,40,30,90));
$pdf->Row(array(
	'No Menu',
	'Kategori',
	'Nama Menu',
	'Harga',
	'Rekomendasi',
	'Keterangan'
));

$i = 1;
if($data){

	foreach($data as $data){
	
	$r='Tidak';
	if($data->rekomendasi=='n'){
		$r = 'Ya';
	}
	
	$pdf->Row(array(
		$data->no_menu,
		$data->kategori,
		$data->nama,
		Format($data->harga),
		$r,
		Get('keterangan','kategori_menu','kategori',$data->kategori)
	));	
	$i++;
}

}



$pdf->Output();
?>
