<?php
if(empty($_SESSION))
{
	echo '<form action="index.php?uc=accueil&action=connexion" method="POST" class="form">'
		.'<label>'.$accueilLabel.'</label>'
		.'<input name="ipn" class="inputs"/>'
		.'<label>'.$accueilLabel2.'</label>'
		.'<input type="password" name="mdp" class="inputs" />'
		.'<button class="submit" type="submit"><strong>'.$accueilBouton.'</strong><div class="separateurButton" ></div><i class="fas fa-angle-right"></i></button>'
	.'</form>';
	
	if(isset($erreur))
	{
		echo $erreur;
	}
}
else
{
	echo "<h4>".$accueilBienvenue."<i style='color:#ffcc33;'> ".$_SESSION['nom']." ".$_SESSION['prenom']."</i></h4>";
}