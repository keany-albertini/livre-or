
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="accueil.css">
		<title>Inscription</title>
	</head>
    
    <body>
			<header id="header_accueil">

			<ul class="dropdownmenu">
            	<li id="Acceuil" class="menu_buttons">
					<a href="index.php">Acceuil</a>	
				</li>
				<li>
					<a href="#">Utilisateurs</a>
                	<ul>
                    	<li><a href="inscription.php">inscription</a></li>
                    	<li><a href="connexion.php">connexion</a></li>
                    	<li><a href="profil.php">profil</a></li>        
                	</ul>
                <li>
           			<a href="#">livre d'or</a>
                	<ul>
                    	<li><a href="livre-or.php">livre d'or</a></li>
                    	<li><a href="commentaire.php">commentaire</a></li>     
                	</ul>
                </li>
            </ul>

		</header>

		<div class="inscrip">



<?php
    
    /* page: inscription.php */
//connexion à la base de données:
$BDD = array();
$BDD['host'] = "localhost";
$BDD['user'] = "root";
$BDD['pass'] = "";
$BDD['db'] = "livreor";
$mysqli = mysqli_connect($BDD['host'], $BDD['user'], $BDD['pass'], $BDD['db']);
if(!$mysqli) {
    echo "Connexion non établie.";
    exit;
}

$AfficherFormulaire=1;
//traitement du formulaire:
if(isset($_POST['login'],$_POST['password'])){//l'utilisateur à cliqué sur "S'inscrire", on demande donc si les champs sont défini avec "isset"
    if(empty($_POST['login'])){//le champ login est vide, on arrête l'exécution du script et on affiche un message d'erreur
        echo "Le champ login est vide.";
    } elseif(!preg_match("#^[a-z0-9]+$#",$_POST['login'])){//le champ login est renseigné mais ne convient pas au format qu'on souhaite qu'il soit, soit: que des lettres minuscule + des chiffres (je préfère personnellement enregistrer le login de mes utilisateurs en minuscule afin de ne pas avoir deux login identique mais différents comme par exemple: Admin et admin)
        echo "Le login doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
    } elseif(strlen($_POST['login'])>25){//le login est trop long, il dépasse 25 caractères
        echo "Le login est trop long, il dépasse 25 caractères.";
    } elseif(empty($_POST['password'])){//le champ mot de passe est vide
        echo "Le champ Mot de passe est vide.";
    } elseif(mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM utilisateurs WHERE login='".$_POST['login']."'"))==1){//on vérifie que ce login n'est pas déjà utilisé par un autre membre
        echo "Ce login est déjà utilisé.";
    } else {
        //toutes les vérifications sont faites, on passe à l'enregistrement dans la base de données:
        //Bien évidement il s'agit là d'un script simplifié au maximum, libre à vous de rajouter des conditions avant l'enregistrement comme la longueur minimum du mot de passe par exemple
        if(!mysqli_query($mysqli,"INSERT INTO `utilisateurs` SET login='".$_POST['login']."', password='".md5($_POST['password'])."'")){//on crypte le mot de passe avec la fonction propre à PHP: md5()
            echo "Une erreur s'est produite: ".mysqli_error($mysqli);//je conseille de ne pas afficher les erreurs aux visiteurs mais de l'enregistrer dans un fichier log
        } else {
            echo "Vous êtes inscrit avec succès!";
            //on affiche plus le formulaire
            $AfficherFormulaire=0;
        }
    }
}
if($AfficherFormulaire==1){
    ?>



			<form class="ins" method="POST"  action="inscription.php">

      			<label id="login">identifiant</label>
      			<input type="text" placeholder="entrer votre identifiant" name="login" required><br>
      			<label id="password">Mot de passe</label>
      			<input type="password"  name="password" id="password" required><br>
      			<label id="password">Confirmation</label>
      			<input type="password"  placeholder="Confirm Password" id="password2" name="confirm_password" required><br>
 	    		<label id="email">entrez votre adresse mail</label>
      			<input type="email"  name="email" required><br>

      			<label id="date">Date de naissance</label>
      			<input type="date"  name="naissance"><br>

      			<label id="genre">Genre</label>
      			<INPUT type= "radio" name="genre" value="homme" checked> Homme
      			<INPUT type= "radio" name="genre" value="femme" checked> Femme<br>

      			<label id="lname">Nom</label>
      			<input type="text"  name="lname"><br>
      			<label id="fname">Prénom</label>
      			<input type="text"  name="fname"><br>
  				<label id="tel">Numero de téléphone</label>
  				<input type="text" id="num" name="num"><br>
      			<label id="presentation">Présentez-vous</label>
      			<textarea name="presentation" ></textarea><br>
       			<button type="submit" name="inscription">Valider mon compte</button><br>
    		</form>
			


		</div>




</body>
</html>
    <?php
}
?>