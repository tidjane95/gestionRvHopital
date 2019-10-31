<?php
    $serveur = "localhost";
    $login = "root";
    $pass="";
    $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
    $requete=$connexion->prepare("SELECT Id_Medecin,Prenom_Medecin,Nom_Medecin,Email_Medecin,Telephone_Medecin,Nom_Service,Nom_Specialiter
    FROM medecin,service,specialiter  WHERE ID_Medecin = :num AND medecin.Id_Service = service.Id_Service
      AND medecin.Id_Specialiter = specialiter.Id_Specialiter ");
    $requete->bindValue(':num',$_GET['Id_Medecin'],PDO::PARAM_INT);
    $excuteIsOk = $requete->execute();
    //on recupre le medecin
    $medecin = $requete->fetch();

    //modification des donner
    try{
        $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requete=$connexion->prepare(
            "UPDATE  medecin set Prenom_Medecin = :prenom, Nom_Medecin = :nom, 
            Telephone_Medecin = :tel, Email_Medecin = :email, Id_Service = :service, Id_Specialiter = :specialiter WHERE Id_Medecin =:num LIMIT 1  "
            
        );
            
            $requete->bindParam(':num',$_POST['numMedecin']);
            $requete->bindParam(':prenom',$_POST['prenom']);
            $requete->bindParam(':nom',$_POST['nom']);
            $requete->bindParam(':tel',$_POST['tel']);
            $requete->bindParam(':email',$_POST['email']);
            $requete->bindParam(':service',$_POST['service1']);
            $requete->bindParam(':specialiter',$_POST['specialiter1']);

            
        
        $requete->execute();
        $message = "Modification reussit";
        

 
    }
    catch(PDOException $e){
        $message = 'Echec : '.$e->getMessage();
    }
    if(isset($_POST['enregistrer'])){ 
       echo $message;
        
    }
    //Mettre le nom du service dans un select et recuper le id pour l'enregistrer
    $serveur = "localhost";
	$login = "root";
    $pass="";
    $dbname="gestionRv";
    $conn = mysqli_connect($serveur,$login,$pass,$dbname);
    $q = $conn->query("SELECT * FROM service");
    $q1 = $conn->query("SELECT * FROM specialiter");


   


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form modification</title>
    <link rel="stylesheet" href="medecin.css">
</head>
<style>
    body{
    margin: 0%;
    padding: 0%;
    background-image: url(images/page.jpg);
    background-size: cover;
    background-repeat: repeat;
    background-size: cover;
    font-family: "montserrat",sans-serif;  
}
    .enregister{
    width: 65%;
    height: 40px;
    font-size: 25px;
    border: 3px  gray outset;
    border-radius: 5px;
    color: #fff;
    background-color:  rgba(1,1,99, 0.8);
   
    
}
a{
    text-decoration: none;
    width: 30%;
    height: 20px;
    font-size: 12px;
    border: 1px   rgb(97, 219, 15) outset;
    border-radius: 5px;
    color: #fff;
    background-color:  rgb(97, 219, 15);
    
}
a:hover{
    background-color: rgb(46, 15, 219);
}
a:active{
    background-color: rgb(0, 96, 175);
    border: 3px #2196F3 inset;
}
.listemedecin{
    margin-top: 10px;
    text-align: center;
}


</style>
<body>
<div class="listemedecin"><a href="listemedecin.php" class="liste">Liste des medecins</a></div>
    
<div class="page"> 
       
		
    
       <form method="POST" >
           <div>
           <fieldset class="medecin">
               <legend>Modifier medecin</legend>
               <input type="hidden" name="numMedecin" value="<?=$medecin['Id_Medecin'];?>">
                   <div class="zonesaisi" > 
                       <label for="prenom" >Prenom:</label>
                       <input type="text" name="prenom" class="saisi" id="prenom" value="<?= $medecin['Prenom_Medecin'];?>">
                   </div>
                   <div class="zonesaisi" > 
                       <label for="nom" >Nom:</label>
                       <input type="text" name="nom" class="saisi" id="nom" value="<?= $medecin['Nom_Medecin'];?>">
                   </div>
                   
                   <div class="zonesaisi" > 
                       <label for="tel" >Telephone:</label>
                       <input type="text" name="tel" class="saisi" id="tel" value="<?= $medecin['Telephone_Medecin'];?>">
                   </div>
                   <div class="zonesaisi" > 
                       <label for="email" >Email:</label>
                       <input type="text" name="email" class="saisi" id="email" value="<?= $medecin['Email_Medecin'];?>">
                   </div>
                   <div class="zonesaisi" > 
                       <label for="service" >Service:</label>
                       <input type="text" name="service" class="saisi" id="service" value="<?= $medecin['Nom_Service'];?>" disabled="disabled">
                   </div>
                   <div class="zonesaisi" > 
                        <label for="service1" >Nouveau Service:</label>
                        <select name="service1" id="service1" class="saisi">
                            <?php
                                while ($r = mysqli_fetch_array($q)) {
                                   echo '<option value="'.$r['Id_Service'].'">'.$r['Nom_Service'].'</option>';
                                }
                            ?>
                        </select>
                    </div> 
                   <div class="zonesaisi" > 
                       <label for="specialiter" >Specialiter:</label>
                       <input type="text" name="specialiter" class="saisi" id="specialiter" value="<?= $medecin['Nom_Specialiter'];?>" disabled="disabled">
                   </div>
                   <div class="zonesaisi" > 
                        <label for="specialiter1" >Nouveau Specialiter:</label>
                        <select name="specialiter1" id="specialiter1" class="saisi">
                            <?php
                                while ($r = mysqli_fetch_array($q1)) {
                                   echo '<option value="'.$r['Id_Specialiter'].'">'.$r['Nom_Specialiter'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                   <input class="enregister" type="submit" name="enregistrer" value="Enregistrer les modifications">
           </fieldset>
           

           </div>
           
           
           
           
           
           
       </form>
       


   </div>
    
</body>
</html>