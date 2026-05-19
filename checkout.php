<?php

require_once "db.php";

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Secure Checkout";

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
content="Secure premium checkout experience at Hungroo Café.">

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
href="assets/css/checkout.css">

</head>

<body>

<!-- =====================================================
NAVBAR
===================================================== -->

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="checkout-page">

    <!-- =====================================================
    HERO
    ===================================================== -->

    <section class="checkout-hero">

        <!-- GLOW -->

        <div class="checkout-glow"></div>

        <!-- LEFT -->

        <div class="checkout-hero-content">

            <span class="checkout-badge">

                Hungroo Premium Checkout

            </span>

            <h1>

                Complete Your
                Delicious Order

            </h1>

            <p>

                Fast checkout,
                secure payment
                and premium delivery
                experience designed
                for modern café lovers.

            </p>

            <!-- FEATURES -->

            <div class="checkout-features">

                <div class="checkout-feature">

                    <i class="fa-solid fa-lock"></i>

                    Secure Payment

                </div>

                <div class="checkout-feature">

                    <i class="fa-solid fa-bolt"></i>

                    Fast Delivery

                </div>

                <div class="checkout-feature">

                    <i class="fa-solid fa-shield-heart"></i>

                    Premium Quality

                </div>

            </div>

        </div>

        <!-- RIGHT -->

        <div class="checkout-hero-image">

            <img
            src="assets/images/promo-1.png"
            alt="Checkout Food">

        </div>

    </section>

    <!-- =====================================================
    WRAPPER
    ===================================================== -->

    <section class="checkout-wrapper">

        <!-- =====================================================
        LEFT
        ===================================================== -->

        <section class="checkout-left">

            <!-- =====================================================
            DELIVERY FORM
            ===================================================== -->

            <div class="checkout-card">

                <!-- TITLE -->

                <div class="checkout-title">

                    <span>

                        Delivery Information

                    </span>

                    <h2>

                        Shipping Details

                    </h2>

                </div>

                <!-- FORM -->

                <form
                class="checkout-form"

                id="checkoutForm">

                    <!-- GRID -->

                    <div class="checkout-grid">

                        <!-- NAME -->

                        <div class="input-group">

                            <label>

                                Full Name

                            </label>

                            <div class="input-box">

                                <i class="fa-solid fa-user"></i>

                                <input
                                type="text"

                                placeholder=
                                "Enter your name"

                                required>

                            </div>

                        </div>

                        <!-- PHONE -->

                        <div class="input-group">

                            <label>

                                Phone Number

                            </label>

                            <div class="input-box">

                                <i class="fa-solid fa-phone"></i>

                                <input
                                type="tel"

                                placeholder=
                                "+91 98765 43210"

                                required>

                            </div>

                        </div>

                    </div>

                    <!-- EMAIL -->

                    <div class="input-group">

                        <label>

                            Email Address

                        </label>

                        <div class="input-box">

                            <i class="fa-solid fa-envelope"></i>

                            <input
                            type="email"

                            placeholder=
                            "hungroo@example.com"

                            required>

                        </div>

                    </div>

                    <!-- ADDRESS -->

                    <div class="input-group">

                        <label>

                            Delivery Address

                        </label>

                        <div class="input-box textarea">

                            <i class="fa-solid fa-location-dot"></i>

                            <textarea

                            placeholder=
                            "Enter full delivery address"

                            required>

                            </textarea>

                        </div>

                    </div>

                    <!-- GRID -->

                    <div class="checkout-grid">

                        <!-- CITY -->

                        <div class="input-group">

                            <label>

                                City

                            </label>

                            <div class="input-box">

                                <i class="fa-solid fa-city"></i>

                                <input
                                type="text"

                                placeholder=
                                "Chandigarh"

                                required>

                            </div>

                        </div>

                        <!-- PIN -->

                        <div class="input-group">

                            <label>

                                Pincode

                            </label>

                            <div class="input-box">

                                <i class="fa-solid fa-map-pin"></i>

                                <input
                                type="text"

                                placeholder=
                                "160001"

                                required>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

            <!-- =====================================================
            PAYMENT
            ===================================================== -->

            <div class="checkout-card">

                <!-- TITLE -->

                <div class="checkout-title">

                    <span>

                        Payment Methods

                    </span>

                    <h2>

                        Select Payment

                    </h2>

                </div>

                <!-- PAYMENT OPTIONS -->

                <div class="payment-methods">

                    <!-- METHOD -->

                    <label class="payment-card active">

                        <input
                        type="radio"
                        name="payment"

                        checked>

                        <div class="payment-icon">

                            <i class=
                            "fa-solid fa-credit-card"></i>

                        </div>

                        <div>

                            <h3>

                                Credit / Debit Card

                            </h3>

                            <p>

                                Visa, Mastercard & Rupay

                            </p>

                        </div>

                    </label>

                    <!-- METHOD -->

                    <label class="payment-card">

                        <input
                        type="radio"
                        name="payment">

                        <div class="payment-icon">

                            <i class=
                            "fa-brands fa-google-pay"></i>

                        </div>

                        <div>

                            <h3>

                                UPI Payment

                            </h3>

                            <p>

                                Google Pay, PhonePe & Paytm

                            </p>

                        </div>

                    </label>

                    <!-- METHOD -->

                    <label class="payment-card">

                        <input
                        type="radio"
                        name="payment">

                        <div class="payment-icon">

                            <i class=
                            "fa-solid fa-money-bill-wave"></i>

                        </div>

                        <div>

                            <h3>

                                Cash On Delivery

                            </h3>

                            <p>

                                Pay when your order arrives

                            </p>

                        </div>

                    </label>

                </div>

            </div>

        </section>

        <!-- =====================================================
        RIGHT
        ===================================================== -->

        <aside class="checkout-summary">

            <!-- TITLE -->

            <div class="summary-title">

                <span>

                    Order Summary

                </span>

                <h2>

                    Checkout Details

                </h2>

            </div>

            <!-- ITEMS -->

            <div
            class="checkout-items"
            id="checkout-items">

            </div>

            <!-- SUMMARY -->

            <div class="checkout-summary-box">

                <!-- ROW -->

                <div class="summary-row">

                    <p>

                        Subtotal

                    </p>

                    <h4>

                        ₹<span id="checkout-subtotal">

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

                        ₹<span id="checkout-delivery">

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

                        ₹<span id="checkout-gst">

                            0

                        </span>

                    </h4>

                </div>

                <!-- TOTAL -->

                <div
                class="summary-row total">

                    <h3>

                        Total Amount

                    </h3>

                    <h2>

                        ₹<span id="checkout-total">

                            0

                        </span>

                    </h2>

                </div>

            </div>

            <!-- ETA -->

            <div class="delivery-time-card">

                <div class="delivery-time-icon">

                    <i class="fa-solid fa-clock"></i>

                </div>

                <div>

                    <h3>

                        Estimated Delivery

                    </h3>

                    <p>

                        15 - 25 Minutes

                    </p>

                </div>

            </div>

            <!-- OFFER -->

            <div class="promo-card-checkout">

                <span>

                    Hungroo Special

                </span>

                <h3>

                    Free Cold Coffee
                    On Orders Above ₹799

                </h3>

            </div>

            <!-- BUTTON -->

            <button
            class="place-order-btn"

            id="placeOrderBtn"

            type="button">

                <i class="fa-solid fa-bag-shopping"></i>

                Place Order

            </button>

        </aside>

    </section>

</main>

<!-- =====================================================
SUCCESS MODAL
===================================================== -->

<div
class="order-success-modal"
id="orderSuccessModal">

    <div class="success-box">

        <!-- ICON -->

        <div class="success-icon">

            <i class="fa-solid fa-check"></i>

        </div>

        <!-- TEXT -->

        <h2>

            Order Placed Successfully

        </h2>

        <p>

            Thank you for ordering from
            Hungroo Café.
            Your delicious food is being prepared.

        </p>

        <!-- BUTTON -->

        <a
        href="home.php"
        class="success-btn">

            Back To Home

        </a>

    </div>

</div>

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

<!-- =====================================================
CHECKOUT JS
===================================================== -->

<script>

/* =========================================================
PAYMENT CARD ACTIVE
========================================================= */

const paymentCards =
document.querySelectorAll(
".payment-card"
);

paymentCards.forEach(card=>{

    card.addEventListener(
    "click",
    ()=>{

        paymentCards.forEach(c=>{

            c.classList.remove(
            "active"
            );

        });

        card.classList.add(
        "active"
        );

    });

});

/* =========================================================
ORDER SUCCESS
========================================================= */

const placeOrderBtn =
document.getElementById(
"placeOrderBtn"
);

const orderSuccessModal =
document.getElementById(
"orderSuccessModal"
);

placeOrderBtn?.addEventListener(
"click",
()=>{

    orderSuccessModal.classList.add(
    "active"
    );

    localStorage.removeItem(
    "hungroo-cart"
    );

});

</script>

</body>
</html>