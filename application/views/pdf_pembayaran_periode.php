<?php

require('com_pdf.php');
$pdf=new table('P','mm','A4');
$pdf->AddPage();

$gambar = base_url()."assets/img/header.png";
$pdf->Cell(0,12,$pdf->Image($gambar, 59,null, 96),0,0,'C');

$pdf->ln(5);
$pdf->Cell(0,0,'',1,0,'C');
$pdf->ln(5);


$awal = $_GET['awal'];
$akhir = $_GET['akhir'];

$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,12,'LAPORAN PEMBAYARAN',0,0,'C');
$pdf->ln(8);

if($awal==$akhir){
	$pdf->Cell(0,12,'Periode '.$awal,0,0,'C');
}else{
	$pdf->Cell(0,12,'Periode '.$awal.' - '.$akhir,0,0,'C');
}

$pdf->ln(16);


$pdf->SetFont('Arial','B',12);
$pdf->ln(10);
$pdf->SetWidths(array(
		19,
		125,
		45
	));

function SumDate($value,$key,$awal,$akhir){
	$query = mysql_query("
		SELECT COALESCE(SUM(".$value."),0) AS tp
		FROM pembayaran_detail
		WHERE item =  '".$key."'
		AND tanggal
		>= '".$awal."'
		AND tanggal
		<=  '".$akhir."'
	");
	while($row = mysql_fetch_array($query)){
		return $row['tp'];
	}
}


$pdf->Row(array(
	'No',
	'Keterangan',
	'Total Harga'
));

$tot = 0;
$jml = 0;

$pdf->SetFont('Arial','',12);
$no_all = 1;

foreach($bayar as $by){

	$nama = $by->item;
	$harga = SumDate('harga',$nama,$awal,$akhir);
	$pdf->Row(array(
		$no_all,
		$by->item,
		Format($harga)
	));
	$tot+=$harga;
	$no_all++;
}


$pdf->Row(array(
	'-',
	'-',
	'-'
));

$pdf->SetFont('Arial','B',12);
$pdf->Row(array(
	'',
	'TOTAL PEMBAYARAN',
	Format($tot)
));	
	

$pdf->Output();
?>
