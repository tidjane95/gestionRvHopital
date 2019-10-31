<?php
		$bdd = new PDO ('mysql:host=localhost;dbname=login','root','');
		//  Verification des parametre
		//  Récupération de l'utilisateur 
		if(isset($_POST['valider'])){
			if (empty($_POST['login']) AND empty($passwd = $_POST['mpd'])) {
			echo "Tous les champs doivent etre remplie";
			}else{
				$email = $_POST['login'];
    			$passwd = $_POST['mpd'];
    			$req = $bdd->query("SELECT * FROM admin WHERE utilisateur= '$email'  AND  motdepasse = '$passwd'   ");
    			$req->execute(array($email, $passwd));
    			$resultat = $req->fetch();
    			if($resultat['utilisateur'] == $email AND $resultat['motdepasse'] == $passwd){
        		header('location:admin.php');
    }

    else
    {
        echo "Adresse email ou mot de passse incorrect";
    }
			}
    	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="logAdmin.css">
    <title>Login Administateur</title>
</head>
<style>

		body{
			background-image: url(images/page.jpg);
			background-size: cover;
		}
		.connect{
			width:300px;
			margin:0 auto;
			margin-top:5%;
		}
		form {
			width:50%;
			padding: 30px;
			border: 1px solid #f1f1f1;
			background: #fff;
			box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
			background: rgba(1,1,99, 0.8);
			margin-top:10%;
			margin-left: 25%;
		}
		.connect.text{
			width: 38%;
			margin: 0 auto;
			padding-bottom: 10px;
		}
		input[type=text], input[type=password] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			box-sizing: border-box;
		}
		input[type=submit] {
			background-color: rgba(1,1,99, 0.6);
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
			width: 100%;
			font-family: 1.4em;
		}
		input[type=submit]:hover {
			background-color: white;
			color: #53af57;
			border: 1px solid #53af57;
		}

</style>
<body>
    <form action="#" method="POST">
		<div class="connect">
                  <fieldset>
                    <legend> Administrateur </legend>
                    
                   
                    <div >
						<label for="login" class="groupe" id="login">LOGIN</label>
						<input name="login" type="text" >
				    </div>
				    <div >
						<label for="mdp" class="groupe" id="mdp">MOT DE PASSE</label>
						<input name="mpd" type="password" >
				    </div><br>
				    <div>
					<input type="submit" value="VALIDER" name="valider">
				</div>
                </fieldset>
		
               
				
        </div>
       
		
		
		
    </form> 
    
</body>
</html>