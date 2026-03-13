<?php
require 'conf.php';
if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM utilisateur where id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: Affichage.php");
    exit;
}
