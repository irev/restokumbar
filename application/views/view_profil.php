<html>
	<head>
		<title><?php echo $title;?></title>
		<?php include "com_library.php";?>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/view_profil.js"></script>
	</head>
	<body>
		<?php include "com_header.php"; ?>
		<?php include "com_toolbar.php"; ?>
		<div id="container">
			<?php include "com_navigasi.php";?>
			<div id="content">
			<?php foreach($data as $data){ ?>
				<form method="POST" action="<?php echo base_url('index.php/profil/Update');?>">
				<table cellpadding="5" border="0" class="table_profil"> 
					<tr>
						<td>No Izin Usaha</td>
						<td>:</td>
						<td><input type="text" name="no_izin" value="<?php echo $data['no_izin'];?>" required/></td>
					</tr>
					
					<tr>
						<td>Nama Perusahaan</td>
						<td>:</td>
						<td><input type="text" name="nama" value="<?php echo $data['nama'];?>" required/></td>
					</tr>
					
					<tr>
						<td>Nomor Telepon</td>
						<td>:</td>
						<td><input type="tel" name="no_telp" value="<?php echo $data['no_telp'];?>" required/></td>
					</tr>
					
					
					<tr>
						<td>Pin BB</td>
						<td>:</td>
						<td><input type="text" name="pin_bb" value="<?php echo $data['pin_bb'];?>" required/></td>
					</tr>
					
					<tr>
						<td>Alamat Lengkap</td>
						<td>:</td>
						<td>
							<input type="text" name="alamat" value="<?php echo $data['alamat'];?>" required/>
						</td>
					</tr>
					
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input type="email" name="email" value="<?php echo $data['email'];?>" required/></td>
					</tr>
					
					<tr>
						<td>Facebook</td>
						<td>:</td>
						<td><input type="text" name="facebook" value="<?php echo $data['facebook'];?>" required/></td>
					</tr>
					
					<tr>
						<td>Twitter</td>
						<td>:</td>
						<td><input type="text" name="twitter" value="<?php echo $data['twitter'];?>" required/></td>
					</tr>
					
					<tr>
						<td>Owner</td>
						<td>:</td>
						<td><input type="text" name="owner" value="<?php echo $data['owner'];?>" required/></td>
					</tr>
					
					<tr>
						<td>Tanggal Berdiri</td>
						<td>:</td>
						<td><input type="text" name="tgl_berdiri" id="tgl_berdiri" value="<?php echo $data['tgl_berdiri'];?>" required/></td>
					</tr>
					
					<tr>
						<td>Waktu Buka</td>
						<td>:</td>
						<td><input type="text" name="waktu_buka" id="waktu_buka" value="<?php echo $data['waktu_buka'];?>" required/></td>
					</tr>
					
					<tr>
						<td>Waktu Tutup</td>
						<td>:</td>
						<td><input type="text" name="waktu_tutup" id="waktu_tutup" value="<?php echo $data['waktu_tutup'];?>" required/></td>
					</tr>
					
					<tr>
						<td colspan="3" align="left">
							<input type="submit" value="Update" class="btn"/>
							
						</td>
					</tr>
					
				</table>
				<?php } ?>
				</form>
				
			</div>
		</div>	
	</body>
</html>	