<?php session_start();
if (!isset($_SESSION['login'])) { } else {
    header('Location:index.php');
} ?>
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
           <?php 
            if(isset($_SESSION['login']))
            {
              echo "<li><a href='deconnexion.php'>deconnexion</a></li>" ;
            }  
            else echo  "<li><a href='connexion.php'>connexion</a></li>" ;
            ?>
            <li><a href="profil.php">profil</a></li>        
          </ul>
        </li>
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



			<form class="ins" method="POST"  action="inscription.php">
      	<label id="login">identifiant</label>
      	<input type="text" placeholder="entrer votre identifiant" name="login" required><br>
      	<label id="password">Mot de passe</label>
      	<input type="password"  name="password" id="password" required><br>
      	<label> Confirmation de mot de passe </label>
        <input type="password" name="password_conf" required />
        <button type="submit" name="inscription" value="Inscription" />Valider mon compte</button><br>
    	</form>

<?php

if (isset($_POST['inscription']))
{
  $login = $_POST["login"];
  $password = password_hash($_POST["password"], PASSWORD_BCRYPT, array('cost' => 12));
  $connexion = mysqli_connect('localhost','root','','livreor');
  $requete = "SELECT login FROM utilisateurs WHERE login = '$login'";
  $query = mysqli_query($connexion,$requete);
  $resultat = mysqli_fetch_all($query);

  if (!empty($resultat))
  {
    echo "Ce login est déjà prit !";
  }
  elseif ($_POST['password'] != $_POST['password_conf'])
  {
    echo " Mot de passe différents ";
  }
  else
  {
    $insert_inscri = "INSERT INTO utilisateurs (login,password) VALUES ('$login','$password')";
    $query_inscri = mysqli_query($connexion,$insert_inscri);
    header('Location:connexion.php');
  }
  mysqli_close($connexion);

}

?>
			


		</div>




</body>
</html>
