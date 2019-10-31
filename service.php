<?php
    if(isset($_POST['enregistrer'])){
        if (empty($_POST['nomservice'])){
            echo "Tous les champs doivent etre remplie";

        }else{
            $idService  = $nomService  =  "";
        function securisation($donnees){
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = strip_tags($donnees);
            return $donnees;
        }
        /* $idService = securisation($_POST['idservice']); */
        $nomService = securisation($_POST['nomservice']);
        $serveur = "localhost";
		$login = "root";
        $pass="";
        try{
            $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete=$connexion->prepare(
                 "INSERT INTO service(Id_Service, Nom_Service)  
                    VALUES(NULL,:nomservice)"
                
            );
                
                $requete->bindParam(':nomservice',$nomService);
                
            
            $requete->execute();
            echo ("Valeur bien inserer");
        }
        catch(PDOException $e){
            echo ('Echec : '.$e->getMessage());
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
    <link rel="stylesheet" href="service.css">
    <title>Service</title>

</head>
<body>
    <nav>
    <div class="logo">
         <img src="images/logo.jpg" alt="logo"  width="320px" height="240px" class="logo">
     </div>
     <div class="deconnecte"><a href="index.php">Deconnexion</a></div>
        <ul>
            <li class="menu-service"> <a href="#">Service</a></li>
            <li class="menu-medecin"> <a href="medecin.php">Medecin</a></li>
            <li class="menu-secretaire"> <a href="secreteriat.php">Secreteriat</a></li>
            
        </ul>
    </nav>
    <h1>Bienvenu au service de l'hopital</h1>
    <div class="page"> 
		
		
		<form method="POST">
			 <div class="zonesaisi" > 
				<label for="idservice" >Id_Service:</label>
				<input type="text" name="idservice" class="saisi" id="idservice" >
			</div> 
			<div class="zonesaisi" > 
				<label for="nomservice" >Nom_Service :</label>
				<input type="text" name="nomservice" class="saisi" id="nomservice">
	        </div>
			
            <input class="enregister" type="submit" name="enregistrer" value="Enregistrer">
            
			
        </form>
        


	</div>
    
    
		
		
		
	
</body>
</html>