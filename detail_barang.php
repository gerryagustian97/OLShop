<?php
	$idbarang = $_GET['idbarang'];
	$namabarang = $_GET['namabarang'];
	$harga = $_GET['harga'];
	$foto = $_GET['foto'];
	$keterangan = $_GET['keterangan'];
?>

<h1>
	<?php
		echo $namabarang;
	?>
</h1>
<img src="Foto/<?php echo $foto;?>" style="width: 50%; height: 70%;"></img>	
<p style="margin-bottom: 10%; style=text-align: center;">
	<?php
		echo "$idbarang <br>";
		echo "Rp. $harga <br>";
		echo "$keterangan";
	?>
</p>
<a href='index.php'>Kembali</a>