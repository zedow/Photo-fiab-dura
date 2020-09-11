<?php

	if($_SESSION['habilitation'] == 1 OR $_SESSION['habilitation'] == 2)
	{
		$tables[0] = "zone";
		$tables[1] = "element";
		$tables[2] = "essai";
		$tables[3] = "type";
		$tables[4] = "criticite";
		$tables[5] = "projet";
		$tables[6] = "vague";
		$tables[7] = "support";
		$tables[8] = "elementNITG";
		$tables[9] = "typePheno";
		
		if(isset($_REQUEST['action']))
		{
			$action = $_REQUEST['action'];
			switch($action) {
			
				case "update" : {
					// on vérifie qu'une table soit bien concernée ex : "zone" 
					if(isset($_REQUEST['table']))
					{
						$table = $_REQUEST['table'];
						// on vérifie que un fichier ait bien été envoyé et que le formulaire n'est pas vide
						if(isset($_FILES['csv']))
						{
							// on vérifie l'extension du fichier qui doit être csv
							$extension= strrchr($_FILES['csv']['name'],'.');
							if($extension == ".csv" or $extension == ".CSV" or $extension == "csv" or $extension == "CSV")
							{
								$dossier = "./includes/CSV/";
								$fichier = $dossier.$_FILES['csv']['name'];
								// on upload le fichier dans le dossier CSV
								if(move_uploaded_file($_FILES['csv']['tmp_name'], $fichier))
								{
									// on essaye d'ouvrir le fichier pour être sûr qu'il existe
									if (($handle = fopen($fichier, "r")) !== FALSE) {
										$row = 0;
										$tableau = [];
										// Les lignes sont étudiées une par une, tant que la ligne étudiée n'est pas vide on extrait les données
										while (($data = fgetcsv($handle, 10000,";")) !== FALSE) {
											// On compte le nombre de colonne formé dans notre tableau
											$num = count($data);
											// Pour chaque colonne on attribut la valeur à notre tableau de données qui contriendra toutes les lignes.
											for ($c=0; $c < $num; $c++) {
												$tableau[$row][$c] = $data[$c];
											}
											$row++; 
										}
										$nbErreurs = 0;
										// si la checkbox supprimer est coché on supprime de la bdd les données qui ne se trouvent pas dans le fichier
										if(isset($_REQUEST['delete'.$table]))
										{
											if(!deleteNotIn($tableau,$table))
											{
												$erreur = $adminErreur;
											}
										}
										// on insére les données dans la bdd
										foreach($tableau as $requete)
										{
											if(!updateTable($requete,$table))
											{
												$nbErreurs ++;
											}
										}
										// si une requête échoue on affiche le nombre de requêtes qui ont échouées.
										if($nbErreurs > 0)
										{
											$erreur = "";
											$erreur .= $nbErreurs.$adminErreur2;
										}
										else
										{
											$erreur = "";
											$erreur .= $adminErreur3;
										}
										// on ferme la lecture du fichier
										fclose($handle);
									}	
									else
									{
										$erreur = $adminErreur4.$fichier.$adminErreur5;
									}
								}
								else
								{
									$erreur = $adminErreur6;
								}
							}
							else
							{
								$erreur = $adminErreur7;
							}
						}
					}
					else
					{
						require "vues/v_error404.php";
					}
					break;
				}
				
				case "updateCompte" : {
				
					if(!updateUtilisateur($_REQUEST['ipn'],$_REQUEST['nom'],$_REQUEST['prenom'],$_REQUEST['habilitation'],$_REQUEST['mdp'],$_REQUEST['trueIpn']))
					{
						$erreur = $adminErreur8;
					}
					break;
				}
				
				case "ajouterCompte" : {
					if(!addCompte($_REQUEST['ipn'],$_REQUEST['nom'],$_REQUEST['prenom'],$_REQUEST['habilitation'],$_REQUEST['mdp']))
					{
						$erreur = $adminErreur9;
					}
					break;
				}
			}
		}
		$comptes = obtenirComptes();
		require "vues/v_admin.php";
	}
	else
	{
		require "vues/v_error404.php";
	}