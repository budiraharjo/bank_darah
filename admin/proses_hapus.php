<?php
// Load file koneksi.php
include "koneksi.php";

// Ambil data id yang dikirim oleh index.php melalui URL
$id = $_GET['id'];

// Query untuk menampilkan data konfirmasi berdasarkan id yang dikirim
$query = "SELECT * FROM konfirmasi WHERE id_konfirmasi='".$id."'";
$sql = mysqli_query($connect, $query); // Eksekusi/Jalankan query dari variabel $query
$data = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql

// Cek apakah file fotonya ada di folder images
if(is_file("../images/".$data['foto'])) // Jika foto ada
	unlink("../images/".$data['foto']); // Hapus foto yang telah diupload dari folder images

// Query untuk menghapus data konfirmasi berdasarkan id yang dikirim
$query2 = "DELETE FROM konfirmasi WHERE id_konfirmasi='".$id."'";
$sql2 = mysqli_query($connect, $query2); // Eksekusi/Jalankan query dari variabel $query

if($sql2){ // Cek jika proses simpan ke database sukses atau tidak
	// Jika Sukses, Lakukan :
	echo '<script language="javascript">alert("Data berhasil dihpus !"); document.location="index.php?page=penjualan&act=pesan_masuk";</script>'; // Redirect ke halaman index.php
}else{
	// Jika Gagal, Lakukan :
	echo '<script language="javascript">alert("Data gagal dihapus !"); document.location="index.php?page=penjualan&act=pesan_masuk";</script>';
}
?>
