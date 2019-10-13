<html>
	<head>
		<title><?php echo $title;?></title>
		<?php include "com_library.php";?>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/chart_penjualan.js"></script>
	</head>
	<body>
		<?php include "com_header.php"; ?>
		<?php include "com_toolbar.php"; ?>
		<div id="container">
			<?php include "com_navigasi.php";?>
			<div id="content">
			
				<div class="pencarian">
					<form class="form_cari">
						<span>Pilih Tahun</span>
						<span><input type="number" id="tahun" name="tahun" required/></span>
						<span><input type="submit" value="Tampilkan " class="btn-info"/></span>
					</form>
				</div>
				
				<div id="chart"></div>
				
				
			</div>
		</div>	
	</body>
</html>	