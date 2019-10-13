<?php

require('com_pdf.php');
$pdf=new table('L','mm',array(400,910));
$pdf->AddPage();

$gambar = base_url()."assets/img/header.png";
$pdf->Cell(0,12,$pdf->Image($gambar, 409,null, 96),0,0,'C');

$pdf->ln(5);
$pdf->Cell(0,0,'',1,0,'C');
$pdf->ln(5);

$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,12,'LAPORAN PENJUALAN',0,0,'C');
$pdf->ln(8);
$pdf->Cell(0,12,'Periode Januari - Desember '.$_GET['tahun'],0,0,'C');
$pdf->ln(16);


$pdf->SetFont('Arial','B',12);
$pdf->ln(10);
$pdf->SetWidths(array(
		135,
		60,
		60,
		60,
		60,
		60,
		60,
		60,
		60,
		60,
		60,
		60,
		60,
		35
	));

function SumDate($value,$key,$awal,$akhir){
	$query = mysql_query("
		SELECT COALESCE(SUM(".$value."),0) AS tp
		FROM penjualan_detail
		WHERE item =  '".$key."'
		AND tanggal
		BETWEEN  '".$awal."'
		AND  '".$akhir."'
	");
	while($row = mysql_fetch_array($query)){
		return $row['tp'];
	}
}

function SumSales($value,$awal,$akhir){
	$query = mysql_query("
		SELECT COALESCE(SUM(".$value."),0) AS tp
		FROM penjualan
		WHERE tanggal
		>=  '".$awal."'
		AND tanggal
		<=  '".$akhir."'
	");
	while($row = mysql_fetch_array($query)){
		return $row['tp'];
	}
}

$pdf->Row(array(
	'',
	'	Januari',
	'	Februari',
	'	Maret',
	'	April',
	'	Mei',
	'	Juni',
	'	Juli',
	'	Agustus',
	'	September',
	'	Oktober',
	'	November',
	'	Desember',
	'	TOTAL'
));

$pdf->SetWidths(array(
	100,
	35,
	25,
	35,
	25,
	35,
	25,
	35,
	25,
	35,
	25,
	35,
	25,
	35,
	25,
	35,
	25,
	35,
	25,
	35,
	25,
	35,
	25,
	35,
	25,
	35,
	35
));

$pdf->Row(array(
	'',
	'	Harga',
	'	Jumlah',
	'	Total',
	'	Jumlah',
	'	Total',
	'	Jumlah',
	'	Total',
	'	Jumlah',
	'	Total',
	'	Jumlah',
	'	Total',
	'	Jumlah',
	'	Total',
	'	Jumlah',
	'	Total',
	'	Jumlah',
	'	Total',
	'	Jumlah',
	'	Total',
	'	Jumlah',
	'	Total',
	'	Jumlah',
	'	Total',
	'	Jumlah',
	'	Total',
	'	'
));


$jml = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
$tot = array(0,0,0,0,0,0,0,0,0,0,0,0,0);




$tahun = $_GET['tahun'];
$no_all = 1;

foreach($kategori as $kat){

	$pdf->SetFont('Arial','B',12);
	$pdf->Row(array(
	$no_all.'. KATEGORI MENU '.$kat['kategori'],
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
		'-',
		'-'
	));
	
	$q1 = mysql_query("SELECT * FROM menu WHERE kategori = '".$kat['kategori']."'");
	$i = 1;
	while($h1 = mysql_fetch_array($q1)){
		$nama = $h1['nama'];
		$harga = Get('harga','menu','nama',$nama);
		$pdf->SetFont('Arial','',12);
		
		$pdf->Row(array(
			'  			'.$no_all.'.'.$i.'  '.$h1['nama'],
			Format($harga),
			SumDate('jumlah',$nama,$tahun.'-01-01',$tahun.'-01-31'),
			Format(SumDate('total',$nama,$tahun.'-01-01',$tahun.'-01-31')),
			
			SumDate('jumlah',$nama,$tahun.'-02-01',$tahun.'-02-31'),
			Format(SumDate('total',$nama,$tahun.'-02-01',$tahun.'-02-31')),
			
			SumDate('jumlah',$nama,$tahun.'-03-01',$tahun.'-03-31'),
			Format(SumDate('total',$nama,$tahun.'-03-01',$tahun.'-03-31')),
			
			SumDate('jumlah',$nama,$tahun.'-04-01',$tahun.'-04-31'),
			Format(SumDate('total',$nama,$tahun.'-04-01',$tahun.'-04-31')),
			
			SumDate('jumlah',$nama,$tahun.'-05-01',$tahun.'-05-31'),
			Format(SumDate('total',$nama,$tahun.'-05-01',$tahun.'-05-31')),
			
			SumDate('jumlah',$nama,$tahun.'-06-01',$tahun.'-06-31'),
			Format(SumDate('total',$nama,$tahun.'-06-01',$tahun.'-06-31')),
			
			SumDate('jumlah',$nama,$tahun.'-07-01',$tahun.'-07-31'),
			Format(SumDate('total',$nama,$tahun.'-07-01',$tahun.'-07-31')),
			
			SumDate('jumlah',$nama,$tahun.'-08-01',$tahun.'-08-31'),
			Format(SumDate('total',$nama,$tahun.'-08-01',$tahun.'-08-31')),
			
			SumDate('jumlah',$nama,$tahun.'-09-01',$tahun.'-09-31'),
			Format(SumDate('total',$nama,$tahun.'-09-01',$tahun.'-09-31')),
			
			SumDate('jumlah',$nama,$tahun.'-10-01',$tahun.'-10-31'),
			Format(SumDate('total',$nama,$tahun.'-10-01',$tahun.'-10-31')),
			
			SumDate('jumlah',$nama,$tahun.'-11-01',$tahun.'-11-31'),
			Format(SumDate('total',$nama,$tahun.'-11-01',$tahun.'-11-31')),
			
			SumDate('jumlah',$nama,$tahun.'-12-01',$tahun.'-12-31'),
			Format(SumDate('total',$nama,$tahun.'-12-01',$tahun.'-12-31')),
			
			Format(SumDate('total',$nama,$tahun.'-01-01',$tahun.'-12-31'))
		));
		
		$jml[0]+=SumDate('total',$nama,$tahun.'-01-01',$tahun.'-01-31');
		$jml[1]+=SumDate('total',$nama,$tahun.'-02-01',$tahun.'-02-31');
		$jml[2]+=SumDate('total',$nama,$tahun.'-03-01',$tahun.'-03-31');
		$jml[3]+=SumDate('total',$nama,$tahun.'-04-01',$tahun.'-04-31');
		$jml[4]+=SumDate('total',$nama,$tahun.'-05-01',$tahun.'-05-31');
		$jml[5]+=SumDate('total',$nama,$tahun.'-06-01',$tahun.'-06-31');
		$jml[6]+=SumDate('total',$nama,$tahun.'-07-01',$tahun.'-07-31');
		$jml[7]+=SumDate('total',$nama,$tahun.'-08-01',$tahun.'-08-31');
		$jml[8]+=SumDate('total',$nama,$tahun.'-09-01',$tahun.'-09-31');
		$jml[9]+=SumDate('total',$nama,$tahun.'-10-01',$tahun.'-10-31');
		$jml[10]+=SumDate('total',$nama,$tahun.'-11-01',$tahun.'-11-31');
		$jml[11]+=SumDate('total',$nama,$tahun.'-12-01',$tahun.'-12-31');
		$jml[12]+=SumDate('total',$nama,$tahun.'-01-01',$tahun.'-12-31');
		
		$tot[0]+=SumDate('jumlah',$nama,$tahun.'-01-01',$tahun.'-01-31');
		$tot[1]+=SumDate('jumlah',$nama,$tahun.'-02-01',$tahun.'-02-31');
		$tot[2]+=SumDate('jumlah',$nama,$tahun.'-03-01',$tahun.'-03-31');
		$tot[3]+=SumDate('jumlah',$nama,$tahun.'-04-01',$tahun.'-04-31');
		$tot[4]+=SumDate('jumlah',$nama,$tahun.'-05-01',$tahun.'-05-31');
		$tot[5]+=SumDate('jumlah',$nama,$tahun.'-06-01',$tahun.'-06-31');
		$tot[6]+=SumDate('jumlah',$nama,$tahun.'-07-01',$tahun.'-07-31');
		$tot[7]+=SumDate('jumlah',$nama,$tahun.'-08-01',$tahun.'-08-31');
		$tot[8]+=SumDate('jumlah',$nama,$tahun.'-09-01',$tahun.'-09-31');
		$tot[9]+=SumDate('jumlah',$nama,$tahun.'-10-01',$tahun.'-10-31');
		$tot[10]+=SumDate('jumlah',$nama,$tahun.'-11-01',$tahun.'-11-31');
		$tot[11]+=SumDate('jumlah',$nama,$tahun.'-12-01',$tahun.'-12-31');
		$tot[12]+=SumDate('jumlah',$nama,$tahun.'-01-01',$tahun.'-12-31');
		
		$i++;
	};
	$no_all++;
}


	foreach($extra as $ex){
		$nama = $ex['nama'];
		$harga = Get('harga','extra','nama',$nama);
		$pdf->SetFont('Arial','',12);
		
		$pdf->Row(array(
			$no_all.' . EXTRA '.$ex['nama'],
			Format($harga),
			SumDate('jumlah',$nama,$tahun.'-01-01',$tahun.'-01-31'),
			Format(SumDate('total',$nama,$tahun.'-01-01',$tahun.'-01-31')),
			
			SumDate('jumlah',$nama,$tahun.'-02-01',$tahun.'-02-31'),
			Format(SumDate('total',$nama,$tahun.'-02-01',$tahun.'-02-31')),
			
			SumDate('jumlah',$nama,$tahun.'-03-01',$tahun.'-03-31'),
			Format(SumDate('total',$nama,$tahun.'-03-01',$tahun.'-03-31')),
			
			SumDate('jumlah',$nama,$tahun.'-04-01',$tahun.'-04-31'),
			Format(SumDate('total',$nama,$tahun.'-04-01',$tahun.'-04-31')),
			
			SumDate('jumlah',$nama,$tahun.'-05-01',$tahun.'-05-31'),
			Format(SumDate('total',$nama,$tahun.'-05-01',$tahun.'-05-31')),
			
			SumDate('jumlah',$nama,$tahun.'-06-01',$tahun.'-06-31'),
			Format(SumDate('total',$nama,$tahun.'-06-01',$tahun.'-06-31')),
			
			SumDate('jumlah',$nama,$tahun.'-07-01',$tahun.'-07-31'),
			Format(SumDate('total',$nama,$tahun.'-07-01',$tahun.'-07-31')),
			
			SumDate('jumlah',$nama,$tahun.'-08-01',$tahun.'-08-31'),
			Format(SumDate('total',$nama,$tahun.'-08-01',$tahun.'-08-31')),
			
			SumDate('jumlah',$nama,$tahun.'-09-01',$tahun.'-09-31'),
			Format(SumDate('total',$nama,$tahun.'-09-01',$tahun.'-09-31')),
			
			SumDate('jumlah',$nama,$tahun.'-10-01',$tahun.'-10-31'),
			Format(SumDate('total',$nama,$tahun.'-10-01',$tahun.'-10-31')),
			
			SumDate('jumlah',$nama,$tahun.'-11-01',$tahun.'-11-31'),
			Format(SumDate('total',$nama,$tahun.'-11-01',$tahun.'-11-31')),
			
			SumDate('jumlah',$nama,$tahun.'-12-01',$tahun.'-12-31'),
			Format(SumDate('total',$nama,$tahun.'-12-01',$tahun.'-12-31')),
			
			Format(SumDate('total',$nama,$tahun.'-01-01',$tahun.'-12-31'))
		));
		
		$jml[0]+=SumDate('total',$nama,$tahun.'-01-01',$tahun.'-01-31');
		$jml[1]+=SumDate('total',$nama,$tahun.'-02-01',$tahun.'-02-31');
		$jml[2]+=SumDate('total',$nama,$tahun.'-03-01',$tahun.'-03-31');
		$jml[3]+=SumDate('total',$nama,$tahun.'-04-01',$tahun.'-04-31');
		$jml[4]+=SumDate('total',$nama,$tahun.'-05-01',$tahun.'-05-31');
		$jml[5]+=SumDate('total',$nama,$tahun.'-06-01',$tahun.'-06-31');
		$jml[6]+=SumDate('total',$nama,$tahun.'-07-01',$tahun.'-07-31');
		$jml[7]+=SumDate('total',$nama,$tahun.'-08-01',$tahun.'-08-31');
		$jml[8]+=SumDate('total',$nama,$tahun.'-09-01',$tahun.'-09-31');
		$jml[9]+=SumDate('total',$nama,$tahun.'-10-01',$tahun.'-10-31');
		$jml[10]+=SumDate('total',$nama,$tahun.'-11-01',$tahun.'-11-31');
		$jml[11]+=SumDate('total',$nama,$tahun.'-12-01',$tahun.'-12-31');
		$jml[12]+=SumDate('total',$nama,$tahun.'-01-01',$tahun.'-12-31');
		
		$tot[0]+=SumDate('jumlah',$nama,$tahun.'-01-01',$tahun.'-01-31');
		$tot[1]+=SumDate('jumlah',$nama,$tahun.'-02-01',$tahun.'-02-31');
		$tot[2]+=SumDate('jumlah',$nama,$tahun.'-03-01',$tahun.'-03-31');
		$tot[3]+=SumDate('jumlah',$nama,$tahun.'-04-01',$tahun.'-04-31');
		$tot[4]+=SumDate('jumlah',$nama,$tahun.'-05-01',$tahun.'-05-31');
		$tot[5]+=SumDate('jumlah',$nama,$tahun.'-06-01',$tahun.'-06-31');
		$tot[6]+=SumDate('jumlah',$nama,$tahun.'-07-01',$tahun.'-07-31');
		$tot[7]+=SumDate('jumlah',$nama,$tahun.'-08-01',$tahun.'-08-31');
		$tot[8]+=SumDate('jumlah',$nama,$tahun.'-09-01',$tahun.'-09-31');
		$tot[9]+=SumDate('jumlah',$nama,$tahun.'-10-01',$tahun.'-10-31');
		$tot[10]+=SumDate('jumlah',$nama,$tahun.'-11-01',$tahun.'-11-31');
		$tot[11]+=SumDate('jumlah',$nama,$tahun.'-12-01',$tahun.'-12-31');
		$tot[12]+=SumDate('jumlah',$nama,$tahun.'-01-01',$tahun.'-12-31');
		
		$no_all++;
	}
	
	foreach($level as $lv){
		$nama = $lv['nama'];
		$harga = Get('harga','level_pedas','nama',$nama);
		$pdf->SetFont('Arial','',12);
		
		$pdf->Row(array(
			$no_all.' . LEVEL PEDAS '.$lv['nama'],
			Format($harga),
			SumDate('jumlah',$nama,$tahun.'-01-01',$tahun.'-01-31'),
			Format(SumDate('total',$nama,$tahun.'-01-01',$tahun.'-01-31')),
			
			SumDate('jumlah',$nama,$tahun.'-02-01',$tahun.'-02-31'),
			Format(SumDate('total',$nama,$tahun.'-02-01',$tahun.'-02-31')),
			
			SumDate('jumlah',$nama,$tahun.'-03-01',$tahun.'-03-31'),
			Format(SumDate('total',$nama,$tahun.'-03-01',$tahun.'-03-31')),
			
			SumDate('jumlah',$nama,$tahun.'-04-01',$tahun.'-04-31'),
			Format(SumDate('total',$nama,$tahun.'-04-01',$tahun.'-04-31')),
			
			SumDate('jumlah',$nama,$tahun.'-05-01',$tahun.'-05-31'),
			Format(SumDate('total',$nama,$tahun.'-05-01',$tahun.'-05-31')),
			
			SumDate('jumlah',$nama,$tahun.'-06-01',$tahun.'-06-31'),
			Format(SumDate('total',$nama,$tahun.'-06-01',$tahun.'-06-31')),
			
			SumDate('jumlah',$nama,$tahun.'-07-01',$tahun.'-07-31'),
			Format(SumDate('total',$nama,$tahun.'-07-01',$tahun.'-07-31')),
			
			SumDate('jumlah',$nama,$tahun.'-08-01',$tahun.'-08-31'),
			Format(SumDate('total',$nama,$tahun.'-08-01',$tahun.'-08-31')),
			
			SumDate('jumlah',$nama,$tahun.'-09-01',$tahun.'-09-31'),
			Format(SumDate('total',$nama,$tahun.'-09-01',$tahun.'-09-31')),
			
			SumDate('jumlah',$nama,$tahun.'-10-01',$tahun.'-10-31'),
			Format(SumDate('total',$nama,$tahun.'-10-01',$tahun.'-10-31')),
			
			SumDate('jumlah',$nama,$tahun.'-11-01',$tahun.'-11-31'),
			Format(SumDate('total',$nama,$tahun.'-11-01',$tahun.'-11-31')),
			
			SumDate('jumlah',$nama,$tahun.'-12-01',$tahun.'-12-31'),
			Format(SumDate('total',$nama,$tahun.'-12-01',$tahun.'-12-31')),
			
			Format(SumDate('total',$nama,$tahun.'-01-01',$tahun.'-12-31'))
		));
		
		$jml[0]+=SumDate('total',$nama,$tahun.'-01-01',$tahun.'-01-31');
		$jml[1]+=SumDate('total',$nama,$tahun.'-02-01',$tahun.'-02-31');
		$jml[2]+=SumDate('total',$nama,$tahun.'-03-01',$tahun.'-03-31');
		$jml[3]+=SumDate('total',$nama,$tahun.'-04-01',$tahun.'-04-31');
		$jml[4]+=SumDate('total',$nama,$tahun.'-05-01',$tahun.'-05-31');
		$jml[5]+=SumDate('total',$nama,$tahun.'-06-01',$tahun.'-06-31');
		$jml[6]+=SumDate('total',$nama,$tahun.'-07-01',$tahun.'-07-31');
		$jml[7]+=SumDate('total',$nama,$tahun.'-08-01',$tahun.'-08-31');
		$jml[8]+=SumDate('total',$nama,$tahun.'-09-01',$tahun.'-09-31');
		$jml[9]+=SumDate('total',$nama,$tahun.'-10-01',$tahun.'-10-31');
		$jml[10]+=SumDate('total',$nama,$tahun.'-11-01',$tahun.'-11-31');
		$jml[11]+=SumDate('total',$nama,$tahun.'-12-01',$tahun.'-12-31');
		$jml[12]+=SumDate('total',$nama,$tahun.'-01-01',$tahun.'-12-31');
		
		$tot[0]+=SumDate('jumlah',$nama,$tahun.'-01-01',$tahun.'-01-31');
		$tot[1]+=SumDate('jumlah',$nama,$tahun.'-02-01',$tahun.'-02-31');
		$tot[2]+=SumDate('jumlah',$nama,$tahun.'-03-01',$tahun.'-03-31');
		$tot[3]+=SumDate('jumlah',$nama,$tahun.'-04-01',$tahun.'-04-31');
		$tot[4]+=SumDate('jumlah',$nama,$tahun.'-05-01',$tahun.'-05-31');
		$tot[5]+=SumDate('jumlah',$nama,$tahun.'-06-01',$tahun.'-06-31');
		$tot[6]+=SumDate('jumlah',$nama,$tahun.'-07-01',$tahun.'-07-31');
		$tot[7]+=SumDate('jumlah',$nama,$tahun.'-08-01',$tahun.'-08-31');
		$tot[8]+=SumDate('jumlah',$nama,$tahun.'-09-01',$tahun.'-09-31');
		$tot[9]+=SumDate('jumlah',$nama,$tahun.'-10-01',$tahun.'-10-31');
		$tot[10]+=SumDate('jumlah',$nama,$tahun.'-11-01',$tahun.'-11-31');
		$tot[11]+=SumDate('jumlah',$nama,$tahun.'-12-01',$tahun.'-12-31');
		$tot[12]+=SumDate('jumlah',$nama,$tahun.'-01-01',$tahun.'-12-31');
		
		$no_all++;
	}
	
	$pdf->Row(array(
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
		'-',
		'-',
		'-'
	));

	$pdf->SetFont('Arial','B',12);
	$pdf->Row(array(
		'SUBTOTAL PENJUALAN',
		'-',
		$tot[0],
		Format($jml[0]),
		$tot[1],
		Format($jml[1]),
		$tot[2],
		Format($jml[2]),
		$tot[3],
		Format($jml[3]),
		$tot[4],
		Format($jml[4]),
		$tot[5],
		Format($jml[5]),
		$tot[6],
		Format($jml[6]),
		$tot[7],
		Format($jml[7]),
		$tot[8],
		Format($jml[8]),
		$tot[9],
		Format($jml[9]),
		$tot[10],
		Format($jml[10]),
		$tot[11],
		Format($jml[11]),
		Format($jml[12]),
	));
	
	$pdf->Row(array(
		'TOTAL POTONGAN PENJUALAN (DISKON)',
		'-',
		'-',
		Format(SumSales('potongan',$tahun.'-01-01',$tahun.'-01-31')),
		'-',
		Format(SumSales('potongan',$tahun.'-02-01',$tahun.'-02-31')),
		'-',
		Format(SumSales('potongan',$tahun.'-03-01',$tahun.'-03-31')),
		'-',
		Format(SumSales('potongan',$tahun.'-04-01',$tahun.'-04-31')),
		'-',
		Format(SumSales('potongan',$tahun.'-05-01',$tahun.'-05-31')),
		'-',
		Format(SumSales('potongan',$tahun.'-06-01',$tahun.'-06-31')),
		'-',
		Format(SumSales('potongan',$tahun.'-07-01',$tahun.'-07-31')),
		'-',
		Format(SumSales('potongan',$tahun.'-08-01',$tahun.'-08-31')),
		'-',
		Format(SumSales('potongan',$tahun.'-09-01',$tahun.'-09-31')),
		'-',
		Format(SumSales('potongan',$tahun.'-10-01',$tahun.'-10-31')),
		'-',
		Format(SumSales('potongan',$tahun.'-11-01',$tahun.'-11-31')),
		'-',
		Format(SumSales('potongan',$tahun.'-12-01',$tahun.'-12-31')),
		Format(SumSales('potongan',$tahun.'-01-01',$tahun.'-12-31')),
	));
	
	$pdf->Row(array(
		'GRAND TOTAL PENJUALAN',
		'-',
		'-',
		Format(SumSales('total_bayar',$tahun.'-01-01',$tahun.'-01-31')),
		'-',
		Format(SumSales('total_bayar',$tahun.'-02-01',$tahun.'-02-31')),
		'-',
		Format(SumSales('total_bayar',$tahun.'-03-01',$tahun.'-03-31')),
		'-',
		Format(SumSales('total_bayar',$tahun.'-04-01',$tahun.'-04-31')),
		'-',
		Format(SumSales('total_bayar',$tahun.'-05-01',$tahun.'-05-31')),
		'-',
		Format(SumSales('total_bayar',$tahun.'-06-01',$tahun.'-06-31')),
		'-',
		Format(SumSales('total_bayar',$tahun.'-07-01',$tahun.'-07-31')),
		'-',
		Format(SumSales('total_bayar',$tahun.'-08-01',$tahun.'-08-31')),
		'-',
		Format(SumSales('total_bayar',$tahun.'-09-01',$tahun.'-09-31')),
		'-',
		Format(SumSales('total_bayar',$tahun.'-10-01',$tahun.'-10-31')),
		'-',
		Format(SumSales('total_bayar',$tahun.'-11-01',$tahun.'-11-31')),
		'-',
		Format(SumSales('total_bayar',$tahun.'-12-01',$tahun.'-12-31')),
		Format(SumSales('total_bayar',$tahun.'-01-01',$tahun.'-12-31')),
	));

$pdf->Output();
?>
