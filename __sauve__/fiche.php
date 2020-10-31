<?php

//Connexion BDD
require_once "db_connect.php";
require_once "functions.php";
require_once "class_livre.php";

/* PHASE LOGIQUE = on traite les données puis on prépare les données pour l'affichage */

if (!empty($_POST)) {
	//création variables
	$livre = new Livre();
	
	//$livre->titre = addslashes(assainit_texte("titre"));
	$livre->setTitre("titre");
	$livre->setDateEdition("date_edition");
	$livre->setResume("resume");
	$livre->setNote("note");
	$livre->setId("id");
	
	if ($id) {
		//edition
		$requete = "UPDATE livre SET titre=?, date_edition=?, resume=?, note=? WHERE ID=?";
		$stmt = $GLOBALS['lien_bdd']->prepare($requete);
		
		$stmt->bind_param("sssii", $r_titre, $r_date_edition, $r_resume, $r_note, $r_id);
		$r_titre = $livre->titre;
		$r_date_edition = $livre->getDateFormatSql();
		$r_resume = $livre->resume;
		$r_note = $livre->note;
		$r_id = $livre->id;
		
		$stmt->execute();
		$stmt->close();
	} else {
		//creation
		$requete = "INSERT INTO livre (titre, date_edition, resume, note) VALUES (?, ?, ?, ?)";
		$stmt = $GLOBALS['lien_bdd']->prepare($requete);
		
		$stmt->bind_param("sssi", $r_titre, $r_date_edition, $r_resume, $r_note);
		$r_titre = $livre->titre;
		$r_date_edition = $livre->getDateFormatSql();
		$r_resume = $livre->resume;
		$r_note = $livre->note;
		
		$stmt->execute();
		$livre->id = $stmt->insert_id;
		$stmt->close();
	}
	
	header("Location: fiche.php?id=$id");
}

if (!empty($_GET['id'])) {
	//Récuperer les infos depuis la BDD
	$id = intval($_GET['id']);
	
	$livre = Livre::loadUnLivre($id);
}

/* PHASE RENDU */

require_once "html_avant.php";
?>
<form method="POST">
	<input type="text" name="titre" placeholder="Titre" value="<?php if (isset($livre)) { echo $livre->titre; } ?>" />
	<input type="date" name="date_edition" placeholder="Date d'édition" value="<?php if (isset($livre)) { echo $livre->getDateFormatSql(); } ?>" />
	<input type="number" name="note" placeholder="Note / 5" value="<?php if (isset($livre)) { echo $livre->note; } ?>" />
	<textarea name="resume" placeholder="Résumé..."><?php if (isset($livre)) { echo $livre->resume; } ?></textarea>
	<input type="hidden" name="id" value="<?php if (isset($livre)) { echo $livre->id; } ?>" />
	<input type="submit" />
</form>
<?php
require_once "html_apres.php";
?>