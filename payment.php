<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<?php
include 'connect.php';
//mysql_select_db($database); //connect to database
?>
<h1>Payment</h1>
<p>No. Transaksi</p>
<form method="post" action="">
	<input type="text" class="form-control" id="nopjl" placeholder="Masukkan nomor transaksi..." name="nopjl"><br>
	<button type="submit" class="btn btn-default" name="submit">Ok</button>
</form><br>
<table width="100%" height="50px" class="table table-striped">
	<thead>
		<tr>
			<th>NO. TRANSAKSI</th>
			<th>ID BARANG</th>
			<th>HARGA</th>
			<th>QUANTITY</th>
		</tr>
	</thead>
	<tbody>
		<?php
			if(isset($_POST['nopjl'])) {
				$nopjl = $_POST['nopjl'];
				$dtpjl = mysqli_query($conn, "select * from jual where nopjl = '$nopjl'");
				while($data=mysqli_fetch_assoc($dtpjl)) {
		?>
		<tr>
			<td><?php echo $data['nopjl']; ?></td>
			<td><?php echo $data['idbarang']; ?></td>
			<td><?php echo $data['harga']; ?></td>
			<td><?php echo $data['jumlah']; ?></td>
		</tr>
		<?php
				}
			}
		?>
	</tbody>
</table>
<a class="btn btn-lg btn-primary" style="margin: 3% auto;" href="index.php?page=confirmPayment&nopjl=<?php echo $nopjl;?>" role="button">Confirm Payment &raquo;</a>