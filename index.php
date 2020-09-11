<?php
session_start();
if(empty($_COOKIE['lang']))
{
	setcookie('lang', 'FR', time() + 365*24*3600, null, null, false, true);
}
if($_COOKIE['lang'] == "FR")
{
	include "includes/langage/fr.php";
}
else
{
	include "includes/langage/eng.php";
}
include "includes/modele/connexion.php" ;
include "includes/modele/gestionBdd.php" ;
include "includes/header.php" ;
include "controleurs/c_principal.php" ;
include "includes/footer.php" ;


