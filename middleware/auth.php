<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$isAjax =
  !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

$acceptJson = str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json');

// kalau belum login
if (!isset($_SESSION["user_id"])) {

  // 🔥 JIKA AJAX → KIRIM JSON
  if ($isAjax || $acceptJson) {
    header('Content-Type: application/json');
    echo json_encode([
      "status" => "error",
      "message" => "Session berakhir, silakan login kembali"
    ]);
    exit;
  }

  // 🔥 JIKA PAGE LOAD → REDIRECT
  $base = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');
  header("Location: $base/index.php?auth=required");
  exit;
}
