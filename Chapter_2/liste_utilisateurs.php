<?php
require "connexion.php";

try {
  $sql = "SELECT * FROM utilisateur";
  $stmt = $pdo->query($sql);

  $utilasteur = $stmt->fetchAll(PDO::FETCH_ASSOC);

  foreach ($utilasteur as $user) {
    echo "-ID : " . $user["id"] . "<br>- Nom : " . $user["nom"] . "<br>- email : " . $user["email"] . "<br>";
  }
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}
