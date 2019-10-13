<?php

require('com_pdf.php');
$pdf=new table('L','mm',array(300,647));
$pdf->AddPage();

$gambar = base_url()."assets/img/header.png";
$pdf->Cell(0,12,$pdf->Image($gambar, 272,null, 96),0,0,'C');

$pdf->ln(5);
$pdf->Cell(0,0,'',1,0,'C');
$pdf->ln(5);

$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,12,'DAFTAR PEGAWAI',0,0,'C');
$pdf->ln(16);


$pdf->SetFont('Arial','',12);
$pdf->Cell(0,12,'Total Data : '.$jml_data,0,0,'L');
$pdf->ln(10);
$pdf->SetWidths(array(15,35,35,90,40,40,40,80,250));
$pdf->Row(array(
	'No',
	'No Pegawai',
	'Posisi',
	'Nama Lengkap',
	'Jenis Kelamin',
	'Tanggal Masuk',
	'Tanggal Lahir',
	'No Telepon',
	'Alamat'
));

$i = 1;
if($data){

	foreach($data as $data){
		$pdf->Row(array(
			$i,
			$data->no_pegawai,
			$data->posisi,
			$data->nama_lengkap,
			$data->gender,
			$data->tgl_register,
			$data->tgl_lahir,
			$data->telp,
			$data->alamat
		));
		$i++;
	}

}



$pdf->Output();
?>
