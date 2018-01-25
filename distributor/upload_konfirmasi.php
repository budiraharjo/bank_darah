<?php
include "koneksi.php";
mysql_connect("localhost", "root", "");
mysql_select_db("bank_darah");

$id_penjualan = $_POST['id_penjualan'];
$id_distributor = $_POST['id_distributor'];
$tanggal = $_POST['tanggal'];
$ket = "Baru";
$seta = "Belum";

$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

$fotobaru = date('dmYHis').$foto;

$path = "../images/".$fotobaru;


if(move_uploaded_file($tmp, $path)){ 
	$query = "INSERT INTO konfirmasi VALUES('', '".$id_penjualan."', '".$id_distributor."', '".$fotobaru."', '".$ket."', '".$tanggal."', '".$seta."')";
	$sql = mysqli_query($connect, $query);
	if($sql){ 
	
		
	mysql_query("update penjualan set status='Konfirmasi' where id_distributor='$id_distributor' AND id_penjualan='$id_penjualan' ");
		echo '<script language="javascript">alert("Data berhasil dikirim !"); document.location="index.php";</script>';
	}else{
		echo '<script language="javascript">alert("Terjadi kesalahan pada saat penyimpanan !"); document.location="index.php";</script>';
	}
}else{
	echo '<script language="javascript">alert("Image  gagal di upload !"); document.location="index.php";</script>';
}
?>
