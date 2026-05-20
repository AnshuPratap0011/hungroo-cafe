<?php

session_start();

$pageTitle =
"Hungroo Café | Home";

/* =========================================================
FEATURED ITEMS
========================================================= */

$featuredItems = [

    [
        "id"    => 1,
        "name"  => "Premium Burger",
        "price" => 349,
        "image" => "https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=1400&auto=format&fit=crop"
    ],

    [
        "id"    => 2,
        "name"  => "Cold Coffee",
        "price" => 229,
        "image" => "https://images.unsplash.com/photo-1517701604599-bb29b565090c?q=80&w=1400&auto=format&fit=crop"
    ],

    [
        "id"    => 3,
        "name"  => "Italian Pizza",
        "price" => 599,
        "image" => "https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=1400&auto=format&fit=crop"
    ],

    [
        "id"    => 4,
        "name"  => "Chocolate Dessert",
        "price" => 279,
        "image" => "https://images.unsplash.com/photo-1551024601-bec78aea704b?q=80&w=1400&auto=format&fit=crop"
    ]

];

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

<link
rel="stylesheet"
href="assets/css/home.css">

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =========================================================
HERO
========================================================= -->

<section class="hero">

    <!-- LEFT -->

    <div class="hero-left">

        <span class="hero-badge">

            <i class="fa-solid fa-fire"></i>

            Premium Café Experience

        </span>

        <h1>

            Taste The

            <span>

                Luxury

            </span>

        </h1>

        <p>

            Discover handcrafted burgers,
            signature coffee and premium
            café vibes only at Hungroo Café.

        </p>

        <div class="hero-buttons">

            <a
            href="menu.php"

            class="hero-btn primary">

                Explore Menu

            </a>

            <a
            href="reservation-history.php"

            class="hero-btn secondary">

                Book Table

            </a>

        </div>

    </div>

    <!-- RIGHT -->

    <div class="hero-right">

        <div class="hero-image">

            <img
            src="https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=1600&auto=format&fit=crop"
            alt="Hungroo Café">

        </div>

        <div class="hero-card">

            <h3>

                25K+

            </h3>

            <p>

                Happy Customers

            </p>

        </div>

    </div>

</section>

<!-- =========================================================
FEATURED SECTION
========================================================= -->

<section class="home-section">

    <div class="section-top">

        <span>

            Featured Menu

        </span>

        <h2>

            Popular Dishes

        </h2>

        <p>

            Premium handcrafted meals,
            desserts and signature drinks.

        </p>

    </div>

    <!-- GRID -->

    <div class="food-grid">

        <?php foreach($featuredItems as $item): ?>

        <div class="food-card">

            <!-- IMAGE -->

            <div class="food-image">

                <img
                src="<?php echo $item['image']; ?>"
                alt="<?php echo $item['name']; ?>">

            </div>

            <!-- CONTENT -->

            <div class="food-content">

                <h3>

                    <?php echo $item['name']; ?>

                </h3>

                <p>

                    Premium handcrafted food
                    with unforgettable taste.

                </p>

                <div class="food-bottom">

                    <div class="food-price">

                        ₹<?php echo $item['price']; ?>

                    </div>

                    <!-- ADD BUTTON -->

                    <button
                    class="food-btn"

                    onclick='addToCart(

                    <?php echo json_encode($item); ?>

                    )'>

                        Add To Cart

                    </button>

                </div>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</section>

<!-- =========================================================
CART OVERLAY
========================================================= -->

<div class="cart-overlay" id="cartOverlay"></div>

<!-- =========================================================
SIDE CART
========================================================= -->

<div class="side-cart" id="sideCart">

    <!-- TOP -->

    <div class="side-cart-top">

        <h2>

            Your Cart

        </h2>

        <button
        class="cart-close"

        onclick="closeCart()">

            <i class="fa-solid fa-xmark"></i>

        </button>

    </div>

    <!-- ITEMS -->

    <div
    class="cart-items"

    id="cartItems">

    </div>

    <!-- BOTTOM -->

    <div class="cart-bottom">

        <div class="cart-total">

            <span>

                Total

            </span>

            <h3 id="cartTotal">

                ₹0

            </h3>

        </div>

        <button
        class="checkout-btn"

        onclick=
        "window.location.href='cart.php'">

            Checkout

        </button>

    </div>

</div>

<?php include "footer.php"; ?>

<!-- JS -->

<script>

/* =========================================================
CART DATA
========================================================= */

let cart =

JSON.parse(
localStorage.getItem("hungrooCart")
) || [];

/* =========================================================
ADD TO CART
========================================================= */

function addToCart(item){

    const existing =

    cart.find(product=>
    product.id === item.id
    );

    if(existing){

        existing.qty += 1;

    }

    else{

        cart.push({

            ...item,

            qty:1

        });

    }

    saveCart();

    openCart();

}

/* =========================================================
SAVE CART
========================================================= */

function saveCart(){

    localStorage.setItem(

        "hungrooCart",

        JSON.stringify(cart)

    );

    updateCart();

}

/* =========================================================
UPDATE CART
========================================================= */

function updateCart(){

    const cartItems =

    document.getElementById(
    "cartItems"
    );

    const cartTotal =

    document.getElementById(
    "cartTotal"
    );

    const cartCount =

    document.querySelector(
    ".cart-count"
    );

    if(!cartItems){

        return;

    }

    cartItems.innerHTML = "";

    let total = 0;

    let count = 0;

    cart.forEach((item,index)=>{

        total +=
        item.price * item.qty;

        count += item.qty;

        cartItems.innerHTML += `

        <div class="cart-item">

            <img
            src="${item.image}"
            alt="${item.name}">

            <div class="cart-item-content">

                <h4>

                    ${item.name}

                </h4>

                <p>

                    ₹${item.price}

                </p>

                <div class="qty-box">

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

            </div>

        </div>

        `;

    });

    cartTotal.innerText =
    `₹${total}`;

    if(cartCount){

        cartCount.innerText =
        count;

    }

}

/* =========================================================
INCREASE
========================================================= */

function increaseQty(index){

    cart[index].qty++;

    saveCart();

}

/* =========================================================
DECREASE
========================================================= */

function decreaseQty(index){

    if(cart[index].qty > 1){

        cart[index].qty--;

    }

    else{

        cart.splice(index,1);

    }

    saveCart();

}

/* =========================================================
OPEN CART
========================================================= */

function openCart(){

    document.getElementById(
    "sideCart"
    ).classList.add("active");

    document.getElementById(
    "cartOverlay"
    ).classList.add("active");

}

/* =========================================================
CLOSE CART
========================================================= */

function closeCart(){

    document.getElementById(
    "sideCart"
    ).classList.remove("active");

    document.getElementById(
    "cartOverlay"
    ).classList.remove("active");

}

/* =========================================================
NAVBAR CART CLICK
========================================================= */

const navCart =

document.querySelector(
".nav-cart"
);

if(navCart){

    navCart.addEventListener(

        "click",

        (e)=>{

            e.preventDefault();

            openCart();

        }

    );

}

/* =========================================================
OVERLAY CLOSE
========================================================= */

document.getElementById(
"cartOverlay"
).addEventListener(

    "click",

    closeCart

);

/* =========================================================
INIT
========================================================= */

updateCart();

</script>

<script src="assets/js/theme.js"></script>
<script src="assets/js/preloader.js"></script>

</body>
</html>