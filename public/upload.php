<?php
// --- Config ---
$authPassword = "MySecret123";  // change this!
$uploadDir = __DIR__ . "/uploads/";
$maxSize = 200 * 1024 * 1024; // 200MB
$allowedTypes = ['pdf','doc','docx','png','jpg','jpeg'];

// --- Auth check ---
if ($_POST['password'] !== $authPassword) {
    die("Unauthorized access");
}

// --- Ensure upload folder exists ---
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['document'])) {
    $file = $_FILES['document'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    // Validate
    if ($file['size'] > $maxSize) die("File too large (max 200MB).");
    if (!in_array($ext, $allowedTypes)) die("Invalid file type.");

    // Safe name
    $newName = uniqid("doc_", true) . "." . $ext;
    $dest = $uploadDir . $newName;

    if (move_uploaded_file($file['tmp_name'], $dest)) {
        echo "✅ Upload successful. File ID: $newName";
    } else {
        echo "❌ Upload failed.";
    }
} else {
    echo "No file uploaded.";
}
