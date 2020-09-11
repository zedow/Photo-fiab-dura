<?php
if(isset($_REQUEST['action']))
{
	$action = $_REQUEST['action'];

	switch($action)
	{
		case "connexion" : {
			if(isset($_REQUEST['ipn']))
			{
				$connexion = connexion($_REQUEST['ipn'],$_REQUEST['mdp']);
				if($connexion == false )
				{
					$erreur = $accueilErreur1;
				}
				else
				{
					$_SESSION['ipn'] = $connexion['ipn'];
					$_SESSION['nom'] = $connexion['nom'];
					$_SESSION['prenom'] = $connexion['prenom'];
					$_SESSION['habilitation'] = $connexion['habilitation'];
					$_SESSION['limite'] = 8;
					
					header("location: index.php");
				}
			}
		break;
		}
		
		case "deconnexion" : {
			session_destroy();
			header("location: index.php");
			break;
		}
		
		case "apropos" : {
			require "vues/v_apropos.php";
			break;
		}
		
		case "langage" : {
			if(isset($_REQUEST['lang']))
			{
				if($_REQUEST['lang'] == "FR")
				{
					setcookie('lang', 'FR', time() + 365*24*3600, null, null, false, true);
				}
				else
				{
					setcookie('lang', 'ENG', time() + 365*24*3600, null, null, false, true);
				}
			}
			header('Location: index.php');
			break;
		}
	}
}
else
{
	require "vues/v_accueil.php";
}


