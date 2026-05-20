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
    LOGO
    ====================================================== -->

    <a
    href="index.php"

    class="navbar-logo">

        <span>

            Hungroo

        </span>

        Café

    </a>

    <!-- =====================================================
    DESKTOP LINKS
    ====================================================== -->

    <div class="navbar-links">

        <a href="index.php">

            Home

        </a>

        <a href="menu.php">

            Menu

        </a>

        <a href="offers.php">

            Offers

        </a>

        <a href="gallery.php">

            Gallery

        </a>

        <a href="about.php">

            About

        </a>

        <a href="team.php">

            Team

        </a>

        <a href="blog.php">

            Blog

        </a>

        <a href="contact.php">

            Contact

        </a>

    </div>

    <!-- =====================================================
    RIGHT SIDE
    ====================================================== -->

    <div class="navbar-right">

        <!-- THEME -->

        <button class="theme-toggle">

            <i class="fa-solid fa-sun"></i>

        </button>

        <!-- SEARCH -->

        <button class="nav-icon-btn">

            <i class="fa-solid fa-magnifying-glass"></i>

        </button>

        <!-- CART -->

        <a
        href="cart.php"

        class="nav-cart">

            <i class="fa-solid fa-cart-shopping"></i>

            <span class="cart-count">

                0

            </span>

        </a>

        <!-- PROFILE -->

        <a
        href="profile.php"

        class="nav-profile">

            <i class="fa-solid fa-user"></i>

        </a>

        <!-- MOBILE MENU -->

        <button class="menu-toggle">

            <span></span>
            <span></span>
            <span></span>

        </button>

    </div>

</nav>

<!-- =========================================================
MOBILE MENU
========================================================= -->

<div class="mobile-menu">

    <a href="index.php">

        <i class="fa-solid fa-house"></i>

        Home

    </a>

    <a href="menu.php">

        <i class="fa-solid fa-utensils"></i>

        Menu

    </a>

    <a href="offers.php">

        <i class="fa-solid fa-tags"></i>

        Offers

    </a>

    <a href="gallery.php">

        <i class="fa-solid fa-image"></i>

        Gallery

    </a>

    <a href="about.php">

        <i class="fa-solid fa-circle-info"></i>

        About

    </a>

    <a href="team.php">

        <i class="fa-solid fa-users"></i>

        Team

    </a>

    <a href="blog.php">

        <i class="fa-solid fa-blog"></i>

        Blog

    </a>

    <a href="contact.php">

        <i class="fa-solid fa-envelope"></i>

        Contact

    </a>

    <a href="dashboard.php">

        <i class="fa-solid fa-chart-line"></i>

        Dashboard

    </a>

    <a href="reservation-history.php">

        <i class="fa-solid fa-calendar-check"></i>

        Reservations

    </a>

</div>

<!-- =========================================================
NAVBAR SCRIPT
========================================================= -->

<script>

/* =========================================================
MENU TOGGLE
========================================================= */

const menuToggle =

document.querySelector(
".menu-toggle"
);

const mobileMenu =

document.querySelector(
".mobile-menu"
);

if(menuToggle && mobileMenu){

    menuToggle.addEventListener(

        "click",

        ()=>{

            mobileMenu.classList.toggle(
            "active"
            );

            menuToggle.classList.toggle(
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

const navLinks =

document.querySelectorAll(
".navbar-links a, .mobile-menu a"
);

navLinks.forEach(link=>{

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
NAVBAR SCROLL EFFECT
========================================================= */

window.addEventListener(

    "scroll",

    ()=>{

        const navbar =

        document.querySelector(
        ".navbar"
        );

        if(!navbar){

            return;

        }

        if(window.scrollY > 20){

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
AUTO CLOSE MOBILE MENU
========================================================= */

const mobileLinks =

document.querySelectorAll(
".mobile-menu a"
);

mobileLinks.forEach(link=>{

    link.addEventListener(

        "click",

        ()=>{

            mobileMenu.classList.remove(
            "active"
            );

            menuToggle.classList.remove(
            "active"
            );

        }

    );

});

</script>