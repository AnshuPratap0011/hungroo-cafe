<!-- =========================================================
FULL Cart.php
WORKING WITH LOCALSTORAGE
PREMIUM UI
========================================================= -->

<?php

session_start();

$pageTitle = "My Cart | Hungroo Café";

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

<?php echo $pageTitle; ?>

</title>

<!-- GOOGLE FONT -->

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
rel="stylesheet">

<!-- FONT AWESOME -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- CSS -->

<link
rel="stylesheet"
href="assets/css/navbar.css">

<link
rel="stylesheet"
href="assets/css/footer.css">

<link
rel="stylesheet"
href="assets/css/cart.css">

</head>

<body>

<!-- =========================================================
NAVBAR
========================================================= -->

<?php include "Navbar.php"; ?>

<!-- =========================================================
BACKGROUND
========================================================= -->

<div class="cart-bg blur-1"></div>
<div class="cart-bg blur-2"></div>

<!-- =========================================================
PAGE HEADER
========================================================= -->

<section class="cart-header">

    <div class="cart-header-content">

        <span>

            Premium Cart Experience

        </span>

        <h1>

            My Cart

        </h1>

        <p>

            Review your delicious premium food items
            before checkout.

        </p>

    </div>

</section>

<!-- =========================================================
CART SECTION
========================================================= -->

<section class="cart-section">

    <div class="cart-grid">

        <!-- ITEMS -->

        <div class="cart-items" id="cartItems"></div>

        <!-- SUMMARY -->

        <div class="summary-box">

            <h2>

                Order Summary

            </h2>

            <div class="summary-row">

                <span>

                    Subtotal

                </span>

                <span id="subtotal">

                    ₹0

                </span>

            </div>

            <div class="summary-row">

                <span>

                    Delivery

                </span>

                <span>

                    ₹49

                </span>

            </div>

            <div class="summary-row total">

                <span>

                    Total

                </span>

                <span id="total">

                    ₹0

                </span>

            </div>

            <a
            href="checkout.php"
            class="checkout-btn">

                Proceed Checkout

            </a>

        </div>

    </div>

</section>

<!-- =========================================================
FOOTER
========================================================= -->

<?php include "footer.php"; ?>

<!-- =========================================================
SCRIPT
========================================================= -->

<script>

/* =========================================================
LOAD CART
========================================================= */

let cart =
JSON.parse(
localStorage.getItem('cart')
) || [];

const cartItems =
document.getElementById(
'cartItems'
);

const subtotal =
document.getElementById(
'subtotal'
);

const total =
document.getElementById(
'total'
);

/* =========================================================
EMPTY CART
========================================================= */

if(cart.length === 0){

    cartItems.innerHTML = `

    <div class="empty-cart">

        <i class="fa-solid fa-cart-shopping"></i>

        <h2>

            Your cart is empty

        </h2>

        <p>

            Add premium food items now.

        </p>

        <a
        href="menu.php"
        class="shop-btn">

            Explore Menu

        </a>

    </div>

    `;

}

/* =========================================================
RENDER CART
========================================================= */

function renderCart(){

    cartItems.innerHTML = '';

    let totalPrice = 0;

    if(cart.length === 0){

        cartItems.innerHTML = `

        <div class="empty-cart">

            <i class="fa-solid fa-cart-shopping"></i>

            <h2>

                Your cart is empty

            </h2>

            <p>

                Add premium food items now.

            </p>

            <a
            href="menu.php"
            class="shop-btn">

                Explore Menu

            </a>

        </div>

        `;

        subtotal.innerHTML = '₹0';

        total.innerHTML = '₹0';

        return;

    }

    cart.forEach((item,index)=>{

        const qty =
        item.qty || 1;

        const itemTotal =
        Number(item.price) * qty;

        totalPrice += itemTotal;

        cartItems.innerHTML += `

        <div class="cart-card">

            <div class="cart-image">

                <img
                src="${item.image}"
                alt="${item.name}">

            </div>

            <div class="cart-content">

                <div>

                    <h2>

                        ${item.name}

                    </h2>

                    <p>

                        Premium Hungroo Special

                    </p>

                </div>

                <div class="cart-bottom">

                    <div class="price">

                        ₹${item.price}

                    </div>

                    <div class="quantity-box">

                        <button
                        class="qty-btn"
                        onclick="changeQty(${index},-1)">

                            -

                        </button>

                        <div class="qty">

                            ${qty}

                        </div>

                        <button
                        class="qty-btn"
                        onclick="changeQty(${index},1)">

                            +

                        </button>

                    </div>

                </div>

            </div>

        </div>

        `;

    });

    subtotal.innerHTML =
    `₹${totalPrice}`;

    total.innerHTML =
    `₹${totalPrice + 49}`;

    document
    .querySelectorAll('.cart-count')
    .forEach(count => {

        count.innerHTML =
        cart.length;

    });

}

/* =========================================================
CHANGE QTY
========================================================= */

function changeQty(index,value){

    if(!cart[index].qty){

        cart[index].qty = 1;

    }

    cart[index].qty += value;

    if(cart[index].qty <= 0){

        cart.splice(index,1);

    }

    localStorage.setItem(
    'cart',
    JSON.stringify(cart)
    );

    renderCart();

}

/* =========================================================
INIT
========================================================= */

renderCart();

</script>

</body>
</html>