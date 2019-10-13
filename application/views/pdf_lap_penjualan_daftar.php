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
$pdf->Cell(0,12,'DAFTAR PENJUALAN PERIODE '.$_GET['awal'].' s/d '.$_GET['akhir'],0,0,'C');
$pdf->ln(20);




if($data){

	$tp = 0;
	foreach($data as $data){

		$no_struk = $data->no_struk;
		$kasir = Get('nama_lengkap','pegawai','no_pegawai',$data->no_casheir);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(0,0,'No Struk : '.$data->no_struk,0,0,'L');
		$pdf->Cell(0,0,'Tanggal : '.$data->tanggal,0,0,'R');
		$pdf->ln(8);
		$pdf->Cell(0,0,'Casheir : '.$kasir,0,0,'L');
		$pdf->Cell(0,0,'Waktu : '.$data->waktu,0,0,'R');
		$pdf->ln(8);
		
		$pdf->SetFont('Arial','',12);
		$pdf->SetWidths(array(10,80,40,20,40));
		$pdf->Row(array(
			'No',
			'Nama Item',
			'Harga',
			'Qty',
			'Total'
		));
		
		$q = mysql_query("SELECT * FROM penjualan_detail WHERE no_struk = '".$no_struk."' ");
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
		
		$pdf->SetWidths(array(150,40));
			$pdf->Row(array(
			'SUBTOTAL',
			Format($data->sub_total)
		));
		
		$pdf->SetWidths(array(150,40));
			$pdf->Row(array(
			'DISKON',
			($data->diskon*100).' %'
		));
		
		$pdf->SetWidths(array(150,40));
			$pdf->Row(array(
			'Potongan',
			Format($data->potongan)
		));
		
		$pdf->SetWidths(array(150,40));
			$pdf->Row(array(
			'GRAND TOTAL',
			Format($data->total_bayar)
		));
		
		$tp+=$tb;
		$pdf->ln(8);
	
	}
	
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,0,'TOTAL PENJUALAN : '.Format($tp),0,0,'R');
}



$pdf->Output();
?>
