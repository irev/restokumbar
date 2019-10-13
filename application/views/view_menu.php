<html>
	<head>
		<title><?php echo $title;?></title>
		<?php include "com_library.php";?>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/view_menu.js"></script>
	</head>
	<body>
		<?php include "com_header.php"; ?>
		<?php include "com_toolbar.php"; ?>
		<div id="container">
			<?php include "com_navigasi.php";?>
			<div id="content">
			
				<div class="pencarian">
					<form class="form_cari" action="<?php echo base_url('index.php/menu/search');?>">
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
								<th colspan="7"><img src="<?php echo base_url();?>assets/img/menu.png" class="icon"/>Daftar Menu</th>
							</tr>
							<tr>
								<th>No Menu</th>
								<th>Kategori</th>
								<th>Nama Menu</th>
								<th>Harga</th>
								<th>Rekomendasi</th>
								<th>Keterangan</th>
								<th align='center'>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php if($data){
							$no = $page+1;
							foreach($data as $data){
						?>
							<tr>
								<td><?php echo $data->no_menu;?></td>
								<td><?php echo $data->kategori;?></td>
								<td><?php echo $data->nama;?></td>
								<td><?php echo Format($data->harga);?></td>
								<?php
									if($data->rekomendasi=='n'){
										echo "<td align='center'>--</td>";
									}else{
										echo "<td align='center'><img src='".base_url('assets/img/success.png')."'/ class='icon'></td>";
									}
								?>
								<td><?php echo Get('keterangan','kategori_menu','kategori',$data->kategori);?></td>
								<td>
									<a href="javascript:void(0)" class="edit" id="<?php echo $data->no_menu;?>"><img src="<?php echo base_url();?>assets/img/fix.png" class="icon"/>Edit</a>
									<a href="javascript:void(0)" class="hapus" id="<?php echo $data->no_menu;?>"><img src="<?php echo base_url();?>assets/img/hapus.png" class="icon"/>Hapus</a>
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
							<input type="text" id="last_no_menu" hidden="true" readonly="true"/>
							<tr>
								<td>Kategori</td>
								<td>:</td>
								<td><select name="kategori" id="kategori" required/></select></td>
							</tr>
							<tr>
								<td>No Menu</td>
								<td>:</td>
								<td><input type="text" name="no_menu" id="id_menu" required readonly="true" /></td>
							</tr>
							<tr>
								<td>Nama Menu</td>
								<td>:</td>
								<td><input type="text" name="nama" id="nama" required/></td>
							</tr>
							<tr>
								<td>Harga</td>
								<td>:</td>
								<td><input type="number" name="harga" id="harga" required//></td>
							</tr>
							<tr>
								<td>Rekomendasi</td>
								<td>:</td>
								<td>
									<select name="rekomendasi" id="rekomendasi" required/>
										<option></option>
										<option value="y">Ya</option>
										<option value="n">Tidak</option>
									</select>
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