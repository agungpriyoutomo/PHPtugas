<?php
	
	$user = "root";
	
	$pass = "";

	$database = new PDO("mysql:host=localhost;dbname=mahasiswa", $user, $pass);

	if (isset($_GET['manyun']))
	{	
		$perintahQuery = $database->prepare("Select nim, nama, ttl, alamat FROM warga WHERE
			nim = ? or nama LIKE ? or ttl ? or alamat ? ORDER BY nama");

		$perintahQuery->bindParam(1, $_GET['manyun']);

		$nama = '%'.$_GET['manyun'].'%';

		$perintahQuery->bindParam(2, $_GET['manyun']);

		$perintahQuery->bindParam(3, $_GET['manyun']);

		$perintahQuery->bindParam(4, $_GET['manyun']);

	}
	else
	{
		$perintahQuery = $database->prepare("Select nim, nama, ttl, alamat FROM warga ORDER BY nama"); 
	}

	

	$perintahQuery->execute();

	$hasilQuery = $perintahQuery->fetchAll(PDO::FETCH_OBJ);


?>


<!DOCTYPE html>
<html>
<head>
	<title>Coba PDO</title>
</head>
<body>

<h1>Data Mahasiswa</h1>

<form method="get" action="cari.php" name"form_pencarian">

	<label>Cari Mahasiswa</label>
		<input type ="text" name="manyun" />
		<input type ="submit" value="Cari" />
 
</form>

<br>
<br>

<table border="1">
	<tr>
		<td>NIM</td>
		<td>NAMA</td>
		<td>TTL</td>
		<td>ALAMAT</td>
	</tr>

	<?php foreach ($hasilQuery as $warga) { ?>

	<tr>
		<td><?php echo $warga->nim; ?></td>
		<td><?php echo $warga->nama; ?></td>
		<td><?php echo $warga->ttl; ?></td>
		<td><?php echo $warga->alamat; ?></td>
	</tr>

	<?php }?>

</table>

</body>
</html>