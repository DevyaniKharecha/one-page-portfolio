<?php
$authPassword = "MySecret123";  
$fileId = $_GET['file'] ?? '';

if (!isset($_GET['password']) || $_GET['password'] !== $authPassword) {
    http_response_code(403);
    exit("❌ Unauthorized access");
}

$filePath = __DIR__ . "/uploads/" . basename($fileId);

if (!file_exists($filePath)) {
    http_response_code(404);
    exit("❌ File not found");
}

// Clean output buffer
if (ob_get_level()) {
    ob_end_clean();
}

$filename = basename($filePath);

// Send headers to force download
header("Content-Description: File Transfer");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Transfer-Encoding: binary");
header("Expires: 0");
header("Cache-Control: must-revalidate");
header("Pragma: public");
header("Content-Length: " . filesize($filePath));

flush(); // flush system output buffer
readfile($filePath);
exit;
