
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Photo-Fiab-Dura</title>
        <meta name="viewport" content="width=device-width">
		
		<link rel="icon" href="includes/img/favicon.ico" />
        <link rel="stylesheet" href="includes/css/chosen.css">
        <link rel="stylesheet" href="includes/css/style.css">
		<link rel="stylesheet" href="includes/css/font-awesome.min.css">
		
		<link rel="stylesheet" href="includes/css/bootstrap.css">
        <link rel="stylesheet" href="includes/css/bootstrap-responsive.css">
		<link rel="stylesheet" href="includes/css/magnific-popup.css">
        <link rel="stylesheet" href="includes/css/lightbox.min.css">
		<link rel="stylesheet" href="includes/css/nivo_themes/default/default.css">
        <link rel="stylesheet" href="includes/css/font-awesome.css">
		
    </head>
    <body>
		<nav>	
			<div id="logo">
				<div>
				</div>
				<div class="langageSelection">
					<a href="index.php?uc=accueil&action=langage&lang=ENG"><div id="england" class="countryFlag"></div></a>
					<p>|</p>
					<a href="index.php?uc=accueil&action=langage&lang=FR"><div id="france" class="countryFlag"></div></a>
				</div>
			</div>
			<header>
				<div id="header">
					<div class="links">
						<a href="index.php"><i class="fas fa-home fa-1x"></i></a>
						<div class="separateur"></div>
						<?php
							if(!empty($_SESSION))
							{
								echo '<a href="index.php?uc=ajouter&envoi=formulaire">'.$ajouter.'</a>'
										.'<div class="separateur"></div>'
									.'<a href="index.php?uc=recherche&affichage=bloc">'.$rechercher.'</a>'
										.'<div class="separateur"></div>';
								if($_SESSION['habilitation'] == 1 or $_SESSION['habilitation'] == 2)
								{
									echo '<a href="index.php?uc=administration">'.$admin.'</a>'
										.'<div class="separateur"></div>';
								}
							}
							
						?>
						<a href="index.php?uc=accueil&action=apropos"><?php echo $propos; ?></a>
						<div class="separateur"></div>
						<?php
						if(!empty($_SESSION))
						{
							echo '<a href="index.php?uc=accueil&action=deconnexion">'.$deconnexion.'</a>';
						}
						?>
					</div>
					<div>
						<img id="logo" src="includes/img/logo.png" />
					</div>
				</div>
			</header>
		</nav>