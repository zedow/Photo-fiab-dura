<?php

function connexion($ipn,$mdp)
{
	require "connexion.php";
	$sql = 'select * from utilisateur';
	$exec=$bdd->prepare($sql);
    	$exec->execute();
    	$result = $exec->fetchAll();
	$idx = 0;
	$found = false;
	while($idx < count($result) && !$found)
	{
		if($result[$idx]['ipn'] == $ipn && $result[$idx]['mdp'] == $mdp)
		{
			$found = true;
		}
		else
		{
			$idx++;
		}
	}
	if($found)
	{
		return $result[$idx];
	}
	else
	{
		return false;
	}

}

function obtenirStructure($table)
{
	require "connexion.php";
	$sql = 'show columns from '.$table;
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result=$exec->fetchAll();
	return $result;
}

function obtenirProjets()
{
	require "connexion.php";
	$sql = 'select * from projet'
			.' order by prj_nom ';
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}

function supprimerProjet($id)
{
	require "connexion.php";
	$sql = 'delete from projet '
			.'where prj_id = '.$id;
	$exec=$bdd->prepare($sql);
	$exec->execute();
}

function obtenirVagueParProjet($id)
{
	require "connexion.php";
	$sql = 'select * from vague where jln_prj_id = '.$id.' '
			.'order by jln_nom';
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}
function obtenirTypes()
{
	require "connexion.php";
	if($_COOKIE['lang'] == "ENG")
	{
		$sql = 'select nom_id,nom_libelle_eng as nom_libelle from denomination';
	}
	else
	{
		$sql = 'select nom_id,nom_libelle from denomination';
	}
	$sql .= ' order by nom_libelle';
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}

function obtenirElements()
{
	require "connexion.php";
	if($_COOKIE['lang'] == "ENG")
	{
		$sql = 'select elm_num,elm_libelle_eng as elm_libelle from element order by elm_libelle';
	}
	else
	{
		$sql = 'select elm_num,elm_libelle from element order by elm_libelle';
	}
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}
function obtenirElementsViaZone($id)
{
	require "connexion.php";
	if($_COOKIE['lang'] == "ENG")
	{
		$sql = 'select elm_num,elm_libelle_eng as elm_libelle from element where zne_num ='.$id.' order by elm_libelle';
	}
	else
	{
		$sql = 'select elm_num,elm_libelle from element where zne_num ='.$id.' order by elm_libelle';
	}
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}
function obtenirDefauts($limite)
{
	require "connexion.php";
	$sql = 'select dft_nom_id,dft_id,dft_km,dft_cycle,dft.ipn,date_format((dft_date), "%d/%m/%Y") as dft_date,dft_commentaire,zne_libelle,prj_nom,jln_nom,sup_nom,nom,prenom,crt_libelle,';
			if($_COOKIE['lang'] == "ENG")
			{
				$sql .= ' nom_libelle_eng as nom_libelle,elm_libelle_eng as elm_libelle, NITG_libelle_eng as NITG_libelle, phe_libelle_eng as phe_libelle';
			}
			else
			{
				$sql .= ' nom_libelle,elm_libelle, NITG_libelle, phe_libelle';
			}
			$sql .= ' from defaut as dft '
			.'left outer join element as elm on elm.elm_num = dft.elm_num '
			.'left outer join zone as zne on zne.zne_num = elm.zne_num '
			.'inner join criticite as crt on crt.crt_id = dft.crt_id '
			.'inner join support on sup_id = dft_sup_id '
			.'inner join vague on jln_id = sup_jln_id '
			.'inner join projet on prj_id = jln_prj_id '
			.'left outer join denomination as nom on nom.nom_id = dft_nom_id '
			.'left outer join elementnitg on NITG_num = dft_NITG_num '
			.'left outer join typepheno on phe_num = dft_phe_num '
			.'inner join utilisateur as ult on ult.ipn = dft.ipn '
			.'limit '.($limite - 8).', '.(8);
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}

function obtenirNbDefauts()
{
	require "connexion.php";
	$sql = "select count(dft_id) from defaut";
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetch();
	return $result[0];
}

