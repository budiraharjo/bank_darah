<!DOCTYPE php>
<?php
include 'config.php'; 

if(isset($_SESSION['nip'])== 0) { 
	header('Location: distributor.php'); 
}

?>
<html>
<head> 
<title>Bank Darah </title>
<link rel="icon" href="images/logo.png" type="image/png">
<!-- STYLES & JQUERY 
================================================== -->
        <link href="assets/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
  
    <link href="css/sb-admin.css" rel="stylesheet">
	 <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
         
<link rel="stylesheet" type="text/css" href="css/css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/css/icons.css"/>
<link rel="stylesheet" type="text/css" href="css/css/skinblue.css"/><!-- change skin color -->
<link rel="stylesheet" type="text/css" href="css/css/responsive.css"/>
<script src="js/jquery-1.9.0.min.js"></script><!-- the rest of the scripts at the bottom of the document -->

<script>
                //mendeksripsikan variabel yang akan digunakan
                var id_penjualan;
                var tanggal;
                var id_darah;
                var golongan;
                var harga;
                var ukuran;
                var stok;
				var jenis;
				var banyaknya;
				var id_distributor;
                $(function(){
                    //meload file pk dengan operator ambil darah dimana nantinya
                    //isinya akan masuk di combo box
                    $("#id_darah").load("pk.php","op=ambildarah");
                    
                    //meload isi tabel
                    $("#darah").load("pk.php","op=darah");
                    
                    //mengkosongkan input text dengan masing2 id berikut
                    $("#golongan").val("");
                    $("#ukuran").val("");
					$("#harga").val("");
                    $("#stok").val("");
                    $("#jenis").val("");
                    $("#banyaknya").val("");
                    
                                
                    //jika ada perubahan di Kode Darah
                    $("#id_darah").change(function(){
                        id_darah=$("#id_darah").val();
                        
                        //tampilkan status loading dan animasinya
                        $("#status").html("loading. . .");
                        $("#loading").show();
                        
                        //lakukan pengiriman data
                        $.ajax({
                            url:"proses.php",
                            data:"op=ambildata&id_darah="+id_darah,
                            cache:false,
                            success:function(msg){
                                data=msg.split("|");
                                
                                //masukan isi data ke masing - masing field
                                $("#golongan").val(data[0]);
                                $("#ukuran").val(data[1]);
                                $("#harga").val(data[2]);
                                $("#stok").val(data[3]);
                                $("#banyaknya").focus();
                                //hilangkan status animasi dan loading
                                $("#status").html("");
                                $("#loading").hide();
                            }
                        });
                    });
                    
                    //jika tombol tambah di klik
                    $("#tambah").click(function(){
						id_distributor=$("#id_distributor").val();
                        id_darah=$("#id_darah").val();
                        stok=$("#stok").val();
                        banyaknya=$("#banyaknya").val();
                        
                        if(id_darah=="Pemilihan"){
                            alert("Pilihan Harus diisi");
                            exit();
                        }else if(banyaknya > stok){
                            alert("Stok tidak terpenuhi");
                            $("#banyaknya").focus();
                            exit();
                        }else if(banyaknya < 1){
                            alert("banyaknya beli tidak boleh 0");
                            $("#banyaknya").focus();
                            exit();
                        }
                        golongan=$("#golongan").val();
                        harga=$("#harga").val();
                        
                                                
                        $("#status").html("sedang diproses. . .");
                        $("#loading").show();
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=tambah&id_distributor="+id_distributor+"&id_darah="+id_darah+"&banyaknya="+banyaknya,
                            cache:false,
                            success:function(msg){
                                if(msg=="sukses"){
									$("#status").html("Data berhasil di simpan. . .");
									alert('Penyimpanan Berhasil');
                                }else{
                                    $("#status").html("ERROR. . .");
                                }
                                $("#loading").hide();
                                $("#golongan").val("");
                                $("#harga").val("");
                                $("#ukuran").val("");
                                $("#stok").val("");
                                $("#banyaknya").val("");
                               
                                $("#id_darah").load("pk.php","op=ambildarah");
                                $("#darah").load("pk.php","op=darah");
                            }
                        });
                    });
                    
                    //jika tombol proses diklik
                    $("#proses").click(function(){
                        id_keranjang=$("#id_penjualan").val();
                        tanggal=$("#tanggal").val();
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=proses&id_penjualan="+id_penjualan+"&tanggal="+tanggal,
                            cache:false,
                            success:function(msg){
                                if(msg=='sukses'){
                                    $("#status").html('Transaksi Pembelian berhasil');
                                    alert('Transaksi Berhasil');
                                    exit();
                                }else{
                                    $("#status").html('Transaksi Gagal');
                                    alert('Transaksi Gagal');
                                    exit();
                                }
                                $("#id_darah").load("pk.php","op=ambildarah");
                                $("#darah").load("pk.php","op=darah");
                                $("#loading").hide();
                                $("#golongan").val("");
                                $("#harga").val("");
                                $("#ukuran").val("");
                                $("#stok").val("");
                            }
                        })
                    })
	
                });
