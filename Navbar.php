<?php

/* =========================================================
PROFILE IMAGE
========================================================= */

 $profileImage = "https://i.imgur.com/2DhmtJ4.png";

if (isset($_SESSION['profile_image']) && !empty($_SESSION['profile_image'])) {

    $profileImage = $_SESSION['profile_image'];

}

/* =========================================================
CURRENT PAGE
========================================================= */

 $currentPage = basename($_SERVER['PHP_SELF']);

?>

<!-- =========================================================
PREMIUM NAVBAR — HUNGROO CAFÉ
========================================================= -->
<link
rel="stylesheet"
href="assets/css/navbar.css">
<div class="navbar-wrapper" id="navbarWrapper">

    <nav class="navbar">

        <!-- =========================================================
        LEFT — LOGO
        ========================================================= -->

        <a href="home.php" class="navbar-logo">

            <div class="logo-icon">

                <img src="https://i.imgur.com/8Km9tLL.png" alt="Hungroo Café">

            </div>

            <div class="logo-text">

                <span class="logo-name">HUNGROO</span>

                <span class="logo-sub">CAFÉ</span>

            </div>

        </a>

        <!-- =========================================================
        CENTER — NAV LINKS
        ========================================================= -->

        <div class="navbar-links" id="mobileMenu">

            <a href="home.php" class="nav-link <?php echo $currentPage == 'home.php' ? 'active' : ''; ?>">

                <i class="fa-solid fa-house"></i>

                <span>Home</span>

            </a>

            <a href="menu.php" class="nav-link <?php echo $currentPage == 'menu.php' ? 'active' : ''; ?>">

                <i class="fa-solid fa-utensils"></i>

                <span>Menu</span>

            </a>

            <a href="offers.php" class="nav-link <?php echo $currentPage == 'offers.php' ? 'active' : ''; ?>">

                <i class="fa-solid fa-tags"></i>

                <span>Offers</span>

            </a>

            <a href="gallery.php" class="nav-link <?php echo $currentPage == 'gallery.php' ? 'active' : ''; ?>">

                <i class="fa-solid fa-images"></i>

                <span>Gallery</span>

            </a>

            <a href="about.php" class="nav-link <?php echo $currentPage == 'about.php' ? 'active' : ''; ?>">

                <i class="fa-solid fa-circle-info"></i>

                <span>About</span>

            </a>

            <a href="contact.php" class="nav-link <?php echo $currentPage == 'contact.php' ? 'active' : ''; ?>">

                <i class="fa-solid fa-envelope"></i>

                <span>Contact</span>

            </a>

            <!-- =========================================================
            MOBILE ONLY — EXTRA ACTIONS
            ========================================================= -->

            <div class="mobile-extra-actions">

                <!-- MOBILE CART BUTTON -->

                <button class="mobile-cart-btn" id="mobileOpenCart">

                    <div class="mobile-cart-left">

                        <i class="fa-solid fa-cart-shopping"></i>

                        <span>My Cart</span>

                    </div>

                    <span class="mobile-cart-badge cart-count">0</span>

                </button>

                <!-- MOBILE PROFILE / LOGIN -->

                <?php if (isset($_SESSION['user_id'])): ?>

                    <a href="profile.php" class="mobile-profile-btn">

                        <img src="<?php echo $profileImage; ?>" alt="Profile">

                        <span>My Profile</span>

                    </a>

                    <a href="orders.php" class="mobile-profile-btn">

                        <i class="fa-solid fa-bag-shopping"></i>

                        <span>My Orders</span>

                    </a>

                    <a href="logout.php" class="mobile-profile-btn mobile-logout">

                        <i class="fa-solid fa-right-from-bracket"></i>

                        <span>Logout</span>

                    </a>

                <?php else: ?>

                    <a href="login.php" class="mobile-profile-btn">

                        <i class="fa-solid fa-right-to-bracket"></i>

                        <span>Login / Sign Up</span>

                    </a>

                <?php endif; ?>

            </div>

        </div>

        <!-- =========================================================
        RIGHT — ACTIONS
        ========================================================= -->

        <div class="navbar-actions">

            <!-- THEME TOGGLE -->

            <button class="action-btn theme-toggle-btn" id="themeToggle" title="Toggle theme">

                <i class="fa-solid fa-moon" id="themeIcon"></i>

            </button>

            <!-- CART BUTTON -->

            <button class="action-btn cart-btn" id="desktopOpenCart" title="Cart">

                <i class="fa-solid fa-cart-shopping"></i>

                <span class="cart-count">0</span>

            </button>

            <!-- USER / LOGIN -->

            <?php if (isset($_SESSION['user_id'])): ?>

                <div class="user-dropdown">

                    <button class="action-btn user-btn" id="userDropdownBtn">

                        <img src="<?php echo $profileImage; ?>" alt="Profile">

                    </button>

                    <div class="dropdown-menu" id="userDropdown">

                        <div class="dropdown-header">

                            <img src="<?php echo $profileImage; ?>" alt="Profile">

                            <div>

                                <strong><?php echo htmlspecialchars($_SESSION['name'] ?? 'User'); ?></strong>

                                <span><?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?></span>

                            </div>

                        </div>

                        <div class="dropdown-divider"></div>

                        <a href="profile.php">

                            <i class="fa-solid fa-user"></i>

                            Profile

                        </a>

                        <a href="orders.php">

                            <i class="fa-solid fa-bag-shopping"></i>

                            My Orders

                        </a>

                        <div class="dropdown-divider"></div>

                        <a href="logout.php" class="dropdown-logout">

                            <i class="fa-solid fa-right-from-bracket"></i>

                            Logout

                        </a>

                    </div>

                </div>

            <?php else: ?>

                <a href="login.php" class="login-btn">

                    <i class="fa-solid fa-user"></i>

                    <span>Login</span>

                </a>

            <?php endif; ?>

            <!-- MOBILE HAMBURGER -->

            <button class="action-btn mobile-menu-btn" id="mobileMenuBtn" title="Menu">

                <span class="hamburger-line"></span>

                <span class="hamburger-line"></span>

                <span class="hamburger-line"></span>

            </button>

        </div>

    </nav>

