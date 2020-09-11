<?php

if(isset($_REQUEST['action']))
{
	$action = $_REQUEST['action'];
	
	switch($action) {
		
		case "ajouter" : {
			if(isset($_REQUEST['envoi']))
			{
				if(isset($_REQUEST['projet']))
				{			
					if(isset($_FILES['photos']))
					{
						$photosDefaut = [];
						$projet = $_REQUEST['projet'];
						$base = $_REQUEST['base'];
						$vague = $_REQUEST['vague'];
						$support = $_REQUEST['support'];
						if($_REQUEST['base'] != "muse") 
						{ 
							$zone = "null"; 
						} 
						else 
						{
							$zone = $_REQUEST['zone'];
						}
						if($base != "muse") 
						{
							$element = "null";
						}
						else
						{
							$element = $_REQUEST['element'];
						}
						$criticite = $_REQUEST['criticite'];
						if($base != "muse")
						{
							$type = "null";
						}
						else
						{
							$type = $_REQUEST['type'];
						}
						$usage = $_REQUEST['usage'];
						$usageNombre = $_REQUEST['usageNombre'];
						$date = $_REQUEST['date'];
						$commentaire = $_REQUEST['commentaire'];
						$essai = $_REQUEST['essai'];
						if($base != "NITG") 
						{ 
							$elementNITG = "null"; 
						} 
						else 
						{ 
							$elementNITG = '"'.$_REQUEST['elementsNITG'].'"'; 
						}
						if($base != "NITG") { $typePheno = "null"; } else { $typePheno = '"'.$_REQUEST['typesPheno'].'"'; }
						
						// on récupère le dernier identifiant attribué à une photo auquel on ajoute 1
						$id = dernierId() + 1;
						// La destination
						$dossier = './photos/';
						// La taille maximale d'un fichier !
						$taille_maxi = 100000000;   
						// Les extensions autorisées pour l'upload
						$extensions = array('.JPG', '.JPEG','.jpg', '.jpeg','.pdf','.PDF');
						// Le nombre de fichiers envoyés
						$nbfichiersEnvoyes = count($_FILES['photos']['name']);
						$succes = false;
						for($i=0; $i<$nbfichiersEnvoyes; $i++) 
						{
							// Pour chaque fichier on récupère son nom, son répertoire actuel, sa taille et son extension
							$fichier= basename($_FILES['photos']['name'][$i]);
							$fichier_temp= $_FILES['photos']['tmp_name'][$i];
							$taille= filesize($_FILES['photos']['tmp_name'][$i]);
							$extension= strrchr($_FILES['photos']['name'][$i],'.');
							if(!in_array($extension, $extensions)) $erreur= $ajouterErreur1;
							if($taille>$taille_maxi)  $erreur= $ajouterErreur2;
							// Si tout est bon le fichier est upload dans le serveur sous un nouveau nom
							if(!isset($erreur))
							{
								if($base == "muse")
								{
									$fichier = $id.'-'.$projet.'-'.$element.'-'.$type.$extension;
								}
								else
								{
									$fichier = $id.'-'.$projet.'-'.$elementNITG.'-'.$typePheno.$extension;
								}
								$photosDefaut[] = $fichier;
								if(!move_uploaded_file($fichier_temp, $dossier.$fichier)) 
								{ 
									$erreur = $ajouterErreur3; 
								}
							}
							$id ++;
						}
						if(!isset($erreur))
						{
							// on ajoute le défaut à la bdd
							$idDefaut = ajouterDefaut($support,$zone,$element,$criticite,$type,$usage,$usageNombre,$date,$commentaire,$elementNITG,$typePheno);
							if(is_numeric($idDefaut))
							{
								// Pour chaque photo on l'ajoute à la bdd avec l'id du défaut qui permettra de l'identifier
								foreach($photosDefaut as $photo)
								{
									$test = ajoutPhoto($photo,$idDefaut);
									if(!$test)
									{
										$erreur = $ajouterErreur4;
									}
								}
								if(!isset($erreur))
								{
									// ajout des essais pour le défaut concerné à la base de donnée
									foreach($essai as $unEssai)
									{
										ajouterEssai($idDefaut,$unEssai);
									}
								}
							}
							else
							{
								$erreur = $ajouterErreur5;
							}
						}
						if(isset($erreur))
						{
							$affichage = $erreur;
						}
						else
						{
							$affichage = "true";
						}
					}
				}
			}
			else
			{
				// définition des variables
				$fichiers = [];
				$name = "";
				$cheminFichiers = [];
				$tableau = [];
				$dossier = './photos/';
				if(isset($_FILES['photos']))
				{
					for($i = 0; $i < count($_FILES['photos']['tmp_name']); $i++)
					{
						// On récupère l'extension de chaque fichier
						$extension = strrchr($_FILES['photos']['name'][$i],'.');
						if($extension == ".CSV" or $extension == ".csv")
						{
							// Si l'extension est CSV on analyse le fichier pour récupèrer les données dans la variable tableau
							$fichier = $_FILES['photos']['tmp_name'][$i];
							if (($handle = fopen($fichier, "r")) !== FALSE) 
							{
								$row = 0;
								while (($data = fgetcsv($handle, 10000,";")) !== FALSE) 
								{
									$num = count($data);	
									for ($c=0; $c < $num; $c++) {
										$tableau[$row][$c] = $data[$c];
									}
									$row ++;
								}
								// Si la première ligne contient le nom des colonne on ne la prend pas en charge
								if($tableau[0][1] == "Date")
								{
									unset($tableau[0]);
								}
							}
							else
							{
								$erreur = $ajouterErreur6;
							}
						}
						// Si l'extension est PDF, JPG ou JPEG on récupère le nom du fichier et son chemin d'accès
						else if($extension == ".PDF" or $extension == ".pdf" or $extension == ".jpg" or $extension == ".JPG" or $extension == ".jpeg" or $extension == ".JPEG")
						{
							$fichiers[] = basename($_FILES['photos']['name'][$i]);
							$cheminFichiers[] = $_FILES['photos']['tmp_name'][$i];
						}
						else
						{
							$erreur = $ajouterErreur7;
						}
						
					}
					// on vérifie que le tableau soit set, donc qu'un fichier csv est été analysé
					if(!isset($erreur))
					{
						if(isset($tableau))
						{
							// On récupère le dernier Id auto increment de la table photo
							$id = dernierId() + 1;
							foreach($tableau as $defaut)
							{
								$photosDefaut = [];
								// On récupère le nom de chaque fichier indiqué par l'utilisateur dans la dernière colonne
								$photos = explode(',',$defaut[12]);
								// Pour chaque fichier récupère durant l'upload
								for($y = 0; $y < count($fichiers); $y++)
								{
									// POur chaque photo indiquée par l'utilisateur
									for($v = 0; $v < count($photos); $v++)
									{
										// Si le fichier est égal à une des photo
										if($fichiers[$y] == $photos[$v])
										{
											// On applique la règle de nommage et on l'upload à la bdd
											// On récupère le nom du fichier dans la variable PhotoDefaut afin de l'insérer dans la bdd pour le bon défaut
											$projet = projetFromSupport($defaut[3]);
											if(empty($defaut[7]))
											{
												$element = $defaut[9];
												$type = $defaut[10];
											}
											else
											{
												$element = $defaut[7];
												$type = $defaut[5];
											}
											$name = $id.'-'.$projet.'-'.$element.'-'.$type.$extension;
											$id++;
											$photosDefaut[] = $name;
											if(!move_uploaded_file($cheminFichiers[$y], $dossier.$name))
											{
												$erreur = $ajouterErreur8;
											}
										}
									}
									
								}
								// On insert les données indiquées dans le fichier CSV et les photos récupèraient avec l'algorithme
								if(!insertDefaut($defaut[0],$defaut[1],$defaut[2],$defaut[3],$defaut[4],$defaut[5],$defaut[6],$defaut[7],$defaut[8],$defaut[9],$defaut[10],$defaut[11],$photosDefaut))
								{
									$erreur = $ajouterErreur9;
								}
							}
						}
						else
						{
							$erreur = $ajouterErreur10;
						}
						$envoi = "csv";
					}
					if(isset($erreur))
					{
						$affichage = $erreur;
					}
					else
					{
						$affichage = "true";
					}
				}
			}
			break;
		}
	}
}
if(isset($_REQUEST['envoi'])) 
{
	$envoi = $_REQUEST['envoi'];
}
$criticites = obtenirCriticites();
$projets = obtenirProjets();
$essais = obtenirEssais();
$zones = obtenirZones();
$elementsNITG = obtenirElementNITG();
$typesPheno = obtenirTypesPheno();
$types = obtenirTypes();
include"vues/v_ajouter.php";