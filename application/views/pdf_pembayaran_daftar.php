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
$pdf->Cell(0,12,'DAFTAR PEMBAYARAN PERIODE '.$_GET['awal'].' s/d '.$_GET['akhir'],0,0,'C');
$pdf->ln(20);




if($data){

	$tp = 0;
	foreach($data as $data){

		$no_pembayaran = $data->no_pembayaran;
		$kasir = Get('nama_lengkap','pegawai','no_pegawai',$data->no_casheir);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(0,0,'No pembayaran : '.$data->no_pembayaran,0,0,'L');
		$pdf->Cell(0,0,'Tanggal : '.$data->tanggal,0,0,'R');
		$pdf->ln(8);
		$pdf->Cell(0,0,'Casheir : '.$kasir,0,0,'L');
		$pdf->Cell(0,0,'Waktu : '.$data->waktu,0,0,'R');
		$pdf->ln(8);
		$pdf->Cell(0,0,'Keterangan : '.$data->keterangan,0,0,'L');
		$pdf->ln(8);
		
		$pdf->SetFont('Arial','',12);
		$pdf->SetWidths(array(10,140,40));
		$pdf->Row(array(
			'No',
			'Nama Item',
			'Total Harga'
		));
		
		$q = mysql_query("SELECT * FROM pembayaran_detail WHERE no_pembayaran = '".$no_pembayaran."' ");
		$i = 1;
		$tb = 0;
		while($row = mysql_fetch_array($q)){
			$pdf->Row(array(
				$i,
				$row['item'],
				Format($row['total'])
			));
			$tb+=$row['total'];
			$i++;
		}
		
		$pdf->SetFont('Arial','B',12);
		$pdf->SetWidths(array(150,40));
			$pdf->Row(array(
			'TOTAL',
			Format($data->total_bayar)
		));
		
		$tp+=$tb;
		$pdf->ln(8);
	
	}
	
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,0,'TOTAL pembayaran : '.Format($tp),0,0,'R');
}



$pdf->Output();
?>
