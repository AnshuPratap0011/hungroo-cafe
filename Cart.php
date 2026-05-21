<?php

session_start();

$pageTitle =
"Hungroo Café | Cart";

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

<!-- FONT -->

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<!-- ICON -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

/* =========================================================
ROOT
========================================================= */

:root{

    --bg:#070707;

    --card:#111111;

    --white:#ffffff;

    --text:#bdbdbd;

    --primary:#ff9a3d;

    --gold:#ffd27a;

    --border:
    rgba(255,255,255,.08);

}

/* =========================================================
LIGHT MODE
========================================================= */

body.light-mode{

    --bg:#f5f5f7;

    --card:#ffffff;

    --white:#111111;

    --text:#666666;

    --border:
    rgba(0,0,0,.08);

}

/* =========================================================
RESET
========================================================= */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

}

body{

    background:var(--bg);

    color:var(--white);

    font-family:'Poppins',sans-serif;

    overflow-x:hidden;

}

/* =========================================================
WRAPPER
========================================================= */

.cart-wrapper{

    width:100%;

    max-width:1450px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =========================================================
TOP
========================================================= */

.cart-top{

    margin-bottom:40px;

}

.cart-top h1{

    font-size:56px;

    margin-bottom:14px;

}

.cart-top p{

    color:var(--text);

    font-size:15px;

}

/* =========================================================
LAYOUT
========================================================= */

.cart-layout{

    display:grid;

    grid-template-columns:
    1.4fr .6fr;

    gap:28px;

}

/* =========================================================
LEFT
========================================================= */

.cart-left{

    display:flex;

    flex-direction:column;

    gap:22px;

}

/* =========================================================
ITEM
========================================================= */

.cart-item{

    display:flex;

    gap:20px;

    padding:22px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

body.light-mode
.cart-item{

    background:#fff;

}

.cart-item-image{

    width:150px;
    height:150px;

    border-radius:24px;

    overflow:hidden;

    flex-shrink:0;

}

.cart-item-image img{

    width:100%;
    height:100%;

    object-fit:cover;

}

.cart-item-content{

    width:100%;

}

.cart-item-top{

    display:flex;

    justify-content:space-between;

    gap:16px;

    margin-bottom:18px;

}

.cart-item-top h2{

    font-size:28px;

}

.cart-item-price{

    font-size:26px;

    font-weight:800;

}

/* =========================================================
QTY
========================================================= */

.qty-controller{

    display:flex;

    align-items:center;

    gap:14px;

    margin-bottom:18px;

}

.qty-controller button{

    width:42px;
    height:42px;

    border:none;

    cursor:pointer;

    border-radius:14px;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

    font-size:18px;

    font-weight:800;

}

.qty-controller span{

    min-width:20px;

    text-align:center;

    font-size:18px;

    font-weight:700;

}

/* =========================================================
REMOVE
========================================================= */

.remove-btn{

    width:max-content;

    border:none;

    cursor:pointer;

    background:none;

    color:#ff6b6b;

    font-size:14px;

    font-weight:600;

}

/* =========================================================
RIGHT
========================================================= */

.cart-summary{

    position:sticky;

    top:120px;

    height:max-content;

    padding:28px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

body.light-mode
.cart-summary{

    background:#fff;

}

.cart-summary h2{

    font-size:34px;

    margin-bottom:26px;

}

/* =========================================================
SUMMARY ROW
========================================================= */

.summary-row{

    display:flex;

    align-items:center;
    justify-content:space-between;

    margin-bottom:20px;

    color:var(--text);

}

.summary-total{

    margin-top:26px;

    padding-top:24px;

    border-top:
    1px solid var(--border);

    display:flex;

    align-items:center;
    justify-content:space-between;

}

.summary-total h3{

    font-size:34px;

}

/* =========================================================
BUTTON
========================================================= */

.checkout-btn{

    width:100%;

    height:60px;

    margin-top:26px;

    border:none;

    cursor:pointer;

    border-radius:18px;

    display:flex;

    align-items:center;
    justify-content:center;

    gap:10px;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

    font-size:15px;

    font-weight:800;

    text-decoration:none;

}

/* =========================================================
EMPTY
========================================================= */

.empty-cart{

    width:100%;

    min-height:60vh;

    display:flex;

    flex-direction:column;

    align-items:center;
    justify-content:center;

    text-align:center;

}

.empty-cart img{

    width:220px;

    margin-bottom:30px;

}

.empty-cart h2{

    font-size:42px;

    margin-bottom:14px;

}

.empty-cart p{

    color:var(--text);

    margin-bottom:26px;

}

.shop-btn{

    min-width:220px;

    height:58px;

    border:none;

    border-radius:18px;

    display:flex;

    align-items:center;
    justify-content:center;

    text-decoration:none;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

    font-size:15px;

    font-weight:800;

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:992px){

    .cart-layout{

        grid-template-columns:1fr;

    }

}

@media(max-width:768px){

    .cart-wrapper{

        padding:
        110px 12px 70px;

    }

    .cart-top h1{

        font-size:42px;

    }

    .cart-item{

        flex-direction:column;

    }

    .cart-item-image{

        width:100%;
        height:240px;

    }

    .cart-item-top{

        flex-direction:column;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =========================================================
WRAPPER
========================================================= -->

<div class="cart-wrapper">

    <!-- =====================================================
    TOP
    ====================================================== -->

    <div class="cart-top">

        <h1>

            Your Cart

        </h1>

        <p>

            Delicious food waiting for you 🍔

        </p>

    </div>

    <!-- =====================================================
    CART CONTENT
    ====================================================== -->

    <div
    id="cartContainer">

    </div>

</div>

<!-- =========================================================
JS
========================================================= -->

<script>

let cart =

JSON.parse(
localStorage.getItem("cart")
) || [];

const cartContainer =

document.getElementById(
"cartContainer"
);

/* =========================================================
SAVE
========================================================= */

function saveCart(){

    localStorage.setItem(

        "cart",

        JSON.stringify(cart)

    );

}

/* =========================================================
UPDATE
========================================================= */

function updateQty(id,type){

    cart = cart.map(item=>{

        if(item.id == id){

            if(type === "plus"){

                item.quantity++;

            }

            else{

                item.quantity--;

                if(item.quantity < 1){

                    item.quantity = 1;

                }

            }

        }

        return item;

    });

    saveCart();

    renderCart();

}

/* =========================================================
REMOVE
========================================================= */

function removeItem(id){

    cart = cart.filter(item=>{

        return item.id != id;

    });

    saveCart();

    renderCart();

}

/* =========================================================
RENDER
========================================================= */

function renderCart(){

    if(cart.length === 0){

        cartContainer.innerHTML = `

            <div class="empty-cart">

                <img
                src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png">

                <h2>

                    Cart Is Empty

                </h2>

                <p>

                    Add delicious food now

                </p>

                <a
                href="menu.php"

                class="shop-btn">

                    Explore Menu

                </a>

            </div>

        `;

        return;

    }

    let subtotal = 0;

    let html = `

        <div class="cart-layout">

            <div class="cart-left">

    `;

    cart.forEach(item=>{

        const total =

        item.price * item.quantity;

        subtotal += total;

        html += `

            <div class="cart-item">

                <div class="cart-item-image">

                    <img
                    src="${item.image}">

                </div>

                <div class="cart-item-content">

                    <div class="cart-item-top">

                        <div>

                            <h2>

                                ${item.name}

                            </h2>

                        </div>

                        <div class="cart-item-price">

                            ₹${total}

                        </div>

                    </div>

                    <div class="qty-controller">

                        <button
                        onclick="updateQty(${item.id},'minus')">

                            -

                        </button>

                        <span>

                            ${item.quantity}

                        </span>

                        <button
                        onclick="updateQty(${item.id},'plus')">

                            +

                        </button>

                    </div>

                    <button
                    class="remove-btn"

                    onclick="removeItem(${item.id})">

                        Remove Item

                    </button>

                </div>

            </div>

        `;

    });

    const delivery = 49;

    const total = subtotal + delivery;

    html += `

            </div>

            <!-- SUMMARY -->

            <div class="cart-summary">

                <h2>

                    Order Summary

                </h2>

                <div class="summary-row">

                    <span>

                        Subtotal

                    </span>

                    <span>

                        ₹${subtotal}

                    </span>

                </div>

                <div class="summary-row">

                    <span>

                        Delivery

                    </span>

                    <span>

                        ₹${delivery}

                    </span>

                </div>

                <div class="summary-total">

                    <span>

                        Total

                    </span>

                    <h3>

                        ₹${total}

                    </h3>

                </div>

                <a
                href="checkout.php"

                class="checkout-btn">

                    <i class="fa-solid fa-bag-shopping"></i>

                    Proceed To Checkout

                </a>

            </div>

        </div>

    `;

    cartContainer.innerHTML =
    html;

}

/* =========================================================
INIT
========================================================= */

renderCart();

</script>

</body>
</html>