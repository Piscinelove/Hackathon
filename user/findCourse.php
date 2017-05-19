<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appui-on</title>

	<!-- STYLES -->
    <link rel="stylesheet" href="../libs/bootstrap.min.css"/>
    <link rel="stylesheet" href="../libs/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="../css/sidebar.css"/>
    <link rel="stylesheet" href="../css/findCourse.css"/>
	
	<!-- SCRIPTS -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>	
	<script>
    $(document).ready(function() {
        getMatiere();
        getCanton();
    });

    function getMatiere() {
        $.ajax({
            url: '/php/traitement.php',
            type: 'POST',
            data: "getMatiere=getMatiere",
            success: function(res) {
                res = JSON.parse(res);
                var txt = "";
                for (i = 0; i < res.length; i++) {
                    txt += '<li onclick="getLvl(' + res[i]['idType'] + ',\'' + res[i]['name'] + '\')"><a>' + res[i]['name'] + '</a></li>';
                }
                document.getElementById('typeCourse').innerHTML = txt;
                //document.getElementById('typeCourse').children[0].click();
            }
        })
    }

    function getLvl(idMatiere, name) {
        document.getElementById('dropdownMenu1').innerHTML = '<span dataId="' + idMatiere + '">' + name + '</span><span class="caret"></span>';
        $.ajax({
            url: '/php/traitement.php',
            type: 'POST',
            data: "getLvl=" + idMatiere,
            success: function(res) {
                res = JSON.parse(res);
                var txt = '';
                for (i = 0; i < res.length; i++) {
                    txt += '<li onclick="showLvl(' + res[i]['idBehavior'] + ',\'' + res[i]['name'] + '\')"><a>' + res[i]['name'] + '</a></li>';
                }
                document.getElementById('behaviorCourse').innerHTML = txt;
                showResult();
            }
        })
    }

    function showLvl(idLvl, name) {
        document.getElementById('dropdownMenu2').innerHTML = '<span dataId="' + idLvl + '">' + name + '</span><span class="caret"></span>';
        showResult();
    }

    function getCanton() {
        $.ajax({
            url: '/php/traitement.php',
            type: 'POST',
            data: "getCanton=getCanton",
            success: function(res) {
                res = JSON.parse(res);
                var txt = "";
                for (i = 0; i < res.length; i++) {
                    txt += '<li onclick="showVille(' + res[i]['idCanton'] + ',\'' + res[i]['name'] + '\')"><a>' + res[i]['name'] + '</a></li>';
                }
                document.getElementById('villeCourse').innerHTML = txt;

            }
        })
    }

    function getCourseById(id) {
        $.ajax({
            url: '/php/traitement.php',
            type: 'POST',
            data: "getCanton=getCanton",
            success: function(res) {
                res = JSON.parse(res);
                var txt = "";
                for (i = 0; i < res.length; i++) {
                    txt += '<li onclick="showVille(' + res[i]['idCanton'] + ',\'' + res[i]['name'] + '\')"><a>' + res[i]['name'] + '</a></li>';
                }
                document.getElementById('villeCourse').innerHTML = txt;

            }
        })
    }

    function showVille(idVille, name) {
        document.getElementById('dropdownMenu3').innerHTML = '<span dataId="' + idVille + '">' + name + '</span><span class="caret"></span>';
        showResult();
    }

    function showResult() {
        var toSend = "";
        var el1 = "filtreMatiere=" + document.getElementById('dropdownMenu1').children[0].attributes['dataId'].value + "&";
        try {
            var el2 = "filtreLvl=" + document.getElementById('dropdownMenu2').children[0].attributes['dataId'].value + "&";
        } catch (err) {
            var el2 = "filtreLvl=&";
        }
        try {
            var el3 = "filtreVille=" + document.getElementById('dropdownMenu3').children[0].attributes['dataId'].value;
        } catch (err) {
            var el3 = "filtreVille=&";
        }
        $.ajax({
            url: '/php/traitement.php',
            type: 'POST',
            data: el1 + el2 + el3,
            success: function(res) {
                res = JSON.parse(res);
                var txt = "";
                for (i = 0; i < res.length; i++) {
                    txt += '<div class="row">'+
                        '<ul class="list-group">'+
							'<a href="/user/course.php?id='+res[i]['idCourse']+'">'+
                            '<li class="list-group-item ">'+
                                '<div class="row">'+
                                    '<div class="col-lg-1">'+
                                        '<img class="img-responsive" src="../media/blackboard.png">'+
                                    '</div>'+
                                    '<div class="col-lg-7">'+
                                        '<div class="col-lg-12">'+
                                            '<h3>'+res[i]['TypeName']+' ('+res[i]['BeName']+')</h3>'+
                                            '<h4>Actuellement : '+res[i]['iam']+'</h4>'+
                                            '<h4>'+res[i]['lastname']+' '+res[i]['firstname']+' ('+res[i]['TownName']+')</h4>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-lg-4">'+
                                        '<p>'+
                                            ''+res[i]['description']+''+
                                        '</p>'+
                                    '</div>'+
                                '</div>'+
                            '</li>'+

                        '</ul>'+
                    '</div>';
                }
                document.getElementById('contentSearch').innerHTML = txt;

            }
        })
    }
    </script>
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
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-2">
					<div class="dropdown">
						<button class="btn btn-default dropdown-toggle form-control filtre" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<span>Matière</span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" id="typeCourse" aria-labelledby="dropdownMenu1">
						</ul>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="dropdown">
						<button class="btn btn-default dropdown-toggle form-control filtre" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<span>Lvl</span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu2" id="behaviorCourse">
						</ul>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="dropdown">
						<button class="btn btn-default dropdown-toggle form-control filtre" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<span>Ville</span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenu3" id="villeCourse">
						</ul>
					</div>
				</div>
			</div>
			<div id="contentSearch">
				<div class="row">
					<h3>Selectionnez une matière</h3>
				</div>
			</div>
		</div>
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

    $("#").click(function(e) {
        e.preventDefault();
        $("#section1").hide();
        $("#section2").show();
    });
    </script>
</body>

</html>
