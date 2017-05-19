<?php
	
	require("loader.php");
	session_start();

	//var_dump($_POST);

	if(isset($_POST['lastname'])&&$_POST['lastname']!=""){
		$conn = Load::load("User");
		echo $conn->addUser($_POST['lastname'],$firstname,$mail,$description,$userType,$phone,$gender,$token,$idTown);
	}else if(isset($_POST['example'])&&$_POST['example']!=""){
		echo 'ca marche :'.$_POST['example'];
	}

	//personne
	else if(isset($_POST['username'])&&$_POST['username']!=""){
			$conn = Load::load("Login");
			echo $conn->login($_POST['username'],$_POST['password']);
	}

	//course
	else if(isset($_POST['typeCourse'])&&$_POST['typeCourse']!=""){
		$conn = Load::load("Course");
		//echo $conn->addCourse($_POST['descriptionCourse'],$_POST['nbUsersCourse'],$_POST['behaviorCourse'],$_SESSION['idUser']);
		echo $conn->addCourse($_POST['descriptionCourse'],$_POST['nbUsersCourse'],$_POST['behaviorCourse'],1);
	}
	else if(isset($_POST['filtreMatiere'])&&$_POST['filtreMatiere']!=""){
		$conn = Load::load("Course");
		echo json_encode($conn->getAllCoursesByTypeAndBehaviorAndCanton($_POST['filtreMatiere'],$_POST['filtreLvl'],$_POST['filtreVille']));
	}

	//get all course for current teacher MADE BY ALEKS A VERIFIER BY MAX
	else if(isset($_POST['getAllCourse'])&&$_POST['getAllCourse']=="getAllCourse"){
			$conn = Load::load("Course");
			echo json_encode($conn->getAllCoursesGivenByIdUser($_SESSION['idUser']));
	}
	
	//get all course for current student MADE BY ALEKS A VERIFIER BY MAX
	else if(isset($_POST['getAllLearnings'])&&$_POST['getAllLearnings']=="getAllLearnings"){
			$conn = Load::load("Course");
			echo json_encode($conn->getAllCoursesReceiveByIdUser($_SESSION['idUser']));
	}

	// Type
	else if(isset($_POST['getMatiere'])&&$_POST['getMatiere']=="getMatiere"){
		$conn = Load::load("Type");
		echo json_encode($conn->getAllTypes());
	}

	//behavior
	else if(isset($_POST['getLvl'])&&$_POST['getLvl']!=""){
		$conn = Load::load("Behavior");
		echo json_encode($conn->getAllBehaviorByIdType($_POST['getLvl']));
	}

	//ville
	else if(isset($_POST['getCanton'])&&$_POST['getCanton']=="getCanton"){
		$conn = Load::load("Canton");
		echo json_encode($conn->getAllCantons());
	}
?>