function obtenirNbDefautsFiltre($projet,$vague,$support,$zone,$element,$type,$elementNITG,$typePheno)
{
	require "connexion.php";
	$sql = 'select count(*)';
			$sql .= ' from defaut as dft '
			.'left outer join element as elm on elm.elm_num = dft.elm_num '
			.'left outer join zone as zne on zne.zne_num = elm.zne_num '
			.'inner join criticite as crt on crt.crt_id = dft.crt_id '
			.'inner join support on sup_id = dft_sup_id '
			.'inner join vague on jln_id = sup_jln_id '
			.'inner join projet on prj_id = jln_prj_id '
			.'left outer join elementnitg on NITG_num = dft_NITG_num '
			.'left outer join typepheno on phe_num = dft_phe_num '
			.'left outer join denomination as nom on nom.nom_id = dft_nom_id '
			.'inner join utilisateur as ult on ult.ipn = dft.ipn ';
			if(!empty($projet)) 
			{ 
				$sql .= 'where (prj_id = '.$projet[0];
				foreach($projet as $unProjet)
				{
					if($unProjet != $projet[0])
					{
						$sql .= ' or prj_id ='.$unProjet;
					}
				}
				$sql .= ')';
			}
			if(!empty($elementNITG))
			{
				$sql .= ' and (dft_NITG_num = '.$elementNITG[0];
				foreach($elementNITG as $unNITG)
				{
					if($unNITG != $elementNITG[0])
					{
						$sql .= ' or dft_NITG_num ='.$unNITG;
					}
				}
				$sql .= ')';
			}
			if(!empty($typePheno))
			{
				$sql .= ' and (dft_phe_num = '.$typePheno[0];
				foreach($typePheno as $unPheno)
				{
					if($unPheno != $typePheno[0])
					{
						$sql .= ' or dft_phe_num ='.$unPheno;
					}
				}
				$sql .= ')';
			}
			if(!empty($type))
			{
				$sql .= ' and (nom_id ='.$type[0];
				foreach($type as $leType)
				{
					if($leType != $type[0])
					{
						$sql .= ' or nom_id = '.$leType;
					}
				}
				$sql .= ')';
			}
			if(!empty($vague)) 
			{ 
				$sql .= ' and (jln_id = '.$vague[0];
				foreach($vague as $uneVague)
				{
					if($uneVague != $vague[0])
					{
						$sql .= ' or jln_id ='.$uneVague;
					}
				}
				$sql .= ')';
			}
			if(!empty($zone)) 
			{ 
				if(empty($projet)) 
				{ 
					$sql .= 'where (zne.zne_num = '.$zone[0]; 
				} 
				else 
				{ 
					$sql .= ' and (zne.zne_num = '.$zone[0]; 
				}
				foreach($zone as $uneZone)
				{
					if($zone[0] != $uneZone)
					{
						$sql .= ' or zne.zne_num = '.$uneZone;
					}
				}
				$sql .= ')';
			}
			if(!empty($element)) {
				foreach($element as $leElement)
				{
						if($leElement == $element[0])
						{
							$sql .= ' and '; if(count($element) > 1) { $sql .= ' ('; }$sql .= 'elm.elm_num = '.$leElement;
						}
						else 
						{
							$sql .= ' or elm.elm_num = '.$leElement;
						}
				}
				if(count($element) > 1) { $sql .= ')'; }
			}
			if(!empty($support)) {
				foreach($support as $leSupport)
				{
					if($leSupport == $support[0])
					{
						$sql .= ' and '; if(count($support) > 1) { $sql .= ' ('; } $sql .= 'dft_sup_id = '.$leSupport;
					}
					else 
					{
						$sql .= ' or dft_sup_id = '.$leSupport;
					}
				}
				if(count($support) > 1) { $sql .= ')'; }
			}
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetch();
	return $result[0];
}

