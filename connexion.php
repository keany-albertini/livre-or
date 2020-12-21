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

   <form class="ins" action="connexion.php" method="post">
  <label id="login">identifiant</label>
  <input type="text" name="login" value="" />
  <br />
  <label id="password">Mot de passe</label>
  <input type="password" name="password" value="" />
  <br />
  <input type="submit" name="connexion" value="Connexion" />


  <?php 

if (isset($_POST['connexion']))
{
  if (isset($_POST['login']) && isset($_POST['password']))
  {
  $connexion = mysqli_connect("localhost", "root", "", "livreor");
  $requete = "SELECT * FROM utilisateurs WHERE login ='" . $_POST['login'] . "'";
  $query = mysqli_query($connexion,$requete);;
  $resultat = mysqli_fetch_assoc($query);

    if (!empty($resultat))
    {
      if (password_verify($_POST['password'],$resultat['password']))
      {
      
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['id'] = $resultat['id'];
        header('Location:index.php');
      }
        else
        {
         echo " Votre mot de passe n'est pas bon ";
        }
      }
      else
      {
        echo " Votre nom d'utilisateur n'existe pas "; 
      }
        mysqli_close($connexion);
    }
}

?>
</form>
      

</div>



</body>
</html>
