<html>
	<head>
		<title><?php echo $title;?></title>
		<link rel="icon" type="image/png" href="<?php echo base_url('assets/img/menu.png');?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login.css');?>"/>
	</head>
	<body>
		
		<div id="header">
			<div class="inside">
				<img src="<?php echo base_url('assets/img/admin.png');?>"/>
				Administrator Login
			</div>
		</div>
		
		<?php if(isset($_GET['login_false'])){ ?>
		<div id="header_failed">
			<div class="inside">
				<img src="<?php echo base_url('assets/img/hapus.png');?>"/>
				Username atau Password ada yang salah !! , Silahkan coba kembali !!
			</div>
		</div>
		<?php } ?>
		
		<div id="flogin">
			<img src="<?php echo base_url('assets/img/Sistem-locked.png');?>"/>
			<div class="inside">
				<form method="POST" action="<?php echo base_url('index.php/admin/login');?>">
					<span><strong>Username</strong></span>
					<span><input type="text" name="username" id="username" placeholder="Masukan Username Anda...." required/></span>
					<span><strong>Password</strong></span>
					<span><input type="password" name="password" id="password" placeholder="Masukan Password Anda...." required/></span>
					<span>
						<input type="submit" name="bsubmit" id="bsubmit" value="Login"/>
						<input type="reset" name="breset" id="breset" value="Reset"/>
					</span>
				</form>	
			</div>
		</div>
		
	</body>
</html>