function obtenirDefaut($id)
{
	require "connexion.php";
	$sql = 'select dft_nom_id,dft_id,dft_km,dft_cycle,dft.ipn,date_format((dft_date), "%d/%m/%Y") as dft_date,dft_commentaire,zne_libelle,elm_libelle,prj_nom,jln_nom,sup_nom,nom,prenom,crt_libelle,';
			if($_COOKIE['lang'] == "ENG")
			{
				$sql .= ' nom_libelle_eng as nom_libelle,elm_libelle_eng as elm_libelle, NITG_libelle_eng as NITG_libelle, phe_libelle_eng as phe_libelle';
			}
			else
			{
				$sql .= ' nom_libelle,elm_libelle, NITG_libelle, phe_libelle';
			}
			$sql .= ' from defaut as dft '
			.'left outer join element as elm on elm.elm_num = dft.elm_num '
			.'left outer join zone as zne on zne.zne_num = elm.zne_num '
			.'inner join criticite as crt on crt.crt_id = dft.crt_id '
			.'inner join support on sup_id = dft_sup_id '
			.'inner join vague on jln_id = sup_jln_id '
			.'inner join projet on prj_id = jln_prj_id '
			.'left outer join elementnitg on NITG_num = dft_NITG_num '
			.'left outer join typepheno on phe_num = dft_phe_num '
			.'left outer join denomination as nom on nom.nom_id = dft_nom_id '
			.'inner join utilisateur as ult on ult.ipn = dft.ipn '
			.'where dft_id = '.$id;
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetch();
	return $result;
}


function obtenirPhoto($id)
{
    require "connexion.php";
	$sql = 'select * from photo where pht_dft_id = '.$id;
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}
function supportViaProjetVague($id)
{
	require "connexion.php";
	$sql = 'select * from support where sup_jln_id = '.$id
			.' order by sup_nom';
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}

function obtenirZones()
{
	require "connexion.php";
	if($_COOKIE['lang'] == "ENG")
	{
		$sql = 'select zne_num,zne_libelle_eng as zne_libelle from zone ';
	}
	else
	{
		$sql = 'select zne_num,zne_libelle from zone ';
	}
	$sql .= 'order by zne_libelle';
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}

function obtenirElementViaZone($id)
{
	require "connexion.php";
	if($_COOKIE['lang'] == "ENG")
	{
		$sql = 'select elm_num,elm_libelle_eng as elm_libelle from element where zne_num ='.$id.' order by elm_libelle';
	}
	else
	{
		$sql = 'select elm_num,elm_libelle from element where zne_num ='.$id.' order by elm_libelle';
	}
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}

function obtenirNomProjet($id)
{
	require "connexion.php";
	$sql = 'select prj_nom from projet where prj_id ='.$id;
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetch();
	return $result;
}

function obtenirNomVague($id)
{
	require "connexion.php";
	$sql = 'select jln_nom from vague where jln_id ='.$id;
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetch();
	return $result;
}

function obtenirNomZone($id)
{
	require "connexion.php";
	$sql = 'select zne_libelle from zone where zne_num ='.$id;
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetch();
	return $result;
}

function obtenirElementNITG()
{
	require "connexion.php";
	if($_COOKIE['lang'] == "ENG")
	{
		$sql = 'select NITG_num,NITG_libelle_eng as NITG_libelle from elementnitg order by NITG_libelle';
	}
	else
	{
		$sql = 'select NITG_num,NITG_libelle from elementnitg order by NITG_libelle';
	}
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}

