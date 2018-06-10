<?php
include 'connect.php';
//mysql_select_db($database); //connect to database

include_once('fpdf181/fpdf.php');

// memanggil library FPDF
//require('fpdf181/fpdf.php');
// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A5');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string 
$pdf->Cell(190,7,'Daftar Barang',0,1,'C');
$pdf->SetFont('Arial','B',12);
 
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);
 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,6,'ID',1,0);
$pdf->Cell(40,6,'NAMA',1,0);
$pdf->Cell(50,6,'KETERANGAN',1,0);
$pdf->Cell(25,6,'FOTO',1,0);
$pdf->Cell(25,6,'HARGA',1,0);
$pdf->Cell(25,6,'STOK',1,1);
 
$pdf->SetFont('Arial','',10);

$dtbarang = mysqli_query($conn, "select * from barang");
while ($row = mysqli_fetch_assoc($dtbarang)){
    $pdf->Cell(20,6,$row['idbarang'],1,0);
    $pdf->Cell(40,6,$row['namabarang'],1,0);
    $pdf->Cell(50,6,$row['keterangan'],1,0);
    $pdf->Cell(25,6,$row['foto'],1,0);
	$pdf->Cell(25,6,$row['harga'],1,0);
	$pdf->Cell(25,6,$row['stok'],1,1);
}
 
$pdf->Output();
?>