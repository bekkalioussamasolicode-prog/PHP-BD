<?php
require 'conf.php';

$sql = "SELECT id, nom, email,telephone,age FROM utilisateur";
$stmt = $pdo->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h1 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: blue;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Users information</h1>


    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>telephone</th>
            <th>age</th>
            <th>Actions</th>
        </tr>
        <?php while ($shelf = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?= $shelf["id"] ?></td>
                <td><?= $shelf["nom"] ?></td>
                <td><?= $shelf["email"] ?></td>
                <td><?= $shelf["telephone"] ?></td>
                <td><?= $shelf["age"] ?></td>
                <td>
                    <a href="modifier.php?id=<?= $shelf["id"] ?>">Modifier</a> ||
                    <a href="delete.php?id=<?= $shelf["id"] ?>">Supprimer</a>
                </td>

            </tr>


        <?php } ?>

    </table>
</body>

</html>