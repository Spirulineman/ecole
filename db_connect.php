<?php
$sql_host = "localhost";
$sql_login = "root";
$sql_pwd = "";
$sql_db = "ecole";

//Connexion
$GLOBALS['lien_bdd'] = new mysqli($sql_host, $sql_login, $sql_pwd, $sql_db);


// try {
            
//     //essai de se connecter a la base de donnee
//     $sql = new PDO('mysql:host=localhost;dbname=ecole', $sql_login, $sql_pwd);


//     }

// catch(Exception $e) {
    
//     //Si ca ne se connecte pas on renvoie une erreur
//     trigger_error($e->getMessage(), E_USER_WARNING);
//     }

//     //Puis j' exécute une requete...
            
//     $req = $sql->prepare("INSERT INTO eleve (nom, prenom, date_naissance, moyenne, appreciation) VALUES (?, ?, ?, ?, ?)");
//     $req->execute(array());
//     $res = $req->fetch(PDO::FETCH_OBJ);

//     $req->closeCursor();

//     if($res) {
    
//          return($res->nom);
//          }

//     else {

//          // Recuperation de l' erreur        
//          $res = $req->errorInfo();
//          unset($res[0]); // Facultatif

//          //Si il y a une erreur on renvoie un message d' erreur
//          trigger_error('(Sql  #'.$res[1].') - '.$res[2], E_USER_WARNING);
//     }


//$dbh = new PDO('mysql:host=localhost;dbname=ecole', $sql_login, $sql_pwd);