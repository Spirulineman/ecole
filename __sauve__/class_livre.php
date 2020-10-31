<?php

class Livre {
	public $id;
	public $titre;
	public $date_edition;
	public $resume;
	public $note;
	
	function __construct() {
		$this->id = 0;
		$this->titre = "";
		$this->date_edition = new DateTime();
		$this->resume = "";
		$this->note = 0;
	}
	
	public static function construit_params($id, $titre, $date_edition, $resume, $note) {
		$livre = new Livre();
		
		$livre->id = $id;
		$livre->titre = $titre;
		$livre->date_edition = new DateTime($date_edition);
		$livre->resume = $resume;
		$livre->note = $note;
		
		return $livre;
	}
	
	public static function loadUnLivre($id) {
		$livre = new Livre();
		
		//sql
		$requete = "SELECT titre, date_edition, resume, note FROM livre WHERE id=?";
		$stmt = $GLOBALS['lien_bdd']->prepare($requete);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$stmt->bind_result($titre, $date_edition, $resume, $note);
		$stmt->fetch();
		$livre->id = $id;
		$livre->titre = $titre;
		$livre->date_edition = new DateTime($date_edition);
		$livre->resume = $resume;
		$livre->note = $note;
		
		return $livre;
	}
	
	public function getTitreMajuscule() {
		return strtoupper($this->titre);
	}
	
	public function getDateFormatSql() {
		return $this->date_edition->format("Y-m-d");
	}
	
	public function setTitre($titre) {
			$this->titre = assainit_texte($titre);
	}
	
	public function setDateEdition($date_edition) {
			$this->date_edition = new DateTime(assainit_texte($date_edition));
	}
	
	public function setResume($resume) {
			$this->resume = assainit_texte($resume);
	}
	
	public function setNote($note) {
			$this->note = assainit_entier($note);
	}
	
	public function setId($id) {
			$this->id = assainit_entier($id);
	}
}