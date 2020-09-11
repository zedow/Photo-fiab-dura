<?php

if (!isset($_REQUEST['uc']) or empty($_SESSION['ipn'])) {
    $uc = "accueil" ;
}
else {
    $uc = $_REQUEST['uc'] ;
}
switch ($uc)
{
    case 'accueil' : { include "c_accueil.php" ; break ;}
	case 'administration' : { include "c_admin.php" ; break ;}
	case 'recherche' : { include "c_recherche.php" ; break ;}
	case 'ajouter' : { include "c_ajouter.php" ; break;}
    default : { require "vues/v_error404.php"; break;}
}

?>
