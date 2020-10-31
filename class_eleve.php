<?php

class eleve {
	public $id;
	public $nom;
	public $prenom;
	public $appreciation;
	public $moyenne;
	public $date_naissance;
	
	function __construct() {
		$this->id = 0;
		$this->nom = "";
		$this->prenom = "";
		$this->date_naissance = new DateTime();
		$this->moyenne = 0;
		$this->appreciation = "";

		require_once "functions.php";
		
	}
	
	public static function construit_params($id, $nom, $prenom, $date_naissance, $moyenne, $appreciation) {
		$ecole = new eleve();
		
		$ecole->id = $id;
		$ecole->nom = $nom;
		$ecole->prenom = $prenom;
		$ecole->date_naissance = new DateTime($date_naissance);
		$ecole->moyenne = $moyenne;
		$ecole->appreciation = $appreciation;
		
		return $ecole;
	}
	
	public static function loadUnEleve($id) {
		$ecole = new eleve();
		
		//sql
		$requete = "SELECT nom, prenom, date_naissance, moyenne, appreciation FROM ecole WHERE id=?";
		$stmt = $GLOBALS['lien_bdd']->prepare($requete);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$stmt->bind_result($nom, $prenom, $date_naissance, $moyenne, $appreciation);
		$stmt->fetch();
		$ecole->id = $id;
		$ecole->nom = $nom;
		$ecole->prenom = $prenom;
		$ecole->date_naissance = new DateTime($date_naissance);
		$ecole->moyenne = $moyenne;
		$ecole->appreciation = $appreciation;
		
		return $ecole;
	}
	
	
	public function getNomMajuscule() {
		return strtoupper($this->nom);
	}
	
	public function getDateFormatSql() {
		return $this->date_naissance->format("Y-m-d");
	}
	
	public function setNom($nom) {
			$this-$nom = assainit_texte($nom);
	}
	
	public function setPrenom($prenom) {
		$this-$prenom = assainit_texte($prenom);
}

	public function setDateNaissance($date_naissance) {
			$this->date_naissance = new DateTime(assainit_texte($date_naissance));
	}
	
	public function setAppreciation($appreciation) {
			$this->appreciation = assainit_texte($appreciation);
	}
	
	public function setMoyenne($moyenne) {
			$this->moyenne = assainit_entier($moyenne);
	}
	
	public function setId($id) {
			$this->id = assainit_entier($id);
	}
}