function obtenirTypesPheno()
{
	require "connexion.php";
	if($_COOKIE['lang'] == "ENG")
	{
		$sql = 'select phe_num,phe_libelle_eng as phe_libelle from typepheno order by phe_libelle ';
	}
	else
	{
		$sql = 'select phe_libelle,phe_num from typepheno order by phe_libelle ';
	}
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}
function defautsViaFiltreSupport($projet,$vague,$support,$zone,$element,$type,$elementNITG,$typePheno,$limite)
{
	require "connexion.php";
	$sql = 'select dft_nom_id,dft_id,dft_km,dft_cycle,dft.ipn,date_format((dft_date), "%d/%m/%Y") as dft_date,dft_commentaire,zne_libelle,elm_libelle,prj_nom,jln_nom,sup_nom,nom,prenom,crt_libelle,';
			if($_COOKIE['lang'] == "ENG")
			{
				$sql .= ' nom_libelle_eng as nom_libelle,elm_libelle_eng as elm_libelle, NITG_libelle_eng as NITG_libelle, phe_libelle_eng as phe_libelle';
			}
			else
			{
				$sql .= ' nom_libelle,elm_libelle, NITG_libelle, phe_libelle';
			}
			$sql .= ' from defaut as dft '
			.'left outer join element as elm on elm.elm_num = dft.elm_num '
			.'left outer join zone as zne on zne.zne_num = elm.zne_num '
			.'inner join criticite as crt on crt.crt_id = dft.crt_id '
			.'inner join support on sup_id = dft_sup_id '
			.'inner join vague on jln_id = sup_jln_id '
			.'inner join projet on prj_id = jln_prj_id '
			.'left outer join elementnitg on NITG_num = dft_NITG_num '
			.'left outer join typepheno on phe_num = dft_phe_num '
			.'left outer join denomination as nom on nom.nom_id = dft_nom_id '
			.'inner join utilisateur as ult on ult.ipn = dft.ipn ';
			if(!empty($projet)) 
			{ 
				$sql .= 'where (prj_id = '.$projet[0];
				foreach($projet as $unProjet)
				{
					if($unProjet != $projet[0])
					{
						$sql .= ' or prj_id ='.$unProjet;
					}
				}
				$sql .= ')';
			}
			if(!empty($elementNITG))
			{
				$sql .= ' and (dft_NITG_num = '.$elementNITG[0];
				foreach($elementNITG as $unNITG)
				{
					if($unNITG != $elementNITG[0])
					{
						$sql .= ' or dft_NITG_num ='.$unNITG;
					}
				}
				$sql .= ')';
			}
			if(!empty($typePheno))
			{
				$sql .= ' and (dft_phe_num = '.$typePheno[0];
				foreach($typePheno as $unPheno)
				{
					if($unPheno != $typePheno[0])
					{
						$sql .= ' or dft_phe_num ='.$unPheno;
					}
				}
				$sql .= ')';
			}
			if(!empty($type))
			{
				$sql .= ' and (nom_id ='.$type[0];
				foreach($type as $leType)
				{
					if($leType != $type[0])
					{
						$sql .= ' or nom_id = '.$leType;
					}
				}
				$sql .= ')';
			}
			if(!empty($vague)) 
			{ 
				$sql .= ' and (jln_id = '.$vague[0];
				foreach($vague as $uneVague)
				{
					if($uneVague != $vague[0])
					{
						$sql .= ' or jln_id ='.$uneVague;
					}
				}
				$sql .= ')';
			}
			if(!empty($zone)) 
			{ 
				if(empty($projet)) 
				{ 
					$sql .= 'where (zne.zne_num = '.$zone[0]; 
				} 
				else 
				{ 
					$sql .= ' and (zne.zne_num = '.$zone[0]; 
				}
				foreach($zone as $uneZone)
				{
					if($zone[0] != $uneZone)
					{
						$sql .= ' or zne.zne_num = '.$uneZone;
					}
				}
				$sql .= ')';
			}
			if(!empty($element)) {
				foreach($element as $leElement)
				{
						if($leElement == $element[0])
						{
							$sql .= ' and '; if(count($element) > 1) { $sql .= ' ('; }$sql .= 'elm.elm_num = '.$leElement;
						}
						else 
						{
							$sql .= ' or elm.elm_num = '.$leElement;
						}
				}
				if(count($element) > 1) { $sql .= ')'; }
			}
			if(!empty($support)) {
				foreach($support as $leSupport)
				{
					if($leSupport == $support[0])
					{
						$sql .= ' and '; if(count($support) > 1) { $sql .= ' ('; } $sql .= 'dft_sup_id = '.$leSupport;
					}
					else 
					{
						$sql .= ' or dft_sup_id = '.$leSupport;
					}
				}
				if(count($support) > 1) { $sql .= ')'; }
			}
			$sql .= ' limit '.($limite - 8).', '.(8);
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}

function supprimerDefaut($id)
{
	require "connexion.php";
	$sql = 'delete from effectuer where dft_id = '.$id.'; delete from photo where pht_dft_id = '.$id.'; delete from defaut where dft_id = '.$id;
	$exec=$bdd->prepare($sql);
	$exec->execute();
}

function obtenirDernierIdDefaut()
{
	require "connexion.php";
	$sql = 'select MAX(dft_id) from defaut';
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetch();
	return $result[0];
}

