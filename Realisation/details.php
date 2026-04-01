<?php
require 'config.php';

if (!isset($_GET['id'])) {
    echo "ID manquant";
}

$id = $_GET['id'];

try {
    $sql = "SELECT * FROM produit where id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        "id" => $id
    ]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$produit) {
        echo "Produit introuvable";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="details.css">
    <title>Details</title>
</head>

<body>
    <?php if ($produit): ?>
        <h2><?= htmlspecialchars($produit['nom']) ?></h2>
        <p>Prix <?= htmlspecialchars($produit['prix']) ?>DH</p>
        <p><?= htmlspecialchars($produit['description']) ?></p>
        <p>Categorie : <?= htmlspecialchars($produit['categorie']) ?></p>
    <?php endif; ?>
    <a href="catalogue.php">Back</a>
</body>

</html>