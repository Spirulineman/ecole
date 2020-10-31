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

if (!empty($_POST)) {
	//création variables
	$eleve = new eleve();
	
	//  ----------------------    --------------
	$eleve->setNom("nom");
	$eleve->setPrenom("prenom");
	$eleve->setDateNaissance("date_naissance");
	$eleve->setMoyenne("moyenne");
	$eleve->setAppreciation("appreciation");
	$eleve->setId("id");
	
	if ($id) {
		//   ---------------------------   edition   -----------------------------
		$requete = "UPDATE eleve SET nom=?, prenom=?, date_naissance=?, moyenne=?, appreciation=?, WHERE id=?";
		$stmt = $GLOBALS['lien_bdd']->prepare($requete);
		
//pre_var_dump($stmt);

		$stmt->bind_param("sssisi", $r_nom, $r_prenom, $r_date_naissance, $r_moyenne, $r_appreciation, $r_id);
		$r_nom = $eleve->nom;
		$r_prenom = $eleve->prenom;
		$r_date_naissance = $eleve->getDateFormatSql();
		$r_moyenne = $eleve->moyenne;
		$r_appreciation = $eleve->appreciation;
		$r_id = $eleve->id;

//pre_var_dump($r_nom);
		
		$stmt->execute();
		$stmt->close();
	} else {

		//    ----------------------    creation   -----------------------------
		$requete = "INSERT INTO eleve (nom, prenom, date_naissance, moyenne, appreciation) VALUES (?, ?, ?, ?, ?)";
		$stmt = $GLOBALS['lien_bdd']->prepare($requete);
		
	pre_var_dump($stmt);

		$stmt->bind_param("sssis", $r_nom, $r_prenom, $r_date_naissance, $r_moyenne, $r_appreciation);
		$r_nom = $eleve->nom;
		$r_prenom = $eleve->prenom;
		$r_date_naissance = $eleve->getDateFormatSql();
		$r_moyenne = $eleve->moyenne;
		$r_appreciation = $eleve->appreciation;
		$r_id = $eleve->id;
		
		$stmt->execute();
		
		print_r($stmt->errorInfo());//---recherche erreur  ----------------
		//---recherche erreur  ----------------
		// $stmt->error;
		// printf("Erreur : %s.\n", $stmt->error);
		//---recherche erreur  ----------------

		$eleve->id = $stmt->insert_id;
		$stmt->close();
	}
// -------------   ERREUR ---- PDO  ----------
// try {
//     $db = new PDO('mysql:host=localhost;dbname=ecole', $sql_login, $sql_pwd);
//     } 
//         catch(PDOException $e) {
//         die('Erreur : '.$e->getMessage()); 
//         }
//
// -------------   ERREUR ---- PDO  ----------


header("Location: fiche_eleve.php?id=$id");
}

if (!empty($_GET['id'])) {
	//Récuperer les infos depuis la BDD
	$id = intval($_GET['id']);
	
	$eleve = eleve::loadUnEleve($id);
}

/* PHASE RENDU */

require_once "html_avant.php";
?>
<form method="POST">
	<input type="text" name="nom" placeholder="NOM" value="<?php if (isset($eleve)) { echo $eleve->nom; } ?>" />
	<input type="text" name="prenom" placeholder="Prénom" value="<?php if (isset($eleve)) { echo $eleve->prenom; } ?>" />
	<input type="date" name="date_naissance" placeholder="Date de naissance" value="<?php if (isset($eleve)) { echo $eleve->getDateFormatSql(); } ?>" />
	<input type="number" name="moyenne" placeholder="Moyenne / 20" value="<?php if (isset($eleve)) { echo $eleve->moyenne; } ?>" />
	<textarea name="appreciation" placeholder="Appréciation"><?php if (isset($eleve)) { echo $eleve->appreciation; } ?></textarea>
	<input type="hidden" name="id" value="<?php if (isset($eleve)) { echo $eleve->id; } ?>" />
	<input type="submit" />
</form>
<?php
require_once "html_apres.php";
?>