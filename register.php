
<!DOCTYPE HTML>
<html>
<head> 
<title>Bank Darah</title>
<link rel="icon" href="images/logo.png" type="image/png">
<!-- STYLES & JQUERY 
================================================== -->
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/icons.css"/>
<link rel="stylesheet" type="text/css" href="css/skinblue.css"/><!-- Change skin color here -->
<link rel="stylesheet" type="text/css" href="css/responsive.css"/>
<script src="js/jquery-1.9.0.min.js"></script><!-- scripts at the bottom of the document -->
</head>
<body>
<div class="boxedtheme">
<!-- TOP LOGO & MENU
================================================== -->
<div class="grid">
	<div class="row space-bot">
		<!--Logo-->
		<div class="c4">
			<a href="index.html">
				<img src="images/logo.png" class="logo" alt="">
			</a>
		</div>
		<!--Menu-->
		<?php
		include "menu_head.php";
		?>
			 
</div>
</div>
<!-- HEADER
================================================== -->
<div class="undermenuarea">
	<div class="boxedshadow">
	</div>
	<div class="grid">
		<div class="row">
			<div class="c8">
				<h1 class="titlehead">Registrasi</h1>
			</div>
			<div class="c4">
				<h1 class="titlehead rightareaheader"><i class="icon-map-marker"></i> Pandeglang</h1>
			</div>
		</div>
	</div>
</div>
<!-- CONTENT
================================================== -->
<div class="grid">
		
		<div class="row space-top">
			<!-- CONTACT FORM -->
			<div class="c4 space-top">
				
				
			</div>
			<div class="c4 space-top">
				<h1 class="maintitle">
				<span><i class="icon-book"></i> Silahkan Daftar </span>
				</h1>
				<div class="wrapcontact">
					 

<?php 

error_reporting(0);
include 'config.php';

if(!isset($_SESSION['username'] )== 0) { /* Halaman ini tidak dapat diakses jika belum ada yang login */
	header('Location: home.php'); 
}

$username 		 = $_POST['username'];
$nama 			 = $_POST['nama'];
$jenis_kelamin 	 = $_POST['jenis_kelamin'];
$password 		 = md5($_POST['password']."ALS52KAO09");
$confirmPassword = md5($_POST['confirmPassword']."ALS52KAO09");
$nip 	 = $_POST['nip'];
$nama_instansi 	 = $_POST['nama_instansi'];
$no_reg_instansi 	 = $_POST['no_reg_instansi'];
$alamat 	 = $_POST['alamat'];
$telp 	 = $_POST['telp'];

if(isset($username, $nama, $password, $confirmPassword)) { 
	
		if($password == $confirmPassword) {
			try {
				$sql = "SELECT * FROM distributor WHERE username = :username OR nama = :nama";
				$stmt = $connect->prepare($sql);
				$stmt->bindParam(':username', $username);
				$stmt->bindParam(':nama', $nama);
				$stmt->execute();
			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}

			$count = $stmt->rowCount();
			if($count == 0) {
				try {
					$sql = "INSERT INTO distributor SET username = :username, password = :password, nama = :nama, jenis_kelamin = :jenis_kelamin, nip = :nip, nama_instansi = :nama_instansi, no_reg_instansi = :no_reg_instansi, alamat = :alamat, telp = :telp";
					$stmt = $connect->prepare($sql);
					$stmt->bindParam(':username', $username);
					$stmt->bindParam(':nama', $nama);
					$stmt->bindParam(':password', $password);
					$stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
					$stmt->bindParam(':nip', $nip);
					$stmt->bindParam(':nama_instansi', $nama_instansi);
					$stmt->bindParam(':no_reg_instansi', $no_reg_instansi);
					$stmt->bindParam(':alamat', $alamat);
					$stmt->bindParam(':telp', $telp);
					$stmt->execute();
				}
				catch(PDOException $e) {
					echo $e->getMessage();
				}
				if($stmt) {
					echo "Selamat Anda berhasil Register, anda dapat Login";
				}
			}else{
				echo "Username dan nama sudah pernah digunakan";
			}
		}else{
			echo "Password tidak sama";
		}
	}

?>

<script language='javascript'>
function validAngka(a)
{
	if(!/^[0-9.]+$/.test(a.value))
	{
	a.value = a.value.substring(0,a.value.length-16);
	}
}
</script>
					<form method='post' action='' >
						<div class='form'>
							<div class='c12 noleftmargin'>
								<label>Username</label>
								<input type='text' name='username'>
							</div>
							<div class='c12 noleftmargin'>
								<label>Password</label>
								<input type='password' name='password'>
							</div>
							<div class='c12 noleftmargin'>
								<label>Confirmasi Password</label>
								<input type='password' name='confirmPassword'>
							</div>
							<div class='c12 noleftmargin'>
								<label>Nama</label>
								<input type='text' name='nama'>
							</div>
							<div class='c12 noleftmargin'>
								<select name='jenis_kelamin' required>
									<option value=''>Jenis Kelamin</option>
									<option value='Laki-laki'>Laki-laki</option>
									<option value='Perempuan'>Perempuan</option>
								</select>
							</div>
							<div class='c12 noleftmargin'>
								<label>NIP</label>
								<input type='text' name='nip' size="16" onkeyup="validAngka(this)" maxlength="16" required>
							</div>
							
							<div class='c12 noleftmargin'>
								<label>Nama Instansi</label>
								<input type='text' name='nama_instansi'>
							</div>
							<div class='c12 noleftmargin'>
								<label>No Registrasi Instansi</label>
								<input type='text' name='no_reg_instansi' size="16" onkeyup="validAngka(this)" maxlength="16" required>
							</div>
							<div class='c12 noleftmargin'>
								<label>Alamat</label>
								<textarea type='text' name='alamat' ></textarea>
							</div>
							
							<div class='c12 noleftmargin'>
								<label>Telpon</label>
								<input type='text' name='telp' size="16" onkeyup="validAngka(this)" maxlength="12" required>
							</div>
							
							
							
							
							<input type="submit" name="register" class="button" style="font-size:12px;" value="Daftar">
							<input type="reset" name="reset" class="button" style="font-size:12px;" value="Reset">
						</div>
					</form>
				</div>
			</div>
			<div class="c4 space-top">
				
				
			</div>
			
		</div>
		</br>
			</br>
			</br>
			</br>
			</br>
			</br>
</div><!-- end grid -->

<!-- FOOTER
================================================== -->
<?php
include "footer.php";
?>

</div>
<!-- JAVASCRIPTS
================================================== -->
<!-- all -->
<script src="js/modernizr-latest.js"></script>

<!-- menu & scroll to top -->
<script src="js/common.js"></script>

<!-- cycle -->
<script src="js/jquery.cycle.js"></script>

<!-- twitter -->
<script src="js/jquery.tweet.js"></script>

<!-- contact form -->
<script src="js/contact.js"></script>

</body>
</html>
