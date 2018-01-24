<?php
mysql_connect("localhost","root","");
mysql_select_db("bank_darah");

require('pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',20);
$pdf->Image('logo.png',1,1,1.6,2);
$pdf->Image('pmi.png',26.5,1,2,2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'DAFTAR PENJUALAN',0,'C');
$pdf->SetX(4);
$pdf->SetFont('Times','B',10);
$pdf->MultiCell(19.5,0.5,'Telpon : 0038XXXXXXX',0,'C');    
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'JL. Cikoneng Pandeglang Banten',0,'C');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'website : www.utdpmicabangpandeglang.com email : utdpmicabangpandeglang@gmail.com',0,'C');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Times','B',14);
$pdf->Cell(25.5,0.7,"DAFTAR PENJUALAN",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Times','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Times','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Distributor', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Golongan', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Ukuran', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Harga', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'QTY', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Total', 1, 0, 'C');
$pdf->Cell(6, 0.8, 'Status', 1, 0, 'C');
$pdf->SetFont('Times','',10);

$no=1;
$query=mysql_query("select * from penjualan inner join distributor on penjualan.id_distributor = distributor.id_distributor inner join darah on penjualan.id_darah=darah.id_darah");
while($lihat=mysql_fetch_array($query)){
	$pdf->ln(0.80);
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(5, 0.8, $lihat['nama'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['golongan'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['ukuran'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['harga'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['banyaknya'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['total'], 1, 0,'C');
	$pdf->Cell(6, 0.8, $lihat['status'], 1, 0,'C');
	$no++;
}

$pdf->Output("laporan_buku.pdf","I");

?>

