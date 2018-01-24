<?php
    $server = "localhost";
	$username = "root";
	$password = "";
	$database = "bank_darah";

	mysql_connect($server,$username,$password) or die("Koneksi gagal");
	mysql_select_db($database) or die("Database tidak bisa dibuka");

  
    $id_darah = $_POST['id_darah'];
    $golongan = $_POST['golongan'];
    $ukuran = $_POST['ukuran'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];


    $sql = mysql_query("UPDATE darah SET golongan = '$golongan', ukuran = '$ukuran', harga = '$harga', stok = '$stok' WHERE id_darah=$id_darah");

    if ($sql) {
        //jika  berhasil tampil ini
        echo '<script language="javascript">alert("Data berhasil di update !"); document.location="index.php?page=penjualan&act=darah";</script>';
    } else {
        // jika gagal tampil ini
        echo '<script language="javascript">alert("Data gagal diupdate !"); document.location="index.php?page=penjualan&act=darah";</script>';
    }



   
?>