<?php
	include 'connect.php';
	$nopjl = $_GET['nopjl'];
	mysqli_query($conn, "update penjualan set valid=1 where nopjl='$nopjl'");
	echo '<script>alert("Pembayaran valid!")</script>';
	header("Location:admin_toko_online.php");
?>