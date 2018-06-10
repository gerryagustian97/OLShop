<?php
include 'connect.php';
//mysql_select_db($database); //connect to database

session_start();
if(isset($_SESSION['cart'])){
	$array_id_barang = array_column($_SESSION['cart'], 'idbarang');
}
$output = '';
if(isset($_POST["export_excel"])) {
	$dtbarang = mysqli_query($conn, "select * from barang");
	if(mysqli_num_rows($dtbarang) > 0) {
		$output .= '
		<table class="table" bordered="1">  
            <tr>  
                <th>id barang</th>  
                <th>nama barang</th>  
                <th>keterangan</th>  
				<th>harga</th>
				<th>foto</th>
				<th>quantity</th>
            </tr>
		';
		while($data=mysqli_fetch_assoc($dtbarang)) {
			$quantity = 0;
			if(isset($_SESSION['cart'])){
				foreach ($_SESSION["cart"] as $barang){
					$id = $barang['idbarang'];
					if($id==$data["idbarang"]) {
						$quantity = $barang["quantity"];
					}
				}
			}
			$output .= '
				<tr>
					<td>'.$data["idbarang"].'</td>
					<td>'.$data["namabarang"].'</td>
					<td>'.$data["keterangan"].'</td>
					<td>'.$data["harga"].'</td>
					<td>'.$data["foto"].'</td>
					<td>'.$quantity.'</td>
				</tr>
			';
		}
		$output .= '</table>';
		header("Content-Type: application/xls");
		header("Content-Disposition: attachment; filename=download.xls");
		echo $output;
	}
}
?>