<?php session_start(); ?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<style>
	.content {
		min-height: 500px;
		height: auto;
		margin: 5%;
		overflow: auto;
		text-align: center;
	}
	
	.wrapTable {
		width: 100%;
	}
	
	.header, .footer {
		text-align: center; 
		height: 20%;
		background-color: #1D3C4D;
		color: white;
		padding: 0;
	}
	
	.navBar {
		width: 100%;
		height: 10%;		
		float: left;
		background-color: #333;
	}
	
	ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		overflow: hidden;
		background-color: #04093a
	}

	li {
		float: left;
	}

	.wrapTable li a {
		display: block;
		color: white;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
	}

	li a:hover {
		background-color: #1D3C4D;
	}
	
	.logo {
		clear: none;
		position: relative;
		float: left;
		width: 20%;
	}
	
	.logo img {
		border-radius: 50%;
		width: 50%;
		height: 100%;
	}
</style>
<div class="wrapTable">
	<div class="header">
		<div class="logo">
			<img src="Foto/logotoko.png" title="Logo" alt="Logo" style="width: auto; height: 80%"/>
		</div>
		<div class="text-header">
			
		</div>
	</div>
	<ul>
		<li><a href='?page=home'>Home</a></li>
		<li><a href='session_toko_online.php'>Admin</a></li>
		<li><a href='?page=import'>Import</a></li>
		<li><a href='?page=payment'>Payment</a></li>
		<!--<li><a href='generate_pdf.php'>PDF</a></li>-->
	</ul>
	<div class="content">
		<?php
			$current_page = 'home';
			// Change value if `page` is specified
			if(array_key_exists('page',$_GET)) {
				$current_page = $_GET['page'];
			}
			// Check page
			switch ($current_page) {
				case 'home':
					include 'konten_toko_online.php';
					break;
				case 'admin':
					include 'login_toko_online.php';
					break;
				case 'detail':
					include 'detail_barang.php';
					break;
				case 'import':
					include 'import_excel.php';
					break;
				case 'checkout':
					include 'form_pembeli.php';
					break;
				case 'payment':
					include 'payment.php';
					break;
				case 'confirmPayment':
					include 'confirm_payment.php';
					break;
			}
		?>
	</div>
	<div class="footer">
		
	</div>
</div>
</table>