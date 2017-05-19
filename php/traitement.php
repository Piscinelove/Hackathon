<?php

	require("loader.php");

	if(isset($_POST['lastname'])&&$_POST['lastname']!=""){
		$conn = Load::load("User");
		echo $conn->addUser($_POST['lastname'],$firstname,$mail,$description,$userType,$phone,$gender,$token,$idTown);
	}else if(isset($_POST['example'])&&$_POST['example']!=""){
		echo 'ca marche :'.$_POST['example'];
	}
?>