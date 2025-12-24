<?php
require_once "../middleware/auth.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <style type="text/tailwindcss">
    @theme {
      --color-primary: #2e8789;
      --color-secondary: #d05743;
      --color-accent: #395384;
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

<body class="font-[Poppins]">

  <!-- Background layer -->
  <div class="fixed inset-0 -z-10 bg-[url(../assets/bg-theme.png)] bg-bottom bg-cover"></div>

  <div class="min-h-screen flex items-center justify-center">
    <div class="container mx-auto p-4 md:p-8 lg:p-12 xl:p-16 2xl:p-24">
      <div class="flex flex-col justify-center items-center p-6 gap-4 bg-white rounded-lg shadow-[0px_0px_8px_0px_rgba(60,60,60,0.25)]">
        <div class="flex py-4 flex-col md:flex-row md:justify-between items-center w-full">
          <div class="flex items-center justify-center gap-2">
            <img src="../assets/logo.png" alt="logo" class="w-12 md:w-16">
            <div class="flex flex-col gap-0 md:gap-1">
              <h1 class="text-lg md:text-xl lg:text-2xl font-bold text-primary">CRM Club Hotspot</h1>
              <div class="flex gap-1">
                <p class="text-[10px] md:text-base text-gray-500">Terhubung sebagai member </p><span class="text-[10px] md:text-base text-gray-500"> • Kelola Kuota dan Koneksi</span>

              </div>

            </div>
          </div>

          <div>
            <p class="hidden md:block text-xs md:text-sm text-gray-800 font-semibold italic">Login : <span><?= $_SESSION["last_login"]; ?></span>
          </div>


        </div>
        <div class="w-full mb-4 md:mb-8 border-t border-gray-200"></div>
        <div class="w-full grid grid-cols-1 md:grid-cols-3 items-center gap-4">
          <!-- COL 1: Profile -->
          <div class="flex items-center gap-3">
            <div
              class="w-16 h-16 md:w-18 md:h-18 rounded-sm shadow-lg flex items-center justify-center
             text-white text-xl font-bold bg-gradient-to-r from-sky-500 to-sky-700">
              <span id="user-initials" class="text-xl md:text-2xl"></span>
            </div>

            <div class="flex flex-col gap-1">
              <p class="block md:hidden text-xs md:text-sm text-gray-800 font-semibold italic">Login : <span><?= $_SESSION["last_login"]; ?></span>
              <h1 class="text-xl font-bold text-black"><?= $_SESSION["fullname"]; ?></h1>
              <p class="text-sm md:text-base lg:text-lg text-gray-500">+<?= $_SESSION["phone"]; ?></p>
            </div>
          </div>

          <!-- COL 2: Didapat dari (Dummy) -->
          <div class="w-full">
            <div class="w-full rounded-xl border border-gray-200 bg-white px-5 py-4">
              <p class="text-sm text-gray-500">Didapat dari</p>
              <p class="mt-2 text-base md:text-lg font-bold text-gray-900">
                Transaksi Rp 10.000 (1 Jam)
              </p>
            </div>
          </div>

          <!-- COL 3: Expired (Dummy) -->
          <div class="w-full">
            <div class="w-full rounded-xl border border-gray-200 bg-white px-5 py-4">
              <p class="text-sm text-gray-500">Expired</p>
              <p class="mt-2 text-base md:text-lg font-bold text-gray-900">
                Hari ini, 11:00
              </p>
            </div>
          </div>
        </div>

        <script>
          const fullname = "<?= $_SESSION['fullname']; ?>";

          function getInitials(name) {

            const parts = name.trim().split(/\s+/).filter(Boolean);
            if (parts.length === 0) return "?";

            const initials = parts.slice(0, 2).map(p => p[0].toUpperCase()).join("");
            return initials;
          }

          document.getElementById("user-initials").textContent = getInitials(fullname);
        </script>


        <div class="p-0 md:p-4 gap-4 md:gap-8 lg:gap-12 xl:gap-16 flex flex-col items-end md:flex-row w-full">
          <div class="w-full flex flex-col gap-1">
            <p class="text-sm text-gray-500">Sisa Kuota</p>
            <p class="text-xl md:text-2xl font-bold text-black mb-2">59 Menit</p>

            <!-- Progress Bar -->
            <div class="relative w-">
              <div class="flex mb-2 items-center justify-between">
              </div>
              <div class="flex mb-2">
                <div class="w-full bg-gray-200 rounded-full">
                  <div class="bg-gradient-to-r from-teal-600 to-slate-300 py-2 text-xs font-medium text-teal-100 text-center leading-none rounded-l-full" style="width: 70%"></div>
                </div>
              </div>
            </div>
          </div>

          <button class="w-full h-1/2 md:w-1/3 p-4 bg-[linear-gradient(230deg,_#CD4B3A_0.89%,_#FAE5B7_146.78%)] text-white font-semibold rounded-xl cursor-pointer" onclick="showLogoutModal()">Logout</button>
        </div>
        <div class="w-full py-8 flex flex-col gap-4 justify-center items-start">
          <p class="text-sm md:text-base lg:text-lg font-semibold ">Contact & Support</p>
          <div class="flex flex-col gap-2">
            <div class="flex flex-col gap-4">
              <div id="contactList" class="space-y-6 text-left"></div>

            </div>
          </div>
        </div>

      </div>

      <!-- Modal Konfirmasi -->
      <div id="logoutModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-[2px] hidden">
        <div class="flex flex-col gap-4 bg-white p-4 rounded-lg shadow-xl w-84 md:w-96">
          <div class="flex justify-center items-center">
            <img src="../assets/icons/warning.svg" alt="warning" class="w-12 md:w-24">
          </div>
          <h2 class="mb-4 text-lg md:text-xl text-center font-semibold mb-4">Apakah Anda yakin ingin logout?</h2>
          <div class="flex justify-center items-center gap-4">
            <button onclick="closeLogoutModal()" class="px-4 py-2 bg-secondary cursor-pointer text-white rounded-lg">Batal</button>
            <button onclick="logout()" class="px-4 py-2 bg-primary cursor-pointer text-white rounded-lg">Ya, Lanjutkan</button>
          </div>
        </div>
      </div>

      <div id="toast" class="fixed top-6 right-6 z-[9999] flex items-center gap-3 px-5 py-4 rounded-xl text-white shadow-lg opacity-0 translate-x-12 pointer-events-none transition-all duration-500 ease-out">
        <span id="toastMessage"></span>
      </div>
      <div id="loaderOverlay" class="fixed inset-0 z-[10000] flex items-center justify-center bg-black/60 backdrop-blur-sm hidden transition-opacity duration-300">
        <div class="flex flex-col items-center gap-4">
          <div
            class="relative h-12 w-12 animate-spin rounded-full
         bg-[conic-gradient(from_0deg,#CD4B3A,#FAE5B7,#CD4B3A)]">
            <div
              class="absolute inset-1 rounded-full bg-black/60 backdrop-blur-sm">
            </div>
          </div>

          <p class="text-white font-semibold text-lg animate-pulse">Memproses...</p>
        </div>
      </div>
</body>

<script src="../js/dashboard.js?v=<?php echo time(); ?>"></script>

</html>