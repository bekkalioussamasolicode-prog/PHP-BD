<?php
require 'config.php';
if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM produit where id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header("Location: catalogue.php");
    exit;
}
