<?php
//GLOBALE
$optionDefaut = "-- sélectionner --";
$ajouter = "Ajouter";
$rechercher = "rechercher";
$admin = "Administration";
$propos = "À propos";
$deconnexion = "déconnexion";
$utilisateurSupprime = "Utilisateur supprimé avec succès !";
$utilisateurErreur = "Impossible de supprimer cet utilisateur";

// ACCUEIL

$accueilLabel = "Identifiant";
$accueilLabel2 = "Mot de passe";
$accueilBouton = "Se connecter";
$accueilBienvenue = "Bienvenue sur Photo-Fiab-Dura ";
$accueilErreur1 = "Utilisateur inexistant";

// AJOUTER

$ajouterRadio1 = " Km";
$ajouterRadio2 = " Cycles";
$ajouterTitre1 = "Définition";
$ajouterTitre2 = "Description";
$ajouterTitre3 = "Fichier CSV";
$ajouterChamp1 = "Projet";
$ajouterChamp2 = "Vagues";
$ajouterChamp3 = "Support";
$ajouterChamp4 = "Type d'essai";
$ajouterChamp5 = "Zone";
$ajouterChamp6 = "Élément";
$ajouterChamp7 = "Type de défaut";
$ajouterChamp8 = "Cotation";
$ajouterChamp9 = "Élément NITG";
$ajouterChamp10 = "Type de défaut Pheno";
$ajouterChamp11 = "Nombre de km";
$ajouterChamp12 = "Nombre de cycle";
$ajouterChamp13 = "Commentaire";
$ajouterBouton1 = "Choisir un fichier";
$ajouterBouton2 = "Envoyer";
$ajouterBouton3 = "Formulaire";
$ajouterBouton4 = "Fichier CSV";
$ajouterBouton5 = "Mes fichiers";
$ajouterBase1 = " Base muse";
$ajouterBase2 = " Base NITG";
$ajouterAide1 = "* Nombre maximum de fichiers : 50";
$ajouterAide2 = "* Veuillez vérifier la structure de votre fichier CSV avant l'upload";
$ajouterAide3 = "* Le fichier CSV ne doit contenir aucune ligne vide et doit être encodé en UTF-8";
$ajouterSucces = "Insertion des données effectuée avec succès !";
$ajouterErreur1 = "Les fichiers doivent être au format JPG,JPEG ou PDF";
$ajouterErreur2 = "Un des fichiers est trop volumineux";
$ajouterErreur3 = "Echec lors de l'envoi des photos sur le serveur";
$ajouterErreur4 = "Impossible d'ajouter les photos à la base de données";
$ajouterErreur5 = "Le défaut n'a pas pu être ajouté !";
$ajouterErreur6 = "Fichier CSV introuvable";
$ajouterErreur7 = "Les exetensions autorisées sont JPG, JPEG, PDF et CSV";
$ajouterErreur8 = "Impossible d'upload les fichiers";
$ajouterErreur9 = "Impossible d'ajouter les défauts à la base de données";
$ajouterErreur10 = "Fichier CSV introuvable ou inexistant";
$ajouterErreur11 = "Structure CSV incorrecte";
$ajouterAide1 = "Tous les champs sont obligatoires pour poster un nouveau défaut";
$ajouterAide2 =	"Le nombre de km / cycles doit être un nombre entier";
$ajouterAide3 = "Le fichier upload doit être au format PDF";
$ajouterAide4 = "La taille maximale pour un fichier est de 10 mo";
$ajouterAide5 = "Informations générales d'utilisation";

// RECHERCHER

$rechercherAff1 = "Blocs";
$rechercherAff2 = "Tableau";
$rechercherDf1 = "Posté par :";
$rechercherDf2 = "IPN :";
$rechercherDf3 = "Nom :";
$rechercherDf4 = "Prénom :";
$rechercherDf5 = "Projet :";
$rechercherDf6 = "Vague :";
$rechercherDf7 = "Support :";
$rechercherDf8 = "Zone :";
$rechercherDf9 = "Cotation";
$rechercherDf10 = "Nombre de cycles parcourus : ";
$rechercherDf11 = "Aucune photo n'est disponible";
$rechercherDf12 = "Aucun résultat trouvé";
$rechercherBouton1 = "Rechercher";
$rechercherBouton2 = "Parcourir les photos";
$rechercherBouton3 = "Parcourir les photos (PDF)";
$rechercherChamp1 = "Km / cycles";
$rechercherChamp2 = "Photos";

