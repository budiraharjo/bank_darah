<?php
    $server = "localhost";
	$username = "root";
	$password = "";
	$database = "bank_darah";

	mysql_connect($server,$username,$password) or die("Koneksi gagal");
	mysql_select_db($database) or die("Database tidak bisa dibuka");

  
    $id_distributor = $_POST['id_distributor'];
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];


    $sql = mysql_query("UPDATE distributor SET nama = '$nama', nip = '$nip', alamat = '$alamat', telp = '$telp' WHERE id_distributor=$id_distributor");

    if ($sql) {
        //jika  berhasil tampil ini
        echo '<script language="javascript">alert("Data berhasil di update !"); document.location="index.php?page=penjualan&act=data_distributor";</script>';
    } else {
        // jika gagal tampil ini
        echo '<script language="javascript">alert("Data gagal diupdate !"); document.location="index.php?page=penjualan&act=data_distributor";</script>';
    }



   
?>