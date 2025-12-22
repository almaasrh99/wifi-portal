/* ================= PASSWORD ================= */

function togglePassword(inputId, eyeId, eyeOffId) {
  const input = document.getElementById(inputId);
  const eye = document.getElementById(eyeId);
  const eyeOff = document.getElementById(eyeOffId);

  const isHidden = input.type === "password";
  input.type = isHidden ? "text" : "password";

  eye.classList.toggle("hidden", !isHidden);
  eyeOff.classList.toggle("hidden", isHidden);
}

// LOGIN
document
  .getElementById("toggleLoginPassword")
  .addEventListener("click", () =>
    togglePassword("loginPasswordInput", "loginEye", "loginEyeOff")
  );

// REGISTER
document
  .getElementById("toggleRegisterPassword")
  .addEventListener("click", () =>
    togglePassword("registerPasswordInput", "registerEye", "registerEyeOff")
  );

/* ================= ANIMATION ================= */

AOS.init();

/* ================= PROMO ================= */

const promoPopup = document.getElementById("promoPopup");
const closePromo = document.getElementById("closePromo");

window.addEventListener("load", () => {
  if (!localStorage.getItem("promoSeen")) {
    promoPopup.classList.remove("hidden");
  }
});

closePromo.addEventListener("click", () => {
  promoPopup.classList.add("hidden");
  localStorage.setItem("promoSeen", "true");
});

const sections = [...document.querySelectorAll("section")];
let currentIndex = 0;
let isAnimating = false;

function getActiveSectionIndex() {
  let index = 0;
  let minOffset = Infinity;

  sections.forEach((section, i) => {
    const offset = Math.abs(section.getBoundingClientRect().top);
    if (offset < minOffset) {
      minOffset = offset;
      index = i;
    }
  });

  return index;
}

/* ================= SCROLL ================= */

function scrollToIndex(targetIndex) {
  if (targetIndex < 0 || targetIndex >= sections.length || isAnimating) return;

  isAnimating = true;
  currentIndex = targetIndex;

  sections[targetIndex].scrollIntoView({
    behavior: "smooth",
    block: "start",
  });

  // Tunggu sampai scroll benar-benar settle
  let checkScroll = setInterval(() => {
    const rect = sections[targetIndex].getBoundingClientRect();

    if (Math.abs(rect.top) < 2) {
      clearInterval(checkScroll);
      isAnimating = false;
    }
  }, 50);
}

// ===== DESKTOP (WHEEL) =====
window.addEventListener(
  "wheel",
  (e) => {
    if (isAnimating) return;

    currentIndex = getActiveSectionIndex();

    if (e.deltaY > 0) {
      scrollToIndex(currentIndex + 1);
    } else {
      scrollToIndex(currentIndex - 1);
    }
  },
  { passive: true }
);

// ===== MOBILE (TOUCH) =====
let startY = 0;

window.addEventListener(
  "touchstart",
  (e) => {
    startY = e.touches[0].clientY;
  },
  { passive: true }
);

window.addEventListener(
  "touchend",
  (e) => {
    if (isAnimating) return;

    const endY = e.changedTouches[0].clientY;
    const diff = startY - endY;

    if (Math.abs(diff) < 60) return;

    currentIndex = getActiveSectionIndex();

    if (diff > 0) {
      scrollToIndex(currentIndex + 1);
    } else {
      scrollToIndex(currentIndex - 1);
    }
  },
  { passive: true }
);

/* ================= BENEFITS ================= */

const benefits = [
  {
    icon: "assets/icons/wifi-member.svg",
    title: "Gratis Wifi Pribadi",
    description:
      "Nikmati Wifi pribadi secara gratis dengan kecepatan hingga 100 Mbps",
  },
  {
    icon: "assets/icons/discount.svg",
    title: "Diskon Member",
    description:
      "Member Gold mendapatkan peningkatan diskon menjadi 20%, memberikan penghematan lebih besar pada setiap transaksi.",
  },
  {
    icon: "assets/icons/menu.svg",
    title: "Akses Menu Spesial",
    description:
      "Tukarkan poin Kamu dengan menu spesial kami untuk 75–150 Points",
  },
  {
    icon: "assets/icons/customer-service.svg",
    title: "Layanan Pelanggan",
    description:
      "Layanan pelanggan khusus tersedia untuk anggota Gold, dengan prioritas penanganan pertanyaan atau masalah.",
  },
  {
    icon: "assets/icons/birthday.svg",
    title: "Birthday",
    description: [
      "Dapatkan voucher diskon hingga 100% untuk hidangan tertentu",
      "Voucher gratis kue kering",
      "Dapatkan poin ganda",
    ],
  },
];

const benefitList = document.getElementById("benefitList");