function dernierId()
{
	require "connexion.php";
	$sql = 'select MAX(pht_id) from photo';
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetch();
	return $result[0];
}

function obtenirEssais()
{
	require "connexion.php";
	$sql = 'select * from essai'
			.' order by ess_libelle';
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}

function obtenirEssaisDefaut($id)
{
	require "connexion.php";
	$sql = 'select * from essai '
			.'inner join effectuer as eff on cyl_num = ess_num '
			.'where dft_id = '.$id
			.' order by ess_libelle';
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}

function obtenirPhotosElementType($id,$type)
{
	require "connexion.php";
	$sql = 'select * from photo as pht '
			.'inner join defaut as dft on dft.dft_id = pht.dft_id '
			.'where elm_num ='.$id.' '
			.'and dft_nom_id = '.$type;
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}

function obtenirCriticites()
{
	require "connexion.php";
	$sql = 'select * from criticite ';
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}

function ajoutPhoto($photo,$id)
{
	require "connexion.php";
	$sql = 'insert into photo(pht_nom,pht_dft_id) values("'.$photo.'",'.$id.')';
	$exec=$bdd->prepare($sql);
	if($exec->execute())
		return true;
	else
		return false;
}

function ajouterDefaut($support,$zone,$element,$criticite,$type,$usage,$usageNombre,$date,$commentaire,$elementNITG,$typePheno)
{
	$km = $usageNombre;
	$cycle = $usageNombre;
	if($usage == "km" ) { $km = $usageNombre; $cycle = "null"; } else { $km = "null"; $cycle = $usageNombre; }
	require "connexion.php";
	$sql = 'insert into defaut values(null,'.$km.',"'.$date.'","'.$commentaire.'",'.$cycle.','.$support.',"'.$_SESSION['ipn'].'",'.$type.','.$criticite.','.$element.','.$zone.','.$elementNITG.','.$typePheno.')';
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $bdd->lastInsertId();
}

function insertDefaut($usage,$date,$commentaire,$support,$ipn,$type,$cotation,$element,$zone,$NITG,$PHENO,$essais,$photos)
{
	if($usage > 200 ) { $km = $usage; $cycle = "null"; } else { $km = "null"; $cycle = $usage; }
	if(empty($PHENO)) { $PHENOA = "null"; } else { $PHENOA = '"'.$PHENO.'"'; }
	if(empty($NITG)) { $NITGA = "null"; } else { $NITGA = '"'.$NITG.'"'; }
	if(empty($element)) { $element = "null"; }
	if(empty($zone)) { $zone = "null"; }
	if(empty($type)) { $type = "null"; }
	require "connexion.php";
	$date = str_replace("/","-",$date);
	$dateA = substr($date,6,4).'-'.substr($date,3,2).'-'.substr($date,0,2);
	$sql = 'insert into defaut values(null,'.$km.',"'.$dateA.'","'.$commentaire.'",'.$cycle.','.$support.',"'.$ipn.'",'.$type.','.$cotation.','.$element.','.$zone.','.$NITGA.','.$PHENOA.');';
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$sql = "";
	$idDefaut = $bdd->lastInsertId();
	foreach($photos as $photo)
	{
		$sql .= ' insert into photo values(null,"'.$photo.'",'.$idDefaut.');';
	}
	$lesEssais = explode(",",$essais);
	foreach($lesEssais as $essai)
	{
		$sql .= ' insert into effectuer values('.$idDefaut.','.$essai.');';
	}
	$exec=$bdd->prepare($sql);
	if($exec->execute())
	{
		return true;
	}
	else
	{
		return false;
	}
}

function projetFromSupport($id)
{
	require "connexion.php";
	$sql = 'select prj_id from projet inner join vague on prj_id = jln_prj_id inner join support on jln_id = sup_jln_id where sup_id ='.$id;
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetch();
	return $result[0];
}

function ajouterEssai($idDefaut,$unEssai)
{
	require "connexion.php";
	$sql = 'insert into effectuer values('.$idDefaut.','.$unEssai.')';
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}

