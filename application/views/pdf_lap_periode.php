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
$pdf->Cell(0,12,'LAPORAN PENJUALAN',0,0,'C');
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
		FROM penjualan_detail
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

function Potongan($awal,$akhir){
	$query = mysql_query("
		SELECT COALESCE(SUM(potongan),0) AS tp
		FROM penjualan
		WHERE tanggal
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

foreach($kategori as $kat){
	
	$pdf->Row(array(
		$no_all.'. KATEGORI MENU '.$kat['kategori'],
		'-',
		'-',
		'-'
	));
	
	$q1 = mysql_query("SELECT * FROM menu WHERE kategori = '".$kat['kategori']."'");
	$i = 1;
	
	while($h1 = mysql_fetch_array($q1)){
		$nama = $h1['nama'];
		$harga = Get('harga','menu','nama',$nama);
		
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

foreach($extra as $ex){
	
	$nama = $ex['nama'];
	$harga = Get('harga','extra','nama',$nama);
	$pdf->Row(array(
		$no_all.' . EXTRA '.$ex['nama'],
		Format($harga),
		SumDate('jumlah',$nama,$awal,$akhir),
		Format(SumDate('total',$nama,$awal,$akhir)),
	));
	$jml +=SumDate('total',$nama,$awal,$akhir); 
	$tot +=SumDate('jumlah',$nama,$awal,$akhir);
	$no_all++;
}

foreach($level as $lv){

	$nama = $lv['nama'];
	$harga = Get('harga','level_pedas','nama',$nama);
	$pdf->Row(array(
		$no_all.' . LEVEL PEDAS '.$lv['nama'],
		Format($harga),
		SumDate('jumlah',$nama,$awal,$akhir),
		Format(SumDate('total',$nama,$awal,$akhir)),
	));
	$jml +=SumDate('total',$nama,$awal,$akhir);
	$tot +=SumDate('jumlah',$nama,$awal,$akhir);	
	$no_all++;
}


	$pdf->Row(array(
		'-',
		'-',
		'-',
		'-'
	));

	$pdf->SetFont('Arial','B',12);
	$pdf->Row(array(
		'SUBTOTAL PENJUALAN',
		'',
		$tot,
		Format($jml)
	));
	
	$pdf->SetWidths(array(
		100,
		55,
		35
	));
	
	$pdf->Row(array(
		'TOTAL POTONGAN PENJUALAN (DISKON)',
				Format(Potongan($awal,$akhir)),
		'-'
	));
	
	$pdf->Row(array(
		'GRAND TOTAL PENJUALAN',
		'',
		Format($jml-Potongan($awal,$akhir))
	));
	
	

$pdf->Output();
?>
