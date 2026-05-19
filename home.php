<?php

require_once "db.php";

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Premium Home";

/* =========================================================
FEATURED ITEMS
========================================================= */

$featuredQuery =
"SELECT * FROM menu_items ORDER BY id DESC LIMIT 8";

$featuredResult =
mysqli_query(
$conn,
$featuredQuery
);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<meta
name="description"
content="Hungroo Café premium modern food ordering website.">

<title>

<?php echo $pageTitle; ?>

</title>

<!-- =====================================================
GOOGLE FONT
===================================================== -->

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<!-- =====================================================
FONT AWESOME
===================================================== -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- =====================================================
CSS
===================================================== -->

<link
rel="stylesheet"
href="assets/css/home.css">

</head>

<body>

<!-- =====================================================
NAVBAR
===================================================== -->

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="home-page">

    <!-- =====================================================
    HERO
    ===================================================== -->

    <section class="hero-section">

        <!-- GLOW -->

        <div class="hero-glow hero-glow-1"></div>

        <div class="hero-glow hero-glow-2"></div>

        <!-- LEFT -->

        <div class="hero-content">

            <!-- BADGE -->

            <span class="hero-badge">

                Premium Café Experience

            </span>

            <!-- TITLE -->

            <h1>

                Crafted Coffee,
                Gourmet Burgers
                & Premium Café Vibes

            </h1>

            <!-- TEXT -->

            <p>

                Experience handcrafted meals,
                café drinks and luxury food ordering
                with a modern premium experience.

            </p>

            <!-- BUTTONS -->

            <div class="hero-buttons">

                <a
                href="menu.php"
                class="hero-btn-primary">

                    Explore Menu

                </a>

                <a
                href="#popular"
                class="hero-btn-secondary">

                    Most Loved

                </a>

            </div>

            <!-- FEATURES -->

            <div class="hero-features">

                <div class="hero-feature-card">

                    <i class="fa-solid fa-star"></i>

                    4.9 Rating

                </div>

                <div class="hero-feature-card">

                    <i class="fa-solid fa-bolt"></i>

                    Fast Delivery

                </div>

                <div class="hero-feature-card">

                    <i class="fa-solid fa-shield-heart"></i>

                    Premium Quality

                </div>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="hero-image">

            <img
            src="assets/images/promo-2.png"
            alt="Hungroo Food">

            <!-- FLOATING -->

            <div class="floating-card floating-1">

                <i class="fa-solid fa-burger"></i>

                <div>

                    <h4>

                        Premium Burgers

                    </h4>

                    <p>

                        Fresh & Hot

                    </p>

                </div>

            </div>

            <div class="floating-card floating-2">

                <i class="fa-solid fa-mug-hot"></i>

                <div>

                    <h4>

                        Café Coffee

                    </h4>

                    <p>

                        Fresh Brewed

                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- =====================================================
    OFFERS
    ===================================================== -->

    <section class="offers-strip">

        <div class="offers-track">

            <?php for($i=0;$i<3;$i++){ ?>

            <div class="offer-card">

                <i class="fa-solid fa-fire"></i>

                Flat 50% OFF Today

            </div>

            <div class="offer-card">

                <i class="fa-solid fa-burger"></i>

                Buy 1 Get Fries Free

            </div>

            <div class="offer-card">

                <i class="fa-solid fa-truck-fast"></i>

                Free Delivery Above ₹499

            </div>

            <div class="offer-card">

                <i class="fa-solid fa-pizza-slice"></i>

                Stone Oven Pizza Specials

            </div>

            <div class="offer-card">

                <i class="fa-solid fa-ice-cream"></i>

                Dessert Combo Deals

            </div>

            <?php } ?>

        </div>

    </section>

    <!-- =====================================================
    CATEGORIES
    ===================================================== -->

    <section class="food-categories">

        <div class="section-title">

            <span>

                Explore Categories

            </span>

            <h2>

                What Are You Craving Today?

            </h2>

        </div>

        <div class="categories-grid">

            <a
            href="menu.php?category=Veg"
            class="category-card">

                <div class="category-wave"></div>

                <img
                src="assets/images/cat-burger.png"
                alt="Burger">

                <h3>

                    Veg Meals

                </h3>

            </a>

            <a
            href="menu.php?category=Coffee"
            class="category-card">

                <div class="category-wave"></div>

                <img
                src="assets/images/cat-coffee.png"
                alt="Coffee">

                <h3>

                    Café Coffee

                </h3>

            </a>

            <a
            href="menu.php?category=Dessert"
            class="category-card">

                <div class="category-wave"></div>

                <img
                src="assets/images/cat-dessert.png"
                alt="Dessert">

                <h3>

                    Desserts

                </h3>

            </a>

            <a
            href="menu.php?category=Boba"
            class="category-card">

                <div class="category-wave"></div>

                <img
                src="assets/images/cat-boba.png"
                alt="Boba">

                <h3>

                    Boba Drinks

                </h3>

            </a>

        </div>

    </section>

</main>

<!-- =====================================================
FOOTER
===================================================== -->

<?php include "footer.php"; ?>

<!-- =====================================================
CART JS
===================================================== -->

<script
src="cart.js">

</script>

</body>
</html>