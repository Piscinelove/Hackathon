<?
	class Town{
		var $conn;
		public function __construct(){
			$this->conn=Load::load('Connection');
		}
		public function addTown($name,$npa,$idCanton){
			$conn = $this->conn;
			$sql="INSERT INTO town(name,npa,idCanton) VALUES (:name,:npa,:idCanton)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":name",$name);$stat->bindParam(":npa",$npa);$stat->bindParam(":idCanton",$idCanton);
			$stat->execute();
		}
		public function updateTown($idTown,$name,$npa,$idCanton){
			$conn = $this->conn;
			$sql="UPDATE town SET name=:name,npa=:npa,idCanton=:idCanton WHERE idTown=:idTown";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idTown",$idTown);$stat->bindParam(":name",$name);$stat->bindParam(":npa",$npa);$stat->bindParam(":idCanton",$idCanton);
			$stat->execute();
		}
		public function deleteTown($idTown){
			$conn = $this->conn;
			$sql="DELETE FROM town WHERE idTown=:idTown";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idTown",$idTown);
			$stat->execute();
		}

		public function getAllTown(){
			$conn = $this->conn;
			$sql="SELECT * FROM town";
			$stat = $conn->prepare($sql);
			$stat->execute();
			return $stat->fetchAll(PDO::FETCH_ASSOC);
		}
	}
?>