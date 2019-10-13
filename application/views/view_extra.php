<html>
	<head>
		<title><?php echo $title;?></title>
		<?php include "com_library.php";?>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/view_extra.js"></script>
	</head>
	<body>
		<?php include "com_header.php"; ?>
		<?php include "com_toolbar.php"; ?>
		<div id="container">
			<?php include "com_navigasi.php";?>
			<div id="content">
			
				<div class="pencarian">
					<form class="form_cari" action="<?php echo base_url('index.php/Extra/Search');?>">
						<span><input type="text" id="txtcari" name="txtcari" placeholder=" Pencarian" required/></span>
						<span><select id="cari" name="cari" required></select></span>
						<span><input type="submit" value="Cari" class="btn-info"/></span>
					</form>
				</div>
				
				<div id="button_list">
					<a href="javascript:void(0)" id="tambah" class="btn"><img src="<?php echo base_url();?>assets/img/tambah.png" class="icon"/> Tambah Baru</a>
					<a href="javascript:void(0)" id="refresh" class="btn"><img src="<?php echo base_url();?>assets/img/update.png" class="icon"/> Refresh</a>
				</div>
				
				<div class="table_data">
					<table cellpadding="5" border="1">
						<thead>
							<tr class="tr_title">
								<th colspan="6"><img src="<?php echo base_url();?>assets/img/Food.png" class="icon"/><?php echo $title;?></th>
							</tr>
							<tr>
								<th>No Extra</th>
								<th>Nama</th>
								<th>Harga</th>
								<th align='center'>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php if($data){
							$no = $page+1;
							foreach($data as $data){
						?>
							<tr>
								<td><?php echo $data->no_extra;?></td>
								<td><?php echo $data->nama;?></td>
								<td><?php echo Format($data->harga);?></td>
								<td>
									<a href="javascript:void(0)" class="edit" id="<?php echo $data->no_extra;?>"><img src="<?php echo base_url();?>assets/img/fix.png" class="icon"/>Edit</a>
									<a href="javascript:void(0)" class="hapus" id="<?php echo $data->no_extra;?>"><img src="<?php echo base_url();?>assets/img/hapus.png" class="icon"/>Hapus</a>
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
								<td>No Extra</td>
								<td>:</td>
								<td><input type="text" name="no_extra" id="no_extra" required readonly="true"/></td>
							</tr>
							<tr>
								<td>Nama Extra</td>
								<td>:</td>
								<td><input type="text" name="nama" id="nama" required/></td>
							</tr>
							<tr>
								<td>Harga</td>
								<td>:</td>
								<td><input type="number" name="harga" id="harga" required/></td>
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