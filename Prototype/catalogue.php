<?php
require 'config.php';
try {
    $sql = "SELECT * FROM produit";
    $stmt = $pdo->query($sql);
    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gestion des produits</title>
</head>

<body>
    <h2>Marjane</h2>
    <?php if (isset($_GET["succ"])) {
        echo "<p class ='succ'>Produit ajouté avec succès</p>";
    } ?>
    <?php foreach ($produits as $p): ?>
        <div class="cont">
            <p><?= htmlspecialchars($p["nom"]) ?></p>
            <p>Prix <?= htmlspecialchars($p["prix"]) ?> DH</p>
            <a href="details.php?id=<?= $p['id'] ?>">Details</a>
        </div>
    <?php endforeach; ?>
    <a href="ajouter-produit.php" class="ajouter">Ajouter une produit</a>
</body>

</html>