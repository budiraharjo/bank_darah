<?php
$host = "localhost"; // Nama hostnya
$username = "root"; // Username
$password = ""; // Password (Isi jika menggunakan password)
$database = "bank_darah"; // Nama databasenya

$connect = mysqli_connect($host, $username, $password, $database); // Koneksi ke MySQL

$koneksi = mysql_connect ($host,$username, $password)
			or die ('gagal terkoneksi'.mysql_error());
			
$database = mysql_select_db ($database)
			or die ('gagal terhubung ke database'.mysql_error());
?>