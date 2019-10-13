<html>
	<head>
		<title><?php echo $title;?></title>
		<?php include "com_library.php";?>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/view_add_pembayaran.js"></script>
	</head>
	<body>
		<?php include "com_header.php"; ?>
		<?php include "com_toolbar_transaksi.php"; ?>
		<div id="container">
			<?php include "com_navigasi.php";?>
			<div id="content">
				
				<div class="table_data">
				<form>
					<table cellpadding="5" border="0" align="center">
						<thead>
							<tr class='supp'>
								<td colspan="10">
									<strong>Keterangan :</strong> 
										<input type='text' name='keterangan' id='keterangan' required/> 
									<strong>No Faktur : </strong>
										<input type='text' name='no_bukti' id='no_bukti' required/>
								</td>	
							</tr>
							<tr class="tr_title">
								<th colspan="10"><img src="<?php echo base_url();?>assets/img/Cash.png" class="icon"/>
									<strong>No pembayaran: <?php echo $no_struk;?></strong>
								</th>
							</tr>
							<tr align='center'>
							
								<th>Nama Pembayaran</th>
								<th>Harga</th>
								<th>Qty</th>
								<th>Total</th>
								<th align='center'>Action</th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
						<tfoot>
							<tr align="left">
								<td align="center">
									<a href="javascript:void(0)" id="tambah" class="btn"><img src="<?php echo base_url();?>assets/img/tambah.png" class="icon"/>Tambah Item Baru</a>
								</td>
								<td colspan="4"></td>
							</tr>
							<tr align="center">
								<td colspan='3' align='right'><strong>TOTAL PEMBAYARAN</strong></td>
								<td>
									<input type="text" name="tobar" id="tobar" readonly="true" required/>
									<input type="text" name="tobar" id="in_tobar" readonly="true" required/>
								</td>
								<td></td>
							</tr>
							<tr align="right">
								<td colspan="5">
									<input type="text"  name="no_pembayaran" id="no_pembayaran" required readonly="true" value="<?php echo $no_struk;?>"/>
									<input type="text"  name="tanggal" id="tanggal" required readonly="true" />
									<input type="text"  name="waktu" id="waktu" required readonly="true" />
									<input type="submit" id="submit" value="Simpan Data & Cetak Fakur" class='btn-success'/>
								</td>
							</tr>
						</tfoot>
					</table>
				</form>
			</div>
		</div>	
	</body>
</html>	