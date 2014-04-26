<?php
	$dbh = new PDO("mysql:dbname=universitas;host=localhost","root","");
	//hapus data
	if (isset($_GET['aksi']) && $_GET['aksi'] = "hapus") 
	{
		$query = $dbh->prepare("DELETE FROM mahasiswa WHERE id=?");
		$query->bindParam(1,$_GET['id']);
		$query->execute();
	}

	//cari data
	if (isset($_GET['q'])) 
	{
		
		$query = $dbh->prepare("SELECT * FROM mahasiswa WHERE nim = ? OR nama LIKE ? OR inisial = ?");
		$query->bindParam(1,$_GET['q']);
		$key = "%".$_GET['q']."%";
		$query->bindParam(2,$key);
		$query->bindParam(3,$_GET['q']);
	}
	else
	{
		$query = $dbh->prepare("SELECT * FROM mahasiswa ORDER BY nim");
	}
	
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Belajar PDO</title>
</head>
<body>
	<h1>Data Mahasiswa</h1>

	<form method="get" action="index.php" name="formPencarian">
		<label>Cari mahasiswa</label>
		<input name="q" type="text">
		<input type="submit" value="Cari">
	</form><br>
	<a href="insert_mahasiswa.php">Tambah Data</a>
	<table border="1">
		<tr>
			<th>No.</th>
			<th>Nim</th>
			<th>Nama</th>
			<th>Inisial</th>
			<th>Aksi</th>
		</tr>
		<?php
			$no = 1;
			foreach ($result as $row) 
			{
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $row->nim; ?></td>
			<td><?php echo $row->nama; ?></td>
			<td><?php echo $row->inisial; ?></td>
			<td>
				
				<a href="index.php?id=<?php echo $row->id;?>&aksi=hapus" onclick="return confirm('Yakin akan di hapus');">Hapus</a>
			</td>
		</tr>
		<?php 
			}
		?>
		<tr>
			<td colspan="5"><?php echo "Total data : ".$query->rowCount(); ?></td>
		</tr>
	</table>

</body>
</html>