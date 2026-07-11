const navItems = [
  { href: "index.html", label: "Головна" },
  { href: "catalog.html", label: "Каталог" },
  { href: "sale.html", label: "Акції" },
  { href: "new.html", label: "Новинки" },
  { href: "about.html", label: "Про нас" },
  { href: "shipping.html", label: "Доставка й оплата" },
  { href: "contacts.html", label: "Контакти" }
];

const footerLinks = [
  { href: "about.html", label: "Про нас" },
  { href: "shipping.html", label: "Доставка й оплата" },
  { href: "returns.html", label: "Обмін / повернення" },
  { href: "contacts.html", label: "Контакти" },
  { href: "privacy.html", label: "Політика конфіденційності" },
  { href: "offer.html", label: "Публічна оферта" }
];

const PRODUCTS = [
  {
    id: "belgian-truffles-selection-300",
    name: "Belgian Truffles Selection 300 г",
    price: 329,
    oldPrice: 389,
    image: "assets/images/product-chocolate.jpg",
    href: "product.html",
    category: "Солодощі",
    description: "Асорті м'яких трюфелів у молочному та темному шоколаді."
  },
  {
    id: "lavazza-crema-gusto-1kg",
    name: "Кава Lavazza Crema e Gusto 1 кг",
    price: 845,
    image: "assets/images/product-coffee-good.jpg",
    href: "product.html",
    category: "Кава",
    description: "Насичений італійський бленд для автоматичних кавомашин."
  },
  {
    id: "salvis-pasta-bundle",
    name: "Salvi's Pasta Bundle 3 х 500 г",
    price: 549,
    image: "assets/images/product-pasta-good.jpg",
    href: "product.html",
    category: "Паста",
    description: "Преміальна добірка італійської пасти для домашньої кухні."
  },
  {
    id: "oreo-family-snack-pack",
    name: "Oreo Family Snack Pack",
    price: 215,
    oldPrice: 249,
    image: "assets/images/product-cookies.jpg",
    href: "product.html",
    category: "Снеки",
    description: "Мікс печива та солодких снеків для вечірок і подарунків."
  },
  {
    id: "wedel-delicje-orange",
    name: "Wedel Delicje Orange 147 г",
    price: 119,
    image: "assets/images/product-cookies.jpg",
    href: "product.html",
    category: "Солодощі",
    description: "Печиво з ніжним желе та шоколадною глазур'ю."
  },
  {
    id: "eurodeli-grocery-box",
    name: "EuroDeli Grocery Box",
    price: 699,
    oldPrice: 799,
    image: "assets/images/aisle.jpg",
    href: "product.html",
    category: "Набори",
    description: "Мікс бакалії та снеків із Європи для першого знайомства."
  },
  {
    id: "italian-pantry-essentials",
    name: "Italian Pantry Essentials Set",
    price: 629,
    image: "assets/images/aisle.jpg",
    href: "product.html",
    category: "Бакалія",
    description: "Паста, томатна основа, оливкова олія та спеції в одному наборі."
  },
  {
    id: "tea-cookies-gift-duo",
    name: "Tea & Cookies Gift Duo",
    price: 289,
    image: "assets/images/product-coffee-good.jpg",
    href: "product.html",
    category: "Подарунки",
    description: "Подарункове поєднання ароматного чаю та європейського печива."
  },
  {
    id: "milka-choco-wafer",
    name: "Milka Choco Wafer 180 г",
    price: 129,
    image: "assets/images/product-cookies.jpg",
    href: "product.html",
    category: "Солодощі",
    description: "Хрусткі вафлі в молочному шоколаді."
  },
  {
    id: "prince-polo-xxl",
    name: "Prince Polo XXL 50 г",
    price: 49,
    image: "assets/images/product-chocolate.jpg",
    href: "product.html",
    category: "Солодощі",
    description: "Легендарний польський батончик з вафельною текстурою."
  },
  {
    id: "wedel-chocolate-mix",
    name: "Wedel Chocolate Mix 220 г",
    price: 259,
    oldPrice: 299,
    image: "assets/images/product-chocolate.jpg",
    href: "product.html",
    category: "Солодощі",
    description: "Асорті польського шоколаду в подарунковому форматі."
  },
  {
    id: "delicje-orange",
    name: "Delicje Orange 147 г",
    price: 82,
    image: "assets/images/product-cookies.jpg",
    href: "product.html",
    category: "Солодощі",
    description: "Печиво з апельсиновим желе та тонким шаром шоколаду."
  },
  {
    id: "costa-coffee-crema-intense",
    name: "Costa Coffee Crema Intense",
    price: 899,
    image: "assets/images/product-coffee-good.jpg",
    href: "product.html",
    category: "Кава",
    description: "Зернова кава для еспресо-машин."
  },
  {
    id: "toblerone-white",
    name: "Toblerone White 100 г",
    price: 119,
    image: "assets/images/product-chocolate.jpg",
    href: "product.html",
    category: "Солодощі",
    description: "Білий шоколад зі Швейцарії."
  }
];

