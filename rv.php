<?php
    $serveur = "localhost";
	$login = "root";
    $pass="";
    $dbname="gestionRv";
    $conn = mysqli_connect($serveur,$login,$pass,$dbname);
    $q = $conn->query("SELECT * FROM patient");
    $q1 = $conn->query("SELECT * FROM secreteriat");
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
        if (!empty($_POST['patient']) AND !empty($_POST['secreteriat']) AND !empty($_POST['date']) AND !empty($_POST['heure']) AND !empty($_POST['durer'])  ){
            $patient = securisation($_POST['patient']) ;
	 		$secreteriat = securisation($_POST['secreteriat']) ;
	 		$date = securisation($_POST['date'])  ;
            $heure = securisation($_POST['heure']) ;
            $durer = securisation($_POST['durer']) ;
                if (strptime($date, "%d/%m/%Y")) {   
            
                try{
                    $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
                    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $requete=$connexion->prepare(
                         "INSERT INTO RV(Id_Rv,Id_Patient,Id_Secreteriat,Date_RV,Heure_Rv,Durer)  
                            VALUES(NULL,:patient,:secreteriat,:date,:heure,:durer)"
                        
                    );
                        
                        $requete->bindParam(':patient',$patient);
                        $requete->bindParam(':secreteriat',$secreteriat);
                        $requete->bindParam(':date',$date);
                        $requete->bindParam(':heure',$heure);
                        $requete->bindParam(':durer',$durer);
                        
                        
                    
                    $requete->execute();
                    echo ("Valeur bien inserer");
                    
        
             
                }
                catch(PDOException $e){
                    echo ('Echec : '.$e->getMessage());
                }


            }
            else{
               echo("Date  invalide");
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
    <link rel="stylesheet" href="rv.css">
    <title>Rendez-Vous</title>

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
    <div class="page"> 
       
		
		
		<form method="POST" >
            <div>
            </div>
            <div>
            <fieldset class="medecin">
                <legend>Rendez-vous</legend>
                    <div class="zonesaisi" > 
				        <label for="idrv" >Id_RV:</label>
				        <input type="text" name="idrv" class="saisi" id="idrv"  disabled="disabled">
                    </div>
                    <div class="zonesaisi" > 
                        <label for="patient" >Patient:</label>
                        <select name="patient" id="patient" class="saisi">
                        <?php
                                while ($r = mysqli_fetch_array($q)) {
                                   echo '<option value="'.$r['Id_Patient'].'">'.$r['Prenom_Patient'].' '.$r['Nom_Patient'].'</option>';
                                }
                        ?>
                        </select>
                    </div>
                    <div class="zonesaisi" > 
                        <label for="secreteriat" >Secreteriat:</label>
                        <select name="secreteriat" id="secreteriat" class="saisi">
                        <?php
                                while ($r = mysqli_fetch_array($q1)) {
                                   echo '<option value="'.$r['Id_Secreteriat'].'">'.$r['Prenom_Secreteriat'].' '.$r['Nom_Secreteriat'].'</option>';
                                }
                        ?>
                        </select>
                    </div>
                    <div class="zonesaisi" > 
				        <label for="date" >Date:</label>
				        <input type="text" name="date" class="saisi" id="date">
                    </div>
			        <div class="zonesaisi" > 
				        <label for="heure" >Heure:</label>
				        <select name="heure" id="heure">
                            <option value="8h">8h</option>
                            <option value="9h">9h</option>
                            <option value="10h">10h</option>
                            <option value="11h">11h</option>
                            <option value="12h">12h</option>
                            <option value="15h">15h</option>
                            <option value="16h">16h</option>
                            <option value="17h">17h</option>
                        </select>
                    </div>
                    
                    <div class="zonesaisi" > 
				        <label for="durer" >Duree:</label>
				        <input type="text" name="durer" class="saisi" id="durer">
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