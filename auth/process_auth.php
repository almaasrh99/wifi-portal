<?php

require_once "../config/connection.php";
require_once "../helper/response.php";
session_start();

header('Content-Type: application/json');



if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  die("Invalid request");
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
    response("error", "Semua field wajib diisi");
  }

  if ($password !== $confirm) {
    response("error", "Password dan konfirmasi tidak sama");
  }

  if($email) {

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      response("error", "Email tidak valid");
    }
    
  }


 if ($phone) {

  // hanya angka
  if (!preg_match('/^62[0-9]{8,11}$/', $phone)) {
    response(
      "error",
      "Nomor HP harus diawali 62 dan terdiri dari 10–13 digit"
    );
  }

}


  $hash = password_hash($password, PASSWORD_DEFAULT);

  $check = mysqli_query(
    $conn,
    "SELECT id FROM users WHERE email='$email' OR phone='$phone'"
  );

  if (mysqli_num_rows($check) > 0) {
    response("error", "Email atau nomor HP sudah terdaftar");
  }

  $insert = mysqli_query(
  $conn,
  "INSERT INTO users (name, email, phone, password)
   VALUES ('$fullname', '$email', '$phone', '$hash')"
);

if (!$insert) {
  response("error", "Registrasi gagal");
}


  // 🔥 AUTO LOGIN
  $userId = mysqli_insert_id($conn);

  $_SESSION["user_id"]  = $userId;
  $_SESSION["fullname"] = $fullname;
  $_SESSION["email"]    = $email;
  $_SESSION["phone"]    = $phone;

  response("success", "Registrasi berhasil, selamat datang 🎉", [
  "redirect" => "dashboard/index.php"
]);

}


/* ================= LOGIN ================= */
$phone    = trim($_POST["phone"] ?? "");
$password = $_POST["login_password"] ?? "";

if (!$phone || !$password) {
  response("error", "Nomor HP dan password wajib diisi");
}

$result = mysqli_query(
  $conn,
  "SELECT * FROM users WHERE phone='$phone' LIMIT 1"
);

if (mysqli_num_rows($result) === 0) {
  response("error", "Akun tidak ditemukan");
}

$user = mysqli_fetch_assoc($result);

if (!password_verify($password, $user["password"])) {
  response("error", "Password salah");
}

$_SESSION["user_id"]  = $user["id"];
$_SESSION["fullname"] = $user["name"];
$_SESSION["email"]    = $user["email"];
$_SESSION["phone"]    = $user["phone"];

 response("success", "Login berhasil");
header("Location: ../dashboard/index.php");
exit;



?>