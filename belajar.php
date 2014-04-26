<?php require_once "functions.php";?>
<?php 
	$data = new mahasiswa();

	if (isset($_GET['aksi']) and $_GET['aksi'] == 'hapus') 
	{
		if ($data->delete($_GET['id'])) 
		{
			echo "berhasil di hapus !!";
		}
		else
		{
			echo "Data gagal di hapus";
		}
	}
	if (isset($_GET['q'])) 
	{
		$mahasiswa = $data->getAll($_GET['q']);
	}
	else
	{
		$mahasiswa = $data->getAll();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Belajar PDO</title>
</head>
<body>
	<h1>Data Mahasiswa</h1>
	<form method="get" action="belajar.php" name="formPencarian">
		<label>Cari mahasiswa</label>
		<input name="q" type="text">
		<input type="submit" value="Cari">
	</form><br>
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
			foreach ($mahasiswa as $row) 
			{
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $row->nim; ?></td>
			<td><?php echo $row->nama; ?></td>
			<td><?php echo $row->inisial; ?></td>
			<td>
				<a href="belajar.php?id=<?php echo $row->id;?>&aksi=hapus" onclick="return confirm('Yakin akan di hapus');">Hapus</a>
			</td>
		</tr>
		<?php 
			}
		?>
		<tr>
			<td colspan="5"><?php echo "Jumlah data = ".$data->getRowCount(); ?></td>
		</tr>
	</table>

</body>
</html>