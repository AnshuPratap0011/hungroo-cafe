<?php

session_start();

include "config/config.php";

$pageTitle = "Hungroo Café | Home";

/* =========================================================
FEATURED PRODUCTS
========================================================= */

$featuredItems = [];

$productQuery = mysqli_query(

    $conn,

    "SELECT * FROM products
    WHERE is_featured='1'
    AND status='active'
    LIMIT 4"

);

while($row = mysqli_fetch_assoc($productQuery)){

    $featuredItems[] = $row;

}

/* =========================================================
CATEGORIES
========================================================= */

$categories = [];

$categoryQuery = mysqli_query(

    $conn,

    "SELECT * FROM categories
    WHERE status='active'
    LIMIT 4"

);

while($cat = mysqli_fetch_assoc($categoryQuery)){

    $categories[] = $cat;

}

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
href="assets/css/home.css">

</head>

<body>

<!-- =========================================================
NAVBAR
========================================================= -->

<?php include "Navbar.php"; ?>

<!-- =========================================================
BACKGROUND BLUR
========================================================= -->

<div class="bg-blur blur-1"></div>
<div class="bg-blur blur-2"></div>

<!-- =========================================================
HERO SECTION
========================================================= -->

<section class="hero">

    <div class="hero-left">

        <div class="hero-badge">

            <i class="fa-solid fa-fire"></i>

            Premium Café Experience

        </div>

        <h1>

            Taste The

            <span>

                Luxury

            </span>

            Café Experience

        </h1>

        <p>

            Handcrafted burgers, artisan coffee,
            desserts and unforgettable café vibes
            designed for modern food lovers.

        </p>

        <div class="hero-buttons">

            <a
            href="menu.php"
            class="hero-btn primary-btn">

                Explore Menu

            </a>

            <a
            href="contact.php"
            class="hero-btn secondary-btn">

                Reserve Table

            </a>

            <a
            href="offers.php"
            class="hero-btn third-btn">

                Today's Offers

            </a>

        </div>

        <div class="hero-stats">

            <div class="hero-stat">

                <h3>

                    25K+

                </h3>

                <p>

                    Happy Customers

                </p>

            </div>

            <div class="hero-stat">

                <h3>

                    120+

                </h3>

                <p>

                    Premium Dishes

                </p>

            </div>

            <div class="hero-stat">

                <h3>

                    4.9★

                </h3>

                <p>

                    Top Rating

                </p>

            </div>

        </div>

    </div>

    <!-- RIGHT -->

    <div class="hero-right">

        <div class="hero-image">

            <img
            src="https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=1200&auto=format&fit=crop"
            alt="Hungroo Café">

        </div>

        <div class="floating-card card-1">

            <i class="fa-solid fa-burger"></i>

            Best Burgers

        </div>

        <div class="floating-card card-2">

            <i class="fa-solid fa-mug-hot"></i>

            Premium Coffee

        </div>

    </div>

</section>



<!-- =========================================================
FEATURED ITEMS
========================================================= -->

<section class="featured-section">

    <div class="section-header">

        <span>

            Customer Favorites

        </span>

        <h2>

            Featured Specials

        </h2>

        <p>

            Most loved premium dishes by our customers.

        </p>

    </div>

    <div class="featured-grid">

        <?php foreach($featuredItems as $item): ?>

        <div class="food-card">

            <div class="food-image">

                <img
                src="<?php echo $item['image']; ?>"
                alt="<?php echo $item['name']; ?>">

                <span class="food-tag">

                    <?php echo $item['tag']; ?>

                </span>

                <div class="delivery-badge">

                    <i class="fa-solid fa-bolt"></i>

                    Fast Delivery

                </div>

            </div>

            <div class="food-content">

                <div class="food-rating">

                    <i class="fa-solid fa-star"></i>

                    <?php echo $item['rating']; ?>

                </div>

                <h3>

                    <?php echo $item['name']; ?>

                </h3>

                <p class="food-description">

                    <?php echo $item['short_description']; ?>

                </p>

                <div class="food-bottom">

                    <h4>

                        ₹<?php echo $item['price']; ?>

                    </h4>

                    <button

                    class="add-cart"

                    data-id="<?php echo $item['id']; ?>"

                    data-name="<?php echo $item['name']; ?>"

                    data-price="<?php echo $item['price']; ?>"

                    data-image="<?php echo $item['image']; ?>">

                        <i class="fa-solid fa-cart-shopping"></i>

                        Add To Cart

                    </button>

                </div>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</section>

<!-- =========================================================
CATEGORIES
========================================================= -->

<section class="categories-section">

    <div class="section-header">

        <span>

            Explore Menu

        </span>

        <h2>

            Food Categories

        </h2>

        <p>

            Discover premium meals, drinks and desserts.

        </p>

    </div>

    <div class="categories-grid">

        <?php foreach($categories as $category): ?>

        <a

        href="menu.php?category=<?php echo urlencode($category['slug']); ?>"

        class="category-card">

            <i class="<?php echo $category['icon']; ?>"></i>

            <h3>

                <?php echo $category['name']; ?>

            </h3>

        </a>

        <?php endforeach; ?>

    </div>

