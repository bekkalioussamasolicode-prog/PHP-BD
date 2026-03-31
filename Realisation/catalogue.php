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

    </form>
    <?php foreach ($produits as $p): ?>
        <div class="cont">
            <p><?= htmlspecialchars($p["nom"]) ?></p>
            <p>Prix <?= htmlspecialchars($p["prix"]) ?> DH</p>
            <a href="details.php?id=<?= $p['id'] ?>">Details</a>
            <a href="delete.php?id=<?= $p['id'] ?>">Supprimer</a>
        </div>
    <?php endforeach; ?>
    <p>Total des produits : <?= count($produits) ?></p>
</body>

</html>