<html>
	<head>
		<title><?php echo $title;?></title>
		<?php include "com_library.php";?>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/view_cashier.js"></script>
	</head>
	<body>
		<?php include "com_header.php"; ?>
		<?php include "com_toolbar_transaksi.php"; ?>
		<div id="container">
			<?php include "com_navigasi.php";?>
			<div id="content">
			
				<div class="table_data table_casheir">
				<form>
					<table cellpadding="5" border="0" align="center">
						<thead>
							<tr class="tr_title">
								<th colspan="10"><img src="<?php echo base_url();?>assets/img/Cash.png" class="icon"/>
									<strong>Struk No : <?php echo $no_struk;?> ,  Check No : <?php echo $no_check;?></strong>
								</th>
							</tr>
							<tr align='center'>
							
								<th>Nama Menu</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Total</th>
								<th align='center'>Action</th>
							</tr>
						</thead>
						<tbody>
						
						</tbody>
						<tfoot>
							<tr align="left">
								<td align="center">
									<a href="javascript:void(0)" id="tambah" class="btn"><img src="<?php echo base_url();?>assets/img/tambah.png" class="icon"/>Tambah Menu Baru</a>
								</td>
								<td colspan="4"></td>
							</tr>
							<tr align="center">
								<td align='right'><strong>SUBTOTAL</strong></td>
								<td>
									<input type="text" name="sub_total" id="sub_total" required readonly="true"/>
									<input type="text" name="in_sub_total" id="in_sub_total" required readonly="true"/>
								</td>
								<td><strong>GRAND TOTAL</strong></td>
								<td>
									<input type="text" name="grand_total" id="grand_total" readonly="true" required/>
									<input type="text" name="in_grand_total" id="in_grand_total" readonly="true" required/>
								</td>
								<td></td>
							</tr>
							<tr align="center">
								<td align='right'><strong>DISKON</strong></td>
								<td>
									<input type="text" name="diskon" id="diskon" required readonly="true"/>
									<input type="text" name="in_diskon" id="in_diskon" required readonly="true"/>
								</td>
								<td><strong>CASH</strong></td>
								<td>
									<input type="number" name="cash" id="cash" required/>
								</td>
								<td></td>
							</tr>
							<tr align="center">
								<td align='right'><strong>POTONGAN</strong></td>
								<td>
									<input type="text" name="potongan" id="potongan" required readonly="true"/>
									<input type="text" name="in_potongan" id="in_potongan" required readonly="true"/>
								</td>
								<td><strong>KEMBALIAN</strong></td>
								<td>
									<input type="text" name="kembalian" id="kembalian" readonly="true" required/>
									<input type="text" name="in_kembalian" id="in_kembalian" readonly="true" required/>
								</td>
								<td></td>
							</tr>
							<tr align="right">
								<td colspan="5">
									<input type="text"  name="no_struk" id="no_struk" required readonly="true" value="<?php echo $no_struk;?>"/>
									<input type="text"  name="no_check" id="no_check" required readonly="true" value="<?php echo $no_check;?>"/>
									<input type="text"  name="tanggal" id="tanggal" required readonly="true" />
									<input type="text"  name="waktu" id="waktu" required readonly="true" />
									<input type="submit" id="submit" value="Simpan dan Cetak Struk" class='btn-success'/>
								</td>
							</tr>
						</tfoot>
					</table>
				</form>
			</div>
		</div>	
	</body>
</html>	