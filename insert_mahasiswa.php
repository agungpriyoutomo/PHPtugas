<?php

?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data Mahasiswa</title>
</head>
<body>
<h1>Masukkan Data Mahasiswa</h1>
	<form method="post" action="insert_mahasiswa.php">
		<div>

			<label>Nim</label>
			<input type="tex" name="nim">
		</div><br>
		<div>
			<label>Nama</label>
			<input type="text" name="nama">
		</div><br>
		<div>
			<label>Inisial</label>
			<input type="text" name="inisial">
		</div><br>
		<div>
			<input type="submit" name="btn_simpan" value="Simpan">
		</div>

		
	</form>

</body>
</html>

<?php 
	if ($_POST) 
	{
		$nim = $_POST['nim'];
		$nama = $_POST['nama'];
		$inisial = $_POST['inisial'];

		$dbh = new PDO("mysql:dbname=universitas;host=localhost","root","");
		$query = $dbh->prepare("INSERT INTO mahasiswa(nim,nama,inisial) VALUES(?,?,?)");
		$query->bindParam(1,$nim);
		$query->bindParam(2,$nama);
		$query->bindParam(3,$inisial);
		$result = $query->execute();
		if ($result) 
		{
			header("location:index.php");
		}
		else
		{
			echo "Data gagal ditambahkan";
		}

	}
?>