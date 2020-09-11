<?php
	if(!isset($_REQUEST['page']))
	{
		$limite = 8;
	}
	else
	{
		$limite = 8 * $_REQUEST['page'];
	}
	if(isset($_REQUEST['test']))
	{
		echo $_REQUEST['test'];
	}
	if(isset($_REQUEST['action']))
	{
		if($_REQUEST['action']=="filtrer")
		{
			// on récupère les variables postées par le formulaire
			if(empty($_REQUEST['projet'])) { $projet = ""; } else { $projet = $_REQUEST['projet']; }
			if(empty($_REQUEST['vague'])) { $vague = ""; } else { $vague = $_REQUEST['vague']; }
			if(empty($_REQUEST['support'])) { $support = ""; } else { $support = $_REQUEST['support']; }
			if(empty($_REQUEST['zone'])) { $zone = ""; } else { $zone = $_REQUEST['zone']; }
			if(empty($_REQUEST['element'])) { $element = ""; } else { $element = $_REQUEST['element']; }
			if(empty($_REQUEST['type'])) { $type = ""; } else { $type = $_REQUEST['type']; }
			if(empty($_REQUEST['typePheno'])) { $typePheno = ""; } else { $typePheno = $_REQUEST['typePheno']; }
			if(empty($_REQUEST['elementNITG'])) { $elementNITG = ""; } else { $elementNITG = $_REQUEST['elementNITG']; }
			$defauts = defautsViaFiltreSupport($projet,$vague,$support,$zone,$element,$type,$elementNITG,$typePheno,$limite);
			$nbDefauts = obtenirNbDefautsFiltre($projet,$vague,$support,$zone,$element,$type,$elementNITG,$typePheno);
			// Le trie pour les essais et les types de défauts s'effectue dans le contrôleur
			if(isset($defauts))
			{
				if(!empty($_REQUEST['essai']))
				{
					$defautsTrie = [];
					$idx = 0;
					for($idx; $idx < count($defauts); $idx++)
					{
						// on effectue le même travail que pour les types de défauts
						$essaisDefauts = obtenirEssaisDefaut($defauts[$idx]['dft_id']);
						$trouve = false;
						$i = 0;
						while($i < count($essaisDefauts) and $trouve = false)
						{
							foreach($_REQUEST['essai'] as $essai)
							{
								if($essaisDefauts[$i]['ess_num'] == $essai)
								{
									$trouve = true;
								}
								else { $i++; }
							}
						}
						if($trouve)
						{
							$defautsTrie[] = $defauts[$idx];
						}
						
					}
					// Puis on remplace la listes des défauts par les défauts validés
					$defauts = $defautsTrie;
					
				}
			}
		}
	}
	else
	{
		$defauts = obtenirDefauts($limite);
		$nbDefauts = obtenirNbDefauts();
	}
	$elementsNITG = obtenirElementNITG();
	$projets = obtenirProjets();
	$essais = obtenirEssais();
	$zones = obtenirZones();
	$types = obtenirTypes();
	$typesPheno = obtenirTypesPheno();
	require "vues/v_recherche.php";