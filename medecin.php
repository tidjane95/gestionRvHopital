<?php
//Securiser les donnees
   function securisation($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = strip_tags($donnees);
    return $donnees;
   
    $serveur = "localhost";
	$login = "root";
    $pass="";
//Enregistrement de specialiter
    if(isset($_POST['enregistrer'])){
        if (empty($_POST['nomspecialiter'])){
            echo "Tous les champs doivent etre remplie";

        }else{
            $idService  = $nomspecialiter  =  "";
            
        }
        $nomspecialiter = securisation($_POST['nomspecialiter']);
//connexion a la base de donnees, preparation et excution de la requete inserer pour specialiter 
        try{
            $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete=$connexion->prepare(
                 "INSERT INTO specialiter(Id_Specialiter, Nom_Specialiter)  
                    VALUES(NULL,:nomspecialiter)"
                
            );
                
                $requete->bindParam(':nomspecialiter',$nomspecialiter);
                
            
            $requete->execute();
            echo ("Valeur bien inserer");
            

     
        }
        catch(PDOException $e){
            echo ('Echec : '.$e->getMessage());
        }

        }
        

    } 
    //Mettre le nom du service dans un select et recuper le id pour l'enregistrer
    $serveur = "localhost";
	$login = "root";
    $pass="";
    $dbname="gestionRv";
    $conn = mysqli_connect($serveur,$login,$pass,$dbname);
    $q = $conn->query("SELECT * FROM service");
    $q1 = $conn->query("SELECT * FROM specialiter");
    //Enregistrement des medecins
    if(isset($_POST['enregistrer'])){
        if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['tel']) AND !empty($_POST['email']) AND !empty($_POST['service']) AND !empty($_POST['specialiter']) ){
            $prenom = securisation($_POST['prenom']) ;
	 		$nom = securisation($_POST['nom']) ;
	 		$tel = securisation($_POST['tel'])  ;
            $email = securisation($_POST['email']) ;
            $service = securisation($_POST['service']) ;
            $specialiter = securisation($_POST['specialiter']) ;
            if (preg_match('#^7[7|6|0|8][0-9]{7}$#', $tel)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)== true) {
                try{
                    $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
                    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $requete=$connexion->prepare(
                         "INSERT INTO medecin(Id_Medecin,Prenom_Medecin,Nom_Medecin,Email_Medecin,Telephone_Medecin,Id_Service,Id_Specialiter)  
                            VALUES(NULL,:prenom,:nom,:tel,:email,:service,:specialiter)"
                        
                    );
                        
                        $requete->bindParam(':prenom',$prenom);
                        $requete->bindParam(':nom',$nom);
                        $requete->bindParam(':tel',$tel);
                        $requete->bindParam(':email',$email);
                        $requete->bindParam(':service',$service);
                        $requete->bindParam(':specialiter',$specialiter);
                        
                    
                    $requete->execute();
                    echo ("Valeur bien inserer")."<br>";
                    //generer un mot de passe et enregistrer le secretaire et son mot de passe
                    function generateur($passnom,$passprenom,$passtel){
	                        
                        $passe ="MED-".strtoupper(substr($passnom,0,2)).substr($passprenom,0,3).$passtel;
                        return $passe;
                    }
                    $passnom=$nom;
                    $passprenom=$prenom;
                    $passtel=$tel;
                    $motdepass=generateur($nom,$prenom,$tel);
                    $connexion = new PDO("mysql:host=$serveur;dbname=login",$login,$pass);
                    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $requete=$connexion->prepare(
                        "INSERT INTO medecin(id,utilisateur,motdepasse)  
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
    <link rel="stylesheet" href="medecin.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <title>Medecin</title>

</head>
<body>
    <!-- <div classe="header">
        <h2 class="logo">Hopital</h2>
        <input type="checkbox" id="chk">
        <label for="chk" class="show-menu-btn">
            <i class="fas fa-ellipsis-h"></i>
        
        </label>
        <ul class="menu">
            <a href="">Medecin</a>
            <a href="service.php">Service</a>
            <a href="secreteriat.php">Secreteriat</a>
            <a href="planning.php">Planning</a>
            <label for="chk" class="hide-menu-btn">
                <i class="fas fa-times"></i>
        
            </label>

        </ul>
        

    </div> -->

        
     <nav>
     <div class="logo">
         <img src="images/logo.jpg" alt="logo"  width="320px" height="240px" class="logo">
     </div>
     <div class="deconnecte"><a href="index.php">Deconnexion</a></div>
        <ul>
            
            <li class="menu-service"> <a href="service.php">Service</a></li>
            <li class="menu-secretaire"> <a href="secreteriat.php">Secreteriat</a></li>
            <li class="menu-planning"> <a href="planning.php">Planning</a></li>
            <li class="menu-medecin"> <a href="">Medecin</a></li>
           
        </ul>
       
    </nav> 
    <div class="listemedecin"><a href="listemedecin.php" class="liste">Liste des medecins</a></div>
    <div class="listespcialiter"><a href="listespecialiter.php" class="liste">Liste des spcialites</a></div>
    <div class="page"> 
       
		
    
		<form method="POST" >
            <div>
               
            <fieldset>
                <legend>Sepecialiter</legend>
                    <div class="zonesaisi" > 
				        <label for="idservice" >Id_Specialiter:</label>
				        <input type="text" name="idservice" class="saisi" id="idservice" disabled="disabled" >
			        </div> 
			        <div class="zonesaisi" > 
				        <label for="nomspecialiter" >Nom_Specialiter :</label>
				        <input type="text" name="nomspecialiter" class="saisi" id="nomspecialiter">
                    </div>
                    <input class="enregister" type="submit" name="enregistrer" value="Enregistrer">
                    <!-- <div class="page1">
                        <input type="submit" class="modifier" name="modifier" value="Modifier">
                        <input type="submit" class="modifier" name="rechercher" value="Rechercher">
                        <input type="submit" class="modifier" name="supprimer" value="Supprimer">
                        <input type="submit" class="modifier" name="quitter" value="Quitter">
                    </div> -->
            </fieldset>

            </div>
            <div>
            <fieldset class="medecin">
                <legend>Medecin</legend>
                    <div class="zonesaisi" > 
				        <label for="idmedecin" >Id_Medecin:</label>
				        <input type="text" name="idmedecin" class="saisi" id="idmedecin"  disabled="disabled">
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
				        <input type="text" name="tel" class="saisi" id="tel">
                    </div>
                    <div class="zonesaisi" > 
				        <label for="email" >Email:</label>
				        <input type="text" name="email" class="saisi" id="email">
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
                    <div class="zonesaisi" > 
                        <label for="specialiter" >Specialiter:</label>
                        <select name="specialiter" id="specialiter" class="saisi">
                            <?php
                                while ($r = mysqli_fetch_array($q1)) {
                                   echo '<option value="'.$r['Id_Specialiter'].'">'.$r['Nom_Specialiter'].'</option>';
                                }
                            ?>
                        </select>
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