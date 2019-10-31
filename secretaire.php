<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="secretaire.css">
    
    <title>Secretaire</title>
</head>
<body id="particles-js">
    

    
    <div class="diapo" id="particles-js" >
            <img id="slide" onnouseover="stopShow()" onneouseout="runShow()" width="800px" height="300px">
    </div>
    <div class="contenu" id="particles-js" >
			<div class="souscontenu" >
                <img src="images/patient1.jpg" alt="Photo patient" width="320px" height="240px" class="imgAdmin" id="particles-js"><br><br><br>
                <a href="patient.php">Patients</a>

			</div>
			<div class="souscontenu" >
            <img src="images/patient3.jpg" alt="Photo rendez-vous" class="imgAdmin" width="320px" height="240px" id="particles-js"><br><br><br>
            <a href="rv.php">Rendez-vous</a>

			</div>
			

        </div>
        
    
    <script>
        var i = 0;
        var timer;
        var path = [];
        path[0] = "images/patient1.jpg"
        path[1] = "images/patient2.jpg"
        path[2] = "images/patient3.jpg"
        path[3] = "images/patient4.jpg"
        function changeImage(){
            document.getElementById("slide").src = path[i];
            if (i  < path.length - 1) {
                i++;
                
            }else{
                i = 0;
            }
            timer = setTimeout("changeImage()", 2000);
                
            
        }
        function stopShow(){
            clearTimeOut(timer);
        }
        function runShow(){
            changeImage();
        }

        window.onload = runShow;
    </script>
    <!-- <script src="js/particles.js"></script>
    <script src="js/app.js"></script>
    <script src="js/particles.min.js"></script> -->
    
</body>
</html>