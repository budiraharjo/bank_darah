<?php
    $server = "localhost";
	$username = "root";
	$password = "";
	$database = "bank_darah";

	mysql_connect($server,$username,$password) or die("Koneksi gagal");
	mysql_select_db($database) or die("Database tidak bisa dibuka");
	
    if($_POST['idx']) {
        $id = $_POST['idx'];      
        $sql = mysql_query("SELECT * FROM darah WHERE id_darah = $id");
        while ($result = mysql_fetch_array($sql)){
		?>
        <form action="edit_darah.php" method="post">
            <input type="hidden" name="id_darah" value="<?php echo $result['id_darah']; ?>">
            <div class="form-group">
                <label>Golongan Darah</label>
                <input type="text" class="form-control" name="golongan" value="<?php echo $result['golongan']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Ukuran</label>
                <input type="text" class="form-control" name="ukuran" value="<?php echo $result['ukuran']; ?>">
            </div>
			<div class="form-group">
                <label>Harga</label>
                <input type="text" class="form-control" name="harga" value="<?php echo $result['harga']; ?>">
            </div>
			<div class="form-group">
                <label>Stok</label>
                <input type="text" class="form-control" name="stok" value="<?php echo $result['stok']; ?>">
            </div>
              <button class="btn btn-primary" type="submit">Update</button>
        </form>     
        <?php } }
?>