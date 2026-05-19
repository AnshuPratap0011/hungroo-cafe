<!-- =========================================================
NAVBAR CSS
========================================================= -->

<link
rel="stylesheet"
href="assets/css/navbar.css?v=2">

<?php
/* =========================================================
HUNGROO PREMIUM NAVBAR
========================================================= */
?>

<!-- =========================================================
HEADER
========================================================= -->

<header
class="navbar"
id="navbar">

    <!-- =====================================================
    NAV CONTAINER
    ===================================================== -->

    <div class="nav-container">

        <!-- =====================================================
        LEFT
        ===================================================== -->

        <div class="nav-left">

            <!-- MOBILE TOGGLE -->

            <button
            class="menu-toggle"
            id="menuToggle"
            type="button"

            aria-label="Open Menu">

                <i class="fa-solid fa-bars"></i>

            </button>

            <!-- LOGO -->

            <a
            href="home.php"
            class="logo">

                <img
                src="hlogo.png"
                alt="Hungroo Café">

                <span>

                    Hungroo Café

                </span>

            </a>

        </div>

        <!-- =====================================================
        NAVIGATION
        ===================================================== -->

        <nav
        class="nav-links"
        id="mobileNav">

            <a href="home.php">

                Home

            </a>

            <a href="menu.php">

                Menu

            </a>

            <a href="home.php#popular">

                Popular

            </a>

            <a href="home.php#reviews">

                Reviews

            </a>

            <a href="#footer">

                Contact

            </a>

        </nav>

        <!-- =====================================================
        RIGHT
        ===================================================== -->

        <div class="nav-right">

            <!-- SEARCH -->

            <button
            class="nav-icon-btn"
            id="searchBtn"
            type="button">

                <i class="fa-solid fa-magnifying-glass"></i>

            </button>

            <!-- THEME -->

            <button
            class="nav-icon-btn"
            id="themeToggle"
            type="button">

                <i class="fa-solid fa-moon"></i>

            </button>

            <!-- CART -->

            <button
            class="cart-btn"
            id="openCartBtn"
            type="button">

                <i class="fa-solid fa-cart-shopping"></i>

                <span id="cart-count">

                    0

                </span>

            </button>

            <!-- PROFILE -->

            <a
            href="#"
            class="profile-btn">

                <i class="fa-solid fa-user"></i>

            </a>

        </div>

    </div>

</header>

<!-- =========================================================
MOBILE OVERLAY
========================================================= -->

<div
class="mobile-overlay"
id="mobileOverlay">

</div>

<!-- =========================================================
SEARCH MODAL
========================================================= -->

<div
class="search-modal"
id="searchModal">

    <div class="search-box">

        <!-- CLOSE -->

        <button
        class="search-close"
        id="closeSearch"
        type="button">

            <i class="fa-solid fa-xmark"></i>

        </button>

        <!-- TITLE -->

        <h2>

            Search Hungroo Menu

        </h2>

        <!-- FORM -->

        <form
        action="menu.php"
        method="GET"

        class="search-form">

            <div class="search-input-wrap">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                type="text"

                name="search"

                placeholder=
                "Search burgers, pizza, coffee...">

            </div>

            <button type="submit">

                Explore Menu

            </button>

        </form>

    </div>

</div>

<!-- =========================================================
CART OVERLAY
========================================================= -->

<div
class="cart-overlay"
id="cartOverlay">

</div>

<!-- =========================================================
MINI CART
========================================================= -->

<aside
class="mini-cart"
id="cartSidebar">

    <!-- TOP -->

    <div class="mini-cart-top">

        <div>

            <span>

                Premium Cart

            </span>

            <h2>

                Your Order

            </h2>

        </div>

        <!-- CLOSE -->

        <button
        id="closeCartBtn"
        type="button">

            <i class="fa-solid fa-xmark"></i>

        </button>

    </div>

    <!-- ITEMS -->

    <div
    class="mini-cart-items"
    id="cart-items">

    </div>

    <!-- FOOTER -->

    <div class="mini-cart-footer">

        <!-- SUBTOTAL -->

        <div class="mini-cart-row">

            <p>

                Subtotal

            </p>

            <h4>

                ₹<span id="sidebar-subtotal">

                    0

                </span>

            </h4>

        </div>

        <!-- DELIVERY -->

        <div class="mini-cart-row">

            <p>

                Delivery

            </p>

            <h4>

                ₹<span id="sidebar-delivery">

                    0

                </span>

            </h4>

        </div>

        <!-- GST -->

        <div class="mini-cart-row">

            <p>

                GST

            </p>

            <h4>

                ₹<span id="sidebar-gst">

                    0

                </span>

            </h4>

        </div>

        <!-- TOTAL -->

        <div
        class="mini-cart-row total-row">

            <h3>

                Total

            </h3>

            <h2>

                ₹<span id="cart-total">

                    0

                </span>

            </h2>

        </div>

        <!-- BUTTONS -->

        <div class="mini-cart-buttons">

            <a
            href="Cart.php"
            class="mini-cart-btn">

                View Cart

            </a>

            <a
            href="checkout.php"
            class="mini-cart-btn checkout">

                Checkout

            </a>

        </div>

    </div>

</aside>

<!-- =========================================================
NAVBAR SCRIPT
========================================================= -->

<script>

/* =========================================================
ELEMENTS
========================================================= */

const navbar =
document.getElementById(
"navbar"
);

const menuToggle =
document.getElementById(
"menuToggle"
);

const mobileNav =
document.getElementById(
"mobileNav"
);

const mobileOverlay =
document.getElementById(
"mobileOverlay"
);

const themeToggle =
document.getElementById(
"themeToggle"
);

const cartSidebar =
document.getElementById(
"cartSidebar"
);

const cartOverlay =
document.getElementById(
"cartOverlay"
);

const openCartBtn =
document.getElementById(
"openCartBtn"
);

const closeCartBtn =
document.getElementById(
"closeCartBtn"
);

const searchBtn =
document.getElementById(
"searchBtn"
);

const searchModal =
document.getElementById(
"searchModal"
);

const closeSearch =
document.getElementById(
"closeSearch"
);

/* =========================================================
NAVBAR SCROLL
========================================================= */

window.addEventListener(
"scroll",
()=>{

    if(window.scrollY > 20){

        navbar.classList.add(
        "scrolled"
        );

    }

    else{

        navbar.classList.remove(
        "scrolled"
        );

    }

});

/* =========================================================
MOBILE MENU
========================================================= */

menuToggle?.addEventListener(
"click",
()=>{

    mobileNav.classList.toggle(
    "active"
    );

    mobileOverlay.classList.toggle(
    "active"
    );

});

/* =========================================================
CLOSE MOBILE
========================================================= */

mobileOverlay?.addEventListener(
"click",
()=>{

    mobileNav.classList.remove(
    "active"
    );

    mobileOverlay.classList.remove(
    "active"
    );

});

/* =========================================================
OPEN CART
========================================================= */

openCartBtn?.addEventListener(
"click",
()=>{

    cartSidebar.classList.add(
    "active"
    );

    cartOverlay.classList.add(
    "active"
    );

    document.body.style.overflow =
    "hidden";

});

/* =========================================================
CLOSE CART
========================================================= */

function closeCart(){

    cartSidebar.classList.remove(
    "active"
    );

    cartOverlay.classList.remove(
    "active"
    );

    document.body.style.overflow =
    "";

}

closeCartBtn?.addEventListener(
"click",
closeCart
);

cartOverlay?.addEventListener(
"click",
closeCart
);

/* =========================================================
SEARCH MODAL
========================================================= */

searchBtn?.addEventListener(
"click",
()=>{

    searchModal.classList.add(
    "active"
    );

    document.body.style.overflow =
    "hidden";

});

/* =========================================================
CLOSE SEARCH
========================================================= */

function closeSearchModal(){

    searchModal.classList.remove(
    "active"
    );

    document.body.style.overflow =
    "";

}

closeSearch?.addEventListener(
"click",
closeSearchModal
);

searchModal?.addEventListener(
"click",
(e)=>{

    if(e.target === searchModal){

        closeSearchModal();

    }

});

/* =========================================================
THEME LOAD
========================================================= */

if(
localStorage.getItem(
"theme"
) === "light"
){

    document.body.classList.add(
    "light-mode"
    );

    themeToggle.innerHTML =
    '<i class="fa-solid fa-sun"></i>';

}

/* =========================================================
THEME TOGGLE
========================================================= */

themeToggle?.addEventListener(
"click",
()=>{

    document.body.classList.toggle(
    "light-mode"
    );

    if(
    document.body.classList.contains(
    "light-mode"
    )
    ){

        localStorage.setItem(
        "theme",
        "light"
        );

        themeToggle.innerHTML =
        '<i class="fa-solid fa-sun"></i>';

    }

    else{

        localStorage.setItem(
        "theme",
        "dark"
        );

        themeToggle.innerHTML =
        '<i class="fa-solid fa-moon"></i>';

    }

});

</script>

<!-- =========================================================
GLOBAL CART JS
========================================================= -->

<script
src="cart.js?v=2"
defer>

</script>