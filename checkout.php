<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>

        Hungroo Cafe | Checkout

    </title>

    <!-- CSS -->

    <link
        rel="stylesheet"
        href="Style.css?v=5000">

    <!-- ICONS -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<!-- =====================================================
================ NAVBAR ================================
===================================================== -->

<?php include "Navbar.php"; ?>

<!-- =====================================================
================ CHECKOUT PAGE =========================
===================================================== -->

<main class="checkout-modern-page">

<!-- =====================================================
================ HERO ==================================
===================================================== -->

<section class="checkout-modern-hero">

    <!-- CONTENT -->

    <div class="checkout-hero-content">

        <span class="checkout-mini-title">

            Hungroo Premium Checkout

        </span>

        <h1>

            Complete Your <br>
            Delicious Order

        </h1>

        <p>

            Fresh meals, premium beverages
            and café favorites prepared
            specially for your cravings.

        </p>

    </div>

</section>

<!-- =====================================================
================ WRAPPER ===============================
===================================================== -->

<section class="checkout-layout-modern">

    <!-- =====================================================
    ================ LEFT ==================================
    ===================================================== -->

    <section class="checkout-form-modern-wrap">

        <!-- TOP -->

        <div class="checkout-modern-heading">

            <span>

                Delivery Information

            </span>

            <h2>

                Checkout Details

            </h2>

        </div>

        <!-- FORM -->

        <form
            id="checkoutForm"
            class="checkout-modern-form">

            <!-- ROW -->

            <div class="checkout-input-group">

                <label>

                    Full Name

                </label>

                <div class="checkout-input-wrap">

                    <i class="fa-solid fa-user"></i>

                    <input
                        type="text"
                        id="customerName"
                        placeholder="Enter your full name"
                        required>

                </div>

            </div>

            <!-- ROW -->

            <div class="checkout-input-group">

                <label>

                    Phone Number

                </label>

                <div class="checkout-input-wrap">

                    <i class="fa-solid fa-phone"></i>

                    <input
                        type="tel"
                        id="phone"
                        placeholder="+91 99999 99999"
                        required>

                </div>

            </div>

            <!-- ROW -->

            <div class="checkout-input-group">

                <label>

                    Email Address

                </label>

                <div class="checkout-input-wrap">

                    <i class="fa-solid fa-envelope"></i>

                    <input
                        type="email"
                        id="email"
                        placeholder="you@example.com">

                </div>

            </div>

            <!-- ROW -->

            <div class="checkout-input-group">

                <label>

                    Delivery Address

                </label>

                <div class="checkout-textarea-wrap">

                    <i class="fa-solid fa-location-dot"></i>

                    <textarea
                        id="address"
                        rows="5"
                        placeholder="House number, street, city"
                        required></textarea>

                </div>

            </div>

            <!-- ROW -->

            <div class="checkout-input-group">

                <label>

                    Payment Method

                </label>

                <div class="checkout-select-wrap">

                    <i class="fa-solid fa-wallet"></i>

                    <select
                        id="payment"
                        required>

                        <option value="">

                            Select payment method

                        </option>

                        <option value="Cash On Delivery">

                            Cash On Delivery

                        </option>

                        <option value="UPI">

                            UPI Payment

                        </option>

                        <option value="Card">

                            Debit / Credit Card

                        </option>

                    </select>

                </div>

            </div>

            <!-- BUTTON -->

            <button
                type="submit"
                class="checkout-place-btn">

                Place Order

            </button>

            <!-- MESSAGE -->

            <p
                id="order-message"
                class="checkout-success-message">

            </p>

        </form>

    </section>

    <!-- =====================================================
    ================ RIGHT =================================
    ===================================================== -->

    <aside class="checkout-summary-modern">

        <div class="checkout-summary-card">

            <!-- TOP -->

            <div class="checkout-summary-top">

                <span>

                    Your Order

                </span>

                <h2>

                    Order Summary

                </h2>

            </div>

            <!-- ITEMS -->

            <div
                id="checkout-items"
                class="checkout-summary-items">

            </div>

            <!-- PRICE -->

            <div class="checkout-summary-pricing">

                <!-- ROW -->

                <div class="checkout-summary-row">

                    <span>

                        Total Items

                    </span>

                    <strong
                        id="total-items">

                        0

                    </strong>

                </div>

                <!-- ROW -->

                <div class="checkout-summary-row">

                    <span>

                        Subtotal

                    </span>

                    <strong>

                        ₹<span id="subtotal">

                            0

                        </span>

                    </strong>

                </div>

                <!-- ROW -->

                <div class="checkout-summary-row">

                    <span>

                        Delivery Fee

                    </span>

                    <strong>

                        ₹<span id="delivery-fee">

                            40

                        </span>

                    </strong>

                </div>

                <!-- ROW -->

                <div class="checkout-summary-row">

                    <span>

                        GST (5%)

                    </span>

                    <strong>

                        ₹<span id="gst-fee">

                            0

                        </span>

                    </strong>

                </div>

            </div>

            <!-- TOTAL -->

            <div class="checkout-total-modern">

                <span>

                    Total Amount

                </span>

                <h3>

                    ₹<span id="grand-total">

                        0

                    </span>

                </h3>

            </div>

            <!-- BACK -->

            <a
                href="cart.php"
                class="checkout-back-btn">

                Back To Cart

            </a>

        </div>

    </aside>

