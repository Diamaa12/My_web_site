<?php
	function bdd(){

        $host_name = 'localhost';
        $database = 'Forum';
        $user_name = 'leyssare';
        $password = 'Kourahi22#';
        $bdd = null;

        try {
          $bdd = new PDO("mysql:host=$host_name; dbname=$database;charset=utf8", $user_name, $password);
          $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
          echo "Erreur!: " . $e->getMessage() . "<br/>";
          die();
        }
      return $bdd;

    }