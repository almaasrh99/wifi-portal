<?php
require_once "../config/connection.php";
require_once "../helper/response.php";
session_start();

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  response("error", "Invalid request");
}

$mode = $_POST["mode"] ?? "login";

/* ================= REGISTER ================= */
if ($mode === "register") {

  $fullname = trim($_POST["fullname"] ?? "");
  $email    = trim($_POST["email"] ?? "");
  $phone    = trim($_POST["phone"] ?? "");
  $password = $_POST["register_password"] ?? "";
  $confirm  = $_POST["confirm_password"] ?? "";

  if (!$fullname || !$email || !$phone || !$password || !$confirm) {
    response("error", "Semua field wajib diisi!");
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    response("error", "Email tidak valid!");
  }

  // 62 + 8-11 digit => total 10-13 digit
  if (!preg_match('/^62[0-9]{8,11}$/', $phone)) {
    response("error", "Nomor HP harus diawali 62 dan terdiri dari 10–13 digit!");
  }

  if ($password !== $confirm) {
    response("error", "Password dan konfirmasi tidak sama!");
  }

  $hash = password_hash($password, PASSWORD_DEFAULT);

  // CATATAN: ini masih raw SQL (rentan injection). Saya berikan versi prepared di bawah.
  $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' OR phone='$phone'");
  if (mysqli_num_rows($check) > 0) {
    response("error", "Email atau nomor HP sudah terdaftar!");
  }

  $insert = mysqli_query(
    $conn,
    "INSERT INTO users (name, email, phone, password) VALUES ('$fullname', '$email', '$phone', '$hash')"
  );

  if (!$insert) {
    response("error", "Registrasi gagal!");
  }

  // AUTO LOGIN (SESSION)
  $userId = mysqli_insert_id($conn);
  $_SESSION["user_id"]  = $userId;
  $_SESSION["fullname"] = $fullname;
  $_SESSION["email"]    = $email;
  $_SESSION["phone"]    = $phone;
  $_SESSION["last_login"] = date('Y-m-d H:i:s');

  response("success", "Register berhasil! Mengalihkan ke dashboard...");
}

/* ================= LOGIN ================= */
$phone    = trim($_POST["phone"] ?? "");
$password = $_POST["login_password"] ?? "";

if (!$phone || !$password) {
  response("error", "Nomor HP dan password wajib diisi!");
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE phone='$phone' LIMIT 1");
if (mysqli_num_rows($result) === 0) {
  response("error", "Akun tidak ditemukan!");
}

$user = mysqli_fetch_assoc($result);

if (!password_verify($password, $user["password"])) {
  response("error", "Password salah");
}

session_regenerate_id(true);
$_SESSION["user_id"]  = $user["id"];
$_SESSION["fullname"] = $user["name"];
$_SESSION["email"]    = $user["email"];
$_SESSION["phone"]    = $user["phone"];

// Mengatur timezone ke Asia/Jakarta
date_default_timezone_set('Asia/Jakarta');

$months = [
  1 => 'Januari',
  'Februari',
  'Maret',
  'April',
  'Mei',
  'Juni',
  'Juli',
  'Agustus',
  'September',
  'Oktober',
  'November',
  'Desember'
];

$now = time();

$d = date('d', $now);
$m = $months[(int)date('m', $now)];
$y = date('Y', $now);
$t = date('H:i', $now);

// Gabungkan dan simpan ke session
$_SESSION["last_login"] = "$d $m $y $t";


session_write_close();
$base = rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/');
response("success", "Login berhasil! Mengalihkan ke dashboard...", [
  "redirect" => $base . "/dashboard/index.php"
]);
