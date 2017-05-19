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

	// Type
	else if(isset($_POST['getMatiere'])&&$_POST['getMatiere']=="getMatiere"){
		$conn = Load::load("Type");
		echo $conn->getAllTypes();
	}
?>