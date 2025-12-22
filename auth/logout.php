<?php
session_start();
header('Content-Type: application/json');

echo json_encode([
  "status" => "success",
  "message" => "Berhasil logout. Sampai jumpa 👋"
]);
session_destroy();
exit;
