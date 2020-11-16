<!DOCTYPE html>
<html lang="fr">
<head>
<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="accueil.css">
	<title>Inscription</title>
<body>
			<header id="header_accueil">

			<ul class="dropdownmenu">
            	<li id="Acceuil" class="menu_buttons">
					<a href="index.php">Acceuil</a>	
				</li>
				<li>
					<a href="#">Utilisateur</a>
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
			<form class="ins"  action="connexion.php">
      			<label id="login">identifiant</label>
      			<input type="text" placeholder="entrer votre identifiant" name="username" required><br>
      			<label id="password">Mot de passe</label>
      			<input type="password"  name="password" required><br>
      			<label id="password">Confirmation</label>
      			<input type="password"  name="password" required><br>
 	    		<label id="email">entrez votre adresse mail</label>
      			<input type="email"  required><br>

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
       			<button type="submit">Valider mon compte</button><br>
    </form>
			


		</div>





</body>
</html>