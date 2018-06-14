<?php
	include 'connect.php';
	//mysql_select_db($database); //connect to database
	
	//session_start();
	if(isset($_POST['nama']) and isset($_POST['email'])and isset($_POST['nohp'])and isset($_POST['alamat'])and isset($_POST['tanggal'])){
		$dtnopjlsblm = mysqli_query($conn, "select nopjl from penjualan order by nopjl desc limit 1");
		$data=mysqli_fetch_assoc($dtnopjlsblm);
		$nopjlsblm = (int) substr($data['nopjl'], -5);
		
		function generate_numbers($start, $count, $digits) {
			$result = array();
			for ($n = $start; $n < $start + $count; $n++) {
				$result[] = str_pad($n, $digits, "0", STR_PAD_LEFT);
			}
			return $result;
		}
		$numbers = generate_numbers($nopjlsblm+1, 1, 5);
		foreach ($numbers as $number) {
			$nopjl = "PJL".$number;
		}
		
		$nama=$_POST['nama'];
		$email=$_POST['email'];
		$nohp=$_POST['nohp'];
		$alamat=$_POST['alamat'];
		$tanggal=$_POST['tanggal'];
		mysqli_query($conn, "INSERT INTO penjualan(nopjl,tanggal,nama,nohp,alamat,tgl_bayar,jml_bayar) VALUES('$nopjl','$tanggal','$nama','$nohp','$alamat','','')");
		$dtnopjl = mysqli_query($conn, "select nopjl from penjualan order by nopjl desc limit 1");
		$data=mysqli_fetch_assoc($dtnopjl);
		$nopjl = $data['nopjl'];?>
		<p style="color: white;">No. Transaksi Anda : <?php echo $nopjl."<br>";?></p>
		<p style="color: white;">Silahkan bayar pada menu Payment</p>
		<?php
			/*$message = "Nomor Penjualan Anda adalah ".$nopjl."";
			$to=$email;
			$subject="Activation Code For Talkerscode.com";
			$from = 'gerryagustian97@gmail.com';
			$body='Nomor Penjualan Anda adalah '.$nopjl.' Klik Link Berikut <a href="index.php?page=confirmPayment&nopjl='.$nopjl.'">Verify</a>untuk melakukan pembayaran';
			$headers = "From:".$from;
			mail($to,$subject,$body,$headers);

			echo "An Activation Code Is Sent To You Check You Emails";*/
			foreach ($_SESSION['cart'] as $keys => $datas) {
				$idbarang = $datas['idbarang'];
				$quantity = $datas['quantity'];
				$harga = $datas['harga'];
				mysqli_query($conn, "insert into jual(nopjl,idbarang,harga,jumlah) values('$nopjl','$idbarang','$harga','$quantity')");
				mysqli_query($conn, "update barang set stok=stok-'$quantity' where idbarang='$idbarang'");
			}
		}
?>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<body style="background-color: #1D3C4D;">
<div class="form" style="width: 300px; margin: 0 auto;">
	<form action="" method="post" class="form form-control" enctype="multipart/form-data">
		<div class="form-group">
			<label for="nama">Nama:</label>
			<input type="text" class="form-control" id="nama" placeholder="Masukkan nama anda..." name="nama">
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="email" class="form-control" id="email" placeholder="Masukkan email anda..." name="email">
		</div>
		<div class="form-group">
			<label for="nohp">No. HP:</label>
			<input type="text" class="form-control" id="nohp" placeholder="Masukkan no. hp anda..." name="nohp">
		</div>
		<div class="form-group">
			<label for="alamat">Alamat:</label>
			<input type="text" class="form-control" id="alamat" placeholder="Masukkan alamat..." name="alamat">
		</div>
		<div class="form-group">
			<label for="tanggal">Tanggal:</label>
			<input type="date" class="form-control" id="tanggal" placeholder="Masukkan tanggal..." name="tanggal">
		</div>
		<button type="submit" class="btn btn-default" name="submit">Save</button>
	</form><br>
</div>
</body>