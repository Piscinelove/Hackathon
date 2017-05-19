<?
	class Disponibility{
		var $conn;
		public function __construct(){
			$this->conn=Load::load('Connection');
		}
		public function addDisponibility($idUser,$beginHour,$endHour,$repeat){
			$conn = $this->conn;
			$sql="INSERT INTO disponibility(idUser,beginHour,endHour) VALUES (:idUser,:beginHour,:endHour)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idUser",$idUser);
			for($i=0;$i<$repeat;$i++){
				$week = "+".$i."week";
				$deb = date('Y-m-d G:i:s',strtotime($beginHour.$week));
				$end = date('Y-m-d G:i:s',strtotime($endHour.$week));
				
				$stat->bindParam(":beginHour",$deb);
				$stat->bindParam(":endHour",$end);
				$stat->execute();
			}
		}
		public function updateDisponibility($idDisponibility,$idUser,$beginHour,$endHour){
			$conn = $this->conn;
			$sql="UPDATE disponibility SET idUser=:idUser,beginHour=:beginHour,endHour=:endHour WHERE idDisponibility=:idDisponibility";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idDisponibility",$idDisponibility);$stat->bindParam(":idUser",$idUser);$stat->bindParam(":beginHour",$beginHour);$stat->bindParam(":endHour",$endHour);
			$stat->execute();
		}
		public function deleteDisponibility($idDisponibility){
			$conn = $this->conn;
			$sql="DELETE FROM disponibility WHERE idDisponibility=:idDisponibility";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idDisponibility",$idDisponibility);
			$stat->execute();
		}
		public function getAllDisponibilitiesById($idUser){
			$conn = $this->conn
			$sql="SELECT * FROM disponibility WHERE idUser = :idUser";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idUser",$idUser);
			$stat->execute();
			return $stat->fetchAll(PDO::FETCH_ASSOC);
		}
	}
?>