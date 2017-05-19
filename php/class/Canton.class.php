<?
	class Canton{
		var $conn;
		public function __construct(){
			$this->conn=Load::load('Connection');
		}
		public function addCanton($name){
			$conn = $this->conn;
			$sql="INSERT INTO canton(name) VALUES (:name)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":name",$name);
			$stat->execute();
		}
		public function updateCanton($idCanton,$name){
			$conn = $this->conn;
			$sql="UPDATE canton SET name=:name WHERE idCanton=:idCanton";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idCanton",$idCanton);$stat->bindParam(":name",$name);
			$stat->execute();
		}
		public function deleteCanton($idCanton){
			$conn = $this->conn;
			$sql="DELETE FROM canton WHERE idCanton=:idCanton";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idCanton",$idCanton);
			$stat->execute();
		}

		public function getCantonByIdUser($idUser){
			$conn = $this->conn;
			$sql="SELECT ca.Canton, ca.name
					FROM canton ca, town t, user u
					WHERE ca.idCanton = t.idCanton
					AND t.idTown = u.idTown
					AND u.idUser = :idUser";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idUser",$idUser);
			$stat->execute();
			return $stat->fetch(PDO::FETCH_LAZY);
		}
	}
?>