</section>

</main>

<!-- =====================================================
================ FOOTER ================================
===================================================== -->

<?php include "footer.php"; ?>

<!-- =====================================================
================ CHECKOUT JS ===========================
===================================================== -->

<script>

/* =====================================================
================ CART DATA ============================
===================================================== */

let cart =
JSON.parse(
localStorage.getItem(
"hungroo-cart"
)
) || [];

/* =====================================================
================ ELEMENTS ==============================
===================================================== */

const checkoutItems =
document.getElementById(
"checkout-items"
);

const subtotalEl =
document.getElementById(
"subtotal"
);

const deliveryEl =
document.getElementById(
"delivery-fee"
);

const gstEl =
document.getElementById(
"gst-fee"
);

const grandTotalEl =
document.getElementById(
"grand-total"
);

const totalItemsEl =
document.getElementById(
"total-items"
);

/* =====================================================
================ RENDER ITEMS =========================
===================================================== */

function renderCheckoutItems(){

    checkoutItems.innerHTML = "";

    let subtotal = 0;

    let totalItems = 0;

    /* EMPTY */

    if(cart.length === 0){

        checkoutItems.innerHTML = `

        <div class="checkout-empty-state">

            <i class="fa-solid fa-cart-shopping"></i>

            <h3>

                Cart Is Empty

            </h3>

        </div>

        `;

        return;

    }

    /* LOOP */

    cart.forEach(item => {

        subtotal +=
        item.price * item.qty;

        totalItems +=
        item.qty;

        checkoutItems.innerHTML += `

        <div class="checkout-product-card">

            <!-- IMAGE -->

            <div class="checkout-product-image">

                <img
                    src="${item.image}"
                    alt="${item.name}">

            </div>

            <!-- CONTENT -->

            <div class="checkout-product-content">

                <h4>

                    ${item.name}

                </h4>

                <span>

                    Qty : ${item.qty}

                </span>

            </div>

            <!-- PRICE -->

            <h5>

                ₹${item.price * item.qty}

            </h5>

        </div>

        `;

    });

    const delivery = 40;

    const gst =
    Math.floor(subtotal * 0.05);

    const total =
    subtotal + delivery + gst;

    subtotalEl.textContent =
    subtotal;

    gstEl.textContent =
    gst;

    grandTotalEl.textContent =
    total;

    totalItemsEl.textContent =
    totalItems;

}

/* =====================================================
================ FORM SUBMIT ==========================
===================================================== */

document
.getElementById(
"checkoutForm"
)
.addEventListener(
"submit",
function(e){

    e.preventDefault();

    const message =
    document.getElementById(
    "order-message"
    );

    /* EMPTY */

    if(cart.length === 0){

        message.textContent =
        "Your cart is empty.";

        message.style.color =
        "#d62828";

        return;

    }

    /* SUCCESS */

    message.textContent =
    "Order placed successfully!";

    message.style.color =
    "green";

    /* CLEAR */

    localStorage.removeItem(
    "hungroo-cart"
    );

    cart = [];

    setTimeout(()=>{

        window.location.href =
        "home.php";

    },1500);

});

/* =====================================================
================ INIT =================================
===================================================== */

renderCheckoutItems();

</script>

</body>
</html>