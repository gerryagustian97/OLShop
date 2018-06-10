<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<?php
include 'connect.php';
if(!empty($_GET['action'])) {
switch($_GET['action']) {
	case "add":
		if(!empty($_POST['quantity']) and $_POST['quantity'] > 0) {
			$idbarang = $_GET['idbarang'];
			$result = mysqli_query($conn, "select * from barang where idbarang = '$idbarang'");
			while($row=mysqli_fetch_assoc($result)) {
				$resultset[] = $row;
			}
			$productByCode = $resultset;
			$itemArray = array($productByCode[0]['idbarang']=>array('namabarang'=>$productByCode[0]['namabarang'], 'idbarang'=>$productByCode[0]['idbarang'], 'quantity'=>$_POST['quantity'], 'harga'=>$productByCode[0]['harga']));
			
			if(!empty($_SESSION['cart'])) {
				if(in_array($productByCode[0]['idbarang'],array_keys($_SESSION['cart']))) {
					foreach($_SESSION['cart'] as $k => $v) {
							if($productByCode[0]['idbarang'] == $k) {
								if(empty($_SESSION['cart'][$k]['quantity'])) {
									$_SESSION['cart'][$k]['quantity'] = 0;
								}
								$_SESSION['cart'][$k]['quantity'] += $_POST['quantity'];
							}
					}
				} else {
					$_SESSION['cart'] = array_merge($_SESSION['cart'],$itemArray);
				}
			} else {
				$_SESSION['cart'] = $itemArray;
			}
		}
		else {
			echo '<script>alert("Jumlah tidak valid")</script>';
		}
	break;
	case "delete":
		if(!empty($_SESSION['cart'])) {
			foreach($_SESSION['cart'] as $k => $v) {
					if($_GET['idbarang'] == $k)
						unset($_SESSION['cart'][$k]);				
					if(empty($_SESSION['cart']))
						unset($_SESSION['cart']);
			}
		}
	break;
	case "deleteall":
		unset($_SESSION['cart']);
	break;
}
}
?>
<?php
	if(isset($_SESSION['cart'])) {
?>
<h1>Cart</h1>
<a id="btn btn-default" href="index.php?page=home&action=deleteall" style="float: right;">Empty Cart</a>

<table width="100%" height="50px" class="table table-striped">
	<thead>
		<tr>
			<th>ID BARANG</th>
			<th>NAMA BARANG</th>
			<th>HARGA</th>
			<th>JUMLAH</th>
			<th>ACTION</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ($_SESSION['cart'] as $barang){
				//$id = $barang['idbarang'];
				//$dtcart = mysqli_query($conn, "select * from barang where idbarang = '$id'");
				//$data=mysqli_fetch_assoc($dtcart);
		?>
		<tr>
			<td><?php echo $barang['idbarang']; ?></td>
			<td><?php echo $barang['namabarang']; ?></td>
			<td><?php echo $barang['harga']; ?></td>
			<td><?php echo $barang['quantity']; ?></td>
			<td><a href="index.php?page=home&action=delete&idbarang=<?php echo $barang['idbarang'];?>">Delete</a></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>
<a class="btn btn-lg btn-primary" href="index.php?page=checkout" role="button">Checkout &raquo;</a>
<?php
	}
?>
<div class="container">    
  <div class="row">
  <?php
		//while($data=mysqli_fetch_assoc($dtbarang)){
		$result = null;
		$resultset = null;
		$result = mysqli_query($conn, "select * from barang");
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if(!empty($resultset))
			$product_array = $resultset;
		if (!empty($product_array)) {
			foreach($product_array as $key=>$value){
  ?>
    <div class="col-sm-4">
      <div class="panel">
	  <form method="post" action="index.php?page=home&action=add&idbarang=<?php echo $product_array[$key]['idbarang']; ?>">
        <div class="panel-heading"><?php echo $product_array[$key]['namabarang']; ?></div>
        <div class="panel-body"><a href="index.php?page=detail&foto=<?php echo $product_array[$key]['foto']; ?>
			&idbarang=<?php echo $product_array[$key]['idbarang']; ?>&namabarang=<?php echo $product_array[$key]['namabarang']; ?>
			&harga=<?php echo $product_array[$key]['harga']; ?>
			&keterangan=<?php echo $product_array[$key]['keterangan']; ?>">
		<img src="Foto/<?php echo $product_array[$key]['foto']; ?>" class="img-responsive" style="width:70%; height:70%" alt="Image"></a></div>
        <div class="panel-footer">Rp. <?php echo $product_array[$key]['harga']; ?></div>
		<input type="text" name="quantity" value="1" size="2" />
		<input type="submit" value="Add2Cart" class="btn btn-default" style="background-color: blue; color: white;"/>
      </form></div>
    </div>
	<?php
			}
		}
	?>
  </div>
</div><br>
<form action="export_excel.php" method="post">
	<input type="submit" name="export_excel" value="Export to Excel"/>
</form>
<form action="generate_pdf.php" method="post">
	<input type="submit" name="pdf" value="Generate PDF"/>
</form>

