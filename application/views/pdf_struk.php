<?php

require('com_pdf.php');
$pdf=new table('P','mm',array(100,300));
$pdf->AddPage();

$gambar = base_url()."assets/img/logo_struk.jpg";
$pdf->Cell(0,12,$pdf->Image($gambar, 30,null, 35),0,0,'C');
$pdf->ln(1);

$alamat = Get('alamat','profil','id',1);


$pdf->SetFont('Arial','',12);
$pdf->Cell(0,12,$alamat,0,0,'C');
$pdf->ln(10);

foreach($data as $data){

	$tanggal = $data['tanggal'];
	$waktu = $data['waktu'];
	$no_check = $data['no_check'];
	$no_struk = substr($data['no_struk'],4);
	$keterangan = 'REG		'.$tanggal.' '.$waktu;

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(0,12,$keterangan,0,0,'L');
	$pdf->ln(7);
	
	$pdf->Cell(0,12,'CHECK No.'.$no_check,0,0,'L');
	$pdf->Cell(0,12,'No Casheir : '.$data['no_casheir'],0,0,'R');
	$pdf->ln(7);
	
	$pdf->Cell(0,12,'Casheir : '.Get('nama_lengkap','pegawai','no_pegawai',$data['no_casheir']),0,0,'R');
	$pdf->ln(10);
	
	$query = mysql_query("
		SELECT * FROM penjualan_detail WHERE no_struk = '".$data['no_struk']."'
	");
	while($rs = mysql_fetch_array($query)){
	
		$jml = $rs['jumlah'];
		$harga = $rs['harga'];
		$total = Format($rs['total']);
		$ket = $jml.' x	 @1 / '.Format($harga);
		
		if($rs['jumlah']==1){
			$pdf->Cell(0,12,$rs['item'],0,0,'L');
			$pdf->Cell(0,12,Format($rs['harga']),0,0,'R');
			$pdf->ln(7);
		}else{
			$pdf->Cell(0,12,$ket,0,0,'C');
			$pdf->ln(7);
			$pdf->Cell(0,12,$rs['item'],0,0,'L');
			$pdf->Cell(0,12,$total,0,0,'R');
			$pdf->ln(7);
		}
		
	}
	
	$pdf->SetFont('Arial','B',10);
	$pdf->ln(12);
	$pdf->Cell(0,12,'SUBTOTAL',0,0,'L');
	$pdf->Cell(0,12,Format($data['sub_total']),0,0,'R');
	$pdf->ln(7);
	
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(0,12,'DISKON',0,0,'L');
	$pdf->Cell(0,12,($data['diskon']*100).' %',0,0,'R');
	$pdf->ln(7);
	
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(0,12,'POTONGAN',0,0,'L');
	$pdf->Cell(0,12,Format($data['potongan']),0,0,'R');
	$pdf->ln(7);
	
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,12,'GRAND TOTAL',0,0,'L');
	$pdf->Cell(0,12,Format($data['total_bayar']),0,0,'R');
	$pdf->ln(7);
	
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(0,12,'CASH',0,0,'L');
	$pdf->Cell(0,12,Format($data['cash']),0,0,'R');
	$pdf->ln(7);
	
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(0,12,'KEMBALIAN',0,0,'L');
	$pdf->Cell(0,12,Format($data['kembalian']),0,0,'R');
	$pdf->ln(20);
	
	
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(0,12,'TERIMA KASIH',0,0,'C');

}

$pdf->Output();
?>