<?php
include "koneksi.php";


	
	if (isset($_POST['simpan_darah'])){
	 
		$golongan = $_POST['golongan'];
		$ukuran = $_POST['ukuran'];
		$harga = $_POST['harga'];
		$stok = $_POST['stok'];
		$jenis = $_POST['jenis'];
		
		
			$query = "INSERT INTO darah VALUES('','".$golongan."','".$ukuran."','".$harga."','".$stok."', '".$jenis."')";
			$sql = mysqli_query($connect, $query);
			if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		// Jika Sukses, Lakukan :
		echo '<script language="javascript">alert("Data berhasil disimpan !"); document.location="index.php?page=penjualan&act=darah";</script>';
	}else{
		// Jika Gagal, Lakukan : 
		echo '<script language="javascript">alert("Data gagal disimpan !"); document.location="index.php?page=penjualan&act=darah";</script>';
	}
	}

?>