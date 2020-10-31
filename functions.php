<?php

/** Fonction qui renvoie un tableau contenant le résultat de la requête
**/
function recupere_bdd_plusieurs($requete) {
	//Variables
	$donnees = array();

	//Requete
	$resultat = $GLOBALS['lien_bdd']->query($requete);

	//Parcours de la requête
	//tant qu'il me renvoie la ligne suivante, on continue dans la boucle
	while ($ligne_resultat = $resultat->fetch_assoc()) {
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
	$resultat = $GLOBALS['lien_bdd']->query($requete);
	if ($resultat->num_rows) {
		$ligne_resultat = $resultat->fetch_assoc();
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