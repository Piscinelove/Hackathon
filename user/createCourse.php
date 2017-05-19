<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appui-on</title>

	<!-- STYLES -->
    <link rel="stylesheet" href="../libs/bootstrap.min.css"/>
    <link rel="stylesheet" href="../libs/bootstrap-theme.min.css"/>
    <link rel="stylesheet" href="../css/sidebar.css"/>
    
    <link rel="stylesheet" href="../css/createCourse.css"/>

	
	<!-- SCRIPTS -->
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>


</head>
<script>

    $(document).ready(function() {
        getMatiere();
    });

    function getMatiere(){
        $.ajax({
            url: '/php/traitement.php',
            type: 'POST',
            data: "getMatiere=getMatiere",
            success : function(res){
                res = JSON.parse(res);
                var txt = '<option disabled selected="selected">Matière</option>';
                for(i=0;i<res.length;i++){
                    txt+="<option value=\""+res[i]['idType']+"\">"+res[i]['name']+"</option>";
                }
                document.getElementById('typeCourse').innerHTML = txt;

            }
        })
    }
    function getLvl(){
        var idMatiere = document.getElementById('typeCourse').value;
        $.ajax({
            url: '/php/traitement.php',
            type: 'POST',
            data: "getLvl="+idMatiere,
            success : function(res){
                $(".cacheParMatiere").show(100);
                res = JSON.parse(res);
                var txt = '<option disabled selected="selected">Jusqu\'où pouvez-vous enseigner ?</option>';
                for(i=0;i<res.length;i++){
                    txt+="<option value=\""+res[i]['idType']+"\">"+res[i]['name']+"</option>";
                }
                document.getElementById('behaviorCourse').innerHTML = txt;

            }
        })
        
    }

    function createCours(e){
        var toSend = "";
        $("#formCourse input").each(function(index, el) {
            toSend+=el.attributes['name'].value+"="+el.value+"&";
        });
        $("#formCourse textarea").each(function(index, el) {
            toSend+=el.attributes['name'].value+"="+el.value+"&";
        });
        $("#formCourse select").each(function(index, el) {
            toSend+=el.attributes['name'].value+"="+el.value+"&";
        });
        toSend = toSend.slice(0,-1);
        e.preventDefault();
        $.ajax({
            url: '/php/traitement.php',
            type: 'POST',
            data: toSend,
            success : function(res){
                window.location="/user/myTeaching.html";
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
            <h3 class="col-xs-12">Créer un cours</h3>
            <form class="col-md-offset-2 col-md-8 col-xs-12" id="formCourse" onsubmit="createCours(event)">
                <div class="form-group">
                    <label for="typeCourse">Matière</label>
                    <select class="form-control" id="typeCourse" name="typeCourse" onchange="getLvl()">
                        <option disabled selected="selected">Matière</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="descriptionCourse">Description</label>
                    <textarea class="form-control" id="descriptionCourse" name="descriptionCourse" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="nbUsersCourse">Nombre de participants maximum</label>
                    <input type="number" class="form-control" name="nbUsersCourse" id="nbUsersCourse" placeholder="Nombre">
                </div>
                <div class="form-group cacheParMatiere" style="display: none">
                    <label for="behaviorCourse">Niveau</label>
                    <select class="form-control" id="behaviorCourse" name="behaviorCourse">
                        <option disabled selected="selected">Jusqu'où pouvez-vous enseigner ?</option>
                    </select>
                </div>
                <div class="form-group pSubmit">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </form>
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
