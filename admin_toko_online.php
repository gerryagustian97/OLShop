<?php
ob_start();
include 'connect.php';
include 'session_toko_online.php';
//mysql_select_db($database); //connect to database
?>
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
	</div>
	<ul>
		<li><a href='?page=logout'>Logout</a></li>
	</ul>
	<div class="content">
		<h1>Payment</h1>
			<table width="100%" height="50px" class="table table-striped">
				<thead>
					<tr>
						<th>NO. TRANSAKSI</th>
						<th>TGL PESAN</th>
						<th>NAMA</th>
						<th>NO. HP</th>
						<th>ALAMAT</th>
						<th>TGL BAYAR</th>
						<th>UANG</th>
						<th>ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$dtpjl = mysqli_query($conn, "select * from penjualan");
						while($data=mysqli_fetch_assoc($dtpjl)) {
					?>
					<tr>
						<td><?php echo $data['nopjl']; ?></td>
						<td><?php echo $data['tanggal']; ?></td>
						<td><?php echo $data['nama']; ?></td>
						<td><?php echo $data['nohp']; ?></td>
						<td><?php echo $data['alamat']; ?></td>
						<td><?php echo $data['tgl_bayar']; ?></td>
						<td><?php echo $data['jml_bayar']; ?></td>
						<td>
						<?php
							if($data['valid']!=1) {
						?>
							<a class="btn btn-lg btn-primary" style="margin: 3% auto;" href="validasi.php?nopjl=<?php echo $data['nopjl'];?>" role="button">Validasi &raquo;</a>
						<?php
							}
							else {
								echo "valid";
							}
						?>
						</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
	</div>
</div>
<?php
	if(array_key_exists('page',$_GET)) {
		$current_page = $_GET['page'];
	}
	// Check page
	switch ($current_page) {
		case 'logout':
			session_destroy();
			header("Location:index.php");
			break;
	}
?>
	