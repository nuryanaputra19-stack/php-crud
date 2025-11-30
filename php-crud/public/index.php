<?php
require_once '../src/config.php';
require_once '../src/helpers.php';

$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
</head>
<body>
<h1>Daftar Produk</h1>
<a href="create.php">Tambah Produk</a>
<hr><br>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($products as $p): ?>
    <tr>
        <td><?= e($p['id']) ?></td>
        <td><?= e($p['name']) ?></td>
        <td><?= e($p['category']) ?></td>
        <td><?= number_format($p['price'],2,',','.') ?></td>
        <td><?= e($p['stock']) ?></td>
        <td><?= e($p['status']) ?></td>
        <td>
            <a href="edit.php?id=<?= $p['id'] ?>">Edit</a> |
            <a href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Yakin?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
