function showLogoutModal() {
  document.getElementById("logoutModal").classList.remove("hidden");
}

function closeLogoutModal() {
  document.getElementById("logoutModal").classList.add("hidden");
}

async function logout() {
  try {
    const res = await fetch("../auth/logout.php", {
      method: "POST",
      headers: {
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest",
      },
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
  closeLogoutModal();
}

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

const contacts = [
  {
    icon: "../assets/icons/mail.svg",
    text: "support@mikrotik.id",
    link: "mailto:support@mikrotik.id",
  },
  {
    icon: "../assets/icons/phone.svg",
    text: "+628871189999",
    link: "https://wa.me/628871189999",
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

      <div class="text-gray-700 text-sm text-left md:text-lg leading-relaxed">
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
