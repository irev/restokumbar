<html>
	<head>
		<title><?php echo $title;?></title>
		<?php include "com_library.php";?>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/view_supplier.js"></script>
	</head>
	<body>
		<?php include "com_header.php"; ?>
		<?php include "com_toolbar.php"; ?>
		<div id="container">
			<?php include "com_navigasi.php";?>
			<div id="content">
			
				<div class="pencarian">
					<form class="form_cari" action="<?php echo base_url('index.php/supplier/search');?>">
						<span><input type="text" id="txtcari" name="txtcari" placeholder=" Pencarian" required/></span>
						<span><select id="cari" name="cari" required></select></span>
						<span><input type="submit" value="Cari" class="btn-info"/></span>
					</form>
				</div>
			
				<div id="button_list">
					<a href="javascript:void(0)" id="tambah" class="btn"><img src="<?php echo base_url();?>assets/img/tambah.png" class="icon"/> Tambah Baru</a>
					<a href="javascript:void(0)" id="cetak" class="btn"><img src="<?php echo base_url();?>assets/img/Print.png" class="icon"/> Cetak Data</a>
					<a href="javascript:void(0)" id="refresh" class="btn"><img src="<?php echo base_url();?>assets/img/update.png" class="icon"/> Refresh</a>
				</div>
				
				<div class="table_data">
					<table cellpadding="5" border="1">
						<thead>
							<tr class="tr_title">
								<th colspan="5"><img src="<?php echo base_url();?>assets/img/icon.ingr-database.png" class="icon"/>Daftar Supplier</th>
							</tr>
							<tr>
								<th>No Supplier</th>
								<th>Nama Supplier</th>
								<th>No Telepon</th>
								<th>Alamat</th>
								<th align='center'>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php if($data){
							$no = $page+1;
							foreach($data as $data){
						?>
							<tr>
								<td><?php echo $data->no_supplier;?></td>
								<td><?php echo $data->nama;?></td>
								<td><?php echo $data->telp;?></td>
								<td><?php echo $data->alamat?></td>
								<td>
									<a href="javascript:void(0)" class="edit" id="<?php echo $data->no_supplier;?>"><img src="<?php echo base_url();?>assets/img/fix.png" class="icon"/>Edit</a>
									<a href="javascript:void(0)" class="hapus" id="<?php echo $data->no_supplier;?>"><img src="<?php echo base_url();?>assets/img/hapus.png" class="icon"/>Hapus</a>
								</td>
							</tr>
						<?php $no++; } } ?>	
						</tbody>
					</table>
					
					<div id="paging">
						<?php echo $links;?>
					</div>
					
				</div>
				
				
				<div id="form_submit">
					<form id="form_data">
						<table cellpadding="5" border="0">
							<tr>
								<td>No Supplier</td>
								<td>:</td>
								<td><input type="text" name="no_supplier" id="no_supplier" readonly="true" required/></td>
							</tr>
							<tr>
								<td>Nama Supplier</td>
								<td>:</td>
								<td><input type="text" name="nama" id="nama" required/></td>
							</tr>
							<tr>
								<td>No Telepon</td>
								<td>:</td>
								<td><input type="tel" name="telp" id="telp" required/></td>
							</tr>
							<tr>
								<td>Alamat Lengkap</td>
								<td>:</td>
								<td>
									<textarea name="alamat" id="alamat"  rows="5" required/>
									</textarea>
								</td>
							</tr>
							<tr>
								<td colspan="3"><input type="submit" id="submit" class="btn"/></td>
							</tr>
						</table>
					</form>
				</div>
				
				
			</div>
		</div>	
	</body>
</html>	