<?php
include '../config.php'; 

if(isset($_SESSION['username'])== 0) { 
	echo '<script language="javascript">alert("Anda belum login !"); document.location="../admin.php";</script>';
			
	
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bank Darah UTD PMI</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../distributor/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../distributor/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../distributor/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../distributor/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../distributor/dist/css/skins/_all-skins.min.css">
   
</head>

<body class="hold-transition skin-blue layout-boxed sidebar-mini">

<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b>ANK</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Darah</b>UTD</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../images/logo.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Admin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../images/logo.png" class="img-circle" alt="User Image">

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
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../images/logo.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
       
        <li class="treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php"><i class="fa fa-circle-o"></i> Home</a></li>
          
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?page=penjualan&act=penjualan"><i class="fa fa-circle-o"></i> Penjualan</a></li>
            <li><a href="?page=penjualan&act=distributor"><i class="fa fa-circle-o"></i> Daftar Distributor</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Daftar Darah</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?page=penjualan&act=darah"><i class="fa fa-circle-o"></i> Stok Darah</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Data Distributor</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?page=penjualan&act=data_distributor"><i class="fa fa-circle-o"></i> Data Distributor</a></li>
          </ul>
        </li>
        
		<?php
		include "koneksi.php";
		$qry_jumlah_nilai=mysql_query("SELECT * FROM konfirmasi where keterangan='Baru' ");
		$array = mysql_num_rows($qry_jumlah_nilai);
	
		?>
        <li>
          <a href="?page=penjualan&act=pesan_masuk">
            <i class="fa fa-envelope"></i> <span>Pesan Masuk</span>
            <span class="pull-right-container">
              
              <small class="label pull-right bg-red"><?php echo json_encode($array); ?></small>
            </span>
          </a>
        </li>

            
          </ul>
        
        
      </ul>
    </section>

  </aside>


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Unit Trasfusi Darah
        <small>PMI Cabang Pandeglang</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Layout</a></li>
        <li class="active">Boxed</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">-</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
         
		 <?php
			
			$p=isset($_GET['act'])?$_GET['act']:null;
					switch($p){
                    default:

                    echo"
					</br>
					<center><h4>Selamat datang kembali admin</h4></center>
					</br>
					</br>
					</br>
					</br>
					";			

					break;
                    case "penjualan":
						
						
                        echo "<a href='laporanpenjualan.php' target='blank' class='btn btn-info'>Cetak Laporan</a>
								<table class='table'>
								<tr>
								<th>No</th>
								<th>Id Keranjang</th>
								<th>Distributor</th>
								<th>Darah</th>
								<th>QTY</th>
								<th>Tanggal</th>
								<th>Status</th>
								
								</tr>";
							$query = "SELECT * FROM penjualan "; 
							$sql = mysqli_query($connect, $query);
							
						
							$no=0;
							
							while($data = mysqli_fetch_array($sql)){ 
							$no++;
						echo "<tr>
								<td>$no</td>
								<td>$data[id_keranjang]</td>
								<td>$data[id_distributor]</td>
								<td>$data[id_darah]</td>
								<td>$data[banyaknya]</td>
								<td>$data[tanggal]</td>
								<td>$data[status]</td>
							  </tr>";
							}
							echo "</table>";
						
					

                        break;
						
						
						case "distributor":
						
						echo "<a href='laporandistributor.php' target='blank' class='btn btn-info'>Cetak Laporan</a>
								<table class='table'>
								<tr>
								<th>No</th>
								<th>Nama</th>
								<th>JK</th>
								<th>NIP</th>
								<th>Nama Instansi</th>
								<th>No Reg Instansi</th>
								<th>Alamat</th>
								<th>Telp</th>
								
								</tr>";
							$query2 = "SELECT * FROM distributor"; 
							$sql2 = mysqli_query($connect, $query2);
							
						
							$no=0;
							while($data2 = mysqli_fetch_array($sql2)){ 
							$no++;
						echo "<tr>
								<td>$no</td>
								<td>$data2[nama]</td>
								<td>$data2[jenis_kelamin]</td>
								<td>$data2[nip]</td>
								<td>$data2[nama_instansi]</td>
								<td>$data2[no_reg_instansi]</td>
								<td>$data2[alamat]</td>
								<td>$data2[telp]</td>
								
							  </tr>";
							}
						
							echo "</table>";
						
						break;
                    
					case "darah":
					
					echo "<div class='pull-right hidden-xs'>
							<a href='laporandarah.php' target='blank' class='btn btn-info'>Cetak Laporan</a>
							</div>
							<a href='#' data-toggle='modal' data-target='#ModalDarah'><button class='btn btn-info'>+ Tambah</button></a>
								<center><h4>Daftar Stok Darah</h4></center></br>
								<table class='table'>
								<tr>
								<th>No</th>
								<th>Golongan</th>
								<th>Ukuran</th>
								<th>Harga</th>
								<th>QTY Stok</th>
								<th>Jenis</th>
								<th colspan=2>Pilih</th>
								</tr>";
							$query1 = "SELECT * FROM darah"; 
							$sql1 = mysqli_query($connect, $query1);
							
						
							$no=0;
							while($data1 = mysqli_fetch_array($sql1)){ 
							$no++;
						echo "<tr>
								<td>$no</td>
								<td>$data1[golongan]</td>
								<td>$data1[ukuran]</td>
								<td>$data1[harga]</td>
								<td>$data1[stok]</td>
								<td>$data1[jenis]</td>
								<td><a href='#edit_modal1' class='btn btn-info btn-sm' data-toggle='modal' data-id=$data1[id_darah]>Edit</a></td>
								<td><a href=hapus_darah.php?id=$data1[id_darah] class='btn btn-danger btn-sm'>Hapus</a></td>
							  </tr>";
							}
						
							echo "</table>";
							
					
					break;
                    
					case "data_distributor":
					echo "<table class='table'>
								<tr>
								<th>No</th>
								<th>Nama</th>
								<th>JK</th>
								<th>NIP</th>
								<th>Nama Instansi</th>
								<th>No Reg Instansi</th>
								<th>Alamat</th>
								<th>Telp</th>
								<th colspan=2>Pilih</th>
								</tr>";
							$query3 = "SELECT * FROM distributor"; 
							$sql3 = mysqli_query($connect, $query3);
							
						
							$no=0;
							while($data3 = mysqli_fetch_array($sql3)){ 
							$no++;
						echo "<tr>
								<td>$no</td>
								<td>$data3[nama]</td>
								<td>$data3[jenis_kelamin]</td>
								<td>$data3[nip]</td>
								<td>$data3[nama_instansi]</td>
								<td>$data3[no_reg_instansi]</td>
								<td>$data3[alamat]</td>
								<td>$data3[telp]</td>
								<td><a href='#edit_modal' class='btn btn-info btn-sm' data-toggle='modal' data-id=$data3[id_distributor]>Edit</a></td>
								<td><a href=hapus_distributor.php?id=$data3[id_distributor] class='btn btn-danger btn-sm'>Hapus</a></td>
							  </tr>";
							}
						
							echo "</table>";
					break;
                    
					case "pesan_masuk":
					
					include 'fungsi.php'; 
					echo "<table class='table'>
								<tr>
								<th><center>No</center></th>
								<th><center>No Nota</center></th>
								<th><center>NIP</center></th>
								<th><center>Nama</center></th>
								<th><center>Alamat</center></th>
								<th><center>Foto</center></th>
								<th><center>Tanggal</center></th>
								<th><center>Keterangan</center></th>
								<th colspan=2><center>Aksi</center></th>
								</tr>";
							$query4 = "SELECT * FROM konfirmasi inner join distributor on distributor.id_distributor=konfirmasi.id_distributor where keterangan='Baru' "; 
							$sql4 = mysqli_query($connect, $query4);
							$no=0;
							while($data4 = mysqli_fetch_array($sql4)){ 

							
							$no++;
						echo "<tr>
								<td>$no</td>
								<td>$data4[id_penjualan]</td>
								<td>$data4[nip]</td>
								<td>$data4[nama]</td>
								<td>$data4[nama_instansi], $data4[alamat], $data4[telp]</td>
								<td><img src='../images/$data4[foto]' class='img-circle' width='80px' height='80px'></td>
								<td>";
						echo tgl($data4['tanggal']);
						echo "</td>
								<td>$data4[keterangan]</td>
								<td><a 	href='struk.php?id=$data4[id_konfirmasi]' onclick='window.open(&apos;&apos;, &apos;popupwindow&apos;, &apos;scrollbars=yes,width=850,height=500&apos;);return true' target='popupwindow' class='btn btn-info btn-sm'>
								Cetak</a></td>
								<td><a href=proses_hapus.php?id=$data4[id_konfirmasi] class='btn btn-danger btn-sm'>Hapus</a></td>
							  </tr>";
							}
							echo "</table>";
					
					break;

					
					}
					?>
		 
		 
        </div>

		
		
		
		<div class="modal fade" id="ModalDarah" role="dialog">
		<div class="modal-dialog">
		<div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title text-center"><strong>Tambah Stok Darah</strong></h3>
        </div>
        <div class="modal-body">
        <div class="form-bottom">
			<form method="post" action="modul.php">
			<div class="form-group">
			<select class="form-control" name="golongan" required>
				<option value="">Pilih Darah</option>
				<option value="A"> A</option>
				<option value="B"> B</option>
				<option value="AB"> AB</option>
				<option value="O"> O</option>
			</select>
			</div>
			<div class="form-group">
			<input class="form-control" type="text" name="ukuran" placeholder="Ukuran" required>
			</div>
			<div class="form-group">
			<input class="form-control" type="text" name="harga" placeholder="Harga" required>
			</div>
			<div class="form-group">
			<input class="form-control" type="text" name="stok" placeholder="Stok" required>
			</div>
			<div class="form-group">
			<input class="form-control" type="text" name="jenis" placeholder="Jenis" required>
			</div>
			<div class="modal-footer">
			<input type="submit" name="simpan_darah" class="btn btn-success" value="Simpan" />
			<button type="button" class="btn btn-info tutup" data-dismiss="modal">Tutup</button>
			</div>
			</form>
        </div>
        </div>
        </div>
        </div>
		</div>
		
		
		
        <div class="box-footer">
           
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>

<div class="modal fade" id="edit_modal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Data Distributor</h4>
                </div>
                <div class="modal-body">
                    <div class="hasil-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="edit_modal1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Data Darah</h4>
                </div>
                <div class="modal-body">
                    <div class="hasil-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
    </div>
	
<script src="jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#edit_modal').on('show.bs.modal', function (e) {
            var idx = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'detail.php',
                data :  'idx='+ idx,
                success : function(data){
                $('.hasil-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>
  
  <script type="text/javascript">
    $(document).ready(function(){
        $('#edit_modal1').on('show.bs.modal', function (e) {
            var idx = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'detail_darah.php',
                data :  'idx='+ idx,
                success : function(data){
                $('.hasil-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>
  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
        
    </div>
    <strong>Copyright &copy; 2017<a href="">Dewi</a>.</strong> UNMA Banten
  </footer>

  
  <div class="control-sidebar-bg"></div>
</div>

<script src="../distributor/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../distributor/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../distributor/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../distributor/bower_components/fastclick/lib/fastclick.js"></script>
<script src="../distributor/dist/js/adminlte.min.js"></script>
<script src="../distributor/dist/js/demo.js"></script>
</body>
</html>
