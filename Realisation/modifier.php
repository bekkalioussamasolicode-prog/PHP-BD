<?php
require "config.php";

$produit = null;
$errors = [];

if (isset($_GET['id'])) {
  $id = (int) $_GET['id'];

  if ($id <= 0) {
    die("Invalid ID.");
  }

  $sql = "SELECT * FROM produit WHERE id = :id";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(["id" => $id]);

  $produit = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$produit) {
    die("Produit not found.");
  }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = (int) ($_POST['id'] ?? 0);
  $nom = trim($_POST['nom'] ?? "");
  $prix = trim($_POST['prix'] ?? "");
  $desc = trim($_POST['description'] ?? "");
  $categorie = trim($_POST['categorie'] ?? "");

  if (empty($nom) || empty($prix) || empty($desc) || empty($categorie)) {
    $errors[] = "All fields are required.";
  }

  if (!is_numeric(($prix))) {
    $errors[] = "Price must be number.";
  }

  if ($prix < 0) {
    $errors[] = "Price must be bigger than 0.";
  }

  if (empty($errors)) {
    $sql = "
    UPDATE produit 
                SET nom = :nom,
                    prix = :prix,
                    description = :desc,
                    categorie = :cate
                WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
      "id" => $id,
      "nom" => $nom,
      "prix" => $prix,
      "desc" => $desc,
      "cate" => $categorie
    ]);

    header("Location: catalogue.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Produit</title>
  <style>
    form {
      display: flex;
      flex-direction: column;
      width: 300px;
    }

    label {
      margin-top: 10px;
    }

    input {
      padding: 5px;
      font-size: 16px;
    }

    button {
      margin-top: 20px;
      padding: 10px;
      font-size: 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>

</head>

<body>

  <h2>Edit Produit</h2>

  <?php foreach ($errors as $error): ?>
    <p style="color:red;"><?= $error ?></p>
  <?php endforeach; ?>

  <?php if ($produit): ?>
    <form method="POST">
      <input type="hidden" name="id" value="<?= htmlspecialchars($produit['id']) ?>">

      <label>Nom</label>
      <input type="text" name="nom" value="<?= htmlspecialchars($produit['nom']) ?>">

      <label>Price</label>
      <input type="text" name="prix" value="<?= htmlspecialchars($produit['prix']) ?>">

      <label>description</label>
      <input type="text" name="description" value="<?= htmlspecialchars($produit['description']) ?>">

      <label>Categorie</label>
      <input type="text" name="categorie" value="<?= htmlspecialchars($produit['categorie']) ?>">

      <button type="submit">Update</button>
    </form>
  <?php endif; ?>

</body>

</html>