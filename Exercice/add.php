<?php
require 'conf.php';
$erreur = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? "";
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $age = $_POST['age'];
    if (empty($name) || empty($email) || empty($telephone) || empty($age)) {
        echo "All fields are required.";
        $erreur = true;
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email is inccorect.";
            $erreur = true;
        } elseif ($age < 18) {
            echo "You have to be an adult.";
            $erreur = true;
        }
    }
    if (!$erreur) {
        $sql = "INSERT INTO utilisateur (nom, email, telephone, age) VALUES (:nom,:email,:tel,:age)";

        $stm = $pdo->prepare($sql);

        $stm->execute([
            "nom" => $name,
            "email" => $email,
            "tel" => $telephone,
            "age" => $age
        ]);

        header("Location: Affichage.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h3 {
            text-align: center;
        }

        form {
            max-width: 300px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"] {
            width: 95%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h3>New user</h3>
    <form method="POST">
        <input type="text" name="name" placeholder="Name"><br><br>
        <input type="text" name="email" placeholder="Email"><br><br>
        <input type="tel" name="telephone" placeholder="Telephone"><br><br>
        <input type="number" name="age" placeholder="Age"><br><br>
        <button type="submit">Add</button>
    </form>
</body>

</html>