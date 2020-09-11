

<div class="flex displayingOption">
	<a class="optionAffichag" onclick="test($('#test').html(),'bloc')" ><button class="submit"><?php echo $rechercherAff1; ?><div class="separateurButton" ></div><i class="fas fa-paint-brush fafa"></i></button></a>	
	<a class="optionAffichag" onclick="test($('#test').html(),'tableau')" ><button class="submit"><?php echo $rechercherAff2; ?><div class="separateurButton" ></div><i class="fas fa-paint-brush fafa"></i></button></a>
</div>
<div style="display:none;" id="test"><?php echo  json_encode($defauts) ?></div>
<div id="pageRecherche">
	<div id="defautsBox" class="defautsBox">
		<?php
		// Vérifier si un type d'affichage est demandé pour afficher en bloc
		if(!empty($defauts))
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
			echo $rechercherDf12;
		}
		?>
	</div>
    <div id="filtre">
		<form method="GET" action=""  class="filtreForm" id="filtreForm">
			<div>
				<input type="hidden" name="uc" value="recherche" />
				<input type="hidden" name="action" value="filtrer" />
				<input type="hidden" name="affichage" <?php if(isset($_REQUEST['affichage'])) echo 'value="bloc"'; ?> />
				<label><?php echo $ajouterChamp1; ?></label>
				<select name="projet[]" multiple onchange="loadVague($(this).val())" class="selectForm" id="projet" data-placeholder="<?php echo $optionDefaut; ?>">
					<?php
						// Récupération des projets si le formulaire vient d'être envoyé
						foreach($projets as $projet)
						{
							if(isset($_REQUEST['projet']))
							{
								$trouve = false;
								// On vérifie pour chaque projet envoyé si il correspond au projet sélectionné par le foreach
								foreach($_REQUEST['projet'] as $unProjet)
								{
									// Si il correspond trouve devient vrai
									if($unProjet == $projet['prj_id'])
									{
										$trouve = true;
									}
								}
								// si trouve est vrai le projet est dans la liste des projets sélectionnés avant donc on ajoute selected dans sa balise
								if($trouve)
								{
									echo '<option selected value="'.$projet['prj_id'].'">'.$projet['prj_nom'].'</option>';
								}
								else
								{
									echo '<option value="'.$projet['prj_id'].'">'.$projet['prj_nom'].'</option>';
								}
							}
							else {
								echo '<option value="'.$projet['prj_id'].'">'.$projet['prj_nom'].'</option>';
							}
						}
					?>
				</select>
			</div>
			<div>
				<label><?php echo $ajouterChamp2; ?></label>
				<select  name="vague[]" multiple class="selectForm" onchange="loadSupport($(this).val())"  id="vague" data-placeholder="<?php echo $optionDefaut; ?>" >
					<?php
					if(isset($_REQUEST['projet']))
					{
						foreach($_REQUEST['projet'] as $unProjet)
						{
							echo '<optgroup label="'.obtenirNomProjet($unProjet)[0].'">';
							$vagues = obtenirVagueParProjet($unProjet);
							foreach($vagues as $laVague)
							{
								$trouve = false;
								foreach($_REQUEST['vague'] as $uneVague)
								{
									if($laVague['jln_id'] == $uneVague)
									{
										$trouve = true;
									}
								}
								if($trouve)
								{
									echo '<option selected value="'.$laVague['jln_id'].'">'.$laVague['jln_nom'].'</option>';
								}
								else
								{
									echo '<option value="'.$laVague['jln_id'].'">'.$laVague['jln_nom'].'</option>';
								}
							}
							echo '</optgroup>';
						}
					} ?>
				</select>
			</div>
			<div>
				<label><?php echo $ajouterChamp3; ?></label>
				<select  name="support[]"  class="selectForm selectChosen multiselect" multiple id="support" data-placeholder="<?php echo $optionDefaut; ?>">
				<?php
				if(isset($_REQUEST['vague']))
				{
					foreach($_REQUEST['vague'] as $vague)
					{
						echo '<optgroup label="'.obtenirNomVague($uneVague)[0].'">';
						$supports = supportViaProjetVague($vague);
						foreach($supports as $leSupport)
						{
							$trouve = false;
							foreach($_REQUEST['support'] as $unSupport)
							{
								if($leSupport['sup_id'] == $unSupport)
								{
									$trouve = true;
								}
							}
							if($trouve) { echo '<option selected value="'.$leSupport['sup_id'].'">'.$leSupport['sup_nom'].'</option>'; }
							else { echo '<option value="'.$leSupport['sup_id'].'">'.$leSupport['sup_nom'].'</option>'; }
						}
						echo '</optgroup>';
					}
				}
				?>
				</select>
			</div>
			<div>
				<label><?php echo $ajouterChamp5; ?></label>
				<select  name="zone[]" onchange="loadElement($(this).val())" multiple id="zone"  class="selectForm" data-placeholder="<?php echo $optionDefaut; ?>">
					<?php
						foreach($zones as $zone)
						{
							if(isset($_REQUEST['zone']))
							{
								$trouve = false;
								foreach($_REQUEST['zone'] as $uneZone)
								{
									if($uneZone == $zone['zne_num'])
									{
										$trouve = true;
									}
								}
								if($trouve)
								{
									echo '<option selected value="'.$zone['zne_num'].'">'.$zone['zne_libelle'].'</option>';
								}
								else
								{
									echo '<option value="'.$zone['zne_num'].'">'.$zone['zne_libelle'].'</option>';
								}
							}
							else {
								echo '<option value="'.$zone['zne_num'].'">'.$zone['zne_libelle'].'</option>';
							}
						}
					?>
				</select>
			</div>
			<div>
				<label><?php echo $ajouterChamp6; ?></label>
				<select  class="selectForm selectChosen multiselect" name="element[]" multiple id="element" data-placeholder="<?php echo $optionDefaut; ?>">
				<?php
				if(isset($_REQUEST['zone']))
				{
					foreach($_REQUEST['zone'] as $uneZone)
					{
						echo '<optgroup label="'.obtenirNomZone($uneZone)[0].'">';
						$elements = obtenirElementViaZone($uneZone['zne_num']);
						foreach($elements as $leElement)
						{
							if(isset($_REQUEST['element']))
							{
								
								$trouve = false;
								foreach($_REQUEST['element'] as $unElement)
								{
									if($leElement['elm_num'] == $unElement)
									{
										$trouve = true;
									}
								}
								if($trouve) { echo '<option selected value="'.$leElement['elm_num'].'">'.$leElement['elm_libelle'].'</option>'; }
								else { echo '<option value="'.$leElement['elm_num'].'">'.$leElement['elm_libelle'].'</option>'; }
							}
							else
							{
								echo '<option value="'.$leElement['elm_num'].'">'.$leElement['elm_libelle'].'</option>';
							}
						}
						echo  '</optgroup>';
					}
				}
				?>
				</select>
			</div>
			<div>
				<label><?php echo $ajouterChamp9; ?></label>
				<select  class="selectForm selectChosen multiselect" name="elementNITG[]" multiple id="element" data-placeholder="<?php echo $optionDefaut; ?>">
				<?php
					foreach($elementsNITG as $element)
					{
						if(isset($_REQUEST['elementNITG']))
						{
							$trouve = false;
							foreach($_REQUEST['elementNITG'] as $elementNITG)
							{
								if($elementNITG == $element['NITG_num'])
								{
									$trouve = true;
								}
							}
							if($trouve)
							{
								echo '<option selected value="'.$element['NITG_num'].'">'.$element['NITG_libelle'].'</option>';
							}
							else
							{
								echo '<option value="'.$element['NITG_num'].'">'.$element['NITG_libelle'].'</option>';
							}
						}
						else
						{
							echo '<option value="'.$element['NITG_num'].'">'.$element['NITG_libelle'].'</option>';
						}
					}
				?>
				</select>
			</div>
			<div>
				<label><?php echo $ajouterChamp10; ?></label>
				<select  class="selectForm selectChosen multiselect" name="typePheno[]" multiple id="typePheno" data-placeholder="<?php echo $optionDefaut; ?>">
				<?php
				
					foreach($typesPheno as $typePheno)
					{
						if(isset($_REQUEST['typePheno']))
						{
							$trouve = false;
							foreach($_REQUEST['typePheno'] as $type)
							{
								if($type == $typePheno['phe_num'])
								{
									$trouve = true;
								}
							}
							if($trouve)
							{
								echo '<option selected value="'.$typePheno['phe_num'].'">'.$typePheno['phe_libelle'].'</option>';
							}
							else
							{
								echo '<option value="'.$typePheno['phe_num'].'">'.$typePheno['phe_libelle'].'</option>';
							}
						}
						else
						{
							echo '<option value="'.$typePheno['phe_num'].'">'.$typePheno['phe_libelle'].'</option>';
						}
					}
				?>
				</select>
			</div>
			<div>
				<label><?php echo $ajouterChamp7; ?></label>
				<select  name="type[]" multiple class="selectForm multiselect" id="type" data-placeholder="<?php echo $optionDefaut; ?>">
					<?php
					foreach($types as $type)
					{
						if(isset($_REQUEST['projet']))
						{
							$trouve = false;
							foreach($_REQUEST['type'] as $unType)
							{
								if($unType == $type['nom_id'])
								{
									$trouve = true;
								}
							}
							if($trouve) { echo '<option selected value="'.$type['nom_id'].'">'.$type['nom_libelle'].'</option>'; }
							else { echo '<option value="'.$type['nom_id'].'">'.$type['nom_libelle'].'</option>'; }
						}
						else {
							echo '<option value="'.$type['nom_id'].'">'.$type['nom_libelle'].'</option>';
						}
					}
					?>
				</select>
			</div>
			<div>
				<label><?php echo $ajouterChamp4; ?></label>
				<select class="selectForm multiselect" multiple name="essai[]" data-placeholder="<?php echo $optionDefaut; ?>">
					<?php 
						foreach($essais as $essai)
						{
							if(isset($_REQUEST['projet']))
							{
								$idx = 0;
								$trouve = false;
								while($idx < count($_REQUEST['essai']) and !$trouve)
								{
									if($_REQUEST['essai'][$idx] == $essai['ess_num'])
									{
										$trouve = true;
									}
									else
									{
										$idx++;
									}
								}
								if($trouve)
								{
									echo '<option selected value="'.$essai['ess_num'].'">'.$essai['ess_libelle'].'</option>';
								}
								else
								{
									echo '<option value="'.$essai['ess_num'].'">'.$essai['ess_libelle'].'</option>';
								}
							}
							else
								echo '<option value="'.$essai['ess_num'].'">'.$essai['ess_libelle'].'</option>';
						}
						?>
				</select>
			</div>
			<div class="center">
				<div></div>
					<button type="submit" class="submit" id="submitFiltre" ><?php echo $rechercherBouton1; ?><div class="separateurButton" ></div><i class="fas fa-angle-right fafa"> </i></button>
				<div></div>
			</div>
		</form>
	</div>
