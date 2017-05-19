<?php
	session_start();
	require("loader.php");

	//var_dump($_POST);

	if(isset($_POST['lastname'])&&$_POST['lastname']!=""){
		$conn = Load::load("User");
		echo $conn->addUser($_POST['lastname'],$firstname,$mail,$description,$userType,$phone,$gender,$token,$idTown);
	}else if(isset($_POST['example'])&&$_POST['example']!=""){
		echo 'ca marche :'.$_POST['example'];
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
			echo json_encode($conn->getAllCoursesGivenByIdUser(1));
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
	else if(isset($_POST['getVille'])&&$_POST['getVille']=="getVille"){
		$conn = Load::load("Town");
		echo json_encode($conn->getAllTown());
	}
?>