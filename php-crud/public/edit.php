<?php
require_once '../src/config.php';
require_once '../src/helpers.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute([':id'=>$id]);
$product = $stmt->fetch();

if (!$product) die('Data tidak ditemukan');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $category = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];

    if ($name === '') $errors[] = 'Nama wajib diisi';
    if (!is_numeric($price)) $errors[] = 'Harga harus angka';
    if (!ctype_digit($stock)) $errors[] = 'Stok harus integer';

    $filename = validate_image_upload($_FILES['image'], $errors);

    $image_path = $product['image_path'];

    if ($filename) {
        $image_path = move_uploaded_image($_FILES['image'], $filename);
        if ($product['image_path']) unlink('../public/' . $product['image_path']);
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE products SET
            name=:name, category=:category, price=:price, stock=:stock,
            image_path=:image_path, status=:status
            WHERE id=:id");
        
        $stmt->execute([
            ':name'=>$name,
            ':category'=>$category,
            ':price'=>$price,
            ':stock'=>$stock,
            ':image_path'=>$image_path,
            ':status'=>$status,
            ':id'=>$id,
        ]);

        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>
<h1>Edit Produk</h1>

<?php foreach ($errors as $e) echo '<p style="color:red">'.$e.'</p>'; ?>

<form method="post" enctype="multipart/form-data">
    Nama: <input type="text" name="name" value="<?= e($product['name']) ?>"><br>
    <br>
    Kategori:
    <select name="category">
        <option <?= $product['category']=='Elektronik'?'selected':'' ?>>Elektronik</option>
        <option <?= $product['category']=='Pakaian'?'selected':'' ?>>Pakaian</option>
        <option <?= $product['category']=='Lainnya'?'selected':'' ?>>Lainnya</option>
    </select><br>
    <br>
    Harga: <input type="text" name="price" value="<?= e($product['price']) ?>"><br>
    <br>
    Stok: <input type="number" name="stock" value="<?= e($product['stock']) ?>"><br>
    <br>
    Gambar: <input type="file" name="image"><br>

    <?php if ($product['image_path']): ?>
        <img src="<?= e($product['image_path']) ?>" width="120"><br>
    <?php endif; ?>

    Status:
    <select name="status">
        <option value="active" <?= $product['status']=='active'?'selected':'' ?>>active</option>
        <option value="inactive" <?= $product['status']=='inactive'?'selected':'' ?>>inactive</option>
    </select><br><br>

    <button type="submit">Update</button>
</form>
<br>
<a href="index.php">Kembali</a>
</body>
</html>