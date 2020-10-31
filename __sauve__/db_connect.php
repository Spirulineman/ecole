<?php

class db_connect { // on déclare la classe 
    
    // les variables : mettre en public => plus efficacce pour l'interpréteur 
    Public $sql_host = "127.0.0.1"; 
    Public $sql_login = "root";
    Public $sql_pwd = "";
    Public $sql_db = "bibliotheque";
    public $var_db_connect; // !! ON OUBLIE PAS !!  la variable qui permet de créer l'objet qui sera appelé

    function lien_bdd(){ // la fonction qui va exécuter les instructions de connexion avec les valeurs des variables 

    // le return + $this (db_connect = classe) -> envoi dans la (variable) var_db_connect le résultat de l'ensemble des valeurs des variables, elles mêmes instanciées par le $this->

    return $this->var_db_connect = mysqli_connect($this->sql_host, $this->sql_login, $this->sql_pwd, $this->sql_db);

    }
}

          /*    ---   Pour appeler la classe dans un autre fichiers ---    /*


            ----->>>     require_once "config/db_connect.php";
            
                require_once "tools/outils__perso__jonas__.php";

            ----->>>         $lien_bdd = new db_connect();
            ----->>>         $lien_bdd = $lien_bdd->lien_bdd();

                pre_var_dump($lien_bdd);

          */  