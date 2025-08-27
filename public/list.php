<?php
$authPassword = "MySecret123";

if (!isset($_GET['password']) || $_GET['password'] !== $authPassword) {
    die("❌ Unauthorized access");
}

$uploadDir = __DIR__ . "/uploads/";
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}
$files = array_diff(scandir($uploadDir), ['.', '..']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Uploaded Documents</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen p-10">
  <div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold text-cyan-400 mb-6">📂 Uploaded Documents</h1>

    <?php if (empty($files)): ?>
      <p class="text-gray-400">No files uploaded yet.</p>
    <?php else: ?>
      <div class="overflow-x-auto">
        <table class="table-auto w-full border border-slate-700 rounded-lg">
          <thead class="bg-slate-800 text-cyan-300">
            <tr>
              <th class="px-4 py-2 text-left">File Name</th>
              <th class="px-4 py-2">Action</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($files as $file): ?>
            <tr class="border-b border-slate-700 hover:bg-slate-800">
              <td class="px-4 py-2"><?= htmlspecialchars($file) ?></td>
              <td class="px-4 py-2 text-center">
                <a href="download.php?file=<?= urlencode($file) ?>&password=<?= urlencode($authPassword) ?>"
                   class="px-3 py-1 bg-cyan-500 hover:bg-cyan-600 rounded text-white text-sm">
                   Download
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