// ABOUT

$About = "  Photo-Fiab-Dura a été développé par <a style='color:#ffcc33' target='_blank' href='http://www.pommier-valentin.fr'>POMMIER Valentin</a> dans le cadre du stage 'développement d'une base de données' proposé par Frédérique LECHEVALIER.";

// ADMINISTRATION

$adminTitre = "Panneau d'administration";
$adminTitre2 = "Ajouter un utilisateur";
$adminTitre3 = "Editer les comptes utilisateurs";
$adminTitre4 = "Editer les éléments";
$adminTitre5 = "Editer les supports";
$adminTitre6 = "Editer les vagues";
$adminTitre7 = "Les fichiers CSV";
$adminAide1 = "Un compte utilisateur ne peut être supprimé si des défauts ont été postés depuis ce compte !";
$adminAide2 = "Les niveaux d'habilitation déterminent les droits sur la application";
$adminAide3 = "Un super administrateur peut ajouter / modifier et supprimer d'autres utilisateurs";
$adminAide4 = "Un administrateur peut gérer les données contenues dans la bdd";
$adminAide5 = "Un utilisateur peut seulement ajouter et rechercher des défauts";
$adminAide6 = "Pour ajouter un compte cliquez sur le bouton";
$adminAide7 = "La première colonne est l'idenfiant de la zone associée à l'élément";
$adminAide8 = "Il est possible de retrouver la liste de ces identifiants dans le fichier CSV des zones";
$adminAide9 = "Le numéro de l'élément se trouve sur la deuxième colonne";
$adminAide10 = "En cas d'ajout d'un élément le numéro de celui-ci doit être unique";
$adminAide11 = "La première colonne est l'identifiant du support tandis que la troisième colonne est l'identifiant de la vague correspondante";
$adminAide12 = "En cas d'ajout d'un support l'identifiant de celui-ci doit être unique";
$adminAide13 = "La première colonne correspond à l'identifiant de la vague";
$adminAide14 = "La troisème colonne correspond à l'identifiant du projet";
$adminAide15 = "Il est possible de retrouver ces identifiants dans la liste des projets";
$adminAide16 = "En cas d'ajout d'une vague l'identifiant de celle-ci doit être unique";
$adminAide17 = "Il est fortement conseillé de télécharger le fichier mis à disposition";
$adminAide18 = "Le fichier doit être encodé en UTF-8";
$adminAide19 = "Il est possible que les accents ne s'affichent pas sous excel";
$adminAide20 = "Ne pas ajouter de colonne au fichir CSV";
$adminAide21 = "Respecter l'ordre des colonnes";
$adminAide22 = "L'encodage des fichiers peut être modifié avec Notepad++";
$adminAide23 = 'Cocher la case "SUPPRIMER" supprimera les données de la bdd ne se trouvant pas dans la liste insérée';
$adminAide24 = "Si ces données identifient d'autres données de la bdd elles ne pourront pas être supprimées ! (ex : Un élément est identifié par une zone )";
$adminErreur = "Supression des données impossible, veillez à ce que les données identifiées par celles-ci soient supprimées avant. ";
$adminErreur2 = " erreurs, veuillez vérifier le format et l'encodage de votre csv";
$adminErreur3 = "Mise à jour effectuée avec succés !";
$adminErreur4 = "Le fichier ";
$adminErreur5 = " est indisponible ou n'existe plus !";
$adminErreur6 = "Impossible d'upload le fichier CSV, le fichier ne doit pas être ouvert !";
$adminErreur7 = "Le fichier doit être au format CSV";
$adminErreur8 = "Impossible de modifier cet utilisateur";
$adminErreur9 = "Impossible d'ajouter cet utilisateur, veuillez revoir les données saisies";
$adminSousTitre = "Avant de commencer !";
$adminChamp1 = "Donnée";
$adminChamp2 = "Télécharger";
$adminChamp3 = "Mettre à jour";
$adminChamp4 = "Informations";
$adminChamp5 = "Supprimer";
$adminChamp6 = "Gestion des utilisateurs";
$adminChamp7 = "IPN";
$adminChamp8 = "Nom";
$adminChamp9 = "Prénom";
$adminChamp10 = "MDP";
$adminChamp11 = "Habilitation (1 = SuperAdministrateur, 2 = Administrateur, 3 = Utilisateur)";
$adminChamp12 = "Habilitation";
$adminBouton1 = "Supprimer";
$adminBouton2 = "Modifier";
$adminBouton3 = "Valider";