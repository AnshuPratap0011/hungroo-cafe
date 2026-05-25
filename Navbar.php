<?php

if(session_status() === PHP_SESSION_NONE){

    session_start();

}

?>

<!-- =========================================================
PREMIUM IOS NAVBAR
HUNGROO CAFÉ
========================================================= -->

<div class="navbar-wrapper">

    <nav class="navbar">

        <!-- =========================================================
        LOGO
        ========================================================= -->

        <a href="home.php" class="navbar-logo">

            <img
            src="https://i.imgur.com/8Km9tLL.png"
            alt="Hungroo Café">

            <div class="logo-text">

                <h2>

                    HUNGROO

                </h2>

                <span>

                    CAFÉ

                </span>

            </div>

        </a>

        <!-- =========================================================
        NAV LINKS
        ========================================================= -->

        <div class="navbar-links" id="mobileMenu">

            <a
            href="home.php"
            class="<?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : ''; ?>">

                <i class="fa-solid fa-house"></i>

                Home

            </a>

            <a
            href="menu.php"
            class="<?php echo basename($_SERVER['PHP_SELF']) == 'menu.php' ? 'active' : ''; ?>">

                <i class="fa-solid fa-utensils"></i>

                Menu

            </a>

            <a
            href="offers.php"
            class="<?php echo basename($_SERVER['PHP_SELF']) == 'offers.php' ? 'active' : ''; ?>">

                <i class="fa-solid fa-tags"></i>

                Offers

            </a>

            <a
            href="gallery.php"
            class="<?php echo basename($_SERVER['PHP_SELF']) == 'gallery.php' ? 'active' : ''; ?>">

                <i class="fa-solid fa-images"></i>

                Gallery

            </a>

            <a
            href="about.php"
            class="<?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">

                <i class="fa-solid fa-circle-info"></i>

                About

            </a>

            <a
            href="contact.php"
            class="<?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">

                <i class="fa-solid fa-envelope"></i>

                Contact

            </a>

            <!-- =========================================================
            MOBILE EXTRA ACTIONS
            ========================================================= -->

            <div class="mobile-extra-actions">

                <!-- MOBILE CART -->

                <a
                href="Cart.php"
                class="mobile-cart-btn">

                    <div class="mobile-cart-left">

                        <i class="fa-solid fa-cart-shopping"></i>

                        My Cart

                    </div>

                    <span
                    class="mobile-cart-count cart-count">

                        0

                    </span>

                </a>

                <!-- MOBILE PROFILE -->

                <?php if(isset($_SESSION['user_id'])): ?>

                    <a
                    href="profile.php"
                    class="mobile-profile-btn">

                        <i class="fa-solid fa-user"></i>

                        My Profile

                    </a>

                <?php else: ?>

                    <a
                    href="login.php"
                    class="mobile-profile-btn">

                        <i class="fa-solid fa-right-to-bracket"></i>

                        Login Account

                    </a>

                <?php endif; ?>

            </div>

        </div>

        <!-- =========================================================
        RIGHT ACTIONS
        ========================================================= -->

        <div class="navbar-actions">

            <!-- THEME BUTTON -->

            <button
            class="theme-btn"
            id="themeToggle">

                <i class="fa-solid fa-moon"></i>

            </button>

            <!-- DESKTOP CART -->

            <a
            href="Cart.php"
            class="cart-btn">

                <i class="fa-solid fa-cart-shopping"></i>

                <span
                class="cart-count">

                    0

                </span>

            </a>

            <!-- DESKTOP USER -->

            <?php if(isset($_SESSION['user_id'])): ?>

                <div class="user-dropdown">

                    <button class="user-btn">

                        <i class="fa-solid fa-user"></i>

                        <span>

                            Account

                        </span>

                    </button>

                    <div class="dropdown-menu">

                        <a href="profile.php">

                            <i class="fa-solid fa-user"></i>

                            Profile

                        </a>

                        <a href="track-order.php">

                            <i class="fa-solid fa-bag-shopping"></i>

                            My Orders

                        </a>

                        <a href="logout.php">

                            <i class="fa-solid fa-right-from-bracket"></i>

                            Logout

                        </a>

                    </div>

                </div>

            <?php else: ?>

                <a
                href="login.php"
                class="login-btn">

                    <i class="fa-solid fa-user"></i>

                    Login

                </a>

            <?php endif; ?>

            <!-- MOBILE MENU BUTTON -->

            <button
            class="mobile-menu-btn"
            id="mobileMenuBtn">

                <i class="fa-solid fa-bars"></i>

            </button>

        </div>

    </nav>

</div>

<!-- =========================================================
MOBILE OVERLAY
========================================================= -->

<div
class="mobile-overlay"
id="mobileOverlay">

</div>

<!-- =========================================================
NAVBAR SCRIPT
========================================================= -->

<script>

/* =========================================================
MOBILE MENU
========================================================= */

const mobileMenuBtn =
document.getElementById(
'mobileMenuBtn'
);

const mobileMenu =
document.getElementById(
'mobileMenu'
);

const mobileOverlay =
document.getElementById(
'mobileOverlay'
);

mobileMenuBtn.addEventListener(
'click',
() => {

    mobileMenu.classList.toggle(
    'active'
    );

    mobileOverlay.classList.toggle(
    'active'
    );

});

mobileOverlay.addEventListener(
'click',
() => {

    mobileMenu.classList.remove(
    'active'
    );

    mobileOverlay.classList.remove(
    'active'
    );

});

/* =========================================================
THEME SYSTEM
========================================================= */

const themeToggle =
document.getElementById(
'themeToggle'
);

const body =
document.body;

const savedTheme =
localStorage.getItem(
'theme'
);

if(savedTheme === 'light'){

    body.classList.add(
    'light-mode'
    );

    themeToggle.innerHTML =
    '<i class="fa-solid fa-sun"></i>';

}

themeToggle.addEventListener(
'click',
() => {

    body.classList.toggle(
    'light-mode'
    );

    if(
    body.classList.contains(
    'light-mode'
    )
    ){

        localStorage.setItem(
        'theme',
        'light'
        );

        themeToggle.innerHTML =
        '<i class="fa-solid fa-sun"></i>';

    }

    else{

        localStorage.setItem(
        'theme',
        'dark'
        );

        themeToggle.innerHTML =
        '<i class="fa-solid fa-moon"></i>';

    }

});

/* =========================================================
LIVE CART COUNT
========================================================= */

function updateCartCount(){

    let cart =
    JSON.parse(
    localStorage.getItem('cart')
    ) || [];

    document
    .querySelectorAll('.cart-count')
    .forEach(count => {

        count.innerHTML =
        cart.length;

    });

}

updateCartCount();

</script>