function setUpdateAction() {
document.frmUser.action = "distributor.php?page=penjualan&act=edit";
document.frmUser.submit();
}
function setDeleteAction() {
if(confirm("Anda yakin ingin menghapus data ?")) {
document.frmUser.action = "delete_keranjang.php";
document.frmUser.submit();
}
}
            </script>
</head>
<body>
<!-- TOP LOGO & MENU
================================================== -->
<div class="undermenuarea">
	<div class="row ">
		<!--Logo-->
		<div class="c3">
			<a href="distributor.php"></br>
			<img src="images/logo.png" class="logo" alt="">
			</a>
		</div>
		
		<div class="c3">
			<nav id="topNav">
			<a href="logout.php"></br><li><img src="images/logout.png" height="50px" align="right" class="logo" alt="Logout"> </a></li>
			</nav>
		</div>
	</div>
</div>
			
			
			<section class="content">
			<div class="row">
			 
				
			<section class="col-lg-4 connectedSortable">
				<div class="row">
                        <div class="col-lg-6 col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        Darah
                                    </h3>
                                    <p>
                                        Pesan Sekarang
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-card"></i>
                                </div>
                                <a href="#" class="small-box-footer" data-toggle="modal" data-target=".bd-example-modal-lg">
                                    Klik di sini <i class="fa fa-arrow-circle-right"></i>
                                </a>
							
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-6 col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        Buka 
                                    </h3>
                                    <p>
                                        Selesai Memilih
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="?page=penjualan&act=selesai_memilih" class="small-box-footer" >
                                    Klik di sini <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
						 
					</div>
					<div class="row">	
                        <div class="col-lg-6 col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        Kirim
                                    </h3>
                                    <p>
                                        Konfirmasi
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-navigate"></i>
                                </div>
                                <a href="#" class="small-box-footer" data-toggle="modal" data-target=".bd-example-modal-lg2">
                                    Klik di sini <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-6 col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        Lihat
                                    </h3>
                                    <p>
                                        Stok
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-loop"></i>
                                </div>
                                <a href="#" class="small-box-footer" data-toggle="modal" data-target=".bd-example-modal-lg3">
                                    Klik di sini <i class="fa fa-arrow-circle-right"></i>
                                </a>
								
                            </div>
                        </div><!-- ./col -->
                    </div>
					<div class="row">	
                        <div class="col-lg-6 col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3>
                                        Edit
                                    </h3>
                                    <p>
                                        Sandi
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-key"></i>
                                </div>
                                <a href="#" class="small-box-footer" data-toggle="modal" data-target=".bd-example-modal-lg4">
                                    Klik di sini <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-6 col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>
                                        Edit 
                                    </h3>
                                    <p>
                                        Profile
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-compose"></i>
                                </div>
                                <a href="#" class="small-box-footer" data-toggle="modal" data-target=".bd-example-modal-lg5">
                                    Klik di sini <i class="fa fa-arrow-circle-right"></i>
                                </a>
								
                            </div>
                        </div><!-- ./col -->
                    </div>
			</section><!-- end main content -->		
			<?php

			$p=isset($_GET['act'])?$_GET['act']:null;
					switch($p){
                    default:

			$id_dis = $_SESSION['nip'];
			$result = $connect->query("SELECT * FROM distributor where nip='$id_dis' ");
			while($row = $result->fetch()) {
					echo"
					<section class='col-lg-8 connectedSortable'>
			 <div class='box box-info' id='loading-example'>
                                <div class='box-header'>
                                    <!-- tools box -->
                                    <div class='pull-right box-tools'>
									<a href='distributor.php'>
                                        <button class='btn btn-info btn-sm refresh-btn' data-toggle='tooltip' title='Reload'><i class='fa fa-refresh'></i></button>
                                    </a>
									</div><!-- /. tools -->
                                    <i class='fa fa-cloud'></i>

                                    <h3 class='box-title'>My Profile</h3>
                                </div><!-- /.box-header -->
                                <div class='box-body no-padding'>
                                    <div class='row'>
                                        <div class='col-sm-7'>
                                        <div class='form-group'>
                                            <label class='control-label' for='inputSuccess'><i class='fa fa-check'></i> NIP</label>
                                            <input type='text' class='form-control' value='$row[5]' readonly />
                                        </div>
                                        <div class='form-group'>
                                            <label class='control-label' for='inputSuccess'><i class='fa fa-check'></i> Nama</label>
                                            <input type='text' class='form-control' id='inputWarning' value='$row[3]' readonly />
                                        </div>
                                        <div class='form-group'>
                                            <label class='control-label' for='inputSuccess'><i class='fa fa-check'></i> Nama Instansi</label>
                                            <input type='text' class='form-control' id='inputError' value='$row[6]' readonly />
                                        </div>
										<div class='form-group'>
                                            <label class='control-label' for='inputSuccess'><i class='fa fa-check'></i> No Reg Instansi</label>
                                            <input type='text' class='form-control' id='inputError' value='$row[7]' readonly />
                                        </div>
										<div class='form-group'>
                                            <label class='control-label' for='inputSuccess'><i class='fa fa-check'></i> Telp</label>
                                            <input type='text' class='form-control' id='inputError' value='$row[9]' readonly />
                                        </div>
        
                                        </div>
                                        <div class='col-sm-5'>
                                            <div class='pad'>
												 
												<div class='pull-left image'>
												<img src='images/avatar3.png' width='150px' height='150px' class='img-circle' alt='User Image' />
												</div>
												</br>
												</br>
												<div class='pull-right'>
												<p>Hello, Jane</p>

												<a href='#'><i class='fa fa-circle text-success'></i> Online</a>
												</div>
											</div>
											</br>
											</br>
											</br>
											</br>
											</br>
											</br>
											</br>
											<div class='form-group'>
                                            <label class='control-label' for='inputSuccess'><i class='fa fa-check'></i> Alamat</label>
                                            <textarea type='text' class='form-control' id='inputError' value='' readonly />$row[8]</textarea>
											</div>
                                                <!-- Buttons -->
												 
                                            <!-- /.pad -->
                                        </div><!-- /.col -->
                                    </div><!-- /.row - inside box -->
                                </div><!-- /.box-body -->
                                 
                            </div>
					</section>"; } $connect = null;
					break;
                    case "selesai_memilih":
                        echo "<section class='col-lg-8 connectedSortable'>
							  <div class='box box-info' id='loading-example'>
                                <div class='box-header'>
                                    <!-- tools box -->
                                    <div class='pull-right box-tools'>
									<a href='distributor.php?page=penjualan&act=selesai_memilih'>
                                        <button class='btn btn-info btn-sm refresh-btn' data-toggle='tooltip' title='Reload'><i class='fa fa-refresh'></i></button>
                                    </a>
									</div><!-- /. tools -->
                                    <i class='fa fa-cloud'></i>

                                <h3 class='box-title'>Edit Pembelian</h3>
                                </div><!-- /.box-header -->
                                <div class='box-body no-padding'>
                                    <div class='row'>
                                        <div class='col-sm-12'>";
										echo "
										<form name='frmUser' method='post' action=''>
										 
										<table class='table'>
										<tr class='listheader'>
										<td>Pilih</td>
										<td>Id Distributor</td>
										<td>Id Darah</td>
										<td>Banyaknya</td>
										<td>Sub Total</td>
										</tr>";
									 $conn = mysql_connect("localhost","root","");
									 mysql_select_db("bank_darah",$conn);
									 
									 $nip = $_SESSION['nip'];
									 $dt=mysql_query("select * from distributor where nip='$nip'");
									 $d=mysql_fetch_array($dt);
									 
									 $id_distributor = $d['id_distributor'];
									 
									 $jumlah=mysql_fetch_array(mysql_query("select sum(total) as jumlah from keranjang where id_distributor='$id_distributor' "));
									 
									 $result = mysql_query("SELECT * FROM keranjang where id_distributor ='$id_distributor' ");
										$i=0;
										while($row = mysql_fetch_array($result)) {
										if($i%2==0)
										$classname='evenRow';
									else
										$classname='oddRow';
									 
									echo"<tr class='if(isset($classname)) echo $classname; '>
										<td><input type='checkbox' name='id_keranjang[]' value='$row[id_keranjang]' required ></td>
										<td>$row[id_distributor]</td>
										<td>$row[id_darah]</td>
										<td>$row[banyaknya]</td>
										<td>$row[total]</td>
										</tr>";
										 
									
									$i++;
										}
									
									echo "
										<tr>
										<td colspan='4'><center>Total</center></td>
										<td colspan='5'>$jumlah[jumlah]</td>
										</tr>
										<tr class='listheader'>
										<td colspan='5'>
										<input class='btn btn-success' type='button' name='update' value='Update' onClick='setUpdateAction();' /> 
										<input class='btn btn-danger' type='button' name='delete' value='Delete'  onClick='setDeleteAction();' />
										<div class='pull-right box-tools'>
											<a href='distributor.php'>
											<input class='btn btn-primary' type='button' id='proses' value='Proses' />
											</a>
										</div>
										</td>
										</tr>
										</table>
										</form>";
							
				   echo"</div>
						</div>
						</div>
					</div>
					</section>";
					
					
					
					break;
                    case "edit":
						
						
                        echo "<section class='col-lg-8 connectedSortable'>
							  <div class='box box-info' id='loading-example'>
                                <div class='box-header'>
                                    <!-- tools box -->
                                    <div class='pull-right box-tools'>
									<a href='distributor.php'>
                                        <button class='btn btn-info btn-sm refresh-btn' data-toggle='tooltip' title='Reload'><i class='fa fa-refresh'></i></button>
                                    </a>
									</div><!-- /. tools -->
                                    <i class='fa fa-cloud'></i>

                                <h3 class='box-title'>Edit Pembelian</h3>
                                </div><!-- /.box-header -->
                                <div class='box-body no-padding'>
                                    <div class='row'>
                                        <div class='col-sm-12'>";
										echo "
										<form name='frmUser' method='post' action='update_pesan.php'>
										<table border='0' cellpadding='10' cellspacing='1' width='500' class='tblListForm'>
										<tr class='listheader'>
										<td>Id Keranjang</td>
										<td>Id Distributor</td>
										<td>Id Darah</td>
										<td>Banyaknya</td>
										</tr>";
										$conn = mysql_connect("localhost","root","");
										mysql_select_db("bank_darah",$conn);
										$rowCount = count($_POST["id_keranjang"]);
										for($i=0;$i<$rowCount;$i++) {
										$result = mysql_query("SELECT * FROM keranjang WHERE id_keranjang='".$_POST["id_keranjang"][$i]."' ");
										$row[$i]= mysql_fetch_array($result);
									echo" 
										<td><input class='form-control' type='text' name='id_keranjang[]' value='".$row[$i]['id_keranjang']."' readonly></td>
										<td><input class='form-control' type='text' name='id_distributor[]' value='".$row[$i]['id_distributor']."' readonly></td>
										<td><input class='form-control' type='text' name='id_darah[]' value='".$row[$i]['id_darah']."' readonly></td>
										<td><input class='form-control' type='text' name='banyaknya[]' value='".$row[$i]['banyaknya']."' ></td>
										</tr>";
										 
										}
									
									echo "<tr class='listheader'>
										<td colspan='4'>
										<input type='submit' name='submit' value='Submit' class='btn btn-success'>
										</td>
										</tr>
										</table>
										</form>";
							
				   echo"</div>
						</div>
						</div>
					</div>
					</section>";
					
										
					
                        break;
					}
					?>
			
			</div>
			</section>
		
		
 <!-- end grid -->


						
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center>Pilih Darah</center></h4>
      </div>
	  <?php
                include "db/koneksi.php";
				
				 
                        $tgl=date('Y-m-d');
                        //untuk autonumber di id_penjualan
                        $auto=mysql_query("select * from penjualan order by id_penjualan desc limit 1");
                        $no=mysql_fetch_array($auto);
                        $angka=$no['id_penjualan']+1;
                        echo "<div class='modal-body'>
						<div class='navbar-form pull-right' >
                                <label>No. Order : </label><td>
								<input class='form-control' style='width:50px;' type='text' id='id_penjualan' value='$angka' readonly > 
								<input class='form-control' type='text' id='tanggal' value='$tgl' readonly>
								</td>   
                            </div>
                            </div></br></br>
							";
                            $nip =$_SESSION['nip'];
							$data1=mysql_query("select * from distributor where nip='$nip'");
							$rr=mysql_fetch_array($data1);
				
							$id_distributor = $rr['id_distributor'];
				 
                            echo"<div class='modal-body'>
							<div class='navbar-form' >
							<div class='form-group'>
                            <select style='width:150px;' id='id_darah' class='form-control'></select>
                            <input style='width:50px;' class='form-control' type='text' id='golongan' placeholder='Gol' readonly>
                            <input style='width:80px;' class='form-control' type='text' id='ukuran' placeholder='Ukuran' ' readonly>
                            <input style='width:80px;' class='form-control' type='text' id='harga' placeholder='Harga' ' readonly>
                            <input style='width:50px;' class='form-control' type='text' id='stok' placeholder='Stok' readonly>
                            <input style='width:80px;' class='form-control' type='text' id='banyaknya' placeholder='JML' >                     
                            <input style='width:80px;' class='form-control' type='hidden' id='id_distributor' value='$rr[id_distributor]'  >
							</br>                         
							
							<button id='tambah' class='btn btn-danger'>Tambah</button>
                            
                            <center><span id='status'></span></center></br></br>
							
							                         
							
							<span id='status'></span> 
                            							
							<table id='darah' class='table'>
                                    
                            </table>
							</div>
                            </div>
                            </div>";


                ?>
				<!-- <div class='form-actions'>
                                <button id='proses' class='btn btn-success'>Proses</button>
                            </div> -->
	  
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center>List Pesanan</center></h4>
      </div>
	  
	  
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center>Konfirmasi</center></h4>
      </div>
	  
	  
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center>Stok Darah</center></h4>
      </div>
	
	  
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center>Edit Katasandi</center></h4>
      </div>
	  
	  
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg5" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center>Edit Profile</center></h4>
      </div>
	 
	  
    </div>
  </div>
</div>


<div class="copyright">
	<div class="grid">
		<div class="row">
			<div class="c6">
				 Dewi Ayu Ratnasari &copy; 2017. UNMA Banten.
			</div>
			<div class="c6">
				<span class="right">
				Website UTD PMI Cabang Pandeglang </span>
			</div>
		</div>
	</div>
</div>
<script src="js/modernizr-latest.js"></script>
<script src="js/common.js"></script>
<script src="js/jquery.cycle.js"></script>
<script src="js/jquery.tweet.js"></script>
	  <script src="js/jquery.js"></script>

 
    <script src="js/bootstrap.min.js"></script>	 
       
        <script src="assets/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>       
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>
</body>
</html>
 