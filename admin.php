<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="admin.css">
    <title>Administrateur</title>
</head>
<style>
    body{
    margin: 0%;
    padding: 0%;
    background-image: url(images/page.jpg);
    background-size: cover;
    background-repeat: no-repeat;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
    text-transform: uppercase;
  
    
}
        .imgAdmin{
            border-radius:50% ;
            width: 200px;
            height: 200px;
        }

        .contenu{
            border: 1px solid wheat;
            display: flex;
            /*width: 100%;
            height:30% ;*/
            justify-content: space-around;
            margin: 90px 200px 20px;
            text-align: center;
            height: 300px;
            width: 1000px;
            padding-top: 105px;
            box-shadow: 1px 2px 10px 0px;
            color: aliceblue;
            margin-left: 150px;

            /*background-color: blue;*/
            

        }
        h3{
            color: black;
            
        }

</style>
<body>
<div class="contenu">
			
			<div class="souscontenu">
            <a href="service.php"><img src="images/service.jpg" alt="Photo medecin" class="imgAdmin" width="320px" height="240px"><br></a>
            <h3>Service</h3>

            </div>
            <div class="souscontenu">
                <a href="medecin.php"><img src="images/medecin1.jpg" alt="Photo administrateur" width="320px" height="240px" class="imgAdmin"><br></a>
                <h3>Medecin</h3>

			</div>
			<div class="souscontenu">
            <a href="secreteriat.php"><img src="images/secretaire1.jpg" alt="Photo secretaire" class="imgAdmin" width="320px" height="240px"><br></a>
            <h3>Secretaire</h3>

			</div>

		</div>
</body>
</html>