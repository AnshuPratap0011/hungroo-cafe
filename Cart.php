<?php

require_once "db.php";

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Premium Cart";

/* =========================================================
INCLUDE NAVBAR
========================================================= */

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
content="Review your Hungroo Café cart, update quantities and proceed to checkout.">

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
href="assets/css/cart.css">

</head>

<body>

<!-- =====================================================
NAVBAR
===================================================== -->

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="cart-page">

    <!-- =====================================================
    HERO
    ===================================================== -->

    <section class="cart-hero">

        <!-- BG -->

        <div class="cart-hero-glow"></div>

        <!-- LEFT -->

        <div class="cart-hero-content">

            <span class="cart-badge">

                Hungroo Premium Cart

            </span>

            <h1>

                Your Delicious
                Order Is Waiting

            </h1>

            <p>

                Review your selected meals,
                update quantities and continue
                to secure checkout for a premium
                café ordering experience.

            </p>

            <!-- FEATURES -->

            <div class="cart-features">

                <div class="cart-feature-box">

                    <i class="fa-solid fa-bolt"></i>

                    Fast Delivery

                </div>

                <div class="cart-feature-box">

                    <i class="fa-solid fa-shield-heart"></i>

                    Secure Checkout

                </div>

                <div class="cart-feature-box">

                    <i class="fa-solid fa-star"></i>

                    Premium Quality

                </div>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="cart-hero-image">

            <img
            src="assets/images/promo-4.png"
            alt="Cart Food">

        </div>

    </section>

    <!-- =====================================================
    WRAPPER
    ===================================================== -->

    <section class="cart-wrapper">

        <!-- =====================================================
        CART ITEMS
        ===================================================== -->

        <section class="cart-items-section">

            <!-- TOPBAR -->

            <div class="cart-topbar">

                <div>

                    <span>

                        Hungroo Order

                    </span>

                    <h2>

                        Cart Items

                    </h2>

                </div>

                <!-- COUNT -->

                <div class="cart-count-box">

                    <i class="fa-solid fa-cart-shopping"></i>

                    <p>

                        <span id="cart-page-count">

                            0

                        </span>

                        Items

                    </p>

                </div>

            </div>

            <!-- EMPTY -->

            <div
            class="empty-cart hidden"
            id="empty-cart">

                <img
                src="assets/images/empty-cart.png"
                alt="Empty Cart">

                <h2>

                    Your Cart Is Empty

                </h2>

                <p>

                    Explore premium meals and
                    add delicious food now.

                </p>

                <a
                href="menu.php"
                class="empty-cart-btn">

                    Explore Menu

                </a>

            </div>

            <!-- ITEMS -->

            <div
            class="cart-page-items"
            id="cart-page-items">

            </div>

        </section>

        <!-- =====================================================
        SUMMARY
        ===================================================== -->

        <aside class="cart-summary">

            <!-- TITLE -->

            <div class="summary-title">

                <span>

                    Payment Summary

                </span>

                <h2>

                    Order Details

                </h2>

            </div>

            <!-- SUMMARY BOX -->

            <div class="summary-box">

                <!-- ROW -->

                <div class="summary-row">

                    <p>

                        Subtotal

                    </p>

                    <h4>

                        ₹<span id="cart-subtotal">

                            0

                        </span>

                    </h4>

                </div>

                <!-- ROW -->

                <div class="summary-row">

                    <p>

                        Delivery Fee

                    </p>

                    <h4>

                        ₹<span id="cart-delivery">

                            0

                        </span>

                    </h4>

                </div>

                <!-- ROW -->

                <div class="summary-row">

                    <p>

                        GST (5%)

                    </p>

                    <h4>

                        ₹<span id="cart-gst">

                            0

                        </span>

                    </h4>

                </div>

                <!-- TOTAL -->

                <div
                class="summary-row total">

                    <h3>

                        Total

                    </h3>

                    <h2>

                        ₹<span id="cart-total-page">

                            0

                        </span>

                    </h2>

                </div>

            </div>

            <!-- DELIVERY -->

            <div class="delivery-card">

                <div class="delivery-icon">

                    <i class="fa-solid fa-truck-fast"></i>

                </div>

                <div>

                    <h3>

                        Fast Delivery

                    </h3>

                    <p>

                        Estimated arrival
                        within 15-25 minutes.

                    </p>

                </div>

            </div>

            <!-- OFFER -->

            <div class="cart-offer-card">

                <span>

                    Special Offer

                </span>

                <h3>

                    Free Fries On Orders
                    Above ₹599

                </h3>

            </div>

            <!-- BUTTONS -->

            <div class="cart-buttons">

                <a
                href="menu.php"
                class="cart-btn-outline">

                    Continue Shopping

                </a>

                <a
                href="checkout.php"
                class="cart-btn-primary">

                    Proceed To Checkout

                </a>

            </div>

        </aside>

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