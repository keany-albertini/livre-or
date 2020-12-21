<?php

session_start();
if (isset($_SESSION['login'])) { } else {
    header('Location:index.php');
}
$connexion = mysqli_connect('localhost', 'root', '', 'livreor');


$requete = "SELECT * FROM utilisateurs WHERE login = '" . $_SESSION['login'] . "'";
$query = mysqli_query($connexion, $requete);
$resultat = mysqli_fetch_assoc($query);

if (isset($_POST['Modifier'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password_conf = $_POST['password_conf'];
    $old_password = $_POST['old_password'];
    $modif_log = false;
    $modif_password = false;
    $erreur_log = false;
    $erreur_password = false;
    $erreur_oldpassword = false;

    if (password_verify($_POST['old_password'], $resultat['password'])) {
        if ($login != $resultat['login']) {
            $requete_verif = "SELECT login FROM utilisateurs WHERE login = '$login'";
            $query_verif = mysqli_query($connexion, $requete_verif);
            $resultat_verif = mysqli_fetch_assoc($query_verif);

            if (!empty($resultat_verif)) {
                $erreur_log = true;
            } else {
                $update_login = "UPDATE utilisateurs SET login = '$login' WHERE id = '" . $resultat['id'] . "'";
                $query_login = mysqli_query($connexion, $update_login);
                $_SESSION['login'] = $login;
                $modif_log = true;
            }
        }

        if (!empty($password))
        {
            if ($password == $password_conf) {
                $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
                $update_password = "UPDATE utilisateurs SET password = '$password' WHERE id = '" . $resultat['id'] . "'";
                $query_password = mysqli_query($connexion, $update_password);
                $modif_password = true;
            } else {
                $erreur_password = true;
            }
        }
        
    } 
    else {
        $erreur_oldpassword = true;
    }
}


$requete = "SELECT * FROM utilisateurs WHERE login = '" . $_SESSION['login'] . "'";
$query = mysqli_query($connexion, $requete);
$resultat = mysqli_fetch_assoc($query);

mysqli_close($connexion);

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


            
            <form class="ins" action="profil.php" method="POST">
                <label>Identifiants</label><br/>
                <input class="login" type="text" name='login' value="<?php echo $user['login']; ?>" required><br/>
                <label> Mot de passe actuel </label>
                <input type="password" name="old_password" required />
                <label> Nouveau mot de passe </label>
                <input type="password" name="password" />
                <label>Confirmez la modification</label><br/>
                <input type="password" name="password_conf" />
                <input class="submit" type="submit" name="Modifier" value="Modifier" />

                <?php

if (isset($_POST['Modifier'])) {
    if ($erreur_oldpassword == 1) {
        echo "<span class='warning'>/!\ Mot de passe actuel incorrect ! /!\</span>";
    } else {
        if ($erreur_log == 1) {
            echo "<span class='warning'>Désolée, " . $login . " est déjà pris !</span>";
        }
        if ($erreur_password == 1) {
            echo "<span class='warning'>/!\ Mot de passe différents ! /!\ </span>";
        }
        if ($modif_log == 1) {
            if ($modif_password == 1) {
                echo "Validation des différentes modifications.";
            } else {
                echo "Validation du nouveau Login.";
            }
        } elseif ($modif_password == 1) {
            echo "Validation du nouveau mot de passe. ";
        }
    }
}


?>
                

            </form>
        </div>
    </main>

    <footer>
    </footer>
</body>
</html>

