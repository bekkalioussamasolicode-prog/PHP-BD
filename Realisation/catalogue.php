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
    <style>
        .cont {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .total {
            font-weight: bold;
            color: green;
        }

        .ajouter {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .ajouter:hover {
            background-color: #45a049;
        }

        .succ {
            color: green;
            font-weight: bold;
        }

        .cont a {
            margin-right: 10px;
            text-decoration: none;
            color: #007BFF;
        }

        .cont a:hover {
            text-decoration: underline;
        }
    </style>
    <title>Gestion des produits</title>
</head>

<body>
    <h2>Marjane</h2>
    <?php if (isset($_GET["succ"])) {
        echo "<p class ='succ'>Produit ajouté avec succès</p>";
    } ?>

    </form>
    <?php foreach ($produits as $p): ?>
        <div class="cont">
            <p><?= htmlspecialchars($p["nom"]) ?></p>
            <p>Prix <?= htmlspecialchars($p["prix"]) ?> DH</p>
            <a href="details.php?id=<?= $p['id'] ?>">Details</a>
            <a href="delete.php?id=<?= $p['id'] ?>">Supprimer</a>
            <a href="modifier.php?id=<?= $p['id'] ?>">Modifier</a>
        </div>
    <?php endforeach; ?>
    <p class="total">Total des produits : <?= count($produits) ?></p>
    <a href="ajouter-produit.php" class="ajouter">Ajouter une produit</a>
</body>

</html>