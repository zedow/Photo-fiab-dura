<?php 
$PARAM_hote='localhost'; // le chemin vers le serveur
$PARAM_port='';
$PARAM_nom_bd='renault'; // le nom de votre base de donnees
$PARAM_utilisateur='root'; // nom d'utilisateur pour se connecter
$PARAM_mot_passe=''; // mot de passe de l'utilisateur pour se connecter
 
try
{
    $bdd = new PDO('mysql:host='.$PARAM_hote.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
    $bdd->exec("SET CHARACTER SET utf8");
}
catch(Exception $e)
{
        echo 'Erreur : '.$e->getMessage().'<br />';
        echo 'No : '.$e->getCode();
}
?>
