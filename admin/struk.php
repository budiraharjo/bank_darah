<?php 
  session_start();
  include "../distributor/db/koneksi.php";
  include "fungsi.php";

?>
<head>
<title>Struk</title>
<link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

</head>

<body onLoad="window.print()">

<div class="row">
<center><h3 style='margin-bottom:3px;'>UTD PMI PANDEGLNAG</h3>
    Struk Bukti Pembayaran Pesanan<hr/></center>
<section class="col-lg-3">
	<div class="pull-right box-tools">
	<table class="tbl">
		<thead>
			<tr>
				<td></td>
				<td>Tanggal </td>
				<td>:</td>
				<td><?php 
				$tgl = date('Y-d-m');
				echo  
				 Indo($tgl)
				?></td>
			</tr>
			<tr>
				<td></td>
				<td>Nomor </td>
				<td>:</td>
				<td>
				<?php
				$id =$_GET['id'];
				$lkonfir=mysql_query("select * from konfirmasi where id_konfirmasi='$id'");
				$kon=mysql_fetch_array($lkonfir);			
				$id_distributor = $kon['id_distributor'];
				
			
				$data1=mysql_query("select * from distributor where id_distributor='$id_distributor' ");
				$rr=mysql_fetch_array($data1);			
				
				
				$id_distributor = $rr['id_distributor'];
				
				$nomor=mysql_query("select * from penjualan where id_distributor='$id_distributor' AND status='Konfirmasi' LIMIT 1 ");
				$ada =mysql_num_rows($nomor);
				if($ada > 0){
				
				while($no=mysql_fetch_array($nomor)){	
				
				mysql_query("update konfirmasi set keterangan='Kirim/Lunas' where id_konfirmasi='$id'");

				echo $no['id_penjualan'];
				}
				?>
				</td>
			</tr>
			<tr>
			<td colspan="4">--------------------------------------------</td>
			</tr>
			<tr>
				<td></td>
				<td>Nama </td>
				<td>:</td>
				<td>
				<?php
				echo $rr['nama'];
				?>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>Nama Instansi </td>
				<td>:</td>
				<td>
				<?php
				echo $rr['nama_instansi'];
				?>
				</td>
			</tr>
		</thead>

	</table>
	</div>
</section>

<section class="col-lg-3">
<?php 
	echo "
	<table class='table'>
	<thead>
            <tr>
                <td></td>
                <td></td>
                <td>Darah</td>
                <td>Jumlah</td>
				<td>Subtotal</td>
                
            </tr>
        </thead>";
	
    
	$brg=mysql_query("select * from penjualan where id_distributor='$id_distributor' and status = 'Konfirmasi' ");
	while($r=mysql_fetch_array($brg)){	
	
		$drh=mysql_query("select * from darah where id_darah=$r[id_darah] ");
		while($dr=mysql_fetch_array($drh)){
			
	$jumlah=mysql_fetch_array(mysql_query("select sum(total) as jumlah from penjualan where id_distributor='$id_distributor' and status = 'Konfirmasi' "));
	$subto = $r['banyaknya'] * $dr['harga'];
	
		echo"
			<tr>
				<td></td>
                <td></td>
                <td>Gol $dr[golongan], Ukuran $dr[ukuran], Harga Rp. $dr[harga]</td>
                <td>$r[banyaknya]</td>
				<td> $subto </td>
                
            </tr>";
	
	}
	}
	echo'
	<tr>
		<td></td>
        <td colspan="3">Total</td>
        <td colspan="4">';
	echo $jumlah['jumlah'];
	echo'
	</td>
	</tr>
    </table>
	</br>';
	
	echo '
	<div class="pull-right box-tools">
	<table class="table">
	<thead>
		<tr>
			<td><center>Ttd</center></td>
		</tr>
		<tr>
			<td><center>Penerima</center></td>
		</tr>
		
		<tr>
		<td></br></br></br></td>
		</tr>
		
		<tr>
			<td><center><b>'; echo $rr['nama']; echo '</b></center></td>
		</tr>
	</thead>
	</table>
	</div>
	
	<table class="table">
	<thead>
		<tr>
			<td><center>Kepala UTD</center></td>
		</tr>
		<tr>
			<td><center>Cabang Pandeglang</center></td>
		</tr>
		
		<tr>
		<td></br></br></br></td>
		</tr>
		
		<tr>
			<td><center>(....................................)</center></td>
		</tr>
	</thead>
	</table>
	
	
	</br>';
	
	echo'
	<b>Alamat tujuan pengiriman : '; echo $rr['nama_instansi']; echo' '; echo $rr['alamat']; echo' '; echo $rr['telp'];
	echo '</b>';
	mysql_query("update penjualan set status='Kirim/Lunas' where id_distributor='$id_distributor' ");
	}else{
	 echo '<script>alert("Kiriman tidak ada/pesanan sudah dikirim !"); window.close();</script>';
}
				
?>

	

</section>
</div>	  