<?
	class Type{
		var $conn;
		public function __construct(){
			$this->conn=Load::load('Connection');
		}
		public function addType($name,$icon){
			$conn = $this->conn;
			$sql="INSERT INTO type(name,icon) VALUES (:name,:icon)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":name",$name);$stat->bindParam(":icon",$icon);
			$stat->execute();
		}
		public function updateType($idType,$name,$icon){
			$conn = $this->conn;
			$sql="UPDATE type SET name=:name,icon=:icon WHERE idType=:idType";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idType",$idType);$stat->bindParam(":name",$name);$stat->bindParam(":icon",$icon);
			$stat->execute();
		}
		public function deleteType($idType){
			$conn = $this->conn;
			$sql="DELETE FROM type WHERE idType=:idType";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idType",$idType);
			$conn->execute();
		}

		public function getAllTypes(){
			$conn = $this->conn;
			$sql="SELECT * FROM type";
			$stat = $conn->prepare($sql);
			$stat->execute();
			return $stat->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getTypeById($idType){
			$conn = $this->conn;
			$sql="SELECT * FROM type WHERE idType = :idType";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idType",$idType);
			$stat->execute();
			return $stat->fetch(PDO::FETCH_LAZY);
		}

		
	}
?>