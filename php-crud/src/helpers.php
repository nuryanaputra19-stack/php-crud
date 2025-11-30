<?php

function e($str) {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function validate_image_upload($file, &$errors) {
    if ($file['error'] === UPLOAD_ERR_NO_FILE) return null;

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Upload error';
        return null;
    }

    if ($file['size'] > 2 * 1024 * 1024) {
        $errors[] = 'File maksimal 2 MB';
        return null;
    }

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($file['tmp_name']);

    if (!in_array($mime, ['image/jpeg','image/png'])) {
        $errors[] = 'File harus JPG atau PNG';
        return null;
    }

    $ext = $mime === 'image/png' ? 'png' : 'jpg';
    $filename = bin2hex(random_bytes(8)) . '.' . $ext;

    return $filename;
}

function move_uploaded_image($file, $filename) {
    $targetDir = __DIR__ . '/../public/uploads/';
    if (!is_dir($targetDir)) mkdir($targetDir, 0775, true);

    $path = $targetDir . $filename;
    if (move_uploaded_file($file['tmp_name'], $path)) {
        return 'uploads/' . $filename;
    }
    return false;
}
