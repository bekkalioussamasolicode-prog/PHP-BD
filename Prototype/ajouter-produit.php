<?php
require 'config.php';

try {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nom = $_POST["nom"];
        $prix = $_POST["prix"];
        $desc = $_POST["desc"];
        $cat = $_POST["categorie"];
        if (!empty($nom) && !empty($prix) && !empty($desc) && !empty($cat)) {
            $sql = "INSERT INTO produit (nom, prix, description, categorie) VALUES (:nom, :prix, :desc, :cat)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                "nom" => $nom,
                "prix" => $prix,
                "desc" => $desc,
                "cat" => $cat
            ]);
            header("Location: catalogue.php?succ=true");
            exit;
        } else {
            echo "Tout les champs sont obligatoire";
        }
    }
} catch (PDOException $e) {
    echo "Error" . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ajouter.css">
    <title>Ajouter une produit</title>
</head>

<body>
    <form method="post">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom">
        <label for="prix">Prix</label>
        <input type="number" name="prix" id="prix">
        <label for="desc">Description</label>
        <input type="text" name="desc" id="desc">
        <label for="categorie">Categorie</label>
        <input type="text" name="categorie" id="categorie">
        <button type="submit" class="btn">Ajouter</button>
    </form>
</body>

</html>