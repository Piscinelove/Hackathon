<?php 
    session_start();
    require('../php/loader.php');
    $pers = Load::load('User');
    $info = $pers->getUserById($_SESSION['idUser']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" href="../css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <script src="../js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/sidebar.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="javascript" src="../js/main.js"></script>


</head>

<body>
<div id="wrapper" class="toggled">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <a class="cancel" id="menu-toggle">&times;</a>
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="#">
                    <?php echo $info['firstname'].' '.$info['lastname'] ?>
                </a>
            </li>
            <li>
                <a href="#" id="give-section1">Mon profil</a>
            </li>
            <li>
                <a href="#" id="give-section2">Donner un cours</a>
            </li>
            <li>
                <a href="#">Trouver un cours</a>
            </li>
            <li>
                <a href="#">Mes disponibilités</a>
            </li>
            <li>
                <a href="#">Créer un cours</a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <section id="section1">
            <div class="container-fluid">
                <div class="row">
                    Mon profil
                </div>
            </div>
        </section>

        <section id="section2" style="display:none">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6">
                        <form class="navbar-form" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-primary">J'offre</button>
                    </div>

                </div>
                <div class="row">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="col-lg-4">
                                
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
    <!-- /#page-content-wrapper -->


</div>
<!-- /#wrapper -->
<script src="../js/bootstrap.min.js"></script>
<!-- Menu Toggle Script -->
<script>

    $(".cancel").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
	
    $("#give-section1").click(function(e) {
        e.preventDefault();
        $("#section2").hide();
        $("#section1").show();
    });

    $("#give-section2").click(function(e) {
        e.preventDefault();
        $("#section1").hide();
        $("#section2").show();
    });

</script>
</body>
</html>