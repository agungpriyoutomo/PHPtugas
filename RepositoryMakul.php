<?php 
	require_once "dbh.php";

	class RepositoryMakul{
		private $dbh;
		private $rowCount;
		private $query = "SELECT * FROM matakuliah ORDER BY kode_makul";

		public function __construct()
		{
			$this->dbh = DBH::createConnection();
		}
		//mengambil semua data
		public function getAll()
		{
			$query = $this->dbh->prepare($this->query);
			$query->execute();
			$this->rowCount = $query->rowCount();
			return $query->fetchAll(PDO::FETCH_OBJ);
		}

		public function rowCount()
		{
			return $this->rowCount;
		}
		//menghapus data
		public function Delete($id)
		{
			$query = $this->dbh->prepare("DELETE FROM matakuliah WHERE id=? ");
			$query->bindParam(1,$id);
			return $query->execute();
		}

		public function getById($id)
		{
			$query = $this->dbh->prepare("SELECT * FROM matakuliah WHERE id = ?");
			$query->bindParam(1,$id);
			$query->execute();
			return $query->fetch(PDO::FETCH_OBJ);
		}
		//menyimpan data
		public function Save($kode_makul,$nama_makul,$sks)
		{
			$sql = "INSERT INTO matakuliah(kode_makul,nama_makul,sks) VALUES(?,?,?)";
			$query = $this->dbh->prepare($sql);
			$query->bindParam(1,$kode_makul);
			$query->bindParam(2,$nama_makul);
			$query->bindParam(3,$sks);

			return 	$query->execute();
		}
		//Edit data
		public function Update($kode_makul,$nama_makul,$sks,$id)
		{
			$sql = "UPDATE mahasiswa SET nim=?, nama=?, inisial=? WHERE id = $id";
			$query = $this->dbh->prepare($sql);
			$query->bindParam(1,$nim);
			$query->bindParam(2,$nama);
			$query->bindParam(3,$inisial);
			
			return 	$query->execute();
		}

	}
?>