benefits.forEach((item) => {
  const wrapper = document.createElement("div");
  wrapper.className = "flex gap-4 p-6 text-left";

  const descriptionHTML = Array.isArray(item.description)
    ? `<ul class="list-disc pl-5 space-y-1">
          ${item.description.map((d) => `<li>${d}</li>`).join("")}
        </ul>`
    : `<p>${item.description}</p>`;

  wrapper.innerHTML = `
      <div class="flex-shrink-0">
    
          <img src="${item.icon}" alt="${item.title}" class="w-10 md:w-12" />
        
      </div>

      <div class="flex flex-col gap-1 justify-start items-start">
        <h3 class="font-semibold text-gray-900 text-base">
          ${item.title}
        </h3>
        <div class="text-sm text-gray-600 leading-relaxed">
          ${descriptionHTML}
        </div>
      </div>
    `;

  benefitList.appendChild(wrapper);
});

/* ================= KUOTA ================= */

const kuota = [
  {
    icon: "assets/icons/wifi-member.svg",
    title: "Konversi Kuota",
    description: [
      "Rp10.000 = 1 Jam internet",
      "Berlaku kelipatan",
      "Kuota langsung masuk otomatis setelah transaksi berhasil",
    ],
  },
  {
    icon: "assets/icons/outlet.svg",
    title: "Kuota Berlaku di Semua Lokasi",
    description:
      "Kuota yang kamu dapat bisa dipakai di seluruh outlet CRM Club yang terhubung dengan jaringan Wifi kami. Jadi, cukup login sekali dan kamu bisa menikmati internet di mana pun selama kuota masih tersedia. ",
  },
  {
    icon: "assets/icons/time.svg",
    title: "Jika Kuota Habis",
    description:
      "Koneksi akan otomatis berhenti. Kamu bisa isi ulang kuota dengan melakukan transaksi berikutnya atau menggunakan mode non-member.",
  },
];

const kuotaList = document.getElementById("kuotaList");

kuota.forEach((item) => {
  const wrapper = document.createElement("div");
  wrapper.className = "flex gap-4 p-6 text-left";

  const descriptionHTML = Array.isArray(item.description)
    ? `<ul class="list-disc pl-5 space-y-1">
          ${item.description.map((d) => `<li>${d}</li>`).join("")}
        </ul>`
    : `<p>${item.description}</p>`;

  wrapper.innerHTML = `
      <div class="flex-shrink-0">
    
          <img src="${item.icon}" alt="${item.title}" class="w-10 md:w-12" />
        
      </div>

      <div class="flex flex-col gap-1 justify-start items-start">
        <h3 class="font-semibold text-gray-900 text-base">
          ${item.title}
        </h3>
        <div class="text-sm text-gray-600 leading-relaxed">
          ${descriptionHTML}
        </div>
      </div>
    `;

  kuotaList.appendChild(wrapper);
});

/* ================= OUTLETS ================= */

const outlets = [
  {
    name: "Apika",
    image: "assets/outlet/apika.png",
    url: "https://citarasamendunia.com",
  },
  {
    name: "Bakpiaku",
    image: "assets/outlet/bakpiaku.png",
    url: "https://bakpiaku.com",
  },
  {
    name: "Bakpiamu",
    image: "assets/outlet/bakpiamu.png",
    url: "https://bakpiamu.com",
  },
  {
    name: "Broeder Coffee",
    image: "assets/outlet/broeder.png",
    url: "https://broeder.coffee",
  },
  {
    name: "ETECE Roastery",
    image: "assets/outlet/etece.png",
    url: "https://instagram.com/etecer.roastery",
  },
  {
    name: "Senja Coffee & Memories",
    image: "assets/outlet/senja.png",
    url: "https://instagram.com/senjacoffee_id",
  },
];

const outletList = document.getElementById("outletList");

outletList.innerHTML = `
    <div class="grid grid-cols-3 gap-4 md:gap-6 px-0 py-2 md:px-16 lg:px-24 xl:px-32">
      ${outlets
        .map(
          (outlet) => `
        <a
          href="${outlet.url}"
          target="_blank"
          rel="noopener noreferrer"
          class="flex justify-center items-center rounded-xl border border-gray-300 hover:shadow-md transition bg-white p-2"
        >
          <img
            src="${outlet.image}"
            alt="${outlet.name}"
            class="max-h-24 object-contain"
          />
        </a>
      `
        )
        .join("")}
    </div>
  `;

/* ================= CONTACT ================= */

