<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<?php
include 'connect.php';
//mysql_select_db($database); //connect to database
?>
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
			<td><a class="btn btn-lg btn-primary" style="margin: 3% auto;" href="index.php?page=confirmPayment&nopjl=<?php echo $nopjl;?>" role="button">Validasi &raquo;</a></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>