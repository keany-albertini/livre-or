<?php
if (isset($_POST['go']) && $_POST['go']=='Signer') 
{
    if ((!empty($_POST['id_utilisateur']))  && (!empty($_POST['commentaire']))) 
    {
      $test_login = eregi ('^[_a-z0-9-]+(.[_a-z0-9-]+)', $_POST['id_utilisateur']);
      if ($test_login) 
      {
      $base = mysql_connect ('localhost', 'root', '');
      mysql_select_db ('livreor', $base);
      $sql = 'INSERT INTO livre_or VALUES("", "'.mysql_escape_string($_POST['id_utilisateur']).'",  "'.date("Y-m-d H:i:s").'", "'.mysql_escape_string($_POST['commentaire']).'")';

      // on lance la requête
      mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

      // on ferme la connexion à la base de données
      mysql_close();

      // on redirige le visiteur vers l'accueil du livre d'or
      header('location: livre-or.php');

      // on termine le script courant
      exit();
      }
      else 
      {
      $erreur = 'votre login est invalide.';
      }
    }
    else 
    {
    $erreur = 'Au moins un des champs est vide.';
    }
  }
  else 
  {
  
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="accueil.css">
    <title>Nouveau Commentaire</title>
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


   <form class="ins" action="livre-or.php" method="post">


    <label id="login">identifiant</label><br>

<input type="text" name="id_utilisateur" maxlength="30" size="50" value="<?php if (isset($_POST['id_utilisateur'])) echo htmlentities(trim($_POST['id_utilisateur'])); ?>"><br>


<label id="com">Votre commentaire</label><br>
<textarea name="message" cols="50" rows="10"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea><br>

<input type="submit" name="go" value="Signer">

</form>
<?php
if (isset($erreur)) echo '<br /><br />',$erreur;
?>




    <footer>

    </footer>

</body>
</html>