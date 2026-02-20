<?php
require __DIR__ . "/../Chapter_2/connexion.php";

try {
  $pre = $pdo->prepare("INSERT INTO utilisateur (nom, email) VALUES (:nom, :email)");
  $pre->execute([
    'nom' => 'Charlie',
    'email' => 'charlie@test.com'
  ]);
  echo "Utilisateur ajoute avec succes<br>";
  $pre = $pdo->prepare("UPDATE utilisateur SET email = :email where id = :id");
  $pre->execute([
    'email' => 'charlie.new@test.com',
    'id' => 4
  ]);
  echo "Utilisateur mis a jour.<br>";
  $pre = $pdo->prepare("DELETE FROM utilisateur WHERE id = :id");
  $pre->execute([
    'id' => 4
  ]);
  echo "Utilisateur supprime.<br>";
  echo $pre->rowCount() . " lign(s) affectee.";
} catch (PDOException $e) {
  echo "Erreur : " . $e->getMessage();
}
