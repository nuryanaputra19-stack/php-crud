# 🛠️ PHP CRUD – Manajemen Produk

## 📘 Deskripsi Proyek

Proyek ini adalah aplikasi CRUD (Create, Read, Update, Delete) sederhana untuk manajemen data produk, termasuk upload gambar. 

## 🔧 Teknologi yang Digunakan

- PHP 8+ (native, tanpa framework)
- MySQL / MariaDB
- PDO untuk koneksi database
- VS Code sebagai editor
- MySQL Workbench untuk manajemen database

## 📁 Struktur Folder

```text
php-crud/
├─ public/
│  ├─ uploads/
│  ├─ index.php
│  ├─ create.php
│  ├─ edit.php
│  ├─ delete.php
├─ src/
│  ├─ config.php
│  └─ helpers.php
└─ schema.sql
```

---

## 🗄️ Isi File Database (MySQL Workbench)

Script:

```sql
CREATE DATABASE crud_app;
USE crud_app;

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  category VARCHAR(50) NOT NULL,
  price DECIMAL(10,2) NOT NULL,
  stock INT NOT NULL,
  image_path VARCHAR(255),
  status ENUM('active','inactive') DEFAULT 'active'
);
```

---

## 🚀 Menjalankan Project

```text
php -S localhost:8000 -t public
```

---

## ✨ Fitur

- Tambah produk
- Edit produk
- Hapus produk
- Upload gambar produk
- Tabel list produk
- Validasi sederhana

---
