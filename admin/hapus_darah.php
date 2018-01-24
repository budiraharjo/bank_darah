<?php
// Load file koneksi.php
include "koneksi.php";

// Ambil data id yang dikirim oleh index.php melalui URL
$id = $_GET['id'];

// Query untuk menampilkan data darah berdasarkan id yang dikirim
$query = "SELECT * FROM darah WHERE id_darah='".$id."'";
$sql = mysqli_query($connect, $query); // Eksekusi/Jalankan query dari variabel $query
$data = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql


$query2 = "DELETE FROM darah WHERE id_darah='".$id."'";
$sql2 = mysqli_query($connect, $query2); // Eksekusi/Jalankan query dari variabel $query

if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
	// Jika Sukses, Lakukan :
	echo '<script language="javascript">alert("Data berhasil dihpus !"); document.location="index.php?page=penjualan&act=darah";</script>'; // Redirect ke halaman index.php
}else{
	// Jika Gagal, Lakukan :
	echo '<script language="javascript">alert("Data gagal dihapus !"); document.location="index.php?page=penjualan&act=darah";</script>';
}
?>
