<?php
include"/modele/gestionBdd.php";
if($_COOKIE['lang'] == "FR")
{
	include"/langage/fr.php";
}
else
{
	include"/langage/eng.php";
}
$action = $_REQUEST['action'];
session_start();

switch($action) {
	
	case "projet" : {
		echo '<option value="" >-- sélectionner --</option>';
		$vagues = obtenirVagueParProjet($_REQUEST['projet']);
		foreach($vagues as $vague)
		{
			echo '<option value="'.$vague['jln_id'].'">'.$vague['jln_nom'].'</option>';
		}
		break;
	}
	
	case "projetMulti" : {
		//sépare une chaîne de caractères en tableau
		$projets = explode(",",$_REQUEST['projet']);
		//Exploitation du tableau
		foreach($projets as $unProjet)
		{
			// Affichage des projets
			echo '<optgroup label="'.obtenirNomProjet($unProjet)[0].'">';
			$vagues = obtenirVagueParProjet($unProjet);
			foreach($vagues as $vague)
			{
				echo '<option value="'.$vague['jln_id'].'">'.$vague['jln_nom'].'</option>';
			}
			echo '</optgroup>';
		}
		break;
	}
	
	case "vagueMulti" : {
		$vagues = explode(",",$_REQUEST['vague']);
		foreach($vagues as $uneVague)
		{
			echo '<optgroup label="'.obtenirNomVague($uneVague)[0].'">';
			$supports = supportViaProjetVague($uneVague);
			foreach($supports as $support)
			{
				echo '<option value="'.$support['sup_id'].'">'.$support['sup_nom'].'</option>';
			}
			echo '</optgroup>';
		}
		break;
	}
	
	case "zoneMulti" : {
		$zones = explode(",",$_REQUEST['zone']);
		foreach($zones as $uneZone)
		{
			echo '<optgroup label="'.obtenirNomZone($uneZone)[0].'">';
			$elements = obtenirElementsViaZone($uneZone);
			foreach($elements as $element)
			{
				echo '<option value="'.$element['elm_num'].'">'.$element['elm_libelle'].'</option>';
			}
			echo '</optgroup>';
		}
		break;
	}
	
	case "affichage" : {
		$defauts = json_decode($_REQUEST['defauts'],true);
		if(!empty($defauts))
		{
			if($_REQUEST['affichage'] == "bloc")
			{
				foreach($defauts as $defaut)
				{
					$photos = obtenirPhoto($defaut['dft_id']);
				?>
					<div class="defauts" id="<?php echo $defaut['dft_id'] ?>">
						<div class="delete">
							<?php
								if($_SESSION['habilitation'] == 1 or $_SESSION['habilitation'] == 2)
								{
									echo '<a class="optionDefaut" onclick="supprimerDefaut('.$defaut['dft_id'].')" ><i class="fas fa-trash-alt fa-2x" style="color:red" alt="Supprimer cet élement"></i></a>';
								}
							?>
						</div>
						<div class="userBox">
							<div>
								<p><strong><?php echo $rechercherDf1; ?></strong></p>
								<p><?php echo $defaut['dft_date']; ?></p>
							</div>
							<div>
								<p  class="userInfo"><i><strong><?php echo $rechercherDf2; ?></strong> <?php echo $defaut['ipn'] ?></strong></i></p>
								<p  class="userInfo"><i><strong><?php echo $rechercherDf3; ?></strong> <?php echo $defaut['nom'] ?></i></p>
								<p  class="userInfo"><i><strong><?php echo $rechercherDf4; ?></strong> <?php echo $defaut['prenom'] ?></i></p>
							</div>
						</div>
						<h3><?php if(!empty($defaut['elm_libelle'])) { echo $defaut['elm_libelle']; } else { echo $defaut['NITG_libelle']; }?></h3>
						<h4><?php echo $defaut['nom_libelle'].$defaut['phe_libelle']?></h4>
						<div class="infoBox">
							<div>
								<ul>
									<li><strong><?php echo $rechercherDf5; ?></strong><i><?php echo $defaut['prj_nom'] ?></i></li>
									<li><strong><?php echo $rechercherDf6; ?></strong><i> <?php echo $defaut['jln_nom'] ?></i></li>
									<li><strong><?php echo $rechercherDf7; ?></strong><i> <?php echo $defaut['sup_nom'] ?></i></li>
								</ul>
							</div>
							<div>
								<ul>
									<?php if(!empty($defaut['zne_libelle'])) echo '<li><strong>'.$rechercherDf8.'</strong><i>'.$defaut['zne_libelle'].'</i></li>';?>
									<li><strong><?php echo $rechercherDf9; ?></strong><i> <?php echo $defaut['crt_libelle'] ?></i></li>
								</ul>
							</div>
						</div>
						<div class="commentBox">
							<?php 
							// Si les kilométrages sont vide Alors affiche les cycles
								if($defaut['dft_km'] != null)
								{
									echo '<strong>Km :</strong> '.$defaut['dft_km'];
								}
								else
								{
									echo '<strong>'.$rechercherDf10.'</strong>'.$defaut['dft_cycle'];
								}
								echo '<div>'.$defaut['dft_commentaire'].'</div>';
							?>
							
						</div>
						
						<?php 
					if(count($photos) > 0)
					{
						if(strrchr($photos[0]['pht_nom'],'.') == '.pdf' or strrchr($photos[0]['pht_nom'],'.') == '.PDF')
						{
							echo '<a class="pdfLink" Target="_blank" href="./photos/'.$photos[0]['pht_nom'].'"><button class="submit">'.$rechercherBouton3.'<div class="separateurButton" ></div><i class="fas fa-angle-right fafa"></i></button></a>';
						}
						else
						{
							echo '<a class="linkBox" href="./photos/'.$photos[0]['pht_nom'].'" data-lightbox="image-'.$photos[0]['pht_dft_id'].'"><button class="submit">'.$rechercherBouton2.'<div class="separateurButton" ></div><i class="fas fa-angle-right fafa"></i></button></a>'; ?>
						
							<div class="imgBox">
							<?php
								if(count($photos) > 1)
								{
									for($idx = 1; $idx < count($photos); $idx++)
									{
									   echo '<a href="./photos/'.$photos[$idx]['pht_nom'].'" data-lightbox="image-'.$photos[0]['pht_dft_id'].'" ><img src="./photos/'.$photos[$idx]['pht_nom'].'" class="dftImg"/></a>';
									}
								}
							?>
							</div>
							<?php
						}
					}
					else
					{
						echo "<i>".$rechercherDf11."</i>";
					}
					?>
						
						
					</div>
				<?php
				}
			}
			else
			{
				echo '<table  class="table table-striped" id="tableauRecherche">
					<thead class="thead-dark">
						<tr id="colonne" >
							<th scope="col">'.$ajouterChamp1.'</th>
							<th scope="col">'.$ajouterChamp2.'</th>
							<th scope="col">'.$ajouterChamp3.'</th>
							<th scope="col">'.$ajouterChamp5.'</th>
							<th scope="col">'.$ajouterChamp6.'</th>
							<th scope="col">'.$ajouterChamp7.'</th>
							<th scope="col">'.$ajouterChamp8.'</th>
							<th scope="col">'.$rechercherChamp1.'</th>
							<th scope="col">'.$ajouterChamp13.'</th>
							<th scope="col">'.$rechercherChamp2.'</th>
						</tr>
					</thead>
					<tbody>';
					foreach($defauts as $defaut)
					{
						$photos = obtenirPhoto($defaut['dft_id']);
					?>
					<tr>
						<td><?php echo $defaut['prj_nom'] ?></td>
						<td><?php echo $defaut['jln_nom'] ?></td>
						<td><?php echo $defaut['sup_nom'] ?></td>
						<td><?php echo $defaut['zne_libelle'] ?></td>
						<td class="importantCell" ><?php echo $defaut['elm_libelle'].$defaut['NITG_libelle'] ?></td>
						<td class="importantCell"><?php echo $defaut['nom_libelle'].$defaut['phe_libelle'] ?></td>
						<td><?php echo $defaut['crt_libelle'] ?></td>
						<td><?php if($defaut['dft_km'] != null) echo $defaut['dft_km']; else echo $defaut['dft_cycle']; ?></td>
						<td class="commentCell"><?php echo $defaut['dft_commentaire'] ?></td>
						<?php 
						if(!empty($photos)) 
						{
							if(strrchr($photos[0]['pht_nom'],'.') == '.pdf' or strrchr($photos[0]['pht_nom'],'.') == '.PDF')
							{
								echo '<td><a class="pdfLink" Target="_blank" href="./photos/'.$photos[0]['pht_nom'].'"><button class="buttonCell"><i class="fas fa-camera fa-1x"></i></button></a></td>';
							}
							else
							{
								echo '<td><a class="pdfLink" href="./photos/'.$photos[0]['pht_nom'].'" data-lightbox="image-'.$photos[0]['pht_dft_id'].'"><button class="buttonCell"><i class="fas fa-camera fa-1x"></i></button></a></td>'; 
								echo '<div class="imgBox">';
								if(count($photos) > 1)
								{
									for($idx = 1; $idx < count($photos); $idx++)
									{
									   echo '<a href="./photos/'.$photos[$idx]['pht_nom'].'" data-lightbox="image-'.$photos[0]['pht_dft_id'].'" ><img src="./photos/'.$photos[$idx]['pht_nom'].'" class="dftImg"/></a>';
									}
								}
								echo '</div>';
							}
						}	
						else 
						{
							echo '<td class="imgCell">'.$rechercherDf11.'</td>';
						}
						?>
					</tr>
					<?php
					
					}
					echo '</tbody>
					</table>';
			}
		}
		else
		{
			echo $rechercherDf12;
		}
		break;
	}
	
	case "vague" : {
		$supports = supportViaProjetVague($_REQUEST['vague']);
		foreach($supports as $support)
		{
			echo '<option value="'.$support['sup_id'].'">'.$support['sup_nom'].'</option>';
		}
		break;
	}
	
	case "zone" : {
			$elements = obtenirElementViaZone($_REQUEST['zone']);
			foreach($elements as $element)
			{
				echo '<option value="'.$element['elm_num'].'">'.$element['elm_libelle'].'</option>';
			}
		break;
	}
	
	case "defaut" : {
		supprimerDefaut($_REQUEST['id']);
		break;
	}
	
	case "ajouterRadio" : {
		echo $_REQUEST['usage'];
		break;
	}
	
	case "supprimerUtilisateur" : {
		$utilisateur = $_REQUEST['utilisateur'];
		if(supprimerUtilisateur($utilisateur))
		{
			echo $utilisateurSupprime;
		}
		else { echo $utilisateurErreur; }
		break;
	}
	
}