function deleteNotIn($tableau,$table)
{
	require "connexion.php";
	switch($table) {
		case "zone" : {
				// on précise la première valeur du tableau
				$sql = 'delete from zone where zne_num not in (select zne_num where zne_num = '.$tableau[0][0];
				// on retire la première valeur du tableau déjà indiquée dans la requête
				unset($tableau[0]);
				// Puis pour chaque valeur restante dans le tableau on indique celel-ci à la requête
				foreach($tableau as $leTableau)
				{
					$sql .= ' or zne_num = '.$leTableau[0];
				}
				$sql .= ' );';
			break;
		}
		
		case "element" : {
				$sql = 'delete from element where elm_num not in (select elm_num where elm_num = '.$tableau[0][1];
				unset($tableau[0]);
				foreach($tableau as $leTableau)
				{
					$sql .= ' or elm_num = '.$leTableau[1];
				}
				$sql .= ' );';
			break;
		}
		
		case "elementNITG" : {
				$sql = 'delete from elementnitg where NITG_num not in (select NITG_num where NITG_num = "'.$tableau[0][1].'"';
				unset($tableau[0]);
				foreach($tableau as $leTableau)
				{
					$sql .= ' or NITG_num = "'.$leTableau[1].'"';
				}
				$sql .= ' );';
			break;
		}
		
		case "essai" : {
				$sql = 'delete from essai where ess_num not in (select ess_num where ess_num = '.$tableau[0][0];
				unset($tableau[0]);
				foreach($tableau as $leTableau)
				{
					$sql .= ' or ess_num = '.$leTableau[0];
				}
				$sql .= ' );';
			break;
		}
		
		case "type" : {
				$sql = 'delete from denomination where nom_id not in (select nom_id where nom_id = '.$tableau[0][0];
				unset($tableau[0]);
				foreach($tableau as $leTableau)
				{
					$sql .= ' or nom_id = '.$leTableau[0];
				}
				$sql .= ' );';
			break;
		}
		
		case "typePheno" : {
				$sql = 'delete from typepheno where phe_num not in (select phe_num where (phe_num = '.$tableau[0][0];
				unset($tableau[0]);
				foreach($tableau as $leTableau)
				{
					$sql .= ' or phe_num = '.$leTableau[0];
				}
				$sql .= ' ));';
			break;
		}
		
		case "criticite" : {
			$sql = 'delete from criticite where crt_num not in (select crt_num where crt_num = '.$tableau[0][0];
				unset($tableau[0]);
				foreach($tableau as $leTableau)
				{
					$sql .= ' or crt_num = '.$leTableau[0];
				}
				$sql .= ' );';
			break;
		}
		
		case "projet" : {
				$sql = 'delete from projet where prj_id not in (select prj_id where prj_id = '.$tableau[0][0];
				unset($tableau[0]);
				foreach($tableau as $leTableau)
				{
					$sql .= ' or prj_id = '.$leTableau[0];
				}
				$sql .= ' );';
			break;
		}
		case "vague" : {
			$sql = 'delete from vague where jln_id not in (select jln_id where jln_id = '.$tableau[0][1];
				unset($tableau[0]);
				foreach($tableau as $leTableau)
				{
					$sql .= ' or jln_id = '.$leTableau[1];
				}
				$sql .= ' );';
			break;
		}
		case "support" : {
			$sql = 'delete from support where sup_id not in (select sup_id where sup_id = '.$tableau[0][2];
				unset($tableau[0]);
				foreach($tableau as $leTableau)
				{
					$sql .= ' or sup_id = '.$leTableau[2];
				}
				$sql .= ' );';
			break;
		}
	}
	$exec=$bdd->prepare($sql);
	$result = $exec;
	if($exec->execute())
		return true;
	else
		return false;
}
function updateTable($tableau,$table)
{
	require "connexion.php";
	// tableau contient la ligne à insérer dans la bdd
	// table contient le nom du type de donnée à modifier
	switch($table) {
		case "zone" : {
				$sql = 'insert into zone(zne_num,zne_libelle,zne_libelle_eng) values('.$tableau[0].',"'.$tableau[1].'","'.$tableau[2].'") on duplicate key update zne_libelle = values(zne_libelle), zne_libelle_eng = values(zne_libelle_eng);';
			break;
		}
		
		case "element" : {
				$sql = 'insert into element(zne_num,elm_num,elm_libelle,elm_libelle_eng) values('.$tableau[0].','.$tableau[1].',"'.$tableau[2].'","'.$tableau[3].'") on duplicate key update elm_libelle = values(elm_libelle), elm_libelle_eng = values(elm_libelle_eng);';
			break;
		}
		
		case "essai" : {
				$sql = 'insert into essai(ess_num,ess_libelle) values('.$tableau[0].',"'.$tableau[1].'") on duplicate key update ess_libelle = values(ess_libelle);';
			break;
		}
		
		case "type" : {
				$sql = 'insert into denomination(nom_id,nom_libelle,nom_libelle_eng) values('.$tableau[0].',"'.$tableau[1].'","'.$tableau[2].'") on duplicate key update nom_libelle = values(nom_libelle), nom_libelle_eng = values(nom_libelle_eng);';
			break;
		}
		
		case "criticite" : {
				$sql = 'insert into criticite(crt_id,crt_libelle) values('.$tableau[0].',"'.$tableau[1].'") on duplicate key update crt_libelle = values(crt_libelle);';
			break;
		}
		
		case "projet" : {
				$sql = 'insert into projet(prj_id,prj_nom) values('.$tableau[0].',"'.$tableau[1].'") on duplicate key update prj_nom = values(prj_nom);';
			break;
		}
		case "vague" : {
				$sql = 'insert into vague(jln_id,jln_nom,jln_prj_id) values('.$tableau[0].',"'.$tableau[1].'","'.$tableau[2].'") on duplicate key update jln_nom = values(jln_nom);';
			break;
		}
		
		case "elementNITG" : {
				$sql = 'insert into elementnitg(NITG_num,NITG_libelle,NITG_libelle_eng) values("'.$tableau[0].'","'.$tableau[1].'","'.$tableau[2].'") on duplicate key update NITG_libelle = values(NITG_libelle), NITG_libelle_eng = values(NITG_libelle_eng);';
			break;
		}
		
		case "typePheno" : {
				$sql = 'insert into typepheno(phe_num,phe_libelle,phe_libelle_eng) values("'.$tableau[0].'","'.$tableau[1].'","'.$tableau[2].'") on duplicate key update phe_libelle = values(phe_libelle),phe_libelle_eng = values(phe_libelle_eng);';
			break;
		}
		
		case "support" : {
				$sql = 'insert into support(sup_id,sup_nom,sup_jln_id) values('.$tableau[0].',"'.$tableau[1].'",'.$tableau[2].') on duplicate key update sup_nom = values(sup_nom);';
			break;
		}
	}
	$exec=$bdd->prepare($sql);
	if($exec->execute())
	{
		return true;
	}
	else
	{
		return false;
	}
}

