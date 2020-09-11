<?php
//GLOBALE
$optionDefaut = "-- select --";
$ajouter = "Add";
$rechercher = "Search";
$admin = "Administration";
$propos = "About";
$deconnexion = "Logout";
$utilisateurSupprime = "User succesfuly deleted";
$utilisateurErreur = "Cannot delete this user";

// ACCUEIL

$accueilLabel = "Login";
$accueilLabel2 = "Password";
$accueilBouton = "Log on";
$accueilBienvenue = "Welcome to Photo-Fiab-Dura ";
$accueilErreur1 = "User does not exist";

// AJOUTER

$ajouterRadio1 = " Km";
$ajouterRadio2 = " Phases";
$ajouterTitre1 = "Definition";
$ajouterTitre2 = "Description";
$ajouterTitre3 = "CSV file";
$ajouterChamp1 = "Project";
$ajouterChamp2 = "Waves";
$ajouterChamp3 = "Support";
$ajouterChamp4 = "Test type";
$ajouterChamp5 = "Area";
$ajouterChamp6 = "Component";
$ajouterChamp7 = "Default type";
$ajouterChamp8 = "Quotation";
$ajouterChamp9 = "NITG component";
$ajouterChamp10 = "Pheno Default type";
$ajouterChamp11 = "km";
$ajouterChamp12 = "phases";
$ajouterChamp13 = "Commentary";
$ajouterBouton1 = "Choose a file";
$ajouterBouton2 = "Send";
$ajouterBouton3 = "Form";
$ajouterBouton4 = "CSV file";
$ajouterBouton5 = "My files";
$ajouterBase1 = " Muse base";
$ajouterBase2 = " NITG base";
$ajouterAide1 = "* Maximum amount of files : 50";
$ajouterAide2 = "* Please check the structure of your CSV file before uploading";
$ajouterAide3 = "* The CSV file must not contain any empty lines and must be encoded in UTF-8";
$ajouterSucces = "Successful data insertion !";
$ajouterErreur1 = "Files must be in JPG,JPEG or PDF format";
$ajouterErreur2 = "One of the files is too large";
$ajouterErreur3 = "Photos uploading failed";
$ajouterErreur4 = "Cannot add photos to database";
$ajouterErreur5 = "The default could not be added!";
$ajouterErreur6 = "CSV file not found";
$ajouterErreur7 = "Allowed extensions are JPG, JPEG, PDF and CSV";
$ajouterErreur8 = "Unable to upload files";
$ajouterErreur9 = "Unable to add defaults to the database";
$ajouterErreur10 = "CSV file not found or non-existent";
$ajouterErreur11 = "Incorrect CSV structure";
$ajouterAide1 = "All fields are required to post a new default";
$ajouterAide2 =	"The number of km / phases must be an integer number";
$ajouterAide3 = "The upload file must be in PDF format";
$ajouterAide4 = "The maximum file size is 10 MB";
$ajouterAide5 = "General informations";

// RECHERCHER

$rechercherAff1 = "Blocs";
$rechercherAff2 = "Table";
$rechercherDf1 = "Posted by :";
$rechercherDf2 = "IPN :";
$rechercherDf3 = "Last name :";
$rechercherDf4 = "First name :";
$rechercherDf5 = "Project :";
$rechercherDf6 = "Wave :";
$rechercherDf7 = "Support :";
$rechercherDf8 = "Area :";
$rechercherDf9 = "Quotation :";
$rechercherDf10 = "Amount of phases : ";
$rechercherDf11 = "No photo available";
$rechercherDf12 = "No results found";
$rechercherBouton1 = "Search";
$rechercherBouton2 = "Browse photos";
$rechercherBouton3 = "Browse photos (PDF)";
$rechercherChamp1 = "Km / phases";
$rechercherChamp2 = "Photos";

// ABOUT

$About = '  Photo-Fiab-Dura was developed by <a style="color:#ffcc33" target="_blank" href="http://www.pommier-valentin.fr">POMMIER Valentin</a> in the context of the "database development" course proposed by Frédérique LECHEVALIER.';

// ADMINISTRATION

$adminTitre = "Administration panel";
$adminTitre2 = "Add a user";
$adminTitre3 = "Edit users";
$adminTitre4 = "Edit components";
$adminTitre5 = "Edit supports";
$adminTitre6 = "Edit waves";
$adminTitre7 = "CSV files";
$adminAide1 = "A user account cannot be deleted if defaults have been posted from that account!";
$adminAide2 = "Enabling levels determine the rights on the application!";
$adminAide3 = "A super administrator can add / edit and delete other users";
$adminAide4 = "An administrator can manage the data contained in the db";
$adminAide5 = "A user can only add and search for defaults";
$adminAide6 = "To add an account click on the button";
$adminAide7 = "The first column is the area identifier associated with the component";
$adminAide8 = "It is possible to find the list of these identifiers in the CSV file of the areas";
$adminAide9 = "The component identifier is in the second column";
$adminAide10 = "If an component is added, its number must be unique";
$adminAide11 = "The first column is the support identifier while the third column is the corresponding wave identifier";
$adminAide12 = "If a support is added, its identifier must be unique";
$adminAide13 = "The first column corresponds to the wave identifier";
$adminAide14 = "The third column corresponds to the project identifier";
$adminAide15 = "It is possible to find projects identifiers in the projects list";
$adminAide16 = "If a wave is added, its identifier must be unique";
$adminAide17 = "It is strongly recommended to download the file provided";
$adminAide18 = "The file must be encoded in UTF-8";
$adminAide19 = "It is possible that accents are not displayed on Excel";
$adminAide20 = "Do not add a column to the CSV file";
$adminAide21 = "Respect columns order";
$adminAide22 = "File encoding can be changed with Notepad++";
$adminAide23 = 'Checking the box "DELETE" will delete the data of the db that is not in the inserted list.';
$adminAide24 = "If these data identify other data from the db it cannot be deleted! (ex: A component is identified by an area)";
$adminErreur = "If you cannot delete the data, make sure that the data identified is deleted first. ";
$adminErreur2 = " errors, please check the format and encoding of your CSV";
$adminErreur3 = "Updated successfully !";
$adminErreur4 = "File ";
$adminErreur5 = " is unavailable or no longer existing";
$adminErreur6 = "Cannot upload CSV file, it must be closed";
$adminErreur7 = "The file must be in CSV format";
$adminErreur8 = "Cannot edit this user";
$adminErreur9 = "Cannot add this user, please review the data entered";
$adminSousTitre = "Before you start!";
$adminChamp1 = "Data";
$adminChamp2 = "Download";
$adminChamp3 = "Update";
$adminChamp4 = "Informations";
$adminChamp5 = "Delete";
$adminChamp6 = "User management";
$adminChamp7 = "IPN";
$adminChamp8 = "Last Name";
$adminChamp9 = "First Name";
$adminChamp10 = "Password";
$adminChamp11 = "Habilitation (1 = SuperAdministrator, 2 = Administrator, 3 = User)";
$adminChamp12 = "Habilitation";
$adminBouton1 = "Delete";
$adminBouton2 = "Edit";
$adminBouton3 = "Validate";