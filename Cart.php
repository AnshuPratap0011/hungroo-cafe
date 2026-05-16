<?php

require_once "db.php";

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Hungroo Cafe | Cart

</title>

<!-- CSS -->

<link
rel="stylesheet"
href="Style.css?v=999">

<!-- GOOGLE FONT -->

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<!-- FONT AWESOME -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<!-- =====================================================
NAVBAR
===================================================== -->

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="modern-cart-page">

<!-- =====================================================
HERO
===================================================== -->

<section class="cart-hero-modern">

    <div class="cart-hero-overlay"></div>

    <div class="cart-hero-content">

        <span class="cart-mini-title">

            Hungroo Premium Cart

        </span>

        <h1>

            Review Your <br>
            Delicious Order

        </h1>

        <p>

            Fresh meals, handcrafted drinks,
            burgers and desserts selected
            specially for you.

        </p>

    </div>

</section>

<!-- =====================================================
WRAPPER
===================================================== -->

<section class="cart-layout-wrapper">

    <!-- =====================================================
    LEFT
    ===================================================== -->

    <section class="cart-left-section">

        <!-- TOP -->

        <div class="cart-section-top">

            <div>

                <span>

                    Your Order

                </span>

                <h2>

                    Cart Items

                </h2>

            </div>

            <button
                class="clear-cart-modern-btn"
                id="clearCartBtn"
                type="button">

                <i class="fa-solid fa-trash"></i>

                Clear Cart

            </button>

        </div>

        <!-- ITEMS -->

        <div
            class="modern-cart-items"
            id="cartPageItems">

        </div>

        <!-- EMPTY -->

        <div
            class="modern-empty-cart hidden"
            id="emptyCart">

            <div class="empty-cart-icon">

                <i class="fa-solid fa-cart-shopping"></i>

            </div>

            <h2>

                Your Cart Is Empty

            </h2>

            <p>

                Add delicious meals and
                experience premium café vibes.

            </p>

            <a
                href="menu.php"
                class="empty-cart-btn">

                Explore Menu

            </a>

        </div>

    </section>

    <!-- =====================================================
    RIGHT
    ===================================================== -->

    <aside class="cart-summary-modern">

        <div class="summary-modern-card">

            <!-- HEAD -->

            <div class="summary-modern-head">

                <span>

                    Payment Summary

                </span>

                <h2>

                    Order Details

                </h2>

            </div>

            <!-- LIST -->

            <div class="summary-modern-list">

                <div class="summary-modern-row">

                    <span>

                        Subtotal

                    </span>

                    <strong>

                        ₹<span id="subtotal">

                            0

                        </span>

                    </strong>

                </div>

                <div class="summary-modern-row">

                    <span>

                        Delivery Fee

                    </span>

                    <strong>

                        ₹<span id="delivery">

                            40

                        </span>

                    </strong>

                </div>

                <div class="summary-modern-row">

                    <span>

                        GST (5%)

                    </span>

                    <strong>

                        ₹<span id="gst">

                            0

                        </span>

                    </strong>

                </div>

            </div>

            <!-- TOTAL -->

            <div class="summary-total-modern">

                <span>

                    Total Amount

                </span>

                <h3>

                    ₹<span id="grandTotal">

                        0

                    </span>

                </h3>

            </div>

            <!-- BUTTON -->

            <button
                class="checkout-modern-btn"
                id="checkoutBtn">

                Proceed To Checkout

            </button>

            <!-- FEATURES -->

            <div class="summary-modern-features">

                <div class="summary-feature">

                    <i class="fa-solid fa-shield-heart"></i>

                    <span>

                        Secure Payment

                    </span>

                </div>

                <div class="summary-feature">

                    <i class="fa-solid fa-truck-fast"></i>

                    <span>

                        Fast Delivery

                    </span>

                </div>

                <div class="summary-feature">

                    <i class="fa-solid fa-burger"></i>

                    <span>

                        Fresh Food

                    </span>

                </div>

            </div>

        </div>

    </aside>

</section>

</main>

<!-- =====================================================
FOOTER
===================================================== -->

<?php include "footer.php"; ?>

<!-- =====================================================
TOP BUTTON
===================================================== -->

<button
id="topBtn"
type="button">

<i class="fa-solid fa-arrow-up"></i>

</button>

<!-- =====================================================
JAVASCRIPT
===================================================== -->

<script>

/* =====================================================
ELEMENTS
===================================================== */

const cartContainer =
document.getElementById(
"cartPageItems"
);

const subtotalEl =
document.getElementById(
"subtotal"
);

const gstEl =
document.getElementById(
"gst"
);

const totalEl =
document.getElementById(
"grandTotal"
);