function obtenirComptes()
{
	require "connexion.php";
	$sql = 'select * from utilisateur';
	$exec=$bdd->prepare($sql);
	$exec->execute();
	$result = $exec->fetchAll();
	return $result;
}

function supprimerUtilisateur($ipn)
{
	require "connexion.php";
	$sql = 'delete from utilisateur where ipn = "'.$ipn.'"';
	$exec=$bdd->prepare($sql);
	if($exec->execute())
		return true;
	else
		return false;
}

function updateUtilisateur($ipn,$nom,$prenom,$habilitation,$mdp,$trueIpn)
{
	require "connexion.php";
	$sql = 'SET FOREIGN_KEY_CHECKS = 0; '
			.'update utilisateur set ipn ="'.$ipn.'", nom = "'.$nom.'", prenom = "'.$prenom.'", habilitation = '.$habilitation.', mdp = "'.$mdp.'" where ipn = "'.$trueIpn.'"; '
			.'update defaut set ipn = "'.$ipn.'" where ipn = "'.$trueIpn.'"; '
			.'SET FOREIGN_KEY_CHECKS = 1;';
	$exec=$bdd->prepare($sql);
	if($exec->execute())
		return true;
	else
		return false;
}

function addCompte($ipn,$nom,$prenom,$habilitation,$mdp)
{
	require "connexion.php";
	$sql = 'insert into utilisateur values("'.$ipn.'","'.$nom.'","'.$prenom.'","'.$mdp.'",'.$habilitation.');';
	$exec=$bdd->prepare($sql);
	if($exec->execute())
		return true;
	else
		return false;
}
