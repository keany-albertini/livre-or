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


    <a href=" commentaire.php">Signer le livre d'or</a>

<br /><br />

<?php
$BDD = array();
$BDD['host'] = "localhost";
$BDD['user'] = "root";
$BDD['pass'] = "";
$BDD['db'] = "livreor";
$mysqli = mysqli_connect($BDD['host'], $BDD['user'], $BDD['pass'], $BDD['db']);
if(!$mysqli) {
    echo "Connexion non établie.";
    exit;

$sql = 'SELECT id_utilisateur, "date", commentaire FROM commentaires ORDER BY date DESC';
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

$nb_signature = mysql_num_rows($req);

if ($nb_signature == 0) {
    echo 'Aucune signature.';
}
else {
    while ($data = mysql_fetch_array($req)) {
    sscanf($data['date'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);

    echo ' le ' , $jour , '/' , $mois , '/' , $annee , ' à ' , $heure , ':' , $minute , '<br />';
    echo nl2br(htmlentities(trim($data['commentaire'])));
    echo '<br /><br />';
    }
}
// on libère l'espace mémoire alloué pour cette requête
mysql_free_result ($req);
// on ferme la connection à la base de données.
mysql_close ();
?>
    <footer>

    </footer>

</body>
</html>
 <?php
}
?>