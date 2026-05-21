<?php

if(session_status() === PHP_SESSION_NONE){

    session_start();

}

?>

<!-- =========================================================
FONT AWESOME
========================================================= -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- =========================================================
NAVBAR CSS
========================================================= -->

<link
rel="stylesheet"
href="assets/css/navbar.css">

<!-- =========================================================
NAVBAR
========================================================= -->

<nav class="navbar">

    <!-- =====================================================
    LEFT
    ====================================================== -->

    <div class="navbar-left">

        <!-- LOGO -->

        <a
        href="home.php"

        class="navbar-logo">

            <div class="logo-circle">

                <img
                src="assets/images/logo.png"
                alt="Hungroo Café">

            </div>

            <div class="logo-text">

                <span>

                    Hungroo

                </span>

                Café

            </div>

        </a>

    </div>

    <!-- =====================================================
    CENTER LINKS
    ====================================================== -->

    <div
    class="navbar-links"

    id="navbarLinks">

        <a
        href="home.php"

        class="nav-link">

            Home

        </a>

        <a
        href="menu.php"

        class="nav-link">

            Menu

        </a>

        <a
        href="offers.php"

        class="nav-link">

            Offers

        </a>

        <a
        href="gallery.php"

        class="nav-link">

            Gallery

        </a>

        <a
        href="about.php"

        class="nav-link">

            About

        </a>

        <a
        href="contact.php"

        class="nav-link">

            Contact

        </a>

    </div>

    <!-- =====================================================
    RIGHT
    ====================================================== -->

    <div class="navbar-right">

        <!-- SEARCH -->

        <button
        type="button"

        class="nav-icon-btn search-btn">

            <i class="fa-solid fa-magnifying-glass"></i>

        </button>

        <!-- THEME -->

        <button
        type="button"

        class="theme-toggle"

        id="themeToggle">

            <i class="fa-solid fa-moon"></i>

        </button>

        <!-- CART -->

        <button
        type="button"

        class="nav-cart"

        id="cartButton">

            <i class="fa-solid fa-cart-shopping"></i>

            <span
            class="cart-count">

                0

            </span>

        </button>

        <!-- PROFILE -->

        <a
        href="profile.php"

        class="nav-profile">

            <i class="fa-solid fa-user"></i>

        </a>

        <!-- MOBILE TOGGLE -->

        <button
        type="button"

        class="menu-toggle"

        id="menuToggle">

            <span></span>
            <span></span>
            <span></span>

        </button>

    </div>

</nav>

<!-- =========================================================
MOBILE MENU
========================================================= -->

<div
class="mobile-menu"

id="mobileMenu">

    <a
    href="home.php">

        <i class="fa-solid fa-house"></i>

        Home

    </a>

    <a
    href="menu.php">

        <i class="fa-solid fa-utensils"></i>

        Menu

    </a>

    <a
    href="offers.php">

        <i class="fa-solid fa-tags"></i>

        Offers

    </a>

    <a
    href="gallery.php">

        <i class="fa-solid fa-image"></i>

        Gallery

    </a>

    <a
    href="about.php">

        <i class="fa-solid fa-circle-info"></i>

        About

    </a>

    <a
    href="contact.php">

        <i class="fa-solid fa-envelope"></i>

        Contact

    </a>

</div>

<!-- =========================================================
MINI CART OVERLAY
========================================================= -->

<div
class="mini-cart-overlay"

id="miniCartOverlay">

</div>

<!-- =========================================================
MINI CART
========================================================= -->

<div
class="mini-cart"

id="miniCart">

    <!-- =====================================================
    TOP
    ====================================================== -->

    <div class="mini-cart-top">

        <!-- IMAGE -->

        <div class="mini-cart-image">

            <img
            src="https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=1600&auto=format&fit=crop"
            alt="Hungroo Café">

            <!-- LAYER -->

            <div class="mini-cart-layer">

                <h2>

                    Hungroo Café

                </h2>

                <p>

                    Premium Food Experience

                </p>

            </div>

        </div>

        <!-- CLOSE -->

        <button
        type="button"

        class="mini-cart-close"

        id="closeMiniCart">

            <i class="fa-solid fa-xmark"></i>

        </button>

    </div>

    <!-- =====================================================
    ITEMS
    ====================================================== -->

    <div
    class="mini-cart-items"

    id="miniCartItems">

    </div>

    <!-- =====================================================
    BOTTOM
    ====================================================== -->

    <div class="mini-cart-bottom">

        <!-- TOTAL -->

        <div class="mini-cart-total">

            <span>

                Total

            </span>

            <h3 id="miniCartTotal">

                ₹0

            </h3>

        </div>

        <!-- BUTTONS -->

        <div class="mini-cart-buttons">

            <a
            href="cart.php"

            class="mini-cart-btn secondary">

                View Cart

            </a>

            <a
            href="checkout.php"

            class="mini-cart-btn">

                Checkout

            </a>

        </div>

    </div>

</div>

<!-- =========================================================
NAVBAR SCRIPT
========================================================= -->

<script>

/* =========================================================
MOBILE MENU
========================================================= */

const menuToggle =

document.getElementById(
"menuToggle"
);

const mobileMenu =

document.getElementById(
"mobileMenu"
);

if(menuToggle){

    menuToggle.addEventListener(

        "click",

        ()=>{

            menuToggle.classList.toggle(
            "active"
            );

            mobileMenu.classList.toggle(
            "active"
            );

        }

    );

}

/* =========================================================
ACTIVE LINK
========================================================= */

const currentPage =

window.location.pathname
.split("/")
.pop();

const allLinks =

document.querySelectorAll(
".navbar-links a, .mobile-menu a"
);

allLinks.forEach(link=>{

    const href =

    link.getAttribute(
    "href"
    );

    if(href === currentPage){

        link.classList.add(
        "active"
        );

    }

});

/* =========================================================
SCROLL EFFECT
========================================================= */

window.addEventListener(

    "scroll",

    ()=>{

        const navbar =

        document.querySelector(
        ".navbar"
        );

        if(window.scrollY > 10){

            navbar.classList.add(
            "navbar-scrolled"
            );

        }

        else{

            navbar.classList.remove(
            "navbar-scrolled"
            );

        }

    }

);

/* =========================================================
ESC CLOSE
========================================================= */

document.addEventListener(

    "keydown",

    (e)=>{

        if(e.key === "Escape"){

            const miniCart =

            document.getElementById(
            "miniCart"
            );

            const overlay =

            document.getElementById(
            "miniCartOverlay"
            );

            if(miniCart){

                miniCart.classList.remove(
                "active"
                );

            }

            if(overlay){

                overlay.classList.remove(
                "active"
                );

            }

        }

    }

);

</script>