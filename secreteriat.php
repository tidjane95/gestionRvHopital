<?php
    $serveur = "localhost";
	$login = "root";
    $pass="";
    $dbname="gestionRv";
   
    $conn = mysqli_connect($serveur,$login,$pass,$dbname);
    $q = $conn->query("SELECT * FROM service");
        function securisation($donnees){
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = strip_tags($donnees);
            return $donnees;
        }
        if(isset($_POST['enregistrer'])){
            if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['tel']) AND !empty($_POST['email']) AND !empty($_POST['service'])  ){
                $prenom = securisation($_POST['prenom']) ;
                 $nom = securisation($_POST['nom']) ;
                 $tel = securisation($_POST['tel'])  ;
                $email = securisation($_POST['email']) ;
                $service = securisation($_POST['service']) ;
                if (preg_match('#^7[7|6|0|8][0-9]{7}$#', $tel)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)== true) {
                    try{
                        $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
                        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $requete=$connexion->prepare(
                             "INSERT INTO secreteriat(Id_Secreteriat,Prenom_Secreteriat,Nom_Secreteriat,Email_Secreteriat,Telephone_Secreteriat,Id_Service)  
                                VALUES(NULL,:prenom,:nom,:tel,:email,:service)"
                            
                        );
                            
                            $requete->bindParam(':prenom',$prenom);
                            $requete->bindParam(':nom',$nom);
                            $requete->bindParam(':tel',$tel);
                            $requete->bindParam(':email',$email);
                            $requete->bindParam(':service',$service);
                            
                           
                            
                        
                        $requete->execute();
                        echo ("Valeur bien inserer")."<br>";
                        //generer un mot de passe et enregistrer le secretaire et son mot de passe
                        function generateur($passnom,$passprenom,$passtel){
	                        
		                            $passe ="SCT-".strtoupper(substr($passnom,0,2)).substr($passprenom,0,3).$passtel;
		                            return $passe;
                                }
                                $passnom=$nom;
                                $passprenom=$prenom;
                                $passtel=$tel;
                                $motdepass=generateur($nom,$prenom,$tel);
                                $connexion = new PDO("mysql:host=$serveur;dbname=login",$login,$pass);
                                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $requete=$connexion->prepare(
                                    "INSERT INTO users(id,utilisateur,motdepasse)  
                                       VALUES(NULL,:utilisateur,:motdepasse)"  
                               );
                               $requete->bindParam(':utilisateur',$prenom);
                               $requete->bindParam(':motdepasse',$motdepass);
                               $requete->execute();
                               echo ("utilisateur et mot de passe bien inserer");

            
                 
                    }
                    catch(PDOException $e){
                        echo ('Echec : '.$e->getMessage());
                    }
    
    
    
    
                }else{
                    echo "Veillez entrer un email valide !";
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
    <link rel="stylesheet" href="secreteriat.css">
    <title>Secreteriat</title>

</head>
<body>
    <nav>
    <div class="logo">
         <img src="images/logo.jpg" alt="logo"  width="320px" height="240px" class="logo">
     </div>
     <div class="deconnecte"><a href="index.php">Deconnexion</a></div>
        <ul>
            <li class="menu-medecin"> <a href="medecin.php">Medecin</a></li>
            <li class="menu-service"> <a href="service.php">Service</a></li>
            <li class="menu-secretaire"> <a href="">Secreteriat</a></li>
            
            
            
        </ul>
    </nav>
    <div class="listemedecin"><a href="listesecreteriat.php" class="liste">Liste des secreteriat</a></div>
    <div class="page"> 
		
		
		<form method="POST">
            
            <fieldset class="medecin">
                <legend>Secreteriat</legend>
                    <div class="zonesaisi" > 
				        <label for="idsecreteriat" >Id_Secreteriat:</label>
				        <input type="text" name="idsecreteriat" class="saisi" id="idsecreteriat" >
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
				        <label for="tel" >Telephone:</label>
				        <input type="tel" name="tel" class="saisi" id="tel">
                    </div>
                    <div class="zonesaisi" > 
				        <label for="tel" >Email:</label>
				        <input type="mail" name="email" class="saisi" id="email">
                    </div>
                    <div class="zonesaisi" > 
                        <label for="service" >Service:</label>
                        <select name="service" id="service" class="saisi">
                        <?php
                                while ($r = mysqli_fetch_array($q)) {
                                   echo '<option value="'.$r['Id_Service'].'">'.$r['Nom_Service'].'</option>';
                                }
                        ?>
                        </select>
                    </div>
                    <input class="enregister" type="submit" name="enregistrer" value="Enregistrer">
                    <!-- <div class="page1">
                        <input type="submit" class="modifier" name="modifier" value="Modifier">
                        <input type="submit" class="modifier" name="rechercher" value="Rechercher">
                        <input type="submit" class="modifier" name="supprimer" value="Supprimer">
                        <input type="submit" class="modifier" name="quitter" value="Quitter">
                    </div> -->
            </fieldset>
			
			
            
            
			
        </form>
        


	</div>
    
    
		
		
		
	
</body>
</html>