<h3 class="titreSection" id="adminTitle" ><?php echo $adminTitre ?></h3>
<p class="info"><a href="#informations" class="open-popup-link" style="color:Tomato"><i class="fas fa-exclamation-triangle"></i><?php echo $adminSousTitre ?><i class="fas fa-exclamation-triangle"></i></a></p>

<table  class="table table-striped" id="panneauAdministration">
	<thead class="thead-dark">
		<tr id="colonne" >
			<th scope="col"><?php echo $adminChamp1 ?></th>
			<th scope="col"><?php echo $adminChamp2 ?></th>
			<th scope="col"><?php echo $adminChamp3 ?></th>
			<th scope="col"><?php echo $adminChamp4 ?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	if(isset($erreur))
	{
		echo '<div id="dialogue">'
				.$erreur
			.'</div>';
	}
		foreach($tables as $table)
		{
			echo '<tr>'
					.'<td>'.$table.'</td>'
					.'<td><a style="color:#ffcc33;" href="includes/CSV/'.$table.'.csv"><i class="fas fa-download fafa"></i></a></td>'
					.'<td><form method="POST" action="index.php?uc=administration&action=update&table='.$table.'" enctype="multipart/form-data"><input class="fileAdmin" type="file" name="csv"/><input type="checkbox" name="delete'.$table.'" />'.$adminChamp5.'<button class="submitAdmin" type="submit">'.$ajouterBouton2.'</button></form></td>';
					if($table == "support" or $table == "element" or $table == "vague" ) echo '<td><a href="#'.$table.'" style="color:#ffcc33;" class="open-popup-link"><i class="fas fa-info-circle fa-2x fafa"></i></a></td>'; else echo '<td></td>';
				echo '</tr>';
		}
	?>
	</tbody>
</table>
<section>
<form action="index.php?uc=administration&action=updateCompte" method="POST">
	<?php 
		if($_SESSION['habilitation'] == 1)
		{
			echo '<h4>'.$adminChamp6.'<a href="#addCompte" class="open-popup-link" style="color:#ffcc33"><i class="fas fa-plus-circle fa-2x"></i></a></h4>'
				.'<p class="info"><a href="#informationsCompte" class="open-popup-link" style="color:Tomato"><i class="fas fa-exclamation-triangle"></i>'.$adminSousTitre.'<i class="fas fa-exclamation-triangle"></i></a></p>'
				.'<table class="table table-striped">'
					.'<thead class="thead-dark">'
						.'<tr id="colonne" >'
							.'<th scope="col">'.$adminChamp7.'</th>'
							.'<th scope="col">'.$adminChamp8.'</th>'
							.'<th scope="col">'.$adminChamp9.'</th>'
							.'<th scope="col">'.$adminChamp10.'</th>'
							.'<th scope="col">'.$adminChamp11.'</th>'
							.'<th scope="col">'.$adminBouton1.'</th>'
							.'<th scope="col">'.$adminBouton2.'</th>'
						.'</tr>'
					.'</thead>';
			foreach($comptes as $compte)
			{
				echo '<tr id="'.$compte['ipn'].'" >'
						.'<td>'.$compte['ipn'].'</td>'
						.'<td>'.$compte['nom'].'</td>'
						.'<td>'.$compte['prenom'].'</td>'
						.'<td>'.$compte['mdp'].'</td>'
						.'<td>'.$compte['habilitation'].'</td>';
						?>
						<td><input type="hidden" id="<?php echo $compte['ipn'] ?>" value="<?php echo $compte['ipn'] ?>" /><div onclick="supprimerUtilisateur('<?php echo $compte['ipn'] ?>')" ><i class="fas fa-trash-alt"></i></div></td>
						<td><button onclick="modifier($('#<?php echo $compte['ipn'] ?>'),'<?php echo $_COOKIE['lang']; ?>','<?php echo $compte['nom'] ?>','<?php echo $compte['prenom'] ?>','<?php echo $compte['mdp'] ?>','<?php echo $compte['habilitation'] ?>','<?php echo $compte['ipn'] ?>')"><i class="fas fa-wrench"></i></button></td> <?php
					echo '</tr>';
			}
		}
	?>
	</table>
	</form>
	
</section>
<section>
	<div id="addCompte" class="informations mfp-hide">
	  <h3><?php echo $adminTitre2 ?></h3>
	  <form  action="index.php?uc=administration&action=ajouterCompte" method="POST">
		<div class="addCompte">
			<div>
				<input class="addComptePart" name="ipn" placeholder="<?php echo $adminChamp7; ?>" />
				<input class="addComptePart" name="nom"placeholder="<?php echo $adminChamp8; ?>"  />
				<input class="addComptePart" name="prenom" placeholder="<?php echo $adminChamp9; ?>"  />
			</div>
			<div>
				<input class="addComptePart" name="mdp" placeholder="<?php echo $adminChamp10; ?>"  />
				<input class="addComptePart" name="habilitation" placeholder="<?php echo $adminChamp12; ?>"  />
			</div>
		</div>
		</br>
		<button class="submit" type="submit"><?php echo $adminBouton3; ?><div class="separateurButton" ></div><i class="fas fa-angle-right fafa"></i></button>
	  </form>
	</div>
<div id="informationsCompte" class="informations mfp-hide">
	  <h3><?php echo $adminTitre3 ?></h3>
	  <ul>
		<li><?php echo $adminAide1; ?></li>
		<li><?php echo $adminAide2; ?></li>
		<li><?php echo $adminAide3; ?></li>
		<li><?php echo $adminAide4; ?></li>
		<li><?php echo $adminAide5; ?></li>
		<li><?php echo $adminAide6; ?> <i class="fas fa-plus-circle fa-2x"></i></li>
	  </ul>
	</div>
	<div id="element" class="informations mfp-hide">
	  <h3><?php echo $adminTitre4 ?></h3>
	  <ul>
		<li><?php echo $adminAide7; ?></li>
		<li><?php echo $adminAide8; ?></li>
		<li><?php echo $adminAide9; ?></li>
		<li><?php echo $adminAide10; ?></li>
	  </ul>
	</div>
	<div id="support" class="informations mfp-hide">
	  <h3><?php echo $adminTitre5 ?></h3>
	  <ul>
		<li><?php echo $adminAide11; ?></li>
		<li><?php echo $adminAide12; ?></li>
	  </ul>
	</div>
	<div id="vague" class="informations mfp-hide">
	  <h3><?php echo $adminTitre6 ?></h3>
	  <ul>
		<li><?php echo $adminAide13; ?></li>
		<li><?php echo $adminAide14; ?></li>
		<li><?php echo $adminAide15; ?></li>
		<li><?php echo $adminAide16; ?></li>
	  </ul>
	</div>
	<div id="informations" class="informations mfp-hide">
	  <h3><?php echo $adminTitre7 ?></h3>
	  <ul>
		<li><?php echo $adminAide17; ?></li>
		<li><?php echo $adminAide18; ?></li>
		<li><?php echo $adminAide19; ?></li>
		<li><?php echo $adminAide20; ?></li>
		<li><?php echo $adminAide21; ?></li>
		<li><?php echo $adminAide22; ?></li>
		<li><?php echo $adminAide23; ?></li>
		<li style="color:red"><?php echo $adminAide24; ?></li>
	  </ul>
	</div>
</section>