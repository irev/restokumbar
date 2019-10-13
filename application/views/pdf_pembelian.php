<?php

require('com_pdf.php');
$pdf=new table('L','mm',array(300,575));
$pdf->AddPage();

$gambar = base_url()."assets/img/header.png";
$pdf->Cell(0,12,$pdf->Image($gambar, 235,null, 96),0,0,'C');

$pdf->ln(5);
$pdf->Cell(0,0,'',1,0,'C');
$pdf->ln(5);

$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,12,'LAPORAN PEMBELIAN',0,0,'C');
$pdf->ln(8);
$pdf->Cell(0,12,'Periode Januari - Desember '.$_GET['tahun'],0,0,'C');
$pdf->ln(16);


$pdf->SetFont('Arial','B',12);
$pdf->ln(10);
$pdf->SetWidths(array(100,35,35,35,35,35,35,35,35,35,35,35,35,35));

function SumDate($key,$awal,$akhir){
	$query = mysql_query("
		SELECT SUM( total ) AS tp
		FROM pembelian_detail
		WHERE item =  '".$key."'
		AND tanggal
		BETWEEN  '".$awal."'
		AND  '".$akhir."'
	");
	while($row = mysql_fetch_array($query)){
		return $row['tp'];
	}
}

function Bulan($key,$bulan){
	$tahun = $_GET['tahun'];
	if($bulan=='Januari'){
		return SumDate($key,$tahun.'-01-01',$tahun.'-01-31');
	}
	else if($bulan=='Februari'){
		return SumDate($key,$tahun.'-02-01',$tahun.'-02-28');
	}
	else if($bulan=='Maret'){
		return SumDate($key,$tahun.'-03-01',$tahun.'-03-31');
	}
	else if($bulan=='April'){
		return SumDate($key,$tahun.'-04-01',$tahun.'-04-30');
	}
	else if($bulan=='Mei'){
		return SumDate($key,$tahun.'-05-01',$tahun.'-05-31');
	}
	else if($bulan=='Juni'){
		return SumDate($key,$tahun.'-06-01',$tahun.'-06-30');
	}
	else if($bulan=='Juli'){
		return SumDate($key,$tahun.'-07-01',$tahun.'-07-31');
	}
	else if($bulan=='Agustus'){
		return SumDate($key,$tahun.'-08-01',$tahun.'-08-31');
	}
	else if($bulan=='September'){
		return SumDate($key,$tahun.'-09-01',$tahun.'-09-30');
	}
	else if($bulan=='Oktober'){
		return SumDate($key,$tahun.'-10-01',$tahun.'-10-31');
	}
	else if($bulan=='November'){
		return SumDate($key,$tahun.'-11-01',$tahun.'-11-30');
	}
	else if($bulan=='Desember'){
		return SumDate($key,$tahun.'-12-01',$tahun.'-12-31');
	}
	else {
		return SumDate($key,$tahun.'-01-01',$tahun.'-12-31');
	}
}


$jml = array(0,0,0,0,0,0,0,0,0,0,0,0,0);



$pdf->Row(array(
	'Nama Supplier',
	'Januari',
	'Februari',
	'Maret',
	'April',
	'Mei',
	'Juni',
	'Juli',
	'Agustus',
	'September',
	'Oktober',
	'November',
	'Desember',
	'TOTAL'
));


$no_all = 1;

foreach($supplier as $sp){

	$pdf->SetFont('Arial','B',12);
	$pdf->Row(array(
	$no_all.'.'.$sp['nama'],
	'-',
	'-',
	'-',
	'-',
	'-',
	'-',
	'-',
	'-',
	'-',
	'-',
	'-',
	'-',
	'-'
	));

	
	$q1 = mysql_query("SELECT * FROM bahan WHERE supplier = '".$sp['nama']."'");
	$i = 1;
	while($h1 = mysql_fetch_array($q1)){
		$nama = $h1['nama'];
		$pdf->SetFont('Arial','',12);
		$pdf->Row(array(
			'  			'.$no_all.'.'.$i.'  '.$h1['nama'],
			Format(Bulan($nama,'Januari')),
			Format(Bulan($nama,'Februari')),
			Format(Bulan($nama,'Maret')),
			Format(Bulan($nama,'April')),
			Format(Bulan($nama,'Mei')),
			Format(Bulan($nama,'Juni')),
			Format(Bulan($nama,'Juli')),
			Format(Bulan($nama,'Agustus')),
			Format(Bulan($nama,'September')),
			Format(Bulan($nama,'Oktober')),
			Format(Bulan($nama,'November')),
			Format(Bulan($nama,'Desember')),
			Format(Bulan($nama,'Akhir'))
		));
		$i++;
		
		$jml[0]+=Bulan($nama,'Januari');
		$jml[1]+=Bulan($nama,'Februari');
		$jml[2]+=Bulan($nama,'Maret');
		$jml[3]+=Bulan($nama,'April');
		$jml[4]+=Bulan($nama,'Mei');
		$jml[5]+=Bulan($nama,'Juni');
		$jml[6]+=Bulan($nama,'Juli');
		$jml[7]+=Bulan($nama,'Agustus');
		$jml[8]+=Bulan($nama,'September');
		$jml[9]+=Bulan($nama,'Oktober');
		$jml[10]+=Bulan($nama,'November');
		$jml[11]+=Bulan($nama,'Desember');
		$jml[12]+=Bulan($nama,'Akhir');
		
	}
	$no_all++;
}

$pdf->Row(array(
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	'',
	''
));

$pdf->SetFont('Arial','B',12);
$pdf->Row(array(
	'TOTAL PEMBELIAN',
	Format($jml[0]),
	Format($jml[1]),
	Format($jml[2]),
	Format($jml[3]),
	Format($jml[4]),
	Format($jml[5]),
	Format($jml[6]),
	Format($jml[7]),
	Format($jml[8]),
	Format($jml[9]),
	Format($jml[10]),
	Format($jml[11]),
	Format($jml[12])
));


$pdf->Output();
?>
