<?php
    $server = "localhost";
	$username = "root";
	$password = "";
	$database = "bank_darah";

	mysql_connect($server,$username,$password) or die("Koneksi gagal");
	mysql_select_db($database) or die("Database tidak bisa dibuka");
	
    if($_POST['idx']) {
        $id = $_POST['idx'];      
        $sql = mysql_query("SELECT * FROM distributor WHERE id_distributor = $id");
        while ($result = mysql_fetch_array($sql)){
		?>
        <form action="edit.php" method="post">
            <input type="hidden" name="id_distributor" value="<?php echo $result['id_distributor']; ?>">
            <div class="form-group">
                <label>Nama Distributor</label>
                <input type="text" class="form-control" name="nama" value="<?php echo $result['nama']; ?>">
            </div>
            <div class="form-group">
                <label>NIP</label>
                <input type="text" class="form-control" name="nip" value="<?php echo $result['nip']; ?>">
            </div>
			<div class="form-group">
                <label>Alamat</label>
                <input type="text" class="form-control" name="alamat" value="<?php echo $result['alamat']; ?>">
            </div>
			<div class="form-group">
                <label>Tlp</label>
                <input type="text" class="form-control" name="telp" value="<?php echo $result['telp']; ?>">
            </div>
              <button class="btn btn-primary" type="submit">Update</button>
        </form>     
        <?php } }
?>