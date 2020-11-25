<?php
session_start();

$db = mysqli_connect("localhost", "root", "root", "livreor"); // Connect to Db
$requete = "SELECT * FROM utilisateurs WHERE id = '" . $_SESSION['id'] . "'"; // SQL query
$query = mysqli_query($db, $requete); // Execut the query
$user = mysqli_fetch_assoc($query); //Took 1line from the Db
?>



<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="accueil.css">
        <title>Profil</title>
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

    <main>

        <?php echo'Bonjour ' .$user['login'];?>

        <div class="formulaireprofil">
            <h1 class="h1profil">Profil</h1>
            <form action="profil.php" method="POST">
                <label>Identifiants</label><br/>
                <input class="login" type="text" name='login' placeholder="<?php echo $user['login']; ?>" required><br/>
                <label>Mot de passe</label><br/>
                <input class="password" type="password" name='password' placeholder="<?php echo $user['password']; ?>" required><br/>
                <label>Confirmez la modification</label><br/>
                <input class="password" type="password" name='confpass' placeholder="<?php echo $user['password']; ?>"required ><br/>
                <input class="submit" type="submit" name="modifier" value="Modifier" onclick="alert('Informations modifiés')">
                <input class="submit" type="submit" name='deco' value="Déconnexion" onclick="alert('Vous êtes déconnecté')">

            </form>
        </div>
    </main>

    <footer>
    </footer>
</body>
</html>

<?php

if(isset($_POST["modifier"])){
$login = $_POST['login'];
$password = $_POST['password'];

if($_POST["password"] != ($_POST["confpass"])){
    exit('Le mot de passe ne correspond pas');
}else{
    $requete2 = "UPDATE utilisateurs SET login='$login', password='$password' WHERE id = '" . $_SESSION['id'] ."' "; // Important to put $ between '' and not " "
    $query = mysqli_query($db,$requete2);
    header('location:http://localhost:8888/livre-or/profil/profil.php');
}
}

if(isset($_POST['deco'])){
    session_destroy();
    header('location:http://localhost:8888/livre-or/index/index.php');
}

?>