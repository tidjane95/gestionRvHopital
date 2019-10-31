<?php
        $serveur = "localhost";
        $login = "root";
        $pass="";
       //supprimer medecin 
     try{
         //ouverture de connexion
         $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
         //preparation de requete
         $requete=$connexion->prepare("DELETE FROM secreteriat   WHERE Id_Secreteriat =:num LIMIT 1 ");
         //liaison du parametre nomer
         $requete->bindValue(':num',$_GET['Id_Secreteriat'],PDO::PARAM_INT);
          
         //excution de la requete
         $requete->execute(); 
         $message = "Suppression reussit";
         
    
    }
    catch(PDOException $e){
        echo ('Echec : '.$e->getMessage());
    }
    

 ?>   
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Supprimer medecin</title>
 </head>
 <body>
     <h1> Suppression</h1>
     <p><?= $message?></p>
     
     
 </body>
 </html>