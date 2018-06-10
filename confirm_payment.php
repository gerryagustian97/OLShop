<?php
	include 'connect.php';
	//mysql_select_db($database); //connect to database
	$nopjl = $_GET['nopjl'];
	
	if(isset($_POST['tgl_bayar'])and isset($_POST['jml_bayar'])) {
		$tglBayar = $_POST['tgl_bayar'];
		$jmlBayar = $_POST['jml_bayar'];
		mysqli_query($conn, "update penjualan set tgl_bayar='$tglBayar', jml_bayar='$jmlBayar' where nopjl='$nopjl'");
		echo '<script>alert("Transaksi berhasil!")</script>';
	}
?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<body style="background-color: #1D3C4D;">
<div class="form" style="width: 300px; margin: 0 auto;">
	<form action="" method="post" class="form form-control" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nopjl">No. Transaksi:</label>
			<input type="text" class="form-control" id="nopjl" placeholder="<?php echo $nopjl; ?>" name="nopjl" readonly>
		</div>
		<div class="form-group">
			<label for="tgl_bayar">Tanggal Pembayaran:</label>
			<input type="date" class="form-control" id="tgl_bayar" placeholder="Masukkan tanggal..." name="tgl_bayar">
		</div>
		<div class="form-group">
			<label for="jml_bayar">Jumlah Pembayaran:</label>
			<input type="text" class="form-control" id="jml_bayar" placeholder="Masukkan jumlah bayar..." name="jml_bayar">
		</div>
		<button type="submit" class="btn btn-default" name="submit">Save</button>
	</form><br>
</div>
</body>