<?php
include 'config.php';

if(isset($_SESSION['nip'])== 0) { 
header('Location: ../index.php'); 
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Bank Darah UTD PMI</title>
  <link rel="icon" href="../images/logo.png" type="image/png">
  <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <script src="../js/jquery-1.9.0.min.js"></script>
<script>
                //mendeksripsikan variabel yang akan digunakan
                var nomer;
                var tanggal;
                var stt;
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

                        nomer=$("#nomer").val();
                        tanggal=$("#tanggal").val();
                        stt=$("#stt").val();
                        
                        $.ajax({
                            url:"pk.php",
                            data:"op=proses&nomer="+nomer+"&tanggal="+tanggal+"&stt="+stt,
                            cache:false,
                            success:function(msg){
                                if(msg=='sukses'){
                                    $("#status").html('Transaksi Pembelian berhasil');
                                    controlWindow=window.open("struk.php","","toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=850,height=500");
									$("#darah").load("index.php");
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
document.frmUser.action = "index.php?page=penjualan&act=edit";
document.frmUser.submit();
}
function setDeleteAction() {
if(confirm("Anda yakin ingin menghapus data ?")) {
document.frmUser.action = "delete_keranjang.php";
document.frmUser.submit();
}
}

function cetakstruk(){
controlWindow=window.open("struk.php","","toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=no,width=850,height=500");
}									
            </script>
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="index.php" class="navbar-brand"><b>Bank</b>Darah</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="?page=penjualan&act=tambah">Pesan Sekarang<span class="sr-only">(current)</span></a></li>
            <li><a href="" data-toggle="modal" data-target=".bd-example-modal-lg1">Stok</a></li>
            
          </ul>
          
        </div>
     
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <?php
			include "koneksi.php";
			$conn = mysql_connect("localhost","root","");
			mysql_select_db("bank_darah",$conn);
			$nipo = $_SESSION['nip'];
			$dto=mysql_query("select * from distributor where nip='$nipo'");
			$do=mysql_fetch_array($dto);						 
			
			$id_distributoro = $do['id_distributor'];
			$qry_jumlah_nilai=mysql_query("SELECT * FROM konfirmasi where id_distributor='$id_distributoro' AND status='Belum' AND keterangan='Kirim/Lunas' ");
			$array = mysql_num_rows($qry_jumlah_nilai);

			?>          
            <li class="dropdown user user-menu">
			 <a href="?page=penjualan&act=pesan" class="dropdown-toggle">
			<i class="fa fa-envelope-o"><small> <?php echo json_encode($array); ?></small></i> 
				</a>
			</li>
			
			<li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="../images/pandeg.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">UTD PMI </span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="../images/pandeg.png" class="img-circle" alt="User Image">

                  <p>
                    Palang Merah Indonesia
                    <small>Cabang Pandeglang</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#"></a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#"></a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#"></a>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="../logout.php" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          UTD PMI
          <small>Cabang Pandeglang</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">.</a></li>
          <li class="active">.</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Palang Merah Indonesia</h3>
          </div>
          <div class="box-body">
             
			 
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
                                <a href="?page=penjualan&act=tambah" class="small-box-footer" >
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
                                        Update Pesanan
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
                                <a href="#" class="small-box-footer" data-toggle="modal" data-target=".bd-example-modal-lg">
                                    Klik di sini <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-6 col-xs-4">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        Cetak
                                    </h3>
                                    <p>
                                        Tagihan
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-loop"></i>
                                </div>  
                                <a href="#" onClick="cetakstruk()" class="small-box-footer" >
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
                                <a href="#" class="small-box-footer" data-toggle="modal" data-target=".bd-example-modal-lg2">
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
                                <a href="#" class="small-box-footer" data-toggle="modal" data-target=".bd-example-modal-lg3">
                                    Klik di sini <i class="fa fa-arrow-circle-right"></i>
                                </a>
								
                            </div>
                        </div><!-- ./col -->
                    </div>
			</section><!-- end main content -->		
			<?php
			
			include 'db/koneksi.php';
			$host = "localhost"; // nama host anda
			$user = "root"; // username dari host anda
			$pass = ""; //password dari host anda
			$db   = "bank_darah"; // nama database yang anda miliki

			try {
			$connect = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			catch(PDOException $e) {
			echo $e->getMessage();
			}
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
									<a href='index.php'>
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
												<img src='../images/pandeg.png' width='150px' height='150px' class='img-circle' alt='User Image' />
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
									<a href='index.php?page=penjualan&act=selesai_memilih'>
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
											<a href='index.php'>
											<input class='btn btn-primary' type='button' id='prosesf' value='Proses' />
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
					case "tambah":
						
				
				 
                        $tgl=date('Y-m-d');
                        //untuk autonumber di id_penjualan
                        $auto=mysql_query("select * from penjualan order by id_penjualan desc limit 1");
                        $no=mysql_fetch_array($auto);
                        $angka=$no['id_penjualan']+1;
                        echo "<div class='modal-body'>
						<div class='navbar-form pull-right' >
								<input class='form-control' style='width:50px;' type='hidden' id='nomer' value='$angka' readonly > 
								<input class='form-control' type='hidden' id='tanggal' value='$tgl' readonly>
								<input class='form-control' type='hidden' id='stt' value='Baru' readonly>
								  
                            </div>
                            </div>
							";
                            $nip =$_SESSION['nip'];
							$data1=mysql_query("select * from distributor where nip='$nip'");
							$rr=mysql_fetch_array($data1);
				
							$id_distributor = $rr['id_distributor'];
				 
                            echo"
							<center>Silahkan Pilih Darah Yang Akan Dipesanan </center>
							<div class='modal-body'>
							<div class='navbar-form' >
							<div class='form-group'>
                            <select style='width:150px;' id='id_darah' class='form-control'></select>
                            <input style='width:50px;' class='form-control' type='text' id='golongan' placeholder='Gol' readonly>
                            <input style='width:80px;' class='form-control' type='text' id='ukuran' placeholder='Ukuran' ' readonly>
                            <input style='width:80px;' class='form-control' type='text' id='harga' placeholder='Harga' ' readonly>
                            <input style='width:50px;' class='form-control' type='text' id='stok' placeholder='Stok' readonly>
                            <input style='width:80px;' class='form-control' type='text' id='banyaknya' value='1' >                     
                            <input style='width:80px;' class='form-control' type='hidden' id='id_distributor' value='$rr[id_distributor]'  >
							</br>                         
							</br>                         
							
							<button id='tambah' class='btn btn-danger'>Tambah</button>
                            
                            <center><span id='status'></span></center></br></br>
							
							                         
							
							<span id='status'></span> 
                            							
							<table id='darah' class='table'>
                                    
                            </table>
							<div class='form-actions'>
                                <button id='proses' class='btn btn-success'>Proses</button>
                            </div>
							</div>
                            </div>
                            </div>";
					break;
					case "pesan":
                        //untuk autonumber di id_penjualan
							echo"
							<section class='col-lg-8 connectedSortable'>
							<div class='box box-info' id='loading-example'>
                            <div class='box-header'>
							<center>PESAN MASUK</center>
							<div class='modal-body'>
							<div class='navbar-form' >
							<table class='table'>
							<thead>
							<tr>
								<td>Tanggal</td>
								<td>Status</td>
								<td>Ketarangan</td>
							<tr>
							</thead>
							";
							
							$nip =$_SESSION['nip'];
							$data1=mysql_query("select * from distributor where nip='$nip'");
							$rr=mysql_fetch_array($data1);
							$id_distributor = $rr['id_distributor'];
							
							$beritahu=mysql_query("select * from konfirmasi where id_distributor='$id_distributor' AND keterangan='Kirim/Lunas' ");
							while($data = mysql_fetch_array($beritahu)) {

                            echo"
								<tr>
								<center><td>$data[tanggal]</td></center>
								<center><td><a href='?page=penjualan&act=baca&id_konfirmasi=$data[id_konfirmasi]'>$data[status]</a></td></center>
								<center><td>$data[keterangan]</td></center>
								</tr>
							";
						    }
                            
							echo"
							</table>
							</div>
							</div>
							</div>
                            </div>
                            </div>
							</section>";
					break;
					case "baca":
                        //untuk autonumber di id_penjualan
							echo"
							<section class='col-lg-8 connectedSortable'>
							<div class='box box-info' id='loading-example'>
                            <div class='box-header'>
							<center>PESAN MASUK</center>
							<div class='modal-body'>
							<div class='navbar-form' >
							<table class='table'>
							
							";
							include "db/koneksi.php";
                            $id_konfirmasi = $_GET['id_konfirmasi'];						
							$ejah=mysql_query("select * from konfirmasi where id_konfirmasi='$id_konfirmasi' ");
						
							while($baca = mysql_fetch_array($ejah)) {
						
                            echo"
								<tr>
								<center><td>Pemesanan anda pada Tanggal : $baca[tanggal] sudah berstatus $baca[keterangan], tunggu pesanan anda akan segera kami kirim.</td></center>
								<td><a href='?page=penjualan&act=pesan'>Kembali</a></td>
								</tr>
							";
						    }
                       
							mysql_query("update konfirmasi set status='Dibaca' where id_konfirmasi='$id_konfirmasi'");
							echo"
							</table>
							</div>
							</div>
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
									<a href='index.php'>
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
		
		 

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title"><center>Konfirmasi</center></h4>
      </div>
	  <div class="modal-body">
       <div class="form-bottom">
	   
	   <form action="upload_konfirmasi.php" method="post" enctype="multipart/form-data">
	   <div class="form-group">
	   <?php
			include "koneksi.php";
			
			$tanggal = date('Y-m-d');

			$id_dis = $_SESSION['nip'];
			$query = "SELECT * FROM distributor where nip='$id_dis' "; 
			$sql = mysqli_query($connect, $query);
			while($rows = mysqli_fetch_array($sql)){ 
			
			$query1 = "SELECT * FROM penjualan where id_distributor='$rows[id_distributor]' and status='Baru' LIMIT 1"; 
			$sql1 = mysqli_query($connect, $query1);
			while($rows1 = mysqli_fetch_array($sql1)){ 
	
				
			?>
	   <div class="form-group">
	   <label>No Penjualan</label>
	   <input type="text" class="form-control" name="id_penjualan" value="<?php echo $rows1['id_penjualan'] ?>" readonly>
	   </div>
	   <div class="form-group">
	   <label>Id Distributor</label>
	   <input type="text" class="form-control" name="id_distributor" value="<?php echo $rows['id_distributor']; ?>" readonly>
	   </div>
	   <div class="form-group">
	   <input type="file" class="form-control" name="foto" placeholder="Foto" >
	   </div>
	   <div class="form-group">
	   <input type="text" class="form-control" name="tanggal" value="<?php echo $tanggal ?>" readonly>
	   </div>
	   <div class="form-group">
	   <input type="submit" class="btn btn-success" value="Kirim">
	   </div>
<?php
}}
?>
	   </div>
	   
	   </form>
	   </div>
	   </div>
    </div>
  </div>
</div>
 <div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center>Data Stok Darah</center></h4>
      </div>
	   <div class="modal-body">
       <div class="form-bottom">
	   <table class="table">
	   <thead>
		<tr>
		<th><center>No</center></th>
		<th><center>Golongan</center></th>
		<th><center>Ukuran</center></th>
		<th><center>Harga</center></th>
		<th><center>Stok</center></th>
		<th><center>Jenis</center></th>
		</tr>
		</thead>
		<?php
		$result1 = mysql_query("SELECT * FROM darah ");
		$no=0;
		while($d = mysql_fetch_array($result1)) {
		$no++;
		echo "<tbody><tr>
		<td>$no</td>
		<td>$d[golongan]</td>
		<td>$d[ukuran]</td>
		<td>$d[harga]</td>
		<td>$d[stok]</td>
		<td>$d[jenis]</td>
		</tr></tbody>";
		}
		?>
	</table>
	  
    </div>
    </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center>Edit Katasandi</center></h4>
      </div>
	  <div class="modal-body">
      <div class="form-bottom">
	  <?php

$id_user = $_SESSION['nip'];

if (isset($_POST["simpanpsw"])) {
	$password_sekarang = md5($_POST["password_sekarang"]."ALS52KAO09");
	$password_baru_1 = md5($_POST["password_baru_1"]."ALS52KAO09");
	$password_baru_2 = md5($_POST["password_baru_2"]."ALS52KAO09");
	
	$sql = "SELECT * FROM distributor WHERE nip = '$id_user'";
	$query = mysql_query($sql);
	$user = mysql_fetch_array($query);
	
	$username = $user["username"];
	if ($password_sekarang != $user["password"]) {
			
	echo "<script>alert(\"Password lama salah!\");</script>";
	echo "<meta http-equiv='refresh' content='1;URL=index.php?id_user=$id_user'>";
	
	} elseif ($password_baru_1 != $password_baru_2) {
	
	echo "<script>alert(\"Konfirmasi password baru tidak sama!\");</script>";
	echo "<meta http-equiv='refresh' content='1;URL=index.php?id_user=$id_user'>";
	
	} elseif ($password_sekarang == $user["password"] && $password_baru_1 == $password_baru_2) {
	
	$sql = "UPDATE distributor SET password = '$password_baru_1' WHERE nip = '$id_user'";
	$query = mysql_query($sql);
	if (!$query){
		die ('Gagal mengubah password' . mysql_error());
	}
	
	echo "<script>alert(\"Password user berhasil diedit!\");</script>";
	echo "<meta http-equiv='refresh' content='1;URL=index.php'>";
		
	} 
}
	
?>
	  <form name="ubah_password" action="" method="post">
	  <div class="form-group">
	  <div class="form-group">
	  <label>Password sekarang</label>
	  <input class="form-control" type="password" name="password_sekarang" size="30" maxlength="30" /> 
	  </div>
	  <div class="form-group">
	  <label>Password baru</label>
	  <input class="form-control" type="password" name="password_baru_1" size="30" maxlength="30" /> 
	  </div>
	  <div class="form-group">
	  <label>Masukkan kembali password baru</label>
	  <input class="form-control" type="password" name="password_baru_2" size="30" maxlength="30" />  
	  </div>
	  <div class="form-group">
	  <input class="btn btn-danger" type="reset" name="reset" value="Reset">
	  <input class="btn btn-success" type="submit" name="simpanpsw" value="Simpan" /> 
	  </div>
	  </div>
	
	</form>
	  
    </div>
    </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><center>Edit Profile</center></h4>
      </div>
	  <div class="modal-body">
      <div class="form-bottom">
	  <?php
	  if (isset($_POST["simpanprofile"])) {
	  $id_user = $_SESSION['nip'];
	  $prof1 = "SELECT * FROM distributor WHERE nip = '$id_user'";
	  $il1 = mysql_query($prof1);
	  $panggil1 = mysql_fetch_array($il1);
	  
	  $id_dis = $panggil1['id_distributor'];
	  
	  $nip 				= $_POST['nip'];
	  $nama 			= $_POST['nama'];
	  $nama_instansi 	= $_POST['nama_instansi'];
	  $no_reg_instansi 	= $_POST['no_reg_instansi'];
	  $telp 			= $_POST['telp'];
	  $alamat 			= $_POST['alamat'];
	  
		  
		  $sql55 = "UPDATE distributor SET nip = '$nip', nama='$nama', nama_instansi='$nama_instansi', no_reg_instansi='$no_reg_instansi', alamat='$alamat', telp='$telp' WHERE id_distributor = '$id_dis'";
		  $query55 = mysql_query($sql55); 
		  if (!$query55){
			  die ('Data gagal di update' . mysql_error());
			  }  
			  echo "<script>alert(\"Data berhasil di update!\");</script>";
			  echo "<meta http-equiv='refresh' content='1;URL=index.php'>";			  
		} 
	
	  ?>
	  
	  <?php
	  $prof = "SELECT * FROM distributor WHERE nip = '$id_user'";
	  $il = mysql_query($prof);
	  $panggil = mysql_fetch_array($il);
	  
	  ?>
	  
	  <form name="ubah_profile" action="" method="post">
	  <div class="form-group">
      <label class="control-label" for="inputSuccess"><i class="fa fa-id-card"></i> NIP</label>
      <input type="text" name="nip" class="form-control" value="<?php echo $panggil['nip']; ?>" readonly />
      </div>
      <div class="form-group">
      <label class="control-label" for="inputSuccess"><i class="fa fa-user"></i> Nama</label>
      <input type="text" name="nama" class="form-control" id="inputWarning" value="<?php echo $panggil['nama']; ?>"  />
      </div>
      <div class="form-group">
      <label class="control-label" for="inputSuccess"><i class="fa fa-institution"></i> Nama Instansi</label>
      <input type="text" name="nama_instansi" class="form-control" id="inputError" value="<?php echo $panggil['nama_instansi']; ?>" />
	  </div>
	  <div class="form-group">
	  <label class="control-label" for="inputSuccess"><i class="fa fa-sort-numeric-asc"></i> No Reg Instansi</label>
	  <input type="text" name="no_reg_instansi" class="form-control" id="inputError" value="<?php echo $panggil['no_reg_instansi']; ?>" readonly />
	  </div>
	  <div class="form-group">
	  <label class="control-label" for="inputSuccess"><i class="fa fa-phone"></i> Telp</label>
	  <input type="text" name="telp" class="form-control" value="<?php echo $panggil['telp']; ?>" />
	  </div>
	  <div class="form-group">
	  <label class="control-label" for="inputSuccess"><i class="fa fa-map"></i> Alamat</label>
	  <textarea type="text" name="alamat" class="form-control" value="" /><?php echo $panggil['alamat']; ?></textarea>
	  
	  <div class="form-group">
	  <input class="btn btn-danger" type="reset" name="reset" value="Reset">
	  <input class="btn btn-success" type="submit" name="simpanprofile" value="Simpan" /> 
	  </div>
	  </form>

	  </div>
	  </div>
	  </div>
  </div>
</div>
</div>




  
  </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  
  <footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        
      </div>
      <strong>Copyright &copy; 2017<a href="">Dewi</a>.</strong> UNMA Banten
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="../js/jquery.js"></script>
<script src="../assets/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script> 
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
