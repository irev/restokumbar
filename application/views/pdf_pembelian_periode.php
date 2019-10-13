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
$pdf->Cell(0,12,'LAPORAN PEMBELIAN',0,0,'C');
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
		100,
		35,
		20,
		35
	));

function SumDate($value,$key,$awal,$akhir){
	$query = mysql_query("
		SELECT COALESCE(SUM(".$value."),0) AS tp
		FROM pembelian_detail
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
	'',
	'Harga',
	'Jumlah',
	'Total'
));

$tot = 0;
$jml = 0;

$pdf->SetFont('Arial','',12);
$no_all = 1;

foreach($supplier as $sup){
	
	$pdf->Row(array(
		$no_all.'. SUPPLIER '.$sup['nama'],
		'-',
		'-',
		'-'
	));
	
	$q1 = mysql_query("SELECT * FROM bahan WHERE supplier = '".$sup['nama']."'");
	$i = 1;
	
	while($h1 = mysql_fetch_array($q1)){
		$nama = $h1['nama'];
		$harga = Get('harga','bahan','nama',$nama);
		
		$pdf->Row(array(
			'  			'.$no_all.'.'.$i.'  '.$h1['nama'],
			Format($harga),
			SumDate('jumlah',$nama,$awal,$akhir),
			Format(SumDate('total',$nama,$awal,$akhir)),
		));
		$jml +=SumDate('total',$nama,$awal,$akhir); 
		$tot +=SumDate('jumlah',$nama,$awal,$akhir);
		$i++;	
	}
	
	$no_all++;
	
}



	$pdf->Row(array(
		'-',
		'-',
		'-',
		'-'
	));
	
	$pdf->SetWidths(array(
		100,
		55,
		35
	));
	
	$pdf->Row(array(
		'TOTAL PEMBELIAN',
		'',
		Format($jml)
	));
	
	

$pdf->Output();
?>