const contacts = [
  {
    icon: "assets/icons/location.svg",
    text: "Jalan Tata Bumi, Perum Gading Sari I no 2, Banyuraden, Gamping Sleman, Daerah Istimewa Yogyakarta 55293, ID",
    link: "https://maps.app.goo.gl/dAsXFXC4o1n4RPFFA",
  },
  {
    icon: "assets/icons/phone.svg",
    text: "+628871189999",
    link: "https://wa.me/628871189999",
  },
  {
    icon: "assets/icons/web.svg",
    text: "https://citarasamendunia.com/",
    link: "https://citarasamendunia.com/",
  },
  {
    icon: "assets/icons/open-work.svg",
    text: "Senin – Sabtu (08:00 – 17:00)",
    link: null,
  },
];

const contactList = document.getElementById("contactList");

contacts.forEach((item) => {
  const wrapper = document.createElement("div");
  wrapper.className = "flex items-center gap-4";

  const content = `
      <div class="flex-shrink-0">
        <div class="flex items-center justify-center">
          <img src="${item.icon}" alt="" class="w-10 md:w-12 " />
        </div>
      </div>

      <div class="text-gray-700 text-sm md:text-lg leading-relaxed">
        ${
          item.link
            ? `<a href="${item.link}" target="_blank" class="hover:underline">
              ${item.text}
            </a>`
            : `<p>${item.text}</p>`
        }
      </div>
    `;

  wrapper.innerHTML = content;
  contactList.appendChild(wrapper);
});

/* ================= Toggle Register ================= */

let isRegister = false;

// Seleksi Elemen DOM
const formTitle = document.getElementById("formTitle");
const formDesc = document.getElementById("formDesc");
const registerFields = document.getElementById("registerFields");
const loginPassword = document.getElementById("loginPassword");
const registerPassword = document.getElementById("registerPassword");
const submitBtn = document.getElementById("submitBtn");
const toggleForm = document.getElementById("toggleForm");
const loginNonMemberText = document.getElementById("loginNonMemberText");
const formMode = document.getElementById("formMode");

// Fungsi Toggle Mode (Login/Register)
toggleForm.addEventListener("click", () => {
  isRegister = !isRegister;

  if (isRegister) {
    // ===== REGISTER MODE =====
    if (formMode) formMode.value = "register";
    formTitle.textContent = "Register";
    formDesc.textContent =
      "Mohon lengkapi form dibawah agar kamu dapat mengakses internet kami.";

    registerFields.classList.remove("hidden");
    loginPassword.classList.add("hidden");
    registerPassword.classList.remove("hidden");

    submitBtn.textContent = "Register";
    toggleForm.textContent = "Klik disini untuk login member";
    loginNonMemberText.classList.add("hidden");
  } else {
    // ===== LOGIN MODE =====
    if (formMode) formMode.value = "login";
    formTitle.textContent = "Login Member";
    formDesc.textContent =
      "Mohon gunakan nomor WhatsApp anda ketika mendaftar aplikasi member CRM Club.";

    registerFields.classList.add("hidden");
    loginPassword.classList.remove("hidden");
    registerPassword.classList.add("hidden");

    submitBtn.textContent = "Login";
    toggleForm.textContent = "Klik disini untuk register";
    loginNonMemberText.classList.remove("hidden");
  }
});

// ===== Form Handling & Toast =====
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("authForm");
  const toast = document.getElementById("toast");
  const msg = document.getElementById("toastMessage");

  if (!form) {
    console.error("Form authForm tidak ditemukan");
    return;
  }

  // Fungsi untuk menampilkan Toast
  const showToast = (message, type = "success") => {
    // Reset state toast
    toast.classList.remove(
      "bg-green-600",
      "bg-red-600",
      "opacity-0",
      "translate-x-12",
      "pointer-events-none"
    );

    // Tambah style berdasarkan tipe
    toast.classList.add(type === "success" ? "bg-green-600" : "bg-red-600");
    msg.innerText = message;

    // Trigger animasi masuk
    requestAnimationFrame(() => {
      toast.classList.add("opacity-100", "translate-x-0");
    });

    // Trigger animasi keluar
    setTimeout(() => {
      toast.classList.remove("opacity-100", "translate-x-0");
      toast.classList.add("opacity-0", "translate-x-12", "pointer-events-none");
    }, 2800);
  };

  // Event Listener Submit Form
  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const formData = new FormData(form);

    try {
      const res = await fetch(form.action, {
        method: "POST",
        body: formData,
        credentials: "include", // penting untuk session cookie
      });

      const data = await res.json();
      showToast(data.message, data.status);

      function getProjectBase() {
        // contoh pathname: /wifi-login/auth/index.php  -> base: /wifi-login
        const parts = window.location.pathname.split("/").filter(Boolean);
        return parts.length ? `/${parts[0]}` : "";
      }

      if (data.status === "success") {
        const target =
          data.redirect || `${getProjectBase()}/dashboard/index.php`;
        setTimeout(() => {
          window.location.href = target;
        }, 800);
      }
    } catch (err) {
      showToast("Terjadi kesalahan server", "error");
    }
  });
});