const emptyCart =
document.getElementById(
"emptyCart"
);

const clearCartBtn =
document.getElementById(
"clearCartBtn"
);

const checkoutBtn =
document.getElementById(
"checkoutBtn"
);

/* =====================================================
CART
===================================================== */

let cart =
JSON.parse(
localStorage.getItem(
"hungroo-cart"
)
) || [];

/* =====================================================
SAVE
===================================================== */

function saveCart(){

    localStorage.setItem(
        "hungroo-cart",
        JSON.stringify(cart)
    );

}

/* =====================================================
COUNT
===================================================== */

function updateCartCount(){

    const cartCount =
    document.getElementById(
    "cart-count"
    );

    if(!cartCount) return;

    let total = 0;

    cart.forEach(item => {

        total += item.qty;

    });

    cartCount.textContent =
    total;

}

/* =====================================================
TOTALS
===================================================== */

function updateTotals(){

    let subtotal = 0;

    cart.forEach(item => {

        subtotal +=
        item.price * item.qty;

    });

    const delivery =
    cart.length > 0 ? 40 : 0;

    const gst =
    Math.floor(subtotal * 0.05);

    const total =
    subtotal + delivery + gst;

    subtotalEl.textContent =
    subtotal;

    gstEl.textContent =
    gst;

    totalEl.textContent =
    total;

}

/* =====================================================
RENDER
===================================================== */

function renderCart(){

    cartContainer.innerHTML = "";

    /* EMPTY */

    if(cart.length === 0){

        emptyCart.classList.remove(
        "hidden"
        );

        updateTotals();

        updateCartCount();

        return;

    }

    emptyCart.classList.add(
    "hidden"
    );

    /* LOOP */

    cart.forEach((item,index)=>{

        cartContainer.innerHTML += `

        <article class="modern-cart-card">

            <!-- IMAGE -->

            <div class="modern-cart-image">

                <img
                    src="${item.image}"
                    alt="${item.name}"

                    onerror="
                    this.src='images/default-food.png'
                    ">

            </div>

            <!-- CONTENT -->

            <div class="modern-cart-content">

                <!-- TOP -->

                <div class="modern-cart-top">

                    <div>

                        <h3>

                            ${item.name}

                        </h3>

                        <span>

                            Freshly Prepared

                        </span>

                    </div>

                    <h4>

                        ₹${item.price}

                    </h4>

                </div>

                <!-- ACTIONS -->

                <div class="modern-cart-actions">

                    <!-- QTY -->

                    <div class="modern-qty-controller">

                        <button
                        onclick="decreaseQty(${index})">

                            -

                        </button>

                        <span>

                            ${item.qty}

                        </span>

                        <button
                        onclick="increaseQty(${index})">

                            +

                        </button>

                    </div>

                    <!-- REMOVE -->

                    <button
                        class="modern-remove-btn"
                        onclick="removeItem(${index})">

                        <i class="fa-solid fa-trash"></i>

                    </button>

                </div>

            </div>

        </article>

        `;

    });

    updateTotals();

    updateCartCount();

}

/* =====================================================
INCREASE
===================================================== */

function increaseQty(index){

    cart[index].qty++;

    saveCart();

    renderCart();

}

/* =====================================================
DECREASE
===================================================== */

function decreaseQty(index){

    if(cart[index].qty > 1){

        cart[index].qty--;

    }

    else{

        cart.splice(index,1);

    }

    saveCart();

    renderCart();

}

/* =====================================================
REMOVE
===================================================== */

function removeItem(index){

    cart.splice(index,1);

    saveCart();

    renderCart();

}

/* =====================================================
CLEAR
===================================================== */

clearCartBtn.addEventListener(
"click",
()=>{

    if(cart.length === 0) return;

    const confirmClear =
    confirm(
    "Clear all cart items?"
    );

    if(!confirmClear) return;

    cart = [];

    saveCart();

    renderCart();

});

/* =====================================================
CHECKOUT
===================================================== */

checkoutBtn.addEventListener(
"click",
()=>{

    if(cart.length === 0){

        alert(
        "Your cart is empty."
        );

        return;

    }

    window.location.href =
    "checkout.php";

});

/* =====================================================
TOP BUTTON
===================================================== */

const topBtn =
document.getElementById(
"topBtn"
);

window.addEventListener(
"scroll",
()=>{

    topBtn.classList.toggle(
    "show",
    window.scrollY > 300
    );

});

topBtn.addEventListener(
"click",
()=>{

    window.scrollTo({

        top:0,
        behavior:"smooth"

    });

});

/* =====================================================
INIT
===================================================== */

renderCart();

</script>

</body>
</html>