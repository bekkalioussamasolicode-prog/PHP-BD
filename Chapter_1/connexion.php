<?php
require_once "info.php";

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connextion reussie a la base $dbname";
} catch (PDOException $e) {
  echo "Erreur de connexion :" . $e->getMessage();
}
