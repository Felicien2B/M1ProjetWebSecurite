<?php

require 'db.php';

// Connexion à la base de données
static $bdd = null;

if ($bdd == null) {
  $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8';
  $bdd = new PDO($dsn, DB_USER, DB_PWD);

  // Lever une exception si erreur
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}