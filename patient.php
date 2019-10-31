<?php
//Securiser les donnees
    $serveur = "localhost";
	$login = "root";
    $pass="";
   function securisation($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = strip_tags($donnees);
    return $donnees;
   
    
    } 
    //Enregistrement des medecins
    if(isset($_POST['enregistrer'])){
        if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['tel']) AND !empty($_POST['age']) AND !empty($_POST['sexe']) AND !empty($_POST['adresse']) ){
            $prenom = securisation($_POST['prenom']) ;
	 		$nom = securisation($_POST['nom']) ;
	 		$tel = securisation($_POST['tel'])  ;
            $age = securisation($_POST['age']) ;
            $sexe = securisation($_POST['sexe']) ;
            $adresse = securisation($_POST['adresse']) ;
            if (preg_match('#^7[7|6|0|8][0-9]{7}$#', $tel)) {
            if ($age>=1 && $age<=100 && ctype_digit($age)) {   
            
                try{
                    $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
                    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $requete=$connexion->prepare(
                         "INSERT INTO patient(Id_Patient,Prenom_Patient,Nom_Patient,Age,Sexe,Adresse,Telephone)  
                            VALUES(NULL,:prenom,:nom,:age,:sexe,:adresse,:tel)"
                        
                    );
                        
                        $requete->bindParam(':prenom',$prenom);
                        $requete->bindParam(':nom',$nom);
                        $requete->bindParam(':age',$age);
                        $requete->bindParam(':sexe',$sexe);
                        $requete->bindParam(':adresse',$adresse);
                        $requete->bindParam(':tel',$tel);
                        
                    
                    $requete->execute();
                    echo ("Valeur bien inserer");
                    
        
             
                }
                catch(PDOException $e){
                    echo ('Echec : '.$e->getMessage());
                }


            }
            else{
               echo("l'age est comprie entre 1 et 100");
                }		


            

            }else{
                echo "Veillez entrer un numero valide !";
            }
            

        }else{
            echo "Tous les champs doivent etre remplie";
            
        }

    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="patient.css">
    <title>Patient</title>

</head>
<body>
    <nav>
    <div class="logo">
         <img src="images/logo.jpg" alt="logo"  width="320px" height="240px" class="logo">
     </div>
     <div class="deconnecte"><a href="index.php">Deconnexion</a></div>
        <ul>
            
            <li class="menu-secretaire"> <a href="rv.php">Rendez-vous</a></li>
            <li class="menu-service"> <a href="patient.php">Patient</a></li>
            
            
        </ul>
    </nav>
    <div class="listemedecin"><a href="listepatient.php" class="liste">Liste des patients</a></div>
    <div class="page"> 
       
		
		
		<form method="POST" >
            <div>
            </div>
            <div>
            <fieldset >
                <legend>Patient</legend>
                    <div class="zonesaisi" > 
				        <label for="idpatient" >Id_Patient:</label>
				        <input type="text" name="idpatient" class="saisi" id="idpatient" disabled="disabled" >
			        </div>
                    <div class="zonesaisi" > 
				        <label for="prenom" >Prenom:</label>
				        <input type="text" name="prenom" class="saisi" id="prenom">
                    </div>
			        <div class="zonesaisi" > 
				        <label for="nom" >Nom:</label>
				        <input type="text" name="nom" class="saisi" id="nom">
                    </div>
                    <div class="zonesaisi" > 
				        <label for="age" >Age:</label>
				        <input type="text" name="age" class="saisi" id="age">
                    </div>
                    <div class="zonesaisi" > 
                    <p>Sexe:</p>  <br>
					<label > Homme </label><input type="radio" name="sexe" value="M"  /><br>
					<label > Femme</label><input type="radio" name="sexe" value="F" /><br>
                    </div>
                    
                    <div class="zonesaisi" > 
				        <label for="adresse" >Adresse:</label>
				        <input type="text" name="adresse" class="saisi" id="adresse">
                    </div>
                    
                    <div class="zonesaisi" > 
				        <label for="tel" >Telephone:</label>
				        <input type="text" name="tel" class="saisi" id="tel">
                    </div>
                    
                    <input class="enregister" type="submit" name="enregistrer" value="Enregistrer">
                   <!--  <div class="page1">
                        <input type="submit" class="modifier" name="modifier" value="Modifier">
                        <input type="submit" class="modifier" name="rechercher" value="Rechercher">
                        <input type="submit" class="modifier" name="supprimer" value="Supprimer">
                        <input type="submit" class="modifier" name="quitter" value="Quitter">
                    </div> -->
            </fieldset>
			

            </div>
            
            
			
            
            
			
        </form>
        


	</div>

    
    
    
		
		
		
	
</body>
</html>