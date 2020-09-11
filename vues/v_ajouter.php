<section class="section">
<div id="test-popup" class="informations mfp-hide">
  <h3><?php echo $ajouterAide5 ?></h3>
  <ul>
	<li><?php echo $ajouterAide1 ?></li>
	<li><?php echo $ajouterAide2 ?></li>
	<li><?php echo $ajouterAide3 ?></li>
	<li><?php echo $ajouterAide4 ?></li>
  </ul>
</div>

<a href="#test-popup" class="open-popup-link"><i class="fas fa-info-circle fa-2x fafa"></i></a>
<div class="typeAjout">
	<a href="index.php?uc=ajouter&envoi=formulaire"><button class="submit" ><?php echo $ajouterBouton3; ?><div class="separateurButton" ></div><i class="fas fa-plus fafa"></i></button></a>
	<a href="index.php?uc=ajouter"><button class="submit" ><?php echo $ajouterBouton4; ?><div class="separateurButton" ></div><i class="fas fa-plus fafa"></i></button></a>
</div>
<div id="separateurForm">
</div>
<?php 
	if(isset($envoi)) 
	{
	?>
	<div id="informationBox" <?php if(isset($affichage)) { if($affichage != "true") echo 'style="color:red"'; else echo 'style="color:green"'; }?> class="informationBox">
			<?php
			if(isset($affichage)) 
			{	
				if($affichage == "true")
				{
					echo $ajouterSucces;
				}
				else
				{
					echo $affichage;
				}
			}
			?>
		</div></br>
	<form id="addForm" method="POST" action="index.php?uc=ajouter&action=ajouter&envoi=formulaire" enctype="multipart/form-data">
		<div class="step">
			<h3><?php echo $ajouterTitre1 ?></h3>
			<div class="separateurTitle"></div>
			<div id="stepDefinition">
				<div>
					<div>
						<input id="radioMuse" <?php if(isset($_REQUEST['base'])) { if($_REQUEST['base'] == "muse") { echo "checked"; } } else { echo 'checked'; }?> onclick="useMuse()" type="radio" name="base" value="muse" /><?php echo $ajouterBase1; ?>
					</div>
					<div>
						<label><?php echo $ajouterChamp1 ?></label>
						<select name="projet" class="selectForm" id="projet" data-placeholder="-- sélectionner --" onchange="trierParProjet($('#projet').val())" required >
						<option value=""><?php echo $optionDefaut ?></option>
							<?php
							
								foreach($projets as $projet)
								{
								//dans le cas ou le formulaire vient être envoyé, pour restaurer les valeurs
									if(isset($_REQUEST['projet']))
									{
										if($_REQUEST['projet'] == $projet['prj_id'])
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
						<label><?php echo $ajouterChamp2 ?></label>
						<select  name="vague" class="selectForm" id="vague"  data-placeholder="-- sélectionner --" onchange="trierParProjetEtVague($('#projet').val(),$('#vague').val())" required >
							<option value=""><?php echo $optionDefaut ?></option>
							<?php
							if(isset($_REQUEST['projet']))
							{
								$vagues = obtenirVagueParProjet($_REQUEST['projet']);
								foreach($vagues as $laVague)
								{
									if($laVague['jln_id'] == $_REQUEST['vague'])
									{
										echo '<option selected value="'.$laVague['jln_id'].'">'.$laVague['jln_nom'].'</option>';
									}
									else
									{
										echo '<option value="'.$laVague['jln_id'].'">'.$laVague['jln_nom'].'</option>';
									}
								}
							}
							?>
						</select>
					</div>
					<div>
						<label><?php echo $ajouterChamp3 ?></label>
						<select  name="support"  class="selectForm supportAjout" id="supportAjout" required data-placeholder="<?php echo $optionDefaut ?>">
							<?php
							if(isset($_REQUEST['projet']))
							{
								$supports = supportViaProjetVague($_REQUEST['projet'],$_REQUEST['vague']);
								foreach($supports as $leSupport)
								{
									if($leSupport['sup_id'] == $_REQUEST['support'])
									{
										echo '<option selected value="'.$leSupport['sup_id'].'">'.$leSupport['sup_nom'].'</option>';
									}
									else
									{
										echo '<option value="'.$leSupport['sup_id'].'">'.$leSupport['sup_nom'].'</option>';
									}
								}
							}
							?>
						</select>
					</div>
				<div>
					<label><?php echo $ajouterChamp4 ?></label>
					<select class="selectForm multiselect" multiple name="essai[]" data-placeholder="<?php echo $optionDefaut ?>" required >
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
				</div>
				<div>
					<div class="base">
						<input id="radioNITG" <?php if(isset($_REQUEST['base'])) { if($_REQUEST['base'] == "NITG") { echo "checked"; } }?> type="radio" onclick="useNITG($('#NITGElement'))" name="base" value="NITG" /><?php echo $ajouterBase2; ?>
					</div>
					<div id="NITGElement" class="baseNITG">
						<label><?php echo $ajouterChamp9 ?></label>
						<select name="elementsNITG" class="selectForm multiselect">
							<option value=""><?php echo $optionDefaut ?></option>
							<?php
							foreach($elementsNITG as $element)
							{
								if(isset($_REQUEST['projet']))
								{
									if($_REQUEST['elementsNITG'] == $element['NITG_num'])
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
						<label><?php echo $ajouterChamp10 ?></label>
						<select class="selectForm" name="typesPheno">
							<option value=""><?php echo $optionDefaut ?></option>
							<?php
							foreach($typesPheno as $type)
							{
								if(isset($_REQUEST['projet']))
								{
									if($_REQUEST['typesPheno'] == $type['phe_num'])
									{
										echo '<option selected value="'.$type['phe_num'].'">'.$type['phe_libelle'].'</option>';
									}
									else
									{
										echo '<option value="'.$type['phe_num'].'">'.$type['phe_libelle'].'</option>';
									}
								}
								else
								{
									echo '<option value="'.$type['phe_num'].'">'.$type['phe_libelle'].'</option>';
								}
							}
							?>
						</select>
					</div>
					<div class="baseMuse">
						<label><?php echo $ajouterChamp5 ?></label>
						<select  name="zone" id="zone" class="selectForm" onchange="trierParZone($('#zone').val())" >
							<option value=""><?php echo $optionDefaut ?></option>
							<?php
								foreach($zones as $zone)
								{
									if(isset($_REQUEST['projet']))
									{
										if($_REQUEST['zone'] == $zone['zne_num'])
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
						<label><?php echo $ajouterChamp6 ?></label>
						<select  class="selectForm" name="element" id="elementAjout" >
							<option value=""><?php echo $optionDefaut ?></option>
							<?php
							if(isset($_REQUEST['element']))
							{
								$elements = obtenirElementViaZone($_REQUEST['zone']);
								foreach($elements as $leElement)
								{
									if($leElement['elm_num'] == $_REQUEST['element'])
									{
										echo '<option selected value="'.$leElement['elm_num'].'">'.$leElement['elm_libelle'].'</option>';
									}
									else
									{
										echo '<option value="'.$leElement['elm_num'].'">'.$leElement['elm_libelle'].'</option>';
									}
								}
							}
							?>
						</select>
						<label><?php echo $ajouterChamp7 ?></label>
						<select  name="type" class="selectForm" id="type" required >
							<option value=""><?php echo $optionDefaut ?></option>
							<?php
								foreach($types as $type)
								{
									if(isset($_REQUEST['projet']))
									{
										if($_REQUEST['type'] == $type['nom_id'])
										{
											echo '<option selected value="'.$type['nom_id'].'">'.$type['nom_libelle'].'</option>';
										}
										else
										{
											echo '<option value="'.$type['nom_id'].'">'.$type['nom_libelle'].'</option>';
										}
									}
									else {
										echo '<option value="'.$type['nom_id'].'">'.$type['nom_libelle'].'</option>';
									}
								}
							?>
						</select>
					</div>
					<div>
						<label><?php echo $ajouterChamp8 ?></label>
						<select  name="criticite" class="selectForm" id="criticite" required >
							<option value=""><?php echo $optionDefaut ?></option>
							<?php
								foreach($criticites as $criticite)
								{
									if(isset($_REQUEST['projet']))
									{
										if($_REQUEST['criticite'] == $criticite['crt_id'])
										{
											echo '<option selected value="'.$criticite['crt_id'].'">'.$criticite['crt_libelle'].'</option>';
										}
										else
										{
											echo '<option value="'.$criticite['crt_id'].'">'.$criticite['crt_libelle'].'</option>';
										}
									}
									else {
										echo '<option value="'.$criticite['crt_id'].'">'.$criticite['crt_libelle'].'</option>';
									}
									
								}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div id="separateurForm">
		</div>
		<div class="step" id="stepDescription">
			<h3><?php echo $ajouterTitre2 ?></h3>
			<div class="separateurTitle"></div>
			<input type="hidden" name="size" value="10485760" />
			<div>
				<input type="radio" id="kmm" onclick="inputUsage($('#kmm').val())" value="km" name="usage" checked /><?php echo $ajouterRadio1; ?>
				<input type="radio" class="radio" id="cycles" onclick="inputUsage($('#cycles').val())" value="cycle" name="usage" /><?php echo $ajouterRadio2; ?>
			</div>
			<input id="usage" name="usageNombre" placeholder="<?php echo $ajouterChamp11 ?>" required />
			<input class="inputsForm" id="date" type="date" <?php if(isset($_REQUEST['projet'])) echo 'value="'.$_REQUEST['date'].'"'; ?> name="date" required />
			<textarea class="textArea" name="commentaire" <?php if(isset($_REQUEST['projet'])) if(isset($affichage)) echo 'value="'.$_REQUEST['commentaire'].'"'; ?> placeholder="<?php echo $ajouterChamp13 ?>" required ></textarea>
			<label class="fileStyle" onclick="$('#file').click()" ><?php echo $ajouterBouton1 ?><div class="separateurButton" ></div><i class="fas fa-upload fafa"></i></label>
			<input id="file" class="fileInput" type="file" multiple name="photos[]" />
		</div>
		<div id="separateurForm">
		</div>		
		<button type="submit" class="submit" ><?php echo $ajouterBouton2 ?><div class="separateurButton" ></div><i class="fas fa-angle-right fafa"> </i></button>
	</form>
	<?php 
	}
	else
	{
	?>
	<div class="step">
		<h3><?php echo $ajouterTitre3 ?></h3>
		<div class="separateurTitle"></div>
		<?php
		if(isset($affichage))
		{
			echo '<div '; if($affichage == "true" ) { echo 'style="color:green"'; } else { echo 'style="color:red"'; } echo '>';
			if($affichage == "true")
			{
				echo $ajouterSucces;
			}
			else
			{
				echo $affichage;
			}
			echo '</div>';
		}
		?>
		<p><?php echo $ajouterAide1 ?></p>
		<p><?php echo $ajouterAide2 ?></p>
		<p><?php echo $ajouterAide3 ?></p>
		<form  action="index.php?uc=ajouter&action=ajouter" enctype="multipart/form-data" method="POST">
			<label class="fileStyle" onclick="$('#file2').click()" ><?php echo $ajouterBouton5 ?><div class="separateurButton" ></div><i class="fas fa-upload fafa"></i></label>
			<input multiple id="file2" type="file" class="fileInput" name="photos[]" />
			<button type="submit" class="submit" ><?php echo $ajouterBouton2 ?><div class="separateurButton" ></div><i class="fas fa-angle-right fafa"> </i></button>
		</form>
	</div>
	<?php
	}
	?>
	
</section>