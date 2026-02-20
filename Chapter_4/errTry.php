<?php
require __DIR__ . "/../Chapter_2/connexion.php";

try {
  $pdo->query("SELECT * FROM table_inexistante");
} catch (PDOException $e) {
  echo "Erreur SQL : " . $e->getMessage();
}
// outpout
// Erreur SQL : SQLSTATE[42S02]: Base table or view not found: 1146 Table 'blogdb.table_inexistante' doesn't exist