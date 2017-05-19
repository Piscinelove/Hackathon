<?php
	require('../php/loader.php');
	session_start();
	$personne = Load::load('User');
	$info = $personne->getUserById($_SESSION['idUser']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appui-on</title>

	<!-- STYLES -->
    <link rel="stylesheet" href="../libs/bootstrap.min.css"/>
    <link rel="stylesheet" href="../libs/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="../css/sidebar.css"/>
    <link rel="stylesheet" href="../css/profile.css"/>
	
	<!-- SCRIPTS -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
</head>
<body>
<div id="wrapper" class="toggled">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <? require('header.php') ?>
    </div>
    <!-- /#sidebar-wrapper -->
	<!-- Page Content -->
    <div id="page-content-wrapper">
		<section id="section-display-profile">
			<div class="container-fluid">
				<div class="row">
				<div  id="img-profile">
					<img src="../media/user.png">
				</div>
					<div class="clear"></div>
				</div>
				<div class="profile-information">
					<div class="row">
						<div class="col-md-3">
							<h5 class="h5-detail">Titre</h5>
						</div>
						<div class="col-md-9">
							Monsieur
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<h5 class="h5-detail">Nom</h5>
						</div>
						<div class="col-md-9">
							<?= $info['lastname'] ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<h5 class="h5-detail">Prénom</h5>
						</div>
						<div class="col-md-9">
							<?= $info['firstname'] ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<h5 class="h5-detail">Adresse e-mail</h5>
						</div>
						<div class="col-md-9">
							<?= $info['mail'] ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<h5 class="h5-detail">Description</h5>
						</div>
						<div class="col-md-9">
							<?= $info['description'] ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<h5 class="h5-detail">N° de téléphone</h5>
						</div>
						<div class="col-md-9">
							<?= $info['phone'] ?>
						</div>
					</div>
				</div>
				<button type="button" id="btn-edit-profile" class="btn btn-primary">Modifier le profil</button>
			</div>
		</section>
		<section id="section-edit-profile">
			<div class="container-fluid">
				<h3 class="col-xs-12">Editer le profil</h3>
				<form class="col-md-offset-2 col-md-8 col-xs-12" id="formCourse" onsubmit="createCours(event)">
					<div class="form-group">
						<label for="titre">Titre</label>
						<div class="input-group">
							<input type="radio" name="titre" value="Madame"> Madame 
							<input type="radio" name="titre" id="radio-monsieur" value="Monsieur"> Monsieur
						</div>
					</div>
					<div class="form-group">
						<label for="name">Nom</label>
					    <input type="text" class="form-control" name="name" value="<?= $info['lastname'] ?>">
					</div>
					<div class="form-group">
						<label for="firstname">Prénom</label>
					    <input type="text" class="form-control" name="firstname" value="<?= $info['firstname'] ?>">
					</div>
					<div class="form-group">
						<label for="email">Adresse e-mail</label>
					    <input type="text" class="form-control" name="email" value="<?= $info['mail'] ?>">
					</div>
					<div class="form-group">
						<label for="description">Description</label>
					    <textarea name="description" class="form-control" rows="5"><?= $info['description'] ?></textarea>
					</div>
					<div class="form-group">
						<label for="phone">N° de téléphone</label>
					    <input type="text" class="form-control" name="phone" value="<?= $info['phone'] ?>">
					</div>
					<div class="form-group pSubmit">
						<button type="submit" class="btn btn-default">Retour</button>
						<button type="submit" class="btn btn-primary">Valider</button>
					</div>
				</form>
			</div>
		</section>
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Menu Toggle Script -->
<script>
	$(document).ready(function(e) {
        $("#section-edit-profile").hide();
        $("#section-display-profile").show();
	
		$("#menu-toggle").click(function(e) {
			$("#wrapper").toggleClass("active");
		});
		
		$("#btn-edit-profile").click(function(e) {
			$("#section-edit-profile").show();
			$("#section-display-profile").hide();
		});
	});	
</script>
</body>
</html>