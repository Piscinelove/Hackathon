<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appui-on</title>

	<!-- STYLES -->
    <link rel="stylesheet" href="../libs/bootstrap.min.css"/>
    <link rel="stylesheet" href="../libs/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="../css/sidebar.css"/>
    <link rel="stylesheet" href="../css/learnings.css"/>
	
	<!-- SCRIPTS -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
</head>

<script>

    $(document).ready(function() {
        getAllLearnings();
    });

        function getAllLearnings(){

     $.ajax({
            url: '/php/traitement.php',
            type: 'POST',
            data: "getAllLearnings=getAllLearnings",
            success : function(res){

                res = JSON.parse(res);

                var txt="";

                for(i=0;i<res.length;i++){

                    txt += '<div class="row">'+
                        '<ul class="list-group">'+
                            '<li class="list-group-item ">'+
                                '<div class="row">'+
                                    '<div class="col-lg-1">'+
                                        '<img class="img-responsive" src="../media/blackboard.png">'+
                                    '</div>'+
                                    '<div class="col-lg-7">'+
                                        '<div class="col-lg-12">'+
                                            '<h4>'+res[i]['TypeName']+'</h4>'+
                                            '<h4>'+res[i]['descr']+'</h4>'+
                                            '<h5>Professeur : '+res[i]['lastname']+' '+res[i]['firstname']+'</h5>'+

                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-lg-4">'+
                                        '<div>' +
                                            '<img src="../media/delete.png" />'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</li>'+
                        '</ul>'+
                    '</div>';
                }
                document.getElementById('test').innerHTML = txt; 
            }
        })
 }
</script>


<body>
<div id="wrapper" class="toggled">

    
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <? require('header.php') ?>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
        <div class="row">
            <h3 id="titleApprentissage">Mes apprentissages</h3>
        </div>

        <div class="row" id="test">
        </div>
    </div>
    <!-- /#page-content-wrapper -->


</div>
<!-- /#wrapper -->
</body>
</html>