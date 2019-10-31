<?php
        $serveur = "localhost";
        $login = "root";
        $pass="";
        
     try{
         $connexion = new PDO("mysql:host=$serveur;dbname=gestionRv",$login,$pass);
         $requete=$connexion->prepare("SELECT Id_Secreteriat,Prenom_Secreteriat,Nom_Secreteriat,Email_Secreteriat,
          Telephone_Secreteriat,Nom_Service FROM secreteriat, service WHERE secreteriat.Id_Service = service.Id_Service ");
         $requete->execute(); 
         //recuperation des resultat
         $tableaus = $requete->fetchAll();
        
      
        
        
    
    
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
    <title>Liste Medecin</title>
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
    h1{
    text-align: center;
}

ul{
    list-style-type: circle;
    list-style-position: outside;
    list-style-image: none;
    
}
ul{
    display: flex;
    position:absolute;
    flex-direction: column;
    justify-content: center ;
	left: 55%;
	width: 70%;
	margin-left: -40%;
    box-shadow: -10px 10px 30px gray;
    background-color: chartreuse;
    border-radius: 10px;
    padding-bottom: 50px;
    margin-top: 20px;

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
table{
    text-align: center;
    margin: auto;
    margin-top: 50px;
}
#titres td{
    font-weight: bold;
    font-size: 25px;
    background-color:  gray;
}
td{
    padding: 5px;
    border: 1px #000 solid;
    max-width: 250px;
    word-wrap: break-word;
}
.enregistrement{
    border-collapse: collapse;
}
.titres{
    background-color:  silver;
    text-align: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.retour{
    background-color:  silver;
    text-align: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;

}

</style>
<body>
<h1>Liste des Secreteriats</h1>


<!--  <ul>
    <?php foreach($tableaus as $tableau):?>
    <hr>
        <li>
            
           <?= $tableau['Id_Secreteriat'] ?>  <?= $tableau['Prenom_Secreteriat'] ?> <?= $tableau['Nom_Secreteriat'] ?>
                <?= $tableau['Email_Secreteriat'] ?> <?= $tableau['Telephone_Secreteriat'] ?> <?= $tableau['Nom_Service'] ?> 
                 <a href="modifierSecreteriat.php?Id_Secreteriat=<?=$tableau['Id_Secreteriat']?>">Modifier</a> <a href="supprimerMedecin.php?Id_Secreteriat=<?=$tableau['Id_Secreteriat']?>">Supprimer</a>
            
                
        </li>
    <?php endforeach;?>
</ul> -->
<div class="liste">
		<table class="enregistrement">
			<tr class="titres">
				<td>Id</td>
                <td>Prenom</td>
				<td>Nom</td>
				<td>Telephone</td>
                <td>Email</td>
				<td>Service</td>
				<td>Action</td>

			</tr>
			<tr class="valeur">
				<?php
				foreach ($tableaus as $valu ) {
                    echo "<td>".$valu['Id_Secreteriat']."</td>";
                    echo "<td>".$valu['Prenom_Secreteriat']."</td>";
                    echo "<td>".$valu['Nom_Secreteriat']."</td>";
                    echo "<td>".$valu['Telephone_Secreteriat']."</td>";
                    echo "<td>".$valu['Email_Secreteriat']."</td>";
                    echo "<td>".$valu['Nom_Service']."</td>";
				
				?>
				<td>
                <a href="modifierSecreteriat.php?Id_Medecin=<?=$tableau['Id_Secreteriat']?>">Modifier</a>
                <a href="modifierSecreteriat.php?Id_Medecin=<?=$tableau['Id_Secreteriat']?>">Supprimer</a>
                

				</td>
				
			</tr>
			<?php
				}
			?>
		</table>
 
 
 
</body>
</html>