</section>

<!-- =========================================================
SLIDE CART
========================================================= -->

<div class="cart-overlay" id="cartOverlay"></div>

<div class="slide-cart" id="slideCart">

    <div class="slide-cart-top">

        <h2>

            My Cart

        </h2>

        <button class="close-cart" id="closeCart">

            <i class="fa-solid fa-xmark"></i>

        </button>

    </div>

    <div class="slide-cart-items" id="slideCartItems"></div>

    <div class="slide-cart-bottom">

        <div class="slide-total-row">

            <span>

                Total

            </span>

            <h3 id="slideCartTotal">

                ₹0

            </h3>

        </div>

        <a
        href="Cart.php"
        class="checkout-btn">

            Checkout

        </a>

    </div>

</div>

<!-- =========================================================
FOOTER
========================================================= -->

<?php include "footer.php"; ?>

<!-- =========================================================
CART SCRIPT
========================================================= -->

<script>

/* =========================================================
ELEMENTS
========================================================= */

const addCartButtons =
document.querySelectorAll('.add-cart');

const slideCart =
document.getElementById('slideCart');

const cartOverlay =
document.getElementById('cartOverlay');

const closeCart =
document.getElementById('closeCart');

const slideCartItems =
document.getElementById('slideCartItems');

const slideCartTotal =
document.getElementById('slideCartTotal');

/* =========================================================
OPEN / CLOSE CART
========================================================= */

function openCart(){

    slideCart.classList.add('active');

    cartOverlay.classList.add('active');

}

function closeSlideCart(){

    slideCart.classList.remove('active');

    cartOverlay.classList.remove('active');

}

closeCart.addEventListener(
'click',
closeSlideCart
);

cartOverlay.addEventListener(
'click',
closeSlideCart
);

/* =========================================================
RENDER CART
========================================================= */

function renderCart(){

    let cart =
    JSON.parse(
    localStorage.getItem('cart')
    ) || [];

    slideCartItems.innerHTML = '';

    let total = 0;

    if(cart.length === 0){

        slideCartItems.innerHTML = `

        <div class="empty-slide-cart">

            <i class="fa-solid fa-cart-shopping"></i>

            <h3>

                Cart is Empty

            </h3>

            <p>

                Add delicious items now.

            </p>

        </div>

        `;

    }

    cart.forEach((item,index)=>{

        if(!item.qty){

            item.qty = 1;

        }

        total +=
        Number(item.price) *
        item.qty;

        slideCartItems.innerHTML += `

        <div class="slide-cart-card">

            <div class="slide-cart-image">

                <img
                src="${item.image}"
                alt="${item.name}">

            </div>

            <div class="slide-cart-content">

                <h4>

                    ${item.name}

                </h4>

                <p>

                    ₹${item.price}

                </p>

                <div class="qty-box">

                    <button onclick="changeQty(${index},-1)">

                        -

                    </button>

                    <span>

                        ${item.qty}

                    </span>

                    <button onclick="changeQty(${index},1)">

                        +

                    </button>

                </div>

            </div>

        </div>

        `;

    });

    slideCartTotal.innerHTML =
    `₹${total}`;

    document
    .querySelectorAll('.cart-count')
    .forEach(count=>{

        count.innerHTML =
        cart.length;

    });

    localStorage.setItem(
    'cart',
    JSON.stringify(cart)
    );

}

/* =========================================================
CHANGE QTY
========================================================= */

function changeQty(index,value){

    let cart =
    JSON.parse(
    localStorage.getItem('cart')
    ) || [];

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
ADD TO CART
========================================================= */

addCartButtons.forEach(button => {

    button.addEventListener('click',()=>{

        const item = {

            id:button.dataset.id,

            name:button.dataset.name,

            price:button.dataset.price,

            image:button.dataset.image,

            qty:1

        };

        let cart =
        JSON.parse(
        localStorage.getItem('cart')
        ) || [];

        const existing =
        cart.find(product =>
        product.id === item.id
        );

        if(existing){

            existing.qty += 1;

        }

        else{

            cart.push(item);

        }

        localStorage.setItem(
        'cart',
        JSON.stringify(cart)
        );

        button.innerHTML =
        '<i class="fa-solid fa-check"></i> Added';

        setTimeout(()=>{

            button.innerHTML =
            '<i class="fa-solid fa-cart-shopping"></i> Add To Cart';

        },1500);

        renderCart();

        openCart();

    });

});

/* =========================================================
INIT
========================================================= */

renderCart();

</script>


<script src="assets/js/theme.js"></script>
<script src="assets/js/preloader.js"></script>

</body>
</html>