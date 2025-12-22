<!DOCTYPE html>
<html lang="en">
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

    <title>Wifi Login</title>
  </head>

  <body class="font-[Poppins]">
    <!-- PROMO POPUP -->
    <div
      id="promoPopup"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-[2px]"
    >
      <div class="relative max-w-[90%] md:max-w-md">
        <!-- Close Button -->
        <div
          id="closePromo"
          class="absolute -top-6 -right-3 bg-white rounded-full cursor-pointer"
          aria-label="Close promo"
        >
          <img src="assets/close-btn.svg" alt="close-btn" />
        </div>

        <!-- Banner Image -->
        <img
          src="assets/banner-promo.png"
          alt="Promo Banner"
          class="rounded-lg shadow-xl w-full"
        />
      </div>
    </div>

    <!-- Background layer -->
    <div
      class="fixed inset-0 -z-10 bg-[url(assets/bg-theme.png)] bg-bottom bg-cover"
    ></div>
    <!-- Scrollable content -->
    <section id="hero" class="container mx-auto py-8 md:py-16">
      <!-- HERO -->
      <div
        class="mt-8 md:mt-0 grid grid-cols-1 justify-between items-center h-auto md:h-screen gap-2 md:gap-16 md:grid-cols-2"
      >
        <div
          data-aos="fade-right"
          data-aos-offset="200"
          data-aos-delay="50"
          data-aos-duration="1000"
          data-aos-easing="ease-in-out"
          data-aos-mirror="flase"
          data-aos-once="false"
          data-aos-anchor-placement="top-center"
        >
          <div
            class="flex flex-col justify-center items-center text-center gap-8 p-4 md:p-0"
          >
            <div class="flex flex-col gap-4">
              <h1
                class="text-[28px] md:text-[36px] font-bold mb-4 text-center text-primary"
              >
                Selamat Datang di Wifi Portal CRM Club
              </h1>
              <p class="text-[16px] md:text-[18px] text-gray-700">
                Akses internet lebih mudah,cepat dan terintegrasi dengan
                aplikasi CRM Club Kamu. Login sebagai member atau langsung masuk
                tanpa akun.
              </p>
            </div>
            <div class="mt-4 hidden md:block">
              <img src="assets/wifi.svg" alt="wifi" class="w-80 xl:w-96" />
            </div>
          </div>
        </div>
        <div class="p-4 md:p-16 mb-8">
          <div
            data-aos="fade-left"
            data-aos-offset="200"
            data-aos-delay="50"
            data-aos-duration="600"
            data-aos-easing="ease-in-out"
            data-aos-mirror="false"
            data-aos-once="true"
            data-aos-anchor-placement="top-center"
          >
            <div
              id="form"
              class="flex bg-white rounded-lg shadow-[0px_0px_8px_0px_rgba(60,60,60,0.25)] flex-col p-6 md:p-8"
            >
              <div class="flex flex-col gap-4">
                <h1
                  id="formTitle"
                  class="text-[24px] md:text-[30px] font-bold text-secondary"
                >
                  Login Member
                </h1>
                <p
                  id="formDesc"
                  class="text-[14px] md:text-[16px] text-gray-700"
                >
                  Mohon gunakan nomor WhatsApp anda ketika mendaftar aplikasi
                  member CRM Club.
                </p>
              </div>
              <form id="authForm" method="POST" action="auth/process_auth.php">
                <input type="hidden" name="mode" id="formMode" value="login" />

                <div class="w-full mt-8">
                  <div id="registerFields" class="hidden">
                    <div class="w-full mt-4">
                      <label class="block text-sm font-semibold text-gray-700">
                        Nama Lengkap
                      </label>
                      <input
                        type="text"
                        name="fullname"
                        placeholder="Nama kamu"
                        class="w-full mb-4 bg-transparent border-0 border-b border-secondary focus:border-secondary focus:ring-0 outline-none focus:outline-none focus:ring-0 py-2 text-gray-900 placeholder:text-gray-400 transition"
                      />
                    </div>

                    <div class="w-full mt-4">
                      <label class="block text-sm font-semibold text-gray-700">
                        Email
                      </label>
                      <input
                        type="email"
                        name="email"
                        placeholder="example@mail.com"
                        class="w-full mb-4 bg-transparent border-0 border-b border-secondary focus:border-secondary focus:ring-0 outline-none focus:outline-none focus:ring-0 py-2 text-gray-900 placeholder:text-gray-400 transition"
                      />
                    </div>
                  </div>

                  <div class="w-full mt-4">
                    <label
                      for="phone"
                      name="phone"
                      class="block text-sm font-semibold text-gray-700"
                      >Nomor Handphone</label
                    >

                    <input
                      type="number"
                      id="phone"
                      name="phone"
                      placeholder="628xxxxxxxxx"
                      class="w-full mb-4 bg-transparent border-0 border-b border-secondary focus:border-secondary focus:ring-0 outline-none focus:outline-none focus:ring-0 py-2 text-gray-900 placeholder:text-gray-400 transition"
                    />
                  </div>
                  <div id="loginPassword" class="w-full mt-4 mb-4">
                    <label
                      class="block text-sm font-semibold text-gray-900 mb-2"
                    >
                      Password
                    </label>

                    <div class="relative">
                      <input
                        type="password"
                        id="loginPasswordInput"
                        name="login_password"
                        placeholder="password"
                        class="w-full bg-transparent border-0 border-b border-secondary focus:border-secondary outline-none focus:outline-none focus:ring-0 py-2 pr-10 text-gray-900 placeholder:text-gray-400 transition"
                      />

                      <button
                        type="button"
                        id="toggleLoginPassword"
                        class="absolute right-0 top-1/2 -translate-y-1/2 text-secondary"
                      >
                        <img
                          src="assets/eye-off.svg"
                          id="loginEyeOff"
                          class="w-5 h-5"
                        />
                        <img
                          src="assets/eye-on.svg"
                          id="loginEye"
                          class="w-5 h-5 hidden"
                        />
                      </button>
                    </div>
                  </div>

                  <div id="registerPassword" class="hidden">
                    <!-- Buat Password -->
                    <div class="w-full mt-4">
                      <label class="block text-sm font-semibold text-gray-700">
                        Buat Password
                      </label>

                      <div class="relative">
                        <input
                          type="password"
                          name="register_password"
                          id="registerPasswordInput"
                          placeholder="password"
                          class="w-full mb-4 bg-transparent border-0 border-b border-secondary focus:border-secondary outline-none focus:outline-none focus:ring-0 py-2 pr-10 text-gray-900 placeholder:text-gray-400 transition"
                        />

                        <button
                          type="button"
                          id="toggleRegisterPassword"
                          class="absolute right-0 top-1/2 -translate-y-1/2 text-secondary"
                        >
                          <img
                            src="assets/eye-off.svg"
                            id="registerEyeOff"
                            class="w-5 h-5"
                          />
                          <img
                            src="assets/eye-on.svg"
                            id="registerEye"
                            class="w-5 h-5 hidden"
                          />
                        </button>
                      </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="w-full mt-4">
                      <label class="block text-sm font-semibold text-gray-700">
                        Konfirmasi Password
                      </label>

                      <input
                        type="password"
                        name="confirm_password"
                        placeholder="Konfirmasi password"
                        class="w-full mb-4 bg-transparent border-0 border-b border-secondary focus:border-secondary outline-none focus:outline-none focus:ring-0 py-2 pr-10 text-gray-900 placeholder:text-gray-400 transition"
                      />
                    </div>
                  </div>
                </div>

                <button
                  id="submitBtn"
                  type="submit"
                  class="w-full cursor-pointer my-4 md:my-6 font-semibold bg-[linear-gradient(230deg,_#CD4B3A_0.89%,_#FAE5B7_146.78%)] text-white py-2 rounded transition"
                >
                  Login
                </button>
              </form>
              <p
                id="loginNonMemberText"
                class="mb-4 text-[14px] md:text-[16px] text-center text-primary font-semibold"
              >
                Klik disini untuk login non member
              </p>

              <p class="text-center text-sm">
                <button
                  id="toggleForm"
                  type="button"
                  class="text-secondary cursor-pointer font-semibold hover:underline"
                >
                  Klik disini untuk register
                </button>
              </p>

              <p class="mt-4 text-xs text-center text-gray-700 font-semibold">
                Copyright © 2025 Mikrotik GS
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="download" class="container mx-auto pt-16 pb-12">
      <!-- DOWNLOAD -->
      <div
        class="mt-8 py-4 md:py-16 flex flex-col text-center justify-center items-center gap-4"
      >
        <div class="my-4 "
          data-aos="fade-down"
          data-aos-offset="200"
          data-aos-delay="50"
          data-aos-duration="1000"
          data-aos-easing="ease-in-out"
          data-aos-mirror="true"
          data-aos-once="false"
          data-aos-anchor-placement="top-center"
        >
          <h1
            class="mt-4 text-[28px] md:text-[36px] font-bold mb-4 text-center text-primary"
          >
            Scan QR untuk Download Aplikasi CRM Club
          </h1>
          <p class="text-[14px] md:text-[16px] text-gray-700">
            Scan kode QR dibawah unutk mendownload aplikasi CRM Club di
            Playstore atau Appstore.Install lalu daftar menjadi member kami.
          </p>
        </div>
        <div
          class="flex justify-center items-center"
          data-aos="zoom-in-up"
          data-aos-offset="120"
          data-aos-duration="600"
          data-aos-easing="ease-out-cubic"
        >
          <picture class="flex my-4 md:my-12 justify-center items-center">
            <source srcset="assets/download.png" media="(min-width: 768px)" />
            <img src="assets/download-mobile.png" alt="qr" class="w-[70%]" />
          </picture>
        </div>
      </div>
    </section>
    <!-- BENEFIT -->
    <section id="benefit" class="container mx-auto pt-8 pb-16">
      <div
        class="p-4 md:py-12 lg:py-16 xl:py-24 flex flex-col text-center justify-center items-center gap-4"
      >
        <div
          data-aos="fade-up"
          data-aos-offset="200"
          data-aos-delay="50"
          data-aos-duration="1000"
          data-aos-easing="ease-in-out"
          data-aos-mirror="true"
          data-aos-once="false"
          data-aos-anchor-placement="top-center"
        >
          <div class="flex flex-col gap-4 px-4 md:px-8 lg:px-16">
            <h1
              class="text-[28px] md:text-[36px] font-bold mb-4 text-center text-primary"
            >
              Nikmati Berbagai Benefit Member CRM Club
            </h1>
            <p class="text-[14px] md:text-[16px] text-gray-700">
              Sebagai member CRM Club, kamu dapat berbagai benefit
              eksklusif—mulai dari kuota internet setiap transaksi, promo
              khusus, hingga info event dan komunitas. Semua bisa diakses mudah
              lewat satu akun.
            </p>
          </div>
        </div>
        <div
          class="mt-4 md:mt-8 flex justify-center items-center"
          data-aos="zoom-in-up"
          data-aos-offset="120"
          data-aos-duration="600"
          data-aos-easing="ease-out-cubic"
        >
          <div
            id="benefitList"
            class="bg-white rounded-xl shadow-[0px_0px_8px_0px_rgba(60,60,60,0.25)] divide-y divide-gray-200"
          ></div>
        </div>
      </div>
    </section>
    <!-- KUOTA -->
    <section id="kuota" class="container mx-auto">
      <div
        class="px-4 py-6 md:py-12 lg:py-16 xl:py-24 flex flex-col text-center justify-center items-center gap-4"
      >
        <div
          data-aos="fade-up"
          data-aos-offset="200"
          data-aos-delay="50"
          data-aos-duration="1000"
          data-aos-easing="ease-in-out"
          data-aos-mirror="true"
          data-aos-once="true"
          data-aos-anchor-placement="top-center"
        >
          <div class="mb-4 md:mb-8 flex flex-col gap-4 px-4 md:px-8 lg:px-16">
            <h1
              class="text-[28px] md:text-[36px] font-bold mb-4 text-center text-primary"
            >
              Bagaimana Cara Dapetin Kuota Internet ?
            </h1>
            <p class="text-[14px] md:text-[16px] text-gray-700">
              Kamu bisa dapetin kuota internet dengan melakukan transaksi di
              store atau café yang terdaftar di jaringan CRM Club. Setiap
              pembelian akan otomatis menambah durasi internet ke akun kamu.
            </p>
          </div>
        </div>
        <div
          class="py-8 grid grid-cols-1 justify-between items-center gap-2 md:gap-16 md:grid-cols-2"
        >
          <div
            class="flex justify-center items-center"
            data-aos="fade-right"
            data-aos-offset="120"
            data-aos-duration="900"
            data-aos-easing="ease-out-cubic"
          >
            <img
              src="assets/internet.svg"
              alt="kuota"
              class="w-80 xl:w-96 hidden md:block"
            />
          </div>

          <div
            data-aos="fade-left"
            data-aos-offset="120"
            data-aos-duration="900"
            data-aos-easing="ease-out-cubic"
            id="kuotaList"
            class="bg-white rounded-xl shadow-[0px_0px_8px_0px_rgba(60,60,60,0.25)] divide-y divide-gray-200"
          ></div>
        </div>
      </div>
    </section>

    <!--Outlet-->
    <section id="outlet" class="mx-auto py-12">
      <div
        class="px-4 py-6 md:py-12 lg:py-16 xl:py-24 flex flex-col text-center justify-center items-center gap-4"
      >
        <div
          data-aos="fade-down"
          data-aos-offset="120"
          data-aos-duration="400"
          data-aos-easing="ease-out-cubic"
          class="mb-4 md:mb-8 flex flex-col gap-4 px-4 md:px-8 lg:px-16"
        >
          <h1
            class="text-[28px] md:text-[36px] font-bold mb-4 text-center text-primary"
          >
            Kunjungi Outlet Kami, Nikmati Internet Gratis
          </h1>
          <p class="text-[14px] md:text-[16px] text-gray-700">
            Nikmati internet cepat setiap kali berkunjung ke outlet kami.Cukup
            bertransaksi di store/café CRM Club dan kuota langsung otomatis
            masuk ke akunmu.
          </p>
        </div>
        <div class="w-full py-6 p-0 md:px-16 lg:px-24 xl:px-32">
          <div
            class="p-4 md:p-8 bg-white rounded-xl shadow-[0px_0px_8px_0px_rgba(60,60,60,0.25)]"
          >
            <div
              data-aos="zoom-in-up"
              data-aos-offset="120"
              data-aos-duration="900"
              data-aos-easing="ease-out-cubic"
              id="outletList"
              class="mt-4 bg-white"
            ></div>
            <div class="flex flex-col gap-4 p-4 md:p-8">
              <h3
                class="text-sm md:text-lg lg:text-xl font-bold mb-4 text-center text-black"
              >
                Contact Us
              </h3>

              <div
                data-aos="zoom-in-down"
                data-aos-offset="120"
                data-aos-duration="900"
                data-aos-easing="ease-out-cubic"
                class="flex flex-col gap-4"
              >
                <div id="contactList" class="space-y-6"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
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
  <script src="js/main.js" defer></script>

 
  
</html>