</div>

<!-- =========================================================
MOBILE OVERLAY
======================================================== -->

<div class="mobile-overlay" id="mobileOverlay"></div>

<!-- =========================================================
NAVBAR SCRIPTS
======================================================== -->

<script>

/* =========================================================
MOBILE MENU
======================================================== */

const mobileMenuBtn = document.getElementById('mobileMenuBtn');

const mobileMenu = document.getElementById('mobileMenu');

const mobileOverlay = document.getElementById('mobileOverlay');

function toggleMobileMenu() {

    const isOpen = mobileMenu.classList.toggle('active');

    mobileOverlay.classList.toggle('active', isOpen);

    mobileMenuBtn.classList.toggle('is-open', isOpen);

    document.body.style.overflow = isOpen ? 'hidden' : '';

}

mobileMenuBtn.addEventListener('click', toggleMobileMenu);

mobileOverlay.addEventListener('click', toggleMobileMenu);

/* Close mobile menu on link click */

mobileMenu.querySelectorAll('.nav-link').forEach(link => {

    link.addEventListener('click', () => {

        if (mobileMenu.classList.contains('active')) {

            toggleMobileMenu();

        }

    });

});

/* =========================================================
USER DROPDOWN
======================================================== */

const userDropdownBtn = document.getElementById('userDropdownBtn');

const userDropdown = document.getElementById('userDropdown');

if (userDropdownBtn && userDropdown) {

    userDropdownBtn.addEventListener('click', (e) => {

        e.stopPropagation();

        userDropdown.classList.toggle('active');

    });

    document.addEventListener('click', (e) => {

        if (!userDropdown.contains(e.target)) {

            userDropdown.classList.remove('active');

        }

    });

}

/* =========================================================
THEME SYSTEM
======================================================== */

const themeToggle = document.getElementById('themeToggle');

const themeIcon = document.getElementById('themeIcon');

const savedTheme = localStorage.getItem('theme') || 'dark';

function applyTheme(theme) {

    document.documentElement.setAttribute('data-theme', theme);

    if (theme === 'light') {

        themeIcon.className = 'fa-solid fa-sun';

    } else {

        themeIcon.className = 'fa-solid fa-moon';

    }

    localStorage.setItem('theme', theme);

}

applyTheme(savedTheme);

themeToggle.addEventListener('click', () => {

    const current = document.documentElement.getAttribute('data-theme');

    applyTheme(current === 'dark' ? 'light' : 'dark');

});

/* =========================================================
NAVBAR SCROLL BEHAVIOR
======================================================== */

const navbarWrapper = document.getElementById('navbarWrapper');

let lastScroll = 0;

window.addEventListener('scroll', () => {

    const currentScroll = window.pageYOffset;

    if (currentScroll > 80) {

        navbarWrapper.classList.add('scrolled');

    } else {

        navbarWrapper.classList.remove('scrolled');

    }

    if (currentScroll > lastScroll && currentScroll > 200) {

        navbarWrapper.classList.add('hidden');

    } else {

        navbarWrapper.classList.remove('hidden');

    }

    lastScroll = currentScroll;

}, { passive: true });

/* =========================================================
CART COUNT
======================================================== */

function updateCartCount() {

    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    let total = 0;

    cart.forEach(item => { total += item.quantity; });

    document.querySelectorAll('.cart-count').forEach(el => {

        el.textContent = total;

        el.style.display = total > 0 ? 'flex' : 'none';

    });

}

updateCartCount();

/* =========================================================
SLIDE CART OPEN (delegated to home.js if exists)
======================================================== */

function openSlideCart() {

    const slideCart = document.getElementById('slideCart');

    const cartOverlay = document.getElementById('cartOverlay');

    if (slideCart) slideCart.classList.add('active');

    if (cartOverlay) cartOverlay.classList.add('active');

    document.body.style.overflow = 'hidden';

}

function closeSlideCart() {

    const slideCart = document.getElementById('slideCart');

    const cartOverlay = document.getElementById('cartOverlay');

    if (slideCart) slideCart.classList.remove('active');

    if (cartOverlay) cartOverlay.classList.remove('active');

    document.body.style.overflow = '';

}

document.getElementById('desktopOpenCart')?.addEventListener('click', openSlideCart);

document.getElementById('mobileOpenCart')?.addEventListener('click', () => {

    openSlideCart();

    if (mobileMenu.classList.contains('active')) toggleMobileMenu();

});

</script>