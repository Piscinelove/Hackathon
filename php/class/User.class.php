<?
	class User{
		var $conn;
		public function __construct(){
			$this->conn=Load::load('Connection');
		}
		public function addUser($lastname,$firstname,$mail,$description,$userType,$phone,$gender,$token,$idTown){
			$conn = $this->conn;
			$sql="INSERT INTO user(lastname,firstname,mail,description,userType,phone,gender,token,idTown) VALUES (:lastname,:firstname,:mail,:description,:userType,:phone,:gender,:token,:idTown)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":lastname",$lastname);$stat->bindParam(":firstname",$firstname);$stat->bindParam(":mail",$mail);$stat->bindParam(":description",$description);$stat->bindParam(":userType",$userType);$stat->bindParam(":phone",$phone);$stat->bindParam(":gender",$gender);$stat->bindParam(":token",$token);$stat->bindParam(":idTown",$idTown);
			$stat->execute();
		}
		public function updateUser($idUser,$lastname,$firstname,$mail,$description,$userType,$phone,$gender,$token,$idTown){
			$conn = $this->conn;
			$sql="UPDATE user SET lastname=:lastname,firstname=:firstname,mail=:mail,description=:description,userType=:userType,phone=:phone,gender=:gender,token=:token,idTown=:idTown WHERE idUser=:idUser";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idUser",$idUser);$stat->bindParam(":lastname",$lastname);$stat->bindParam(":firstname",$firstname);$stat->bindParam(":mail",$mail);$stat->bindParam(":description",$description);$stat->bindParam(":userType",$userType);$stat->bindParam(":phone",$phone);$stat->bindParam(":gender",$gender);$stat->bindParam(":token",$token);$stat->bindParam(":idTown",$idTown);
			$stat->execute();
		}
		public function deleteUser($idUser){
			$conn = $this->conn;
			$sql="DELETE FROM user WHERE idUser=:idUser";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idUser",$idUser);
			$stat->execute();
		}
		public function getUserById($idUser){
			$conn = $this->conn;
			$sql="SELECT * FROM user WHERE idUser = :idUser";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idUser",$idUser);
			$stat->execute();
			return $stat->fetch(PDO::FETCH_LAZY);
		}
	}
?>