const CART_STORAGE_KEY = "eurodeli-cart-items";
const FAVORITES_STORAGE_KEY = "eurodeli-favorite-items";
let toastTimer = null;

function currentPage() {
  const path = window.location.pathname.split("/").pop();
  return path || "index.html";
}

function formatPrice(value) {
  return `${value} грн`;
}

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

function currentQuery() {
  return new URLSearchParams(window.location.search);
}

function getProductById(id) {
  return PRODUCTS.find((product) => product.id === id) || null;
}

function findProductByName(name) {
  return PRODUCTS.find((product) => product.name === name) || null;
}

function slugify(value) {
  return (value || "")
    .toLowerCase()
    .replace(/[^a-z0-9а-яіїєґ]+/gi, "-")
    .replace(/^-+|-+$/g, "");
}

function cartButtonMarkup(label = "Додати в кошик") {
  return `
    <svg class="btn__icon" viewBox="0 0 24 24" aria-hidden="true">
      <path d="M3 5H5L7.2 14.2C7.31 14.66 7.81 15 8.32 15H18.4C18.87 15 19.29 14.72 19.47 14.3L21.6 9.3C21.88 8.64 21.39 7.9 20.66 7.9H8.1"></path>
      <circle cx="9.2" cy="19" r="1.6"></circle>
      <circle cx="17.2" cy="19" r="1.6"></circle>
    </svg>
    <span class="btn__label">${label}</span>
  `;
}

function setCartButtonLabel(button, label = "Додати в кошик") {
  if (!button) return;
  button.innerHTML = cartButtonMarkup(label);
}

function setWishlistButtonLabel(button) {
  if (!button) return;
  button.innerHTML = `
    <svg class="product-card__wish-icon" viewBox="0 0 24 24" aria-hidden="true">
      <path d="M12 21.35 10.55 20.03C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z"></path>
    </svg>
  `;
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

function isFavorite(productId) {
  return getFavoriteIds().includes(productId);
}

function toggleFavorite(productId) {
  const ids = getFavoriteIds();
  const next = ids.includes(productId)
    ? ids.filter((id) => id !== productId)
    : [...ids, productId];
  setFavoriteIds(next);
  return next.includes(productId);
}

function getCartItems() {
  try {
    const raw = localStorage.getItem(CART_STORAGE_KEY);
    const parsed = raw ? JSON.parse(raw) : [];
    if (!Array.isArray(parsed)) return [];
    return parsed
      .map((item) => normalizeCartItem(item))
      .filter(Boolean);
  } catch {
    return [];
  }
}

function setCartItems(items) {
  localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(items));
  updateCartCount();
}

function getCartCount() {
  return getCartItems().reduce((sum, item) => sum + item.qty, 0);
}

function normalizeCartItem(item) {
  if (!item) return null;
  const known = item.id ? getProductById(item.id) : null;
  const name = item.name || known?.name;
  const price = Number(item.price ?? known?.price ?? 0);

  if (!name || !price) return null;

  return {
    id: item.id || known?.id || slugify(name),
    name,
    price,
    oldPrice: Number(item.oldPrice ?? known?.oldPrice ?? 0) || undefined,
    image: item.image || known?.image || "assets/images/hero.webp",
    href: item.href || known?.href || "product.html",
    category: item.category || known?.category || "Товари",
    description: item.description || known?.description || "",
    qty: Math.max(1, Number(item.qty) || 1)
  };
}

function updateCartCount() {
  const count = getCartCount();
  document.querySelectorAll("[data-cart-count]").forEach((node) => {
    node.textContent = String(count);
  });
}

function addToCart(product) {
  if (!product) return;
  const items = getCartItems();
  const normalizedProduct = normalizeCartItem({ ...product, qty: 1 });
  if (!normalizedProduct) return;
  const existing = items.find((item) => item.id === normalizedProduct.id);
  if (existing) {
    existing.qty += 1;
  } else {
    items.push(normalizedProduct);
  }
  setCartItems(items);
}

function updateCartItem(productId, qty) {
  const items = getCartItems()
    .map((item) => (item.id === productId ? { ...item, qty } : item))
    .filter((item) => item.qty > 0);
  setCartItems(items);
  renderCartPage();
}

function removeCartItem(productId) {
  const items = getCartItems().filter((item) => item.id !== productId);
  setCartItems(items);
  renderCartPage();
}

function renderHeader() {
  const active = currentPage();
  const headerHost = document.querySelector("[data-site-header]");
  if (!headerHost) return;

  const navLinks = navItems
    .map((item) => {
      const activeClass = item.href === active ? "nav-link is-active" : "nav-link";
      return `<a class="${activeClass}" href="${item.href}">${item.label}</a>`;
    })
    .join("");

  headerHost.innerHTML = `
    <div class="topbar">
      <div class="container topbar__inner">
        <div class="topbar__meta">
          <span>Доставка по Україні</span>
          <span>Самовивіз у Києві</span>
          <span>Пн-Нд: 09:00–20:00</span>
        </div>
        <div class="topbar__links">
          <a href="sale.html">Акції</a>
          <a href="new.html">Новинки</a>
          <a href="contacts.html">Кабінет</a>
          <a href="contacts.html">Зворотний зв'язок</a>
          <a href="tel:+380980000000">+38 (098) 000-00-00</a>
        </div>
      </div>
    </div>
    <header class="site-header">
      <div class="container header__inner header__inner--reference">
        <a class="brand" href="index.html" aria-label="На головну">
          <div class="brand__title">EuroDeli</div>
          <div class="brand__subtitle">Європейські продукти та делікатеси</div>
        </a>
        <a class="catalog-button" href="catalog.html" aria-label="Відкрити каталог товарів">
          <svg viewBox="0 0 24 24" aria-hidden="true">
            <rect x="3" y="4" width="7" height="7" rx="1.5"></rect>
            <rect x="14" y="4" width="7" height="7" rx="1.5"></rect>
            <rect x="3" y="13" width="7" height="7" rx="1.5"></rect>
            <rect x="14" y="13" width="7" height="7" rx="1.5"></rect>
          </svg>
          <span>Каталог</span>
        </a>
        <div class="search search--retail">
          <input type="search" placeholder="Пошук товарів, брендів, категорій" aria-label="Пошук" data-search-input autocomplete="off">
          <button class="search-submit" type="button" aria-label="Шукати">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <circle cx="11" cy="11" r="6.5"></circle>
              <path d="M16 16 21 21"></path>
            </svg>
          </button>
          <div class="search-results" data-search-results hidden></div>
        </div>
        <div class="header__actions">
          <a class="icon-chip" href="sale.html" aria-label="Акції">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M19 5 5 19"></path>
              <circle cx="7" cy="7" r="2.2"></circle>
              <circle cx="17" cy="17" r="2.2"></circle>
            </svg>
          </a>
          <a class="icon-chip" href="index.html" aria-label="Обране">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M12 21.35 10.55 20.03C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z"></path>
            </svg>
          </a>
          <a class="icon-chip icon-chip--cart" href="cart.html" aria-label="Кошик">
            <svg viewBox="0 0 24 24" aria-hidden="true">
              <path d="M3 5H5L7.2 14.2C7.31 14.66 7.81 15 8.32 15H18.4C18.87 15 19.29 14.72 19.47 14.3L21.6 9.3C21.88 8.64 21.39 7.9 20.66 7.9H8.1"></path>
              <circle cx="9.2" cy="19" r="1.6"></circle>
              <circle cx="17.2" cy="19" r="1.6"></circle>
            </svg>
            <span data-cart-count>0</span>
          </a>
        </div>
        <button class="menu-toggle" type="button" data-menu-toggle>Меню</button>
      </div>
      <nav class="main-nav" data-main-nav>
        <div class="container main-nav__inner">
          ${navLinks}
        </div>
      </nav>
    </header>
  `;

  const toggle = headerHost.querySelector("[data-menu-toggle]");
  const nav = headerHost.querySelector("[data-main-nav]");
  if (toggle && nav) {
    toggle.addEventListener("click", () => nav.classList.toggle("is-open"));
  }
}

function renderFooter() {
  const footerHost = document.querySelector("[data-site-footer]");
  if (!footerHost) return;

  const links = footerLinks.map((item) => `<a href="${item.href}">${item.label}</a>`).join("");

  footerHost.innerHTML = `
    <footer class="footer">
      <div class="container footer__top">
        <div class="footer__brand footer-card footer-card--brand">
          <div class="footer-mark">
            <div class="footer-mark__crest">ED</div>
            <div>
              <div class="footer-mark__title">EuroDeli Market</div>
              <div class="footer-mark__subtitle">Європейські продукти та делікатеси</div>
            </div>
          </div>
          <p>Інтернет-магазин із продуманим каталогом, великими фото товарів, акційними добірками, кошиком і готовими сторінками для презентації замовниці.</p>
          <div class="footer-payments">
            <span class="pill">Visa / Mastercard</span>
            <span class="pill">Післяплата</span>
            <span class="pill">Відправка щодня</span>
          </div>
        </div>
        <div class="footer__cols">
          <div class="footer-card">
            <h3>Контакти</h3>
            <div class="footer-links footer-links--stack">
              <a href="tel:+380980000000">+38 (098) 000-00-00</a>
              <a href="mailto:hello@eurodeli.ua">hello@eurodeli.ua</a>
              <span>м. Київ, Україна</span>
              <span>Пн-Пт: 09:00-20:00</span>
              <span>Сб: 10:00-18:00</span>
              <span>Нд: 10:00-16:00</span>
            </div>
          </div>
          <div class="footer-card">
            <h3>Про магазин</h3>
            <div class="footer-links footer-links--stack">${links}</div>
          </div>
          <div class="footer-card">
            <h3>Каталог товарів</h3>
            <div class="footer-links footer-links--stack">
              <a href="category.html">Солодощі та шоколад</a>
              <a href="category.html">Кава та чай</a>
              <a href="category.html">Паста та бакалія</a>
              <a href="category.html">Соуси та спеції</a>
              <a href="catalog.html">Дивитися весь каталог</a>
            </div>
          </div>
        </div>
      </div>
      <div class="container footer__bottom">
        <span>© 2026 EuroDeli. Усі права захищені.</span>
        <div class="socials">
          <a class="pill" href="contacts.html">Instagram</a>
          <a class="pill" href="contacts.html">Facebook</a>
          <a class="pill" href="contacts.html">Telegram</a>
        </div>
      </div>
    </footer>
  `;
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

function extractProductData(card) {
  const titleLink = card.querySelector("h3 a[href]");
  if (!titleLink) return null;
  const name = titleLink.textContent.trim();
  const known = findProductByName(name);
  if (known) return known;

  const priceText = card.querySelector(".price")?.textContent || "";
  const oldPriceText = card.querySelector(".old-price")?.textContent || "";

  return {
    id: slugify(name),
    name,
    price: Number(priceText.replace(/[^\d]/g, "")) || 0,
    oldPrice: oldPriceText ? Number(oldPriceText.replace(/[^\d]/g, "")) || undefined : undefined,
    image: card.querySelector("img")?.getAttribute("src") || "assets/images/hero.webp",
    href: titleLink.getAttribute("href") || "product.html",
    category: card.querySelector(".tag")?.textContent?.trim() || "Товари",
    description: card.querySelector("p")?.textContent?.trim() || ""
  };
}

function assignProductIds() {
  document.querySelectorAll(".product-card").forEach((card) => {
    const titleLink = card.querySelector("h3 a[href]");
    if (!titleLink) return;
    card.dataset.productId = slugify(titleLink.textContent.trim());
  });

  const productMetaTitle = document.querySelector(".product-meta h1");
  if (productMetaTitle) {
    document.querySelector(".product-layout")?.setAttribute("data-product-id", slugify(productMetaTitle.textContent.trim()));
  }
}

function initStoreInteractions() {
  assignProductIds();

  document.querySelectorAll(".product-card").forEach((card) => {
    const productLink = card.querySelector("h3 a[href]");
    const addButton = card.querySelector(".product-add, .btn--brand");
    const wishButton = card.querySelector(".product-card__wish");
    const product = extractProductData(card);
    if (!productLink || !addButton || !product) return;

    card.classList.add("product-card--interactive");
    if (!addButton.classList.contains("product-add")) {
      setCartButtonLabel(addButton);
    }
    setWishlistButtonLabel(wishButton);
    if (wishButton) {
      wishButton.classList.toggle("is-active", isFavorite(product.id));
      wishButton.setAttribute("aria-pressed", wishButton.classList.contains("is-active") ? "true" : "false");
      wishButton.addEventListener("click", (event) => {
        event.preventDefault();
        event.stopPropagation();
        const active = toggleFavorite(product.id);
        wishButton.classList.toggle("is-active", active);
        wishButton.setAttribute("aria-pressed", active ? "true" : "false");
        showToast(active ? `Товар "${product.name}" додано в обране.` : `Товар "${product.name}" прибрано з обраного.`);
      });
    }
    addButton.setAttribute("href", "#");
    addButton.setAttribute("data-add-to-cart", "");
    addButton.dataset.product = encodeURIComponent(JSON.stringify(product));

    card.addEventListener("click", (event) => {
      if (event.target.closest("a, button, input, textarea")) return;
      window.location.href = productLink.getAttribute("href");
    });
  });

  const mainProductButton = document.querySelector(".product-purchase .btn--brand");
  const productMetaTitle = document.querySelector(".product-meta h1");
  if (mainProductButton && productMetaTitle) {
    const product = {
      id: slugify(productMetaTitle.textContent.trim()),
      name: productMetaTitle.textContent.trim(),
      price: Number((document.querySelector(".product-purchase .price")?.textContent || "").replace(/[^\d]/g, "")) || 0,
      oldPrice: Number((document.querySelector(".product-purchase .old-price")?.textContent || "").replace(/[^\d]/g, "")) || undefined,
      image: document.querySelector("[data-product-main-image]")?.getAttribute("src") || "assets/images/hero.webp",
      href: "product.html",
      category: document.querySelector(".tag")?.textContent?.trim() || "Товари",
      description: document.querySelector(".product-meta p")?.textContent?.trim() || ""
    };
    mainProductButton.setAttribute("href", "#");
    mainProductButton.setAttribute("data-add-to-cart", "");
    mainProductButton.dataset.product = encodeURIComponent(JSON.stringify(product));
    setCartButtonLabel(mainProductButton);
  }
}

function cartDetailedItems() {
  return getCartItems()
    .map((item) => ({
      ...item,
      image: item.image || "assets/images/hero.webp",
      href: item.href || "product.html",
      category: item.category || "Товари",
      description: item.description || "",
      total: item.price * item.qty
    }))
    .filter(Boolean);
}

function renderCartPage() {
  const cartRoot = document.querySelector("[data-cart-page]");
  if (!cartRoot) return;

  const items = cartDetailedItems();
  if (items.length === 0) {
    cartRoot.innerHTML = `
      <div class="content-card card">
        <h2>Кошик порожній</h2>
        <p>Додайте товари з каталогу, щоб побачити їх тут.</p>
        <a class="btn btn--brand" href="catalog.html">Перейти в каталог</a>
      </div>
    `;
    return;
  }

  const total = items.reduce((sum, item) => sum + item.total, 0);
  const itemsHtml = items
    .map(
      (item) => `
        <article class="cart-item card">
          <div class="cart-item__media"><img src="${item.image}" alt="${item.name}"></div>
          <div class="cart-item__body">
            <h3><a href="${item.href}">${item.name}</a></h3>
            <p>${item.description}</p>
            <div class="cart-item__meta">
              <strong>${formatPrice(item.price)}</strong>
              <div class="cart-controls">
                <button type="button" class="qty-btn" data-qty-change="${item.id}" data-delta="-1">−</button>
                <span>${item.qty}</span>
                <button type="button" class="qty-btn" data-qty-change="${item.id}" data-delta="1">+</button>
              </div>
              <strong>${formatPrice(item.total)}</strong>
              <button type="button" class="remove-btn" data-remove-item="${item.id}">Видалити</button>
            </div>
          </div>
        </article>
      `
    )
    .join("");

  cartRoot.innerHTML = `
    <div class="cart-layout">
      <div class="cart-items">${itemsHtml}</div>
      <aside class="cart-summary card">
        <h3>Ваше замовлення</h3>
        <div class="cart-summary__row"><span>Товарів</span><strong>${getCartCount()}</strong></div>
        <div class="cart-summary__row"><span>До сплати</span><strong>${formatPrice(total)}</strong></div>
        <button class="btn btn--brand" type="button" data-checkout-toggle>Оформити замовлення</button>
        <form class="site-form cart-checkout-form" data-checkout-form hidden>
          <label>
            <span>Ім'я</span>
            <input type="text" name="name" placeholder="Ваше ім'я" required>
          </label>
          <label>
            <span>Телефон</span>
            <input type="tel" name="phone" placeholder="+38 (0__) ___-__-__" required>
          </label>
          <label>
            <span>Email (за бажанням)</span>
            <input type="email" name="email" placeholder="your@email.com">
          </label>
          <label>
            <span>Адреса доставки</span>
            <input type="text" name="address" placeholder="Місто, вулиця, будинок, квартира" required>
          </label>
          <label>
            <span>Коментар до замовлення</span>
            <textarea name="comment" rows="4" placeholder="Наприклад: зателефонувати перед відправкою"></textarea>
          </label>
          <button class="btn btn--brand" type="submit">Підтвердити замовлення</button>
        </form>
      </aside>
    </div>
  `;

  cartRoot.querySelectorAll("[data-qty-change]").forEach((button) => {
    button.addEventListener("click", () => {
      const productId = button.getAttribute("data-qty-change");
      const delta = Number(button.getAttribute("data-delta") || "0");
      const item = getCartItems().find((entry) => entry.id === productId);
      if (!item) return;
      updateCartItem(productId, item.qty + delta);
    });
  });

  cartRoot.querySelectorAll("[data-remove-item]").forEach((button) => {
    button.addEventListener("click", () => {
      removeCartItem(button.getAttribute("data-remove-item"));
    });
  });

  const checkoutToggle = cartRoot.querySelector("[data-checkout-toggle]");
  const checkoutForm = cartRoot.querySelector("[data-checkout-form]");

  if (checkoutToggle && checkoutForm) {
    checkoutToggle.addEventListener("click", () => {
      checkoutForm.hidden = false;
      checkoutToggle.hidden = true;
      checkoutForm.querySelector("input")?.focus();
    });

    checkoutForm.addEventListener("submit", (event) => {
      event.preventDefault();
      const formData = new FormData(checkoutForm);
      const name = String(formData.get("name") || "").trim();
      const phone = String(formData.get("phone") || "").trim();
      const address = String(formData.get("address") || "").trim();
      if (!name || !phone || !address) {
        showToast("Заповніть ім'я, телефон і адресу для оформлення.");
        return;
      }

      localStorage.removeItem(CART_STORAGE_KEY);
      updateCartCount();
      renderCartPage();
      showToast(`Замовлення для ${name} прийнято. Менеджер зв'яжеться найближчим часом.`);
    });
  }
}

function renderSearchResults(resultsHost, results) {
  if (results.length === 0) {
    resultsHost.hidden = false;
    resultsHost.innerHTML = `<div class="search-results__empty">Нічого не знайдено</div>`;
    return;
  }

  resultsHost.hidden = false;
  resultsHost.innerHTML = results
    .slice(0, 6)
    .map(
      (product) => `
        <a class="search-result" href="${product.href}">
          <img src="${product.image}" alt="${product.name}">
          <div>
            <strong>${product.name}</strong>
            <span>${product.category} · ${formatPrice(product.price)}</span>
          </div>
        </a>
      `
    )
    .join("");
}

function getSearchProducts() {
  const productsMap = new Map();

  PRODUCTS.forEach((product) => {
    productsMap.set(product.id, normalizeCartItem({ ...product, qty: 1 }));
  });

  document.querySelectorAll(".product-card").forEach((card) => {
    const product = extractProductData(card);
    const normalized = normalizeCartItem({ ...product, qty: 1 });
    if (normalized) {
      productsMap.set(normalized.id, normalized);
    }
  });

  const productMetaTitle = document.querySelector(".product-meta h1");
  if (productMetaTitle) {
    const currentProduct = normalizeCartItem({
      id: slugify(productMetaTitle.textContent.trim()),
      name: productMetaTitle.textContent.trim(),
      price: Number((document.querySelector(".product-purchase .price")?.textContent || "").replace(/[^\d]/g, "")) || 0,
      oldPrice: Number((document.querySelector(".product-purchase .old-price")?.textContent || "").replace(/[^\d]/g, "")) || undefined,
      image: document.querySelector("[data-product-main-image]")?.getAttribute("src") || "assets/images/hero.webp",
      href: "product.html",
      category: document.querySelector(".product-meta .tag")?.textContent?.trim() || "Товари",
      description: document.querySelector(".product-meta p")?.textContent?.trim() || "",
      qty: 1
    });
    if (currentProduct) {
      productsMap.set(currentProduct.id, currentProduct);
    }
  }

  return Array.from(productsMap.values());
}

function initSearch() {
  const input = document.querySelector("[data-search-input]");
  const resultsHost = document.querySelector("[data-search-results]");
  const submitButton = document.querySelector(".search-submit");
  if (!input || !resultsHost) return;
  const searchProducts = getSearchProducts();

  const searchFromQuery = currentQuery().get("search");
  if (searchFromQuery) {
    input.value = searchFromQuery;
  }

  const applyFilterToCatalog = (term) => {
    const cards = Array.from(document.querySelectorAll(".content-card .product-card"));
    if (cards.length === 0) return;
    const normalized = term.trim().toLowerCase();
    cards.forEach((card) => {
      const title = card.querySelector("h3")?.textContent?.toLowerCase() || "";
      const text = card.textContent.toLowerCase();
      const visible = !normalized || title.includes(normalized) || text.includes(normalized);
      card.style.display = visible ? "" : "none";
    });
  };

  if (searchFromQuery) {
    applyFilterToCatalog(searchFromQuery);
  }

  input.addEventListener("input", () => {
    const term = input.value.trim().toLowerCase();
    if (!term) {
      resultsHost.hidden = true;
      resultsHost.innerHTML = "";
      applyFilterToCatalog("");
      return;
    }

    const results = searchProducts.filter((product) => {
      const haystack = `${product.name} ${product.category} ${product.description}`.toLowerCase();
      return haystack.includes(term);
    });

    renderSearchResults(resultsHost, results);
    applyFilterToCatalog(term);
  });

  input.addEventListener("keydown", (event) => {
    if (event.key !== "Enter") return;
    const term = input.value.trim();
    if (!term) return;
    event.preventDefault();
    window.location.href = `catalog.html?search=${encodeURIComponent(term)}`;
  });

  submitButton?.addEventListener("click", () => {
    const term = input.value.trim();
    if (!term) {
      input.focus();
      return;
    }
    window.location.href = `catalog.html?search=${encodeURIComponent(term)}`;
  });

  document.addEventListener("click", (event) => {
    if (!event.target.closest(".search")) {
      resultsHost.hidden = true;
    }
  });
}

function initNewsletterForm() {
  const form = document.querySelector("[data-newsletter-form]");
  if (!form) return;

  form.addEventListener("submit", (event) => {
    event.preventDefault();
    const email = form.querySelector('input[name="email"]')?.value.trim() || "";
    if (!email || !email.includes("@")) {
      showToast("Введіть коректний email для підписки.");
      return;
    }

    form.reset();
    showToast("Дякуємо! Підписку на акції та новинки оформлено.");
  });
}

function initContactForm() {
  const form = document.querySelector("[data-contact-form]");
  if (!form) return;

  const params = currentQuery();
  const topic = params.get("topic") || "";
  const product = params.get("product") || "";
  const hiddenTopic = form.querySelector('input[name="topic"]');
  const messageField = form.querySelector('textarea[name="message"]');
  const contextBadge = document.querySelector("[data-contact-context]");

  if (hiddenTopic) {
    hiddenTopic.value = topic;
  }

  if (contextBadge && topic) {
    contextBadge.hidden = false;
    contextBadge.textContent = topic === "one-click" && product ? `Швидке замовлення: ${product}` : "Заявка з сайту";
  }

  if (messageField && topic === "one-click" && product && !messageField.value.trim()) {
    messageField.value = `Хочу оформити швидке замовлення на товар: ${product}.`;
  }

  form.addEventListener("submit", (event) => {
    event.preventDefault();
    const formData = new FormData(form);
    const name = String(formData.get("name") || "").trim();
    const phone = String(formData.get("phone") || "").trim();
    if (!name || !phone) {
      showToast("Заповніть ім'я та телефон, щоб надіслати заявку.");
      return;
    }

    form.reset();
    if (hiddenTopic) hiddenTopic.value = topic;
    if (messageField && topic === "one-click" && product) {
      messageField.value = `Хочу оформити швидке замовлення на товар: ${product}.`;
    }
    showToast("Заявку надіслано. Менеджер зв'яжеться з вами найближчим часом.");
  });
}

function initCart() {
  updateCartCount();

  document.querySelectorAll("[data-add-to-cart]").forEach((button) => {
    button.addEventListener("click", (event) => {
      event.preventDefault();
      event.stopPropagation();
      const product = button.dataset.product ? JSON.parse(decodeURIComponent(button.dataset.product)) : null;
      if (!product) return;
      addToCart(product);

      const initialText = button.classList.contains("product-add") ? "+" : "Додати в кошик";
      if (button.classList.contains("product-add")) {
        button.textContent = "✓";
      } else {
        setCartButtonLabel(button, "Додано");
      }
      showToast(`Товар "${product.name}" додано в кошик.`);
      window.setTimeout(() => {
        if (button.classList.contains("product-add")) {
          button.textContent = initialText;
        } else {
          setCartButtonLabel(button, initialText);
        }
      }, 900);
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

document.addEventListener("DOMContentLoaded", () => {
  renderHeader();
  renderFooter();
  initStoreInteractions();
  initCart();
  initProductGallery();
  initSliders();
  initSearch();
  initNewsletterForm();
  initContactForm();
  renderCartPage();
});
