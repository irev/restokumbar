<?php

require('com_pdf.php');
$pdf=new table('P','mm','A4');
$pdf->AddPage();

$gambar = base_url()."assets/img/header.png";
$pdf->Cell(0,12,$pdf->Image($gambar, 55,null, 96),0,0,'C');

$pdf->ln(5);
$pdf->Cell(0,0,'',1,0,'C');
$pdf->ln(5);

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,12,'FAKTUR PEMBAYARAN',0,0,'C');
$pdf->ln(20);





foreach($data as $data){

	$pdf->SetFont('Arial','',12);

	$pdf->Cell(0,0,'No pembayaran : '.$_GET['id'],0,0,'L');


	$pdf->Cell(0,0,'Tanggal : '.$data['tanggal'],0,0,'R');
	$pdf->ln(8);

	$pdf->Cell(0,0,'No Faktur : '.$data['no_bukti'],0,0,'L');
	$pdf->Cell(0,0,'Waktu : '.$data['waktu'],0,0,'R');

	$pdf->ln(8);
	$pdf->Cell(0,0,'Keterangan : '.$data['keterangan'],0,0,'L');
	$pdf->ln(5);

	$pdf->SetFont('Arial','',12);
	$pdf->SetWidths(array(10,80,40,20,40));
	$pdf->Row(array(
		'No',
		'Nama Item',
		'Harga',
		'Qty',
		'Total'
	));

	$q = mysql_query("SELECT * FROM pembayaran_detail WHERE no_pembayaran = '".$_GET['id']."' ");
	$i = 1;
	$tb = 0;
	while($row = mysql_fetch_array($q)){
		$pdf->Row(array(
			$i,
			$row['item'],
			Format($row['harga']),
			$row['jumlah'],
			Format($row['total'])
		));
		$tb+=$row['total'];
		$i++;
	}

	$pdf->SetFont('Arial','B',12);
	$pdf->SetWidths(array(150,40));
		$pdf->Row(array(
		'TOTAL',
		Format($tb)
	));
	
	$pdf->ln(15);
	$pdf->Cell(0,0,'Casheir : '.Get('nama_lengkap','pegawai','no_pegawai',$data['no_casheir']),0,0,'R');
	
}



$pdf->Output();
?>
