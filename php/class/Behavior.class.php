<?
	class Behavior{
		var $conn;
		public function __construct(){
			$this->conn=Load::load('Connection');
		}
		public function addBehavior($name,$idType){
			$conn = $this->conn;
			$sql="INSERT INTO behavior(name,idType) VALUES (:name,:idType)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":name",$name);$stat->bindParam(":idType",$idType);
			$stat->execute();
		}
		public function updateBehavior($idBehavior,$name,$idType){
			$conn = $this->conn;
			$sql="UPDATE behavior SET name=:name,idType=:idType WHERE idBehavior=:idBehavior";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idBehavior",$idBehavior);$stat->bindParam(":name",$name);$stat->bindParam(":idType",$idType);
			$stat->execute();
		}
		public function deleteBehavior($idBehavior){
			$conn = $this->conn;
			$sql="DELETE FROM behavior WHERE idBehavior=:idBehavior";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idBehavior",$idBehavior);
			$stat->execute();
		}

		public function getAllBehaviorByIdType($idType){
			$conn = $this->conn;
			$sql="SELECT * FROM behavior WHERE idType = :idType";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idType",$idType);
			$stat->execute();
			return $stat->fetchAll(PDO::FETCH_ASSOC);
		}
	}
?>