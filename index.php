<?php

//Connexion BDD ---------------------
require_once "db_connect.php";

// --------------  -  ----------------

require_once "functions.php";
require_once "class_eleve.php";

// --------------  -  ----------------

require_once "tools/outils__perso__jonas__.php";

// --------------  -  ----------------


/* PHASE LOGIQUE = on traite les données puis on prépare les données pour l'affichage */

//$livres = recupere_bdd_plusieurs("SELECT * FROM livre");
$eleve = array();

$requete = "SELECT id, nom, prenom, date_naissance, moyenne, appreciation FROM eleve";
$stmt = $GLOBALS['lien_bdd']->prepare($requete);
$stmt->execute();
$stmt->bind_result($res_id, $res_nom, $res_prenom, $res_date_naissance, $res_moyenne, $res_appreciation);
while ($stmt->fetch()) {
	$eleve[] = eleve::construit_params($res_id, $res_nom, $res_prenom, $res_date_naissance, $res_moyenne, $res_appreciation);
}

/* PHASE RENDU */

require_once "html_avant.php";
// --------------    ----------------

?>
<a href="fiche_eleve.php">Créer un élève</a>
<table>
	<thead>
		<tr>
			<th>NOM</th>
			<th>Prénom</th>
			<th>Date de naissance</th>
			<th>Moyenne</th>
			<th>Appréciation</th>
		</tr>
	</thead>
	<tbody>
		
<?php for ($i=0; $i<count($eleve); $i++) { ?>
		<tr>
			<td><?= $eleve[$i]->getNomMajuscule() ?></td>
			<td><?= $eleve[$i]->prenom ?></td>
			<td><?= $eleve[$i]->date_naissance->format("d/m/Y") ?></td>
			<td><?= $eleve[$i]->moyenne ?></td>
			<td><?= $eleve[$i]->appreciation ?></td>
		</tr>
<?php } ?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>NOM</th>
			<th>Prénom</th>
			<th>Date de naissance</th>
			<th>Moyenne</th>
			<th>Appréciation</th>
		</tr>
	</tfoot>
</table>
<?php

// --------------    ----------------
require_once "html_apres.php";
?>

	
	
	
