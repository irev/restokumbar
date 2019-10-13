<html>
	<head>
		<title><?php echo $title;?></title>
		<?php include "com_library.php";?>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/view_home.js"></script>
	</head>
	<body>
		<?php include "com_header.php"; ?>
		<?php include "com_toolbar.php"; ?>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/view_home.js"></script>
		<div id="container">
			<?php include "com_navigasi.php";?>
			<div id="content">
			
				<div id="button_list">
					<a href="javascript:void(0)" id="cetak" class="btn"><img src="<?php echo base_url();?>assets/img/Print.png" class="icon"/> Cetak Daily Report</a>
					<a href="javascript:void(0)" id="refresh" class="btn"><img src="<?php echo base_url();?>assets/img/update.png" class="icon"/> Refresh</a>
				</div>
				
				<div id="chart"></div>
			
				<div class="table_data">
					<table cellpadding="5" border="1">
						<thead>
							<tr class="tr_title">
								<th colspan="13">
									<img src="<?php echo base_url();?>assets/img/Cash.png" class="icon"/>Penjualan Bulan Ini , 
									<img src="<?php echo base_url();?>assets/img/Spreadsheet.png" class="icon"/> Total Transaksi : <?php echo $jml_data;?> , 
									<img src="<?php echo base_url();?>assets/img/Commerce_1.png" class="icon"/> Kas Masuk : <?php echo Format($kas);?> 
								</th>
							</tr>
							<tr align="center">
								<th>No</th>
								<th>No Struk</th>
								<th>No Check</th>
								<th>Tanggal</th>
								<th>Waktu</th>
								<th>Total Pembayaran</th>
								<th>Total Item</th>
								<th>Uang Cash</th>
								<th>Kembalian</th>
								<th>Casheir</th>
								<th align='center'>Action</th>
							</tr>
						</thead>
						<tbody align="center">
							<?php if($data){
								$no = 1;
								foreach($data as $data){
							?>
							<tr>
								<td><?php echo $no;?></td>
								<td><?php echo $data->no_struk;?></td>
								<td><?php echo $data->no_check;?></td>
								<td><?php echo $data->tanggal;?></td>
								<td><?php echo $data->waktu;?></td>
								<td><?php echo Format($data->total_bayar);?></td>
								<td><?php echo Get('SUM(jumlah)','penjualan_detail','no_struk',$data->no_struk);?></td>
								<td><?php echo Format($data->cash);?></td>
								<td><?php echo Format($data->kembalian);?></td>
								<td><?php echo Get('nama_lengkap','pegawai','no_pegawai',$data->no_casheir);?></td>
								<td>
									<a href="javascript:void(0)" class="detail" id="<?php echo $data->no_struk;?>"><img src="<?php echo base_url();?>assets/img/1519465.png" class="icon"/>Lihat Detail</a>
									<a href="javascript:void(0)" class="struk" id="<?php echo $data->no_struk;?>"><img src="<?php echo base_url();?>assets/img/Print.png" class="icon"/>Lihat Struk</a>
								</td>
							</tr>
							
							
							<?php $no++; } }else{?>
								<tr>
									<td colspan="11">Hari ini belum ada transaksi</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
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
				
			</div>
		</div>	
	</body>
</html>	