<?php

require('com_pdf.php');
$pdf=new table('P','mm','A4');
$pdf->AddPage();

$gambar = base_url()."assets/img/header.png";
$pdf->Cell(0,12,$pdf->Image($gambar, 60,null, 96),0,0,'C');

$pdf->ln(5);
$pdf->Cell(0,0,'',1,0,'C');
$pdf->ln(5);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,12,'DAILY REPORT',0,0,'C');
$pdf->ln(9);
if($awal==$akhir){
	$pdf->Cell(0,12,$awal,0,0,'C');
}else{
	$pdf->Cell(0,12,'Periode '.$awal.' s/d '.$akhir,0,0,'C');
}
$pdf->ln(15);

$pdf->SetFont('Arial','',12);
if($data){
	
	$tt = 0;
	$tp = 0;
	$item = 0;
	foreach($data as $data){
		$tt++;
		$tanggal = $data->tanggal;
		$waktu = $data->waktu;
		$no_check = $data->no_check;
		$no_struk = substr($data->no_struk,4);
	
		if($awal==$akhir){
			
			$pdf->Cell(0,12,'No Struk : '.$no_struk,0,0,'L');
			$pdf->Cell(0,12,'Waktu : '.$data->waktu,0,0,'R');
			$pdf->ln(8);
			$pdf->Cell(0,12,'No Check : '.$no_check,0,0,'L');
			$pdf->Cell(0,12,'Casheir : '.$data->no_casheir,0,0,'R');
			$pdf->ln(10);
			
		}else{
		
			$pdf->Cell(0,12,'Tanggal : '.$tanggal,0,0,'L');
			$pdf->Cell(0,12,'No Struk : '.$no_struk,0,0,'R');
			$pdf->ln(8);
			$pdf->Cell(0,12,'Waktu : '.$waktu,0,0,'L');
			$pdf->Cell(0,12,'No Check : '.$no_check,0,0,'R');
			$pdf->ln(8);
			$pdf->Cell(0,12,'Casheir : '.$data->no_casheir,0,0,'L');
			$pdf->ln(10);
			
		}
			$pdf->SetWidths(array(10,93,35,16,35));
			$pdf->Row(array(
				'No',
				'Nama Item',
				'Harga',
				'Jumlah',
				'Total'
			));
			$query = mysql_query("
				SELECT * FROM penjualan_detail WHERE no_struk = '".$data->no_struk."'
			");
			$no = 1;
			while($rs = mysql_fetch_array($query)){
				$pdf->Row(array(
					$no,
					$rs['item'],
					Format($rs['harga']),
					$rs['jumlah'],
					Format($rs['total'])
				));
				$no++;
				$item+=$rs['jumlah'];
			}
			$pdf->SetWidths(array(154,35));
			$pdf->Row(array(
				'Total Pembayaran',
				Format($data->total_bayar)
			));
			$pdf->ln(10);
			$tp+=$data->total_bayar;
	}
	
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,12,'TOTAL PENJUALAN : '.Format($tp),0,0,'C');
	$pdf->ln(8);
	$pdf->Cell(0,12,'TOTAL TRANSAKSI : '.$tt,0,0,'C');
	$pdf->ln(8);
	$pdf->Cell(0,12,'TOTAL ITEM TERJUAL : '.$item,0,0,'C');
}



$pdf->Output();
?>
