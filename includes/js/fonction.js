
function trierParProjet( data )
{
	$.ajax({
// type d'envoi : GET signifie par que les données seront contenues dans l'URL
  type: "GET",
  // Lieu d'envoi des données
  url: "includes/traitement.php",
  // le type de données
  datatype: "html",
  // Déclaration des variable qui seront insérées dans l'URL
  data: "&action=projet&projet=" + data,
  // Si le serveur répond
  success: function ( datab ) {
				// la liste déroulante des vagues récupère les données
				$('#vague').html( datab );
				$('#support').html( "" );
				$('#supportAjout').html('<option value="">-- sélectionner --</option>');
				$("select").trigger('chosen:updated');
            } 
  });
}

function trierParProjetEtVague( data,data2 )
{
	$.ajax({
  type: "GET",
  url: "includes/traitement.php",
  datatype: "html",
  data: "&action=vague&projet=" + data + "&vague=" + data2,
  success: function ( datab ) {
				$('#supportAjout').html('<option value="">-- sélectionner --</option>' + datab );
				$('#support').html( datab );
				$("select").trigger('chosen:updated');
            }
  });
}

function trierParZone( data )
{
	$.ajax({
  type: "GET",
  url: "includes/traitement.php",
  datatype: "html",
  data: "&action=zone&zone=" + data,
  success: function ( datab ) {
				$('#elementAjout').html( '<option value="">-- sélectionner --</option>' + datab );
				$('#element').html( datab );
				$("select").trigger('chosen:updated');
            } 
  });
}

function supprimerDefaut( data )
{
	$.ajax({
  type: "GET",
  url: "includes/traitement.php",
  datatype: "html",
  data: "&action=defaut&id=" + data,
  success: function ( datab ) {
				$('#'+ data +'').fadeOut();
            } 
  });
}

function zip( data , datab )
{
	$.ajax({
  type: "GET",
  url: "includes/traitement.php",
  datatype: "html",
  data: "&action=download&type=" + data + "&element=" + datab,
  success: function ( datac ) {
				$('#download').html(datac);
            } 
  });
}

function inputUsage( data )
{
	$.ajax({
  type: "GET",
  url: "includes/traitement.php",
  datatype: "html",
  data: "&action=ajouterRadio&usage=" + data,
  success: function ( datac ) {
				if(datac == "km") { $('#usage').attr("placeholder",'nombre de km'); }
				else {	$('#usage').attr("placeholder",'nombre de cycles'); }
            } 
  });
}

function supprimerUtilisateur( data )
{
	$.ajax({
  type: "GET",
  url: "includes/traitement.php",
  datatype: "html",
  data: "&action=supprimerUtilisateur&utilisateur=" + data,
  success: function ( datab ) {
				$('#'+ data + '').fadeOut();
				$('#dialogue').html(datab);
            } 
  });
}

function modifier( data, datab, data2, data3, data4, data5, data6 )
{
	if(datab == "FR")
	{
		data.html('<td><input type="hidden" name="trueIpn" value="' + data6 + '" /><input value="' + data6 + '" name="ipn" /></td><td><input value="' + data2 + '" name="nom" /></td><td><input value="' + data3 + '" name="prenom" /></td><td><input value="' + data4 + '" name="mdp" /></td><td><input value="' + data5 + '" name="habilitation" /></td><td>None</td><td><button class="submitAdmin" type="submit">Valider</button></td>');
	}
	else
	{
		data.html('<td><input type="hidden" name="trueIpn" value="' + data6 + '" /><input value="' + data6 + '" name="ipn" /></td><td><input value="' + data2 + '" name="nom" /></td><td><input value="' + data3 + '" name="prenom" /></td><td><input value="' + data4 + '" name="mdp" /></td><td><input value="' + data5 + '" name="habilitation" /></td><td>None</td><td><button class="submitAdmin" type="submit">Submit</button></td>');
	}
}

function modifierDefaut( data )
{
	$.ajax({
  type: "GET",
  url: "includes/traitement.php",
  datatype: "html",
  data: "&action=modifierDefaut&defaut=" + data,
  success: function ( datab ) {
				$('#modifier').html( datab );
            } 
  });
}

function loadVague( data )
{
	$.ajax({
  type: "GET",
  url: "includes/traitement.php",
  datatype: "html",
  data: "&action=projetMulti&projet=" + data,
  success: function ( datab ) {
				$('#vague').html( datab );
				$("select").trigger('chosen:updated');
            } 
  });
}

function loadSupport( data )
{
	$.ajax({
  type: "GET",
  url: "includes/traitement.php",
  datatype: "html",
  data: "&action=vagueMulti&vague=" + data,
  success: function ( datab ) {
				$('#support').html( datab );
				$("select").trigger('chosen:updated');
            } 
  });
}

function loadElement( data )
{
	$.ajax({
  type: "GET",
  url: "includes/traitement.php",
  datatype: "html",
  data: "&action=zoneMulti&zone=" + data,
  success: function ( datab ) {
				$('#element').html( datab );
				$("select").trigger('chosen:updated');
            } 
  });
}

function test( data, data2 )
{
	$.ajax({
  type: "POST",
  url: "includes/traitement.php",
  datatype: "html",
  data: "action=affichage&defauts="+data+"&affichage="+data2,
  success: function ( datab ) {
				$('.defautsBox').html( datab );
            } 
  });
}

function useNITG()
{
	$('.baseMuse').fadeOut();
	$('.baseNITG').fadeIn();
	$("select").trigger('chosen:updated');
}

function useMuse()
{
	$('.baseMuse').fadeIn();
	$('.baseNITG').fadeOut();
	$("select").trigger('chosen:updated');
}
