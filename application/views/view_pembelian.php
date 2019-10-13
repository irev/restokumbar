<html>
	<head>
		<title><?php echo $title;?></title>
		<?php include "com_library.php";?>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/view_pembelian.js"></script>
	</head>
	<body>
		<?php include "com_header.php"; ?>
		<?php include "com_toolbar.php"; ?>
		<div id="container">
			<?php include "com_navigasi.php";?>
			<div id="content">
			
				<div class="pencarian">
					<form class="form_cari" action="<?php echo base_url('index.php/pembelian/Search');?>">
						<span><input type="text" id="awal" name="awal" class="date" placeholder="Tanggal Awal" required/></span>
						<span><input type="text" id="akhir" name="akhir" class="date" placeholder="Tanggal Akhir" required/></span>
						<span><input type="submit" value="Cari" class="btn-info"/></span>
					</form>
				</div>
			
				<div id="button_list">
					<a href="javascript:void(0)" id="daftar" class="btn"><img src="<?php echo base_url();?>assets/img/1519465.png" class="icon"/>Laporan Perdaftar</a>
					<a href="javascript:void(0)" id="periode" class="btn"><img src="<?php echo base_url();?>assets/img/Calender.png" class="icon"/>Laporan Perperiode</a>
					<a href="javascript:void(0)" id="report" class="btn"><img src="<?php echo base_url();?>assets/img/15194618.png" class="icon"/>Laporan Pertahun</a>
					<a href="javascript:void(0)" id="refresh" class="btn"><img src="<?php echo base_url();?>assets/img/update.png" class="icon"/> Refresh</a>
				</div>
				
				<div class="table_data">
					<table cellpadding="5" border="1">
						<thead>
							<tr class="tr_title">
								<th colspan="13"><img src="<?php echo base_url();?>assets/img/Cash.png" class="icon"/>Daftar pembelian</th>
							</tr>
							<tr align="center">
								<th>No Pembelian</th>
								<th>No Faktur</th>
								<th>Tanggal</th>
								<th>Waktu</th>
								<th>Supplier</th>
								<th>Total</th>
								<th align='center'>Action</th>
							</tr>
						</thead>
						<tbody align="center">
							<?php if($data){
								$no = $page+1;
								foreach($data as $data){
							?>
							<tr>
								<td><?php echo $data->no_pembelian;?></td>
								<td><?php echo $data->no_faktur;?></td>
								<td><?php echo $data->tanggal;?></td>
								<td><?php echo $data->waktu;?></td>
								<td><?php echo $data->supplier;?></td>
								<td><?php echo Format($data->total_bayar);?></td>
								<td>
									<a href="javascript:void(0)" class="detail" id="<?php echo $data->no_pembelian;?>"><img src="<?php echo base_url();?>assets/img/1519465.png" class="icon"/>Lihat Detail</a>
									<a href="<?php echo base_url('index.php/pembelian/CetakFaktur?id='.$data->no_pembelian);?>"  class="struk" id="<?php echo $data->no_pembelian;?>"><img src="<?php echo base_url();?>assets/img/Print.png" class="icon"/>Lihat Faktur</a>
									<a href="javascript:void(0)" class="hapus" id="<?php echo $data->no_pembelian;?>"><img src="<?php echo base_url();?>assets/img/hapus.png" class="icon"/>Hapus Data</a>
								</td>
							</tr>
							<?php $no++; } }?>
						</tbody>
					</table>
					
					<div id="paging">
						<?php echo $links;?>
					</div>
					
				</div>
							
			</div>
		</div>	
		
		<div id="detail" title="Detail Transaksi">
			<table cellpadding="5" border="1" class="table_detail">
				<thead>
					<tr>
						<td>No</td>
						<td>Item</td>
						<td>Harga</td>
						<td>Jumlah</td>
						<td>Total</td>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
						<td colspan="4">Total Pembayaran</td>
						<td><label id="tobar"></label></td>
					</tr>
				</tfoot>
			</table>	
		</div>
		
		<div id="form_report_sales">
			<table border=0 cellpadding="5">
				<tr>
					<td><strong>Pilih Tahun</strong></td>
					<td>:</td>
					<td><input type="number" id="tahun_report" min="2010" /></td>
				</tr>
				<tr>
					<td colspan="3"><button id="view_sales" class="btn">Lihat</button></td>
				</tr>
			</table>	
		</div>
		
	</body>
</html>	