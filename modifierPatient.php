<?php
    $serveur = "localhost";
    $login = "root";
    $pass="";
    $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
    $requete=$connexion->prepare("SELECT Id_Patient,Prenom_Patient,Nom_Patient,Age,Sexe,Adresse,Telephone FROM patient ");
    $requete->bindValue(':num',$_GET['Id_Patient'],PDO::PARAM_INT);
    $excuteIsOk = $requete->execute();
    //on recupre le medecin
    $patient = $requete->fetch();

    //modification des donner
    try{
        $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requete=$connexion->prepare(
            "UPDATE  patient set Prenom_Patient = :prenom, Nom_Patient = :nom, Age = :age, 
             Sexe = :sexe, Adresse = :adresse, Telephone = :tel, WHERE Id_Patient =:num LIMIT 1  "
            
        );
            
            $requete->bindParam(':num',$_POST['numPatient']);
            $requete->bindParam(':prenom',$_POST['prenom']);
            $requete->bindParam(':nom',$_POST['nom']);
            $requete->bindParam(':tel',$_POST['tel']);
            $requete->bindParam(':age',$_POST['age']);
            $requete->bindParam(':sexe',$_POST['sexe']);
            $requete->bindParam(':adresse',$_POST['adresse']);

            
        
        $requete->execute();
        $message = "Modification reussit";
        

 
    }
    catch(PDOException $e){
        $message = 'Echec : '.$e->getMessage();
    }
    if(isset($_POST['enregistrer'])){ 
       echo $message;
        
    }
   

   


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
<div class="listemedecin"><a href="listepatient.php" class="liste">Liste des patients</a></div>
    
<div class="page"> 
       
		
    
       <form method="POST" >
           <div>
           <fieldset class="medecin">
               <legend>Modifier medecin</legend>
               <input type="hidden" name="numPatient" value="<?=$patient['Id_Patient'];?>">
                   <div class="zonesaisi" > 
                       <label for="prenom" >Prenom:</label>
                       <input type="text" name="prenom" class="saisi" id="prenom" value="<?= $patient['Prenom_Patient'];?>">
                   </div>
                   <div class="zonesaisi" > 
                       <label for="nom" >Nom:</label>
                       <input type="text" name="nom" class="saisi" id="nom" value="<?= $patient['Nom_Patient'];?>">
                   </div>
                   <div class="zonesaisi" > 
                       <label for="age" >Age:</label>
                       <input type="text" name="age" class="saisi" id="age" value="<?= $patient['Age'];?>">
                   </div>
                   <div class="zonesaisi" > 
                       <label for="sexe" >Sexe:</label>
                       <input type="text" name="sexe" class="saisi" id="sexe" value="<?= $patient['Sexe'];?>" >
                   </div>
                   <div class="zonesaisi" > 
                       <label for="adresse" >Adresse:</label>
                       <input type="text" name="adresse" class="saisi" id="adresse" value="<?= $patient['Adresse'];?>" >
                   </div>
                   
                   <div class="zonesaisi" > 
                       <label for="tel" >Telephone:</label>
                       <input type="text" name="tel" class="saisi" id="tel" value="<?= $patient['Telephone'];?>">
                   </div>
                   
                   <input class="enregister" type="submit" name="enregistrer" value="Enregistrer les modifications">
           </fieldset>
           

           </div>
           
           
           
           
           
           
       </form>
       


   </div>
    
</body>
</html>