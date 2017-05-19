<?
	class Login{
		var $conn;
		public function __construct(){
			$this->conn=Load::load('Connection');
		}
		public function addLogin($username,$password){
			$conn = $this->conn;
			$sql="INSERT INTO login(username,password) VALUES (:username,:password)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":username",$username);$stat->bindParam(":password",$password);
			$stat->execute();
		}
		public function updateLogin($idLogin,$username,$password){
			$conn = $this->conn;
			$sql="UPDATE login SET username=:username,password=:password WHERE idLogin=:idLogin";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idLogin",$idLogin);$stat->bindParam(":username",$username);$stat->bindParam(":password",$password);
			$stat->execute();
		}
		public function deleteLogin($idLogin){
			$conn = $this->conn;
			$sql="DELETE FROM login WHERE idLogin=:idLogin";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idLogin",$idLogin);
			$conn->execute();
		}
		public function login($username,$pass){
			$conn = $this->conn;
			$sql="SELECT * FROM login WHERE username = :username ";
			$stat = $conn->preapre($sql);
			$stat->bindParam(":username",$username);
			$conn->execute();
			$temp = $stat->fetch(PDO::FETCH_LAZY);
			if(isset($temp['password']) && $temp['password']==$pass){
				$_SESSION['idUser'] = $temp['idUser'];
				return 'ok';
			}
			return 'ko';
		}
	}
?>