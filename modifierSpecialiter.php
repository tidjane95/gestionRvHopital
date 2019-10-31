<?php
    $serveur = "localhost";
    $login = "root";
    $pass="";
    $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
    $requete=$connexion->prepare("SELECT * FROM specialiter");
    $requete->bindValue(':num',$_GET['Id_Specialiter'],PDO::PARAM_INT);
    $excuteIsOk = $requete->execute();
    //on recupre le specialite
    $specialite = $requete->fetch();

    //modification des donner
    try{
        $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requete=$connexion->prepare(
            "UPDATE  specialiter set Nom_Specialiter = :nom  WHERE Id_Specialiter =:num LIMIT 1  " );
            $requete->bindParam(':num',$_POST['idspecialiter']);
            $requete->bindParam(':nom',$_POST['nomspecialiter']);
            

            
        
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
<div class="listemedecin"><a href="listemedecin.php" class="liste">Liste des medecins</a></div>
    
<div class="page"> 
       
		
    
       <form method="POST" >
       <div>
               
               <fieldset>
                   <legend>Modifier Sepecialiter</legend>
                       <div class="zonesaisi" > 
                           <input  type="hidden" name="idspecialiter" class="saisi" id="idspecialiter" value="<?=$specialite['Id_Specialiter'];?>" >
                       </div> 
                       <div class="zonesaisi" > 
                           <label for="nomspecialiter" >Nom_Specialiter :</label>
                           <input type="text" name="nomspecialiter" class="saisi" id="nomspecialiter" value="<?=$specialite['Nom_Specialiter'];?>">
                       </div>
                       <input class="enregister" type="submit" name="enregistrer" value="Enregistrer les modifications">
                      
               </fieldset>
   
               </div>
           
           
           
           
           
       </form>
       


   </div>
    
</body>
</html>