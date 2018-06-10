<?php
include 'connect.php';
//mysql_select_db($database); //connect to database

include ("PHPExcel/IOFactory.php");
if(isset($_POST['submit'])){
	$file = $_FILES['filebarang']['name'];
	$isExcel = pathinfo($file);
	
	if($isExcel['extension'] == "xls") {
		//mengubah file excel menjadi file yg dapat dibaca oleh php
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		echo "Terbaca!!";
		foreach($objPHPExcel->getWorksheetIterator() as $worksheet)
		{
			//menghitung jumlah baris yang terisi data pada file excel
			$highestRow = $worksheet->getHighestRow();
			for($row = 2; $row<=$highestRow; $row++)
			{
				//mengambil data cell sesuai (kolom, baris)
				$idbarang = mysqli_real_escape_string($worksheet->getCellByColumnAndRow(0, $row)->getValue());
				$namabarang = mysqli_real_escape_string($worksheet->getCellByColumnAndRow(1, $row)->getValue());
				$keterangan = mysqli_real_escape_string($worksheet->getCellByColumnAndRow(2, $row)->getValue());
				$harga = mysqli_real_escape_string($worksheet->getCellByColumnAndRow(3, $row)->getValue());
				$foto = mysqli_real_escape_string($worksheet->getCellByColumnAndRow(4, $row)->getValue());
				mysqli_query($conn, "INSERT INTO barang(idbarang,namabarang,keterangan,harga,foto) VALUES('$idbarang','$namabarang','$keterangan','$harga','$foto')");
			}
		}
		echo "Data Masuk !!";
		header("Location:index.php");
	}
	else {
		echo '<script>alert("File tidak valid!")</script>';
	}
}
?>

<form name="myForm" id="myForm" action="import_excel.php" method="post" enctype="multipart/form-data">
    <input type="file" id="filebarang" name="filebarang" /><br/><br/><br/>
    <input type="submit" name="submit" value="Import" /><br/>
</form>