<?php

/** 
 * $stmt = $mysqli->prepare("INSERT INTO CountryLanguage VALUES (?, ?, ?, ?)");
*  $stmt->bind_param('sssd', $code, $language, $official, $percent);
*
*   $code = 'DEU';
*   $language = 'Bavarian';
*   $official = "F";
*   $percent = 11.2;
*
* Exécution de la requête 
*     
*     $stmt->execute();
 * 
 * 
 * **/

/** Fonction qui renvoie un tableau contenant le résultat de la requête
**/
function recupere_bdd_plusieurs($requete) {
	//Variables
	$donnees = array();

	//Requete
	$stmt = $mysqli->prepare("INSERT INTO ")

	$resultat = mysqli_query($GLOBALS['lien_bdd'], $requete);

	//Parcours de la requête
	//tant qu'il me renvoie la ligne suivante, on continue dans la boucle
	while ($ligne_resultat = mysqli_fetch_assoc($resultat)) {
		$donnees[] = $ligne_resultat;
	}
	
	return $donnees;
}

/** Fonction qui renvoie le résultat de la requête
**/
function recupere_bdd_unseul($requete) {
	//Variables
	$donnees = NULL;

	//Requete
	$resultat = mysqli_query($GLOBALS['lien_bdd'], $requete);
	if (mysqli_num_rows($resultat)) {
		$ligne_resultat = mysqli_fetch_assoc($resultat);
		$donnees = $ligne_resultat;
	}
	
	return $donnees;
}

/** Fonction qui assainit les données depuis le POST
**/
function assainit_texte($cle) {
	if (isset($_POST[$cle])) {
		return htmlspecialchars(trim(strip_tags($_POST[$cle])));
	}
	return "";
}

function assainit_entier($cle) {
	if (isset($_POST[$cle])) {
		return intval($_POST[$cle]);
	}
	return 0;
}