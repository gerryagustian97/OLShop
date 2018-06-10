<?php
	session_start();
	if ($_SESSION['status'] == 1) {
	}
	else {
		session_destroy();
		echo "Tidak bisa akses";
		header("Location:login_toko_online.php");
	}
?>