<?php

/** Fonction qui renvoie un tableau contenant le résultat de la requête
 * function recupere_bdd_plusieurs($requete) {
*	//Variables
*	$donnees = array();
*
*	//Requete
*	$resultat = mysqli_query($GLOBALS['lien_bdd'], $requete);
*
*	//Parcours de la requête
*	//tant qu'il me renvoie la ligne suivante, on continue dans la boucle
*	while ($ligne_resultat = mysqli_fetch_assoc($resultat)) {
*		$donnees[] = $ligne_resultat;
*	}
*	
*	return $donnees;
*}**/

/*  function recupere_bdd_plusieurs($requete) {
	//Variables
	$donnees = array();

	//Requete
	$resultat = mysqli_query($GLOBALS['lien_bdd'], $requete);

	//Parcours de la requête
	//tant qu'il me renvoie la ligne suivante, on continue dans la boucle
	while ($ligne_resultat = mysqli_fetch_assoc($resultat)) {
		$donnees[] = $ligne_resultat;
	}
	
	return $donnees;
} */
require_once "db_connect.php";


class c_recupere_bdd_plusieurs {

	//Variables
	public $donnees = array();
	public $resultat;
	public $ligne_resultat;
	public $lien_bdd;
	
	
	function __construct() // j'utilise un constructeur pour la connexion bdd 
	{
		$db_connect = new db_connect();  // j'instancie la classe db_connect de db_connect.php
		$this->lien_bdd= $db_connect->lien_bdd(); // la fonction lien_bdd [conf les () !!] de db_connect.php est chargé de la valeur de la variable $db_connect contenant l'objet new db_connect(); traitée par la classe c_recupere_bdd_plusieurs dont l'objet lien_bdd est 
	}

	function recupere_bdd_plusieurs($requete) { // --- ici le paramètre $requete n'est pas utilisée mais sert dans le fichier qui appelle cette fonction : $livres = recupere_bdd_plusieurs("SELECT * FROM livre");
	
		//Requete
		return $this->resultat = mysqli_query($this->lien_bdd, $requete);

		//Parcours de la requête
		//tant qu'il me renvoie la ligne suivante, on continue dans la boucle
		while ($this->ligne_resultat = mysqli_fetch_assoc($this->resultat)) {
			$this->donnees = $this->ligne_resultat;
		}
	
		return $this->donnees;
	}

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