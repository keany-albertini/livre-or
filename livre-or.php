<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="accueil.css">
    <title>Livre d'or</title>
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

            <!-- changement du boutton connexion en deconnexion -->
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


  



      <main id="main_livreor">

        <?php if (isset($_SESSION['login'])) : ?>

          <section>
            <article>

              <a href="commentaire.php"><h2>nouveau commentaire</h2></a>
            </article>
          </section>

            <section class="commentaire">
                <article>
<?php

  $connexion = mysqli_connect("localhost", "root", "", "livreor");
  $requete = "SELECT commentaire,date,login FROM commentaires JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id ORDER BY date ASC";
  $query = mysqli_query($connexion, $requete);
  $resultat = mysqli_fetch_all($query, MYSQLI_ASSOC);
  $taille = sizeof($resultat);
  $k = 0;
while ($k < $taille) 
{
  $date = date('d-m-Y à H:i:s', strtotime($resultat[$k]['date']));
  $log = "<span class='login'>@".$resultat[$k]['login']."</span>";
  echo "<h1> Posté le " .$date." par ".$log." :<br></h1><p>".$resultat[$k]['commentaire']."</p>"; 
  $k = $k + 1;
}
mysqli_close($connexion);
?>
                </article>
            </section>

<?php else : ?>

            <section id="noconnect" class="commentaire">
                <article>
                    <?php

$connexion = mysqli_connect("localhost", "root", "", "livreor");
$requete = "SELECT commentaire,date,login FROM commentaires JOIN utilisateurs ON commentaires.id_utilisateur = utilisateurs.id ORDER BY date ASC";
$query = mysqli_query($connexion, $requete);
$resultat = mysqli_fetch_all($query, MYSQLI_ASSOC);

$taille = sizeof($resultat);

$k = 0;
while ($k < $taille) 
{
    $date = date('d-m-Y à H:i:s', strtotime($resultat[$k]['date']));
    $log = "<span class='login'>@".$resultat[$k]['login']."</span>";
    echo "<h1> Posté le " .$date." par ".$log." :<br></h1><p>".$resultat[$k]['commentaire']."</p>"; 
    $k = $k + 1;
}

mysqli_close($connexion);

?>
                </article>
            </section>

        <?php endif; ?>

    </main>





    <footer>

    </footer>

</body>
</html>
 <?php
?>