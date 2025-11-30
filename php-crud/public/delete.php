<?php
require_once '../src/config.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT image_path FROM products WHERE id = :id");
$stmt->execute([':id'=>$id]);
$product = $stmt->fetch();

if ($product) {
    if ($product['image_path']) unlink('../public/' . $product['image_path']);
}

$del = $pdo->prepare("DELETE FROM products WHERE id = :id");
$del->execute([':id'=>$id]);

header('Location: index.php');
exit;