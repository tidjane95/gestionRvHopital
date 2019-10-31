<?php
    $serveur = "localhost";
	$login = "root";
    $pass="";
    $dbname="gestionRv";
    $conn = mysqli_connect($serveur,$login,$pass,$dbname);
    $q = $conn->query("SELECT * FROM medecin");
    if(isset($_POST['enregistrer'])){
        if (empty($_POST['jours']) AND empty($_POST['medecin'])){
            echo "Tous les champs doivent etre remplie";

        }else{
            
        function securisation($donnees){
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = strip_tags($donnees);
            return $donnees;
        }
        $jours = securisation($_POST['jours']);
        $heures = securisation($_POST['heures']);
        $medecin = securisation($_POST['medecin']);
        $serveur = "localhost";
		$login = "root";
        $pass="";
        try{
            $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete=$connexion->prepare(
                 "INSERT INTO planning(Id_Planning,Jours,Heure,Id_Medecin)  
                    VALUES(NULL,:jours,:heures,:medecin)"
                
            );
                
                $requete->bindParam(':jours',$jours);
                $requete->bindParam(':heures',$heures);
                $requete->bindParam(':medecin',$medecin);
                
            
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
    <link rel="stylesheet" href="medecin.css">
    <title>Planning</title>

</head>
<body>
    <nav>
    <div class="logo">
         <img src="images/logo.jpg" alt="logo"  width="320px" height="240px" class="logo">
     </div>
     <div class="deconnecte"><a href="index.php">Deconnexion</a></div>
        <ul>
            <li class="menu-medecin"> <a href="medecin.php">Medecin</a></li>
            
            
        </ul>
    </nav>
    <div class="page"> 
		
		
		<form method="POST">
            
            <fieldset >
                <legend>Planning medecin</legend>
                    <div class="zonesaisi" > 
				        <label for="idplanning" >Id_Planning:</label>
				        <input type="text" name="idplanning" class="saisi" id="idplanning" >
			        </div>
                    <div class="zonesaisi" > 
                        <label for="jours" >Jours:</label>
                        <select name="jours" id="jours" class="saisi">
                            <option value="Lundi">Lundi</option>
                            <option value="Mardi">Mardi</option>
                            <option value="Mecredi">Mecredi</option>
                            <option value="Jeudi">Jeudi</option>
                            <option value="Vendredi">Vendredi</option>
                        </select>
                    </div>
                    <div class="zonesaisi" > 
                        <label for="heures" >Heures:</label>
                        <select name="heures" id="heures" class="saisi">
                            <option value="8h-12h">8h-12h</option>
                            <option value="15h-17h">15h-17h</option>
                            
                            
                        </select>
                    </div>
                    <div class="zonesaisi" > 
                        <label for="medecin" >Medecin:</label>
                        <select name="medecin" id="medecin" class="saisi">
                        <?php
                                while ($r = mysqli_fetch_array($q)) {
                                   echo '<option value="'.$r['Id_Medecin'].'">'.$r['Prenom_Medecin'].' '.$r['Nom_Medecin'].'</option>';
                                }
                        ?>
                        </select>
                    </div>
                    <input class="enregister" type="submit" name="enregistrer" value="Enregistrer">
                    <div class="page1">
                        <input type="submit" class="modifier" name="modifier" value="Modifier">
                        <input type="submit" class="modifier" name="rechercher" value="Rechercher">
                        <input type="submit" class="modifier" name="supprimer" value="Supprimer">
                        <input type="submit" class="modifier" name="quitter" value="Quitter">
                    </div>
            </fieldset>
			
			
            
            
			
        </form>
        


	</div>
    
    
		
		
		
	
</body>
</html>