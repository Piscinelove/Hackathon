<?
	class Course{
		var $conn;
		public function __construct(){
			$this->conn=Load::load('Connection');
		}
		public function addCourse($description,$nbUsers,$idBehavior,$idTeacher){
			$conn = $this->conn;
			$sql="INSERT INTO course(description,nbUsers,idBehavior,idTeacher) VALUES (:description,:nbUsers,:idBehavior,:idTeacher)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":description",$description);$stat->bindParam(":nbUsers",$nbUsers);$stat->bindParam(":idBehavior",$idBehavior);$stat->bindParam(":idTeacher",$idTeacher);
			$stat->execute();
		}
		public function updateCourse($idCourse,$description,$nbUsers,$idBehavior,$idTeacher){
			$conn = $this->conn;
			$sql="UPDATE course SET description=:description,nbUsers=:nbUsers,idBehavior=:idBehavior,idTeacher=:idTeacher WHERE idCourse=:idCourse";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idCourse",$idCourse);$stat->bindParam(":description",$description);$stat->bindParam(":nbUsers",$nbUsers);$stat->bindParam(":idBehavior",$idBehavior);$stat->bindParam(":idTeacher",$idTeacher);
			$stat->execute();
		}
		public function deleteCourse($idCourse){
			$conn = $this->conn;
			$sql="DELETE FROM course WHERE idCourse=:idCourse";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idCourse",$idCourse);
			$stat->execute();

			$sql = "DELETE FROM courseUser WHERE idCourse = :idCourse";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idCourse",$idCourse);
			$stat->execute();
		}


		//part max
		public function getCourseById($idCourse){
			$conn = $this->conn;
			$sql="SELECT * FROM course WHERE idCourse = :idCourse";
			$stat=  $conn->prepare($sql);
			$stat->bindParam(":idCourse",$idCourse);
			$stat->execute();
		}
		public function getAllCoursesByTypeAndBehaviorAndCanton($type,$behavior,$canton){
			$conn = $this->conn;
			$sql="SELECT * FROM course C
						INNER JOIN behavior B on B.idBehavior = T.idBehavior
						INNER JOIN type T ON T.idType = B.idType
						INNER JOIN user U on U.idUser = C.idTeacher
						INNER JOIN town T on T.idTown = U.idTown
						INNER JOIN canton Ca on Ca.idCanton = T.idCanton
					WHERE B.idBehavior = :behavior 
						AND T.idType = :type
						AND Ca.idCanton = :canton
					";		
			$stat = $conn->prepare($sql);
			$stat->bindParam(":type",$type);
			$stat->bindParam(":behavior",$behavior);
			$stat->bindParam(":canton",$canton);
			$stat->execute();
			return $stat->fetchAll(PDO::FETCH_ASSOC);
		}
		public function getAllCoursesGivenByIdUser($idUser){
			$conn = $this->conn;
			$sql="SELECT * FROM courseUser CU 
					INNER JOIN course C ON C.idCourse = CU.idCourse
					WHERE C.idTeacher = :idUser
					AND CU.beginHour > NOW()";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idUser",$idUser);
			$stat->execute();
			return $stat->fetchAll(PDO::FETCH_ASSOC);
		}
		public function getAllCoursesReceiveByIdUser($idUser){
			$conn = $this->conn;
			$sql="SELECT * FROM courseUser CU 
					INNER JOIN course C ON C.idCourse = CU.idCourse
					WHERE CU.idUser = :idUser
					AND CU.beginHour > NOW()";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idUser",$idUser);
			$stat->execute();
			return $stat->fetchAll(PDO::FETCH_ASSOC);
		}

		public function reserveCourse($idUser,$idCourse,$beginHour,$endHour){
			$conn = $this->conn;
			$sql="INSERT INTO courseUser(idUser,idCourse) VALUES (:idUser,:idCourse,:beginHour,:endHour)";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idUser",$idUser);
			$stat->bindParam(":idCourse",$idCourse);
			$stat->bindParam(":beginHour",$beginHour);
			$stat->bindParam(":endHour",$endHour);
			$stat->execute();
		}
		public function deleteCourse($idUser,$idCourse){
			$conn = $this->conn;
			$sql="DELETE FROM courseUser WHERE idUser = :idUser AND idCourse = :idCourse";
			$stat = $conn->prepare($sql);
			$stat->bindParam(":idUser",$idUser);
			$stat->bindParam(":idCourse",$idCourse);
			$stat->execute();
		}
	}
?>