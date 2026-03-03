<?php
require "connextion.php";
try {
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST['nom']) && !empty($_POST['email'])) {
      $nom = trim($_POST['nom']);
      $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
      if (!$email) {
        die("Email invalide !");
      }
      $stmt = $pdo->prepare("INSERT INTO utilisateur (nom, email)VALUES (:nom, :email)");
      $stmt->execute([
        'nom' => $nom,
        'email' => $email
      ]);
      echo "Utilisateur ajoute avec succes.";
    }
  }
} catch (PDOException $e) {

  $logDir = __DIR__ . "/logs";

  if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true);
  }

  file_put_contents(
    $logDir . "/errors.log",
    date('Y-m-d H:i:s') . " - " . $e->getMessage() . PHP_EOL,
    FILE_APPEND
  );

  echo "Une erreur est survenue. Contactez l'administrateur.";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <form method="post">
    <label>Nom :</label>
    <input type="text" name="nom">
    <label>Email :</label>
    <input type="text" name="email">
    <button type="submit">Ajouter</button>
  </form>
</body>

</html>