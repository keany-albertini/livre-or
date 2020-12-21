
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
                  


   <form class="com" action="livre-or.php" method="post">


    <label id="login">identifiant</label><br>

<input type="text" name="id_utilisateur" maxlength="30" size="50" value=""><br>


<label id="com">Votre commentaire</label><br>
<textarea name="message" cols="50" rows="10"></textarea><br>

<input type="submit" name="go" value="Signer">

<?php 
if (isset($_POST['go']))
{
    $commentaire = addslashes($_POST['commentaire']);
    $utilisateur = $_SESSION['id'];
    $connexion = mysqli_connect('localhost','root','','livreor');
    $insert_comment= "INSERT INTO commentaires (commentaire,id_utilisateur, date) VALUES ('$commentaire', '$utilisateur',NOW())";
    $query_comment = mysqli_query($connexion,$insert_comment);
    echo "commentaire pris en compte";
    mysqli_close($connexion);
}

?>


</form>






    <footer>

    </footer>

</body>
</html>