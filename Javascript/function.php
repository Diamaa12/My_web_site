<?php
  $host_name = 'db5000104635.hosting-data.io';
  $database = 'dbs99134';
  $user_name = 'dbu133435';
  $password = 'MamadouCherif1987#';
  $dbh = null;

  try {
    $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
  } catch (PDOException $e) {
    echo "Erreur!: " . $e->getMessage() . "<br/>";
    die();
  }
