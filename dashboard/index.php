<?php
require_once "../middleware/auth.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
      @theme {
        --color-primary: #2e8789;
        --color-secondary: #d05743;
      }
    </style>

    <style>
      html,
      body {
        overflow-x: hidden;
        width: 100%;
        position: relative;
      }
    </style>

    <title>Dashboard Member</title>
  </head>
</head>
<body class="font-[Poppins]">

  <!-- Background layer -->
    <div
      class="fixed inset-0 -z-10 bg-[url(../assets/bg-theme.png)] bg-bottom bg-cover"
    ></div>

   <div class="min-h-screen flex items-center justify-center">
  <div class="container mx-auto px-4">
    <div
      class="flex flex-col justify-center items-center
             p-6 gap-4
             bg-white rounded-lg
             shadow-[0px_0px_8px_0px_rgba(60,60,60,0.25)]"
    >
      <h1 class="text-xl font-bold">
        Selamat Datang, <?= $_SESSION["fullname"]; ?>
      </h1>
      <p>Email: <?= $_SESSION["email"]; ?></p>
      <p>Phone: <?= $_SESSION["phone"]; ?></p>

      <div class="p-4 w-full">
        <button
          class="w-full fon p-4 bg-[linear-gradient(230deg,_#CD4B3A_0.89%,_#FAE5B7_146.78%)] text-white rounded cursor-pointer"
          onclick="logout()"
        >
          Logout
        </button>
      </div>
    </div>
  </div>
</div>

 <!-- TOAST -->
<div
  id="toast"
  class="fixed top-6 right-6 z-[9999]
         flex items-center gap-3
         px-5 py-4 rounded-xl text-white shadow-lg
         opacity-0 translate-x-12
         pointer-events-none
         transition-all duration-500 ease-out"
>
  <span id="toastMessage"></span>
</div>


  


</body>

<script>
    function showToast(message, type = "success") {
  const toast = document.getElementById("toast");
  const msg = document.getElementById("toastMessage");

  toast.classList.remove(
    "bg-green-600",
    "bg-red-600",
    "opacity-0",
    "translate-x-12",
    "pointer-events-none"
  );

  toast.classList.add(type === "success" ? "bg-green-600" : "bg-red-600");
  msg.textContent = message;

  requestAnimationFrame(() => {
    toast.classList.add("opacity-100", "translate-x-0");
  });

  setTimeout(() => {
    toast.classList.remove("opacity-100", "translate-x-0");
    toast.classList.add("opacity-0", "translate-x-12", "pointer-events-none");
  }, 2800);
}

</script>

<script>
   async function logout() {
  try {
    const res = await fetch("../auth/logout.php", {
      method: "POST",
      headers: {
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest"
      }
    });

    const data = await res.json();

    showToast(data.message, data.status);

    if (data.status === "success") {
      setTimeout(() => {
        window.location.href = "../index.php";
      }, 1500);
    }
  } catch (err) {
    console.error(err);
    showToast("Gagal logout", "error");
  }
}


</script>

<script>

    if (data.status === "success") {
  setTimeout(() => {
    window.location.href = "dashboard/index.php";
  }, 1500);
}

   
</script>

</html>
