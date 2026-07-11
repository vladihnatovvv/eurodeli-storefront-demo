const FAVORITES_STORAGE_KEY = "eurodeli-favorite-items";
let toastTimer = null;

function showToast(message) {
  let toast = document.querySelector("[data-site-toast]");
  if (!toast) {
    toast = document.createElement("div");
    toast.className = "site-toast";
    toast.setAttribute("data-site-toast", "");
    document.body.appendChild(toast);
  }

  toast.textContent = message;
  toast.classList.add("is-visible");

  if (toastTimer) {
    window.clearTimeout(toastTimer);
  }

  toastTimer = window.setTimeout(() => {
    toast.classList.remove("is-visible");
  }, 2600);
}

function slugify(value) {
  return (value || "")
    .toLowerCase()
    .replace(/[^a-z0-9а-яіїєґ]+/gi, "-")
    .replace(/^-+|-+$/g, "");
}

function getFavoriteIds() {
  try {
    const raw = localStorage.getItem(FAVORITES_STORAGE_KEY);
    const parsed = raw ? JSON.parse(raw) : [];
    return Array.isArray(parsed) ? parsed.filter(Boolean) : [];
  } catch {
    return [];
  }
}

function setFavoriteIds(ids) {
  localStorage.setItem(FAVORITES_STORAGE_KEY, JSON.stringify(ids));
}

function toggleFavorite(productId) {
  const ids = getFavoriteIds();
  const next = ids.includes(productId)
    ? ids.filter((id) => id !== productId)
    : [...ids, productId];

  setFavoriteIds(next);
  return next.includes(productId);
}

function initMenuToggle() {
  const toggle = document.querySelector("[data-menu-toggle]");
  const nav = document.querySelector("[data-main-nav]");

  if (!toggle || !nav) return;

  toggle.addEventListener("click", () => {
    const isOpen = nav.classList.toggle("is-open");
    toggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
  });
}

function initProductGallery() {
  const mainImage = document.querySelector("[data-product-main-image]");
  const thumbs = Array.from(document.querySelectorAll("[data-product-thumb]"));
  if (!mainImage || thumbs.length === 0) return;

  const setActiveThumb = (activeThumb) => {
    thumbs.forEach((thumb) => {
      thumb.classList.toggle("is-active", thumb === activeThumb);
    });
  };

  thumbs.forEach((thumb) => {
    thumb.addEventListener("click", () => {
      const nextSrc = thumb.getAttribute("data-full");
      const nextAlt = thumb.getAttribute("data-alt") || mainImage.alt;
      if (!nextSrc) return;
      mainImage.src = nextSrc;
      mainImage.alt = nextAlt;
      setActiveThumb(thumb);
    });
  });

  setActiveThumb(thumbs[0]);
}

function initProductCards() {
  document.querySelectorAll(".product-card").forEach((card) => {
    const productLink = card.querySelector("h3 a[href]");
    const wishButton = card.querySelector(".product-card__wish");
    const titleText = productLink?.textContent?.trim() || "";
    const productId = card.dataset.productId || slugify(titleText);

    if (productId) {
      card.dataset.productId = productId;
    }

    if (productLink) {
      card.classList.add("product-card--interactive");
      card.addEventListener("click", (event) => {
        if (event.target.closest("a, button, input, textarea, select")) return;
        window.location.href = productLink.getAttribute("href");
      });
    }

    if (!wishButton || !productId) return;

    wishButton.setAttribute("aria-pressed", getFavoriteIds().includes(productId) ? "true" : "false");
    wishButton.classList.toggle("is-active", getFavoriteIds().includes(productId));

    wishButton.addEventListener("click", (event) => {
      event.preventDefault();
      event.stopPropagation();
      const active = toggleFavorite(productId);
      wishButton.classList.toggle("is-active", active);
      wishButton.setAttribute("aria-pressed", active ? "true" : "false");
      showToast(active ? `Товар "${titleText}" додано в обране.` : `Товар "${titleText}" прибрано з обраного.`);
    });
  });
}

function initSliders() {
  document.querySelectorAll("[data-slider-track]").forEach((track) => {
    const name = track.getAttribute("data-slider-track");
    const prev = document.querySelector(`[data-slider-prev="${name}"]`);
    const next = document.querySelector(`[data-slider-next="${name}"]`);
    const step = () => {
      const firstItem = track.firstElementChild;
      const gap = Number.parseFloat(window.getComputedStyle(track).columnGap || window.getComputedStyle(track).gap || "16");
      return firstItem ? firstItem.getBoundingClientRect().width + gap : 320;
    };

    if (prev) {
      prev.addEventListener("click", () => {
        track.scrollBy({ left: -step(), behavior: "smooth" });
      });
    }

    if (next) {
      next.addEventListener("click", () => {
        track.scrollBy({ left: step(), behavior: "smooth" });
      });
    }
  });
}

function initSearchUi() {
  const searchWrappers = document.querySelectorAll(".search");

  searchWrappers.forEach((search) => {
    const input = search.querySelector("input[type='search']");
    const button = search.querySelector(".search-submit");

    if (!input || !button) return;

    button.addEventListener("click", () => {
      const form = button.closest("form");
      if (form) {
        form.requestSubmit();
      } else {
        input.focus();
      }
    });
  });
}

function initFaq() {
  document.querySelectorAll(".faq-item").forEach((item) => {
    const icon = item.querySelector(".faq-item__icon");
    if (!icon) return;

    const sync = () => {
      icon.textContent = item.hasAttribute("open") ? "−" : "+";
    };

    item.addEventListener("toggle", sync);
    sync();
  });
}

document.addEventListener("DOMContentLoaded", () => {
  initMenuToggle();
  initProductGallery();
  initProductCards();
  initSliders();
  initSearchUi();
  initFaq();
});
