<?php

session_start();

$pageTitle =
"Hungroo Café | Checkout";

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
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
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
PAGE
========================================================= */

.checkout-page{

    width:100%;

    max-width:1450px;

    margin:auto;

    padding:
    130px 16px 90px;

}

/* =========================================================
TOP
========================================================= */

.checkout-top{

    text-align:center;

    margin-bottom:50px;

}

.checkout-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.checkout-top h1{

    font-size:
    clamp(42px,6vw,82px);

    margin:
    12px 0 16px;

}

.checkout-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:2;

}

/* =========================================================
WRAPPER
========================================================= */

.checkout-wrapper{

    display:grid;

    grid-template-columns:
    1fr .8fr;

    gap:30px;

}

/* =========================================================
FORM
========================================================= */

.checkout-form{

    padding:30px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

.checkout-form h2{

    font-size:34px;

    margin-bottom:26px;

}

/* =========================================================
GRID
========================================================= */

.form-grid{

    display:grid;

    grid-template-columns:
    repeat(2,1fr);

    gap:20px;

}

.form-group{

    display:flex;

    flex-direction:column;

    gap:10px;

}

.form-group.full{

    grid-column:1/-1;

}

.form-group label{

    font-size:14px;

    font-weight:600;

}

.form-group input,
.form-group textarea,
.form-group select{

    width:100%;

    height:60px;

    border:none;

    outline:none;

    padding:
    0 18px;

    border-radius:18px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:var(--white);

    font-size:14px;

}

body.light-mode
.form-group input,
body.light-mode
.form-group textarea,
body.light-mode
.form-group select{

    color:#111;

}

.form-group textarea{

    height:130px;

    padding-top:18px;

    resize:none;

}

/* =========================================================
SUMMARY
========================================================= */

.checkout-summary{

    position:sticky;

    top:120px;

    height:max-content;

    padding:30px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

.checkout-summary h2{

    font-size:34px;

    margin-bottom:26px;

}

/* =========================================================
ITEM
========================================================= */

.summary-item{

    display:flex;

    align-items:center;
    justify-content:space-between;

    gap:16px;

    margin-bottom:20px;

    padding-bottom:20px;

    border-bottom:
    1px solid var(--border);

}

.summary-item-left{

    display:flex;

    align-items:center;

    gap:14px;

}

.summary-item-left img{

    width:72px;
    height:72px;

    border-radius:18px;

    object-fit:cover;

}

.summary-item-left h4{

    font-size:16px;

    margin-bottom:6px;

}

.summary-item-left p{

    color:var(--text);

    font-size:13px;

}

/* =========================================================
TOTAL
========================================================= */

.checkout-total{

    margin-top:24px;

    padding-top:24px;

    border-top:
    1px solid var(--border);

}

.total-row{

    display:flex;

    align-items:center;
    justify-content:space-between;

    margin-bottom:16px;

    color:var(--text);

}

.grand-total{

    display:flex;

    align-items:center;
    justify-content:space-between;

    margin-top:20px;

}

.grand-total h3{

    font-size:34px;

}

/* =========================================================
BUTTON
========================================================= */

.place-order-btn{

    width:100%;

    height:62px;

    margin-top:28px;

    border:none;

    cursor:pointer;

    border-radius:20px;

    font-size:15px;

    font-weight:700;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

}

/* =========================================================
SUCCESS
========================================================= */

.order-success{

    position:fixed;

    inset:0;

    background:
    rgba(0,0,0,.6);

    backdrop-filter:
    blur(8px);

    display:none;

    align-items:center;
    justify-content:center;

    z-index:99999;

}

.order-success.active{

    display:flex;

}

.success-box{

    width:95%;

    max-width:500px;

    padding:40px 30px;

    border-radius:30px;

    text-align:center;

    background:var(--card);

    border:
    1px solid var(--border);

}

.success-box i{

    width:90px;
    height:90px;

    margin:auto auto 24px;

    border-radius:50%;

    display:flex;

    align-items:center;
    justify-content:center;

    background:
    linear-gradient(
    135deg,
    #3ad66e,
    #1fb954
    );

    color:#fff;

    font-size:38px;

}

.success-box h2{

    font-size:38px;

    margin-bottom:14px;

}

.success-box p{

    color:var(--text);

    line-height:1.9;

    margin-bottom:28px;

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:992px){

    .checkout-wrapper{

        grid-template-columns:1fr;

    }

}

@media(max-width:768px){

    .checkout-page{

        padding:
        120px 14px 70px;

    }

    .form-grid{

        grid-template-columns:1fr;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =========================================================
PAGE
========================================================= -->

<section class="checkout-page">

    <!-- TOP -->

    <div class="checkout-top">

        <span>

            Secure Checkout

        </span>

        <h1>

            Complete Your Order

        </h1>

        <p>

            Enter your delivery details
            and confirm your order.

        </p>

    </div>

    <!-- WRAPPER -->

    <div class="checkout-wrapper">

        <!-- FORM -->

        <div class="checkout-form">

            <h2>

                Delivery Details

            </h2>

            <form id="checkoutForm">

                <div class="form-grid">

                    <div class="form-group">

                        <label>

                            Full Name

                        </label>

                        <input
                        type="text"
                        required>

                    </div>

                    <div class="form-group">

                        <label>

                            Phone Number

                        </label>

                        <input
                        type="tel"
                        required>

                    </div>

                    <div class="form-group full">

                        <label>

                            Address

                        </label>

                        <textarea
                        required></textarea>

                    </div>

                    <div class="form-group">

                        <label>

                            Payment Method

                        </label>

                        <select required>

                            <option>

                                Cash On Delivery

                            </option>

                            <option>

                                UPI

                            </option>

                            <option>

                                Card Payment

                            </option>

                        </select>

                    </div>

                    <div class="form-group">

                        <label>

                            City

                        </label>

                        <input
                        type="text"
                        required>

                    </div>

                </div>

            </form>

        </div>

        <!-- SUMMARY -->

        <div class="checkout-summary">

            <h2>

                Order Summary

            </h2>

            <div id="summaryItems"></div>

            <div class="checkout-total">

                <div class="total-row">

                    <span>

                        Subtotal

                    </span>

                    <span id="subtotal">

                        ₹0

                    </span>

                </div>

                <div class="total-row">

                    <span>

                        Delivery

                    </span>

                    <span>

                        ₹49

                    </span>

                </div>

                <div class="grand-total">

                    <span>

                        Total

                    </span>

                    <h3 id="grandTotal">

                        ₹0

                    </h3>

                </div>

            </div>

            <button
            class="place-order-btn"

            onclick="placeOrder()">

                Place Order

            </button>

        </div>

    </div>

</section>

<!-- =========================================================
SUCCESS
========================================================= -->

<div
class="order-success"

id="orderSuccess">

    <div class="success-box">

        <i class="fa-solid fa-check"></i>

        <h2>

            Order Confirmed

        </h2>

        <p>

            Your delicious order has been
            placed successfully.

        </p>

        <button
        class="place-order-btn"

        onclick=
        "window.location.href='home.php'">

            Back To Home

        </button>

    </div>

</div>

<script src="assets/js/theme.js"></script>

<script>

/* =========================================================
CART
========================================================= */

let cart =

JSON.parse(
localStorage.getItem(
"hungrooCart"
)) || [];

/* =========================================================
RENDER SUMMARY
========================================================= */

function renderSummary(){

    const summaryItems =

    document.getElementById(
    "summaryItems"
    );

    const subtotalText =

    document.getElementById(
    "subtotal"
    );

    const grandTotalText =

    document.getElementById(
    "grandTotal"
    );

    let subtotal = 0;

    summaryItems.innerHTML = "";

    cart.forEach(item=>{

        subtotal +=
        item.price * item.qty;

        summaryItems.innerHTML += `

        <div class="summary-item">

            <div class="summary-item-left">

                <img
                src="${item.image}"
                alt="${item.name}">

                <div>

                    <h4>

                        ${item.name}

                    </h4>

                    <p>

                        Qty : ${item.qty}

                    </p>

                </div>

            </div>

            <strong>

                ₹${item.price * item.qty}

            </strong>

        </div>

        `;

    });

    const total =
    subtotal + 49;

    subtotalText.innerText =
    `₹${subtotal}`;

    grandTotalText.innerText =
    `₹${total}`;

}

/* =========================================================
PLACE ORDER
========================================================= */

function placeOrder(){

    const form =

    document.getElementById(
    "checkoutForm"
    );

    if(!form.checkValidity()){

        form.reportValidity();

        return;

    }

    localStorage.removeItem(
    "hungrooCart"
    );

    document.getElementById(
    "orderSuccess"
    ).classList.add(
    "active"
    );

}

/* =========================================================
LOAD
========================================================= */

renderSummary();

</script>

</body>
</html>