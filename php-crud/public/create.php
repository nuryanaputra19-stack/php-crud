<?php
require_once '../src/config.php';
require_once '../src/helpers.php';

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

    if (empty($errors)) {
        $image_path = null;
        if ($filename) {
            $image_path = move_uploaded_image($_FILES['image'], $filename);
        }

        $stmt = $pdo->prepare("INSERT INTO products
            (name, category, price, stock, image_path, status)
            VALUES (:name, :category, :price, :stock, :image_path, :status)");

        $stmt->execute([
            ':name' => $name,
            ':category' => $category,
            ':price' => $price,
            ':stock' => $stock,
            ':image_path' => $image_path,
            ':status' => $status,
        ]);

        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>
<h1>Tambah Produk</h1>

<?php foreach ($errors as $e) echo '<p style="color:red">'.$e.'</p>'; ?>
<form method="post" enctype="multipart/form-data">
    Nama: <input type="text" name="name"><br>
    <br>
    Kategori:
    <select name="category">
        <option>Elektronik</option>
        <option>Pakaian</option>
        <option>Lainnya</option>
    </select><br>
    <br>
    Harga: <input type="text" name="price"><br>
    <br>
    Stok: <input type="number" name="stock"><br>
    <br>
    Gambar: <input type="file" name="image"><br>
    <br>
    Status:
    <select name="status">
        <option value="active">active</option>
        <option value="inactive">inactive</option>
    </select><br><br>
    <button type="submit">Simpan</button>
</form>
<br>
<a href="index.php">Kembali</a>
</body>
</html>