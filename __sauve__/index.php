<?php

//Connexion BDD
require_once "db_connect.php";

// ------------------------------
require_once "functions.php";
require_once "tools/outils__perso__jonas__.php";
// ------------------------------
require_once "class_livre.php";

/* PHASE LOGIQUE = on traite les données puis on prépare les données pour l'affichage */

//$livres = recupere_bdd_plusieurs("SELECT * FROM livre");
$livres = array();

$requete = "SELECT id, titre, date_edition, resume, note FROM livre";
$stmt = $GLOBALS['lien_bdd']->prepare($requete);
$stmt->execute();
$stmt->bind_result($res_id, $res_titre, $res_date_edition, $res_resume, $res_note);
while ($stmt->fetch()) {
	$livres[] = Livre::construit_params($res_id, $res_titre, $res_date_edition, $res_resume, $res_note);
}

/* PHASE RENDU */

require_once "html_avant.php";
?>
<a href="fiche.php">Créer un livre</a>
<table>
	<thead>
		<tr>
			<th>Titre</th>
			<th>Date d'édition</th>
			<th>Résumé</th>
		</tr>
	</thead>
	<tbody>
		
<?php for ($i=0; $i<count($livres); $i++) { ?>
		<tr>
			<td><?= $livres[$i]->getTitreMajuscule() ?></td>
			<td><?= $livres[$i]->date_edition->format("d/m/Y") ?></td>
			<td><?= $livres[$i]->resume ?></td>
		</tr>
<?php } ?>
		
	</tbody>
	<tfoot>
		<tr>
			<th>Titre</th>
			<th>Date d'édition</th>
			<th>Résumé</th>
		</tr>
	</tfoot>
</table>
<?php
require_once "html_apres.php";
?>