</div>
	<div id="pagination">
		<?php
			$nbLiens = 5;
			$nbPages = $nbDefauts / $_SESSION['limite'];
			if(($nbDefauts % $_SESSION['limite']) > 0)
			{
				$nbPages ++;
			}
			if($nbPages >= 2)
			{
				if(isset($_REQUEST['page']))
				{
					$currentPage = $_REQUEST['page'];
				}
				else
				{
					$currentPage = 1;
					$_GET['page'] = 1;
				}
				if($nbPages > $nbLiens && $currentPage != 1 && $currentPage != 2)
				{

					
					for($i = $currentPage-(($nbLiens / 2) - (5 % 2) / 2); $i <= $currentPage+(($nbLiens / 2) - (5 % 2) / 2); $i++)
					{
						$_GET['page'] = $i;
						?><a href="<?php echo 'index.php?'.http_build_query($_GET); ?>" <?php if($i == $_REQUEST['page']) echo 'style="color:white"'; ?> class="page"><?php echo $i ?></a><?php
					}
				}
				else
		 		{
		 			for($i = 1; $i <= $nbPages; $i++)
					{
						$_GET['page'] = $i;
						?><a href="<?php echo 'index.php?'.http_build_query($_GET); ?>" <?php if($i == $_REQUEST['page']) echo 'style="color:white"'; ?> class="page"><?php echo $i ?></a><?php
					}
		 		}
	 		}
		?>
	</div>
