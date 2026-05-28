

<?php

include "config/config.php";

if (session_status() === PHP_SESSION_NONE) {

    session_start();

}

/* =========================================================
TRENDING PRODUCTS
========================================================= */

 $trendingProducts = mysqli_query(

    $conn,

    "SELECT * FROM products ORDER BY id DESC LIMIT 8"

);

/* =========================================================
FEATURED PRODUCTS
========================================================= */

 $featuredProducts = mysqli_query(

    $conn,

    "SELECT * FROM products ORDER BY id DESC LIMIT 8"

);

/* =========================================================
OFFERS (sample - replace with DB if needed)
========================================================= */

 $offers = [

    ['title' => 'Flat 30% OFF', 'sub' => 'On all Burgers today', 'code' => 'BURGER30', 'bg' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=1200&auto=format&fit=crop', 'color' => '#ff6b35'],

    ['title' => 'Buy 1 Get 1 Free', 'sub' => 'On all Coffee drinks', 'code' => 'COFFEEBOGO', 'bg' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1200&auto=format&fit=crop', 'color' => '#6C5CE7'],

    ['title' => '₹100 OFF', 'sub' => 'On orders above ₹499', 'code' => 'HUNGRY100', 'bg' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=1200&auto=format&fit=crop', 'color' => '#00b894'],

];

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Hungroo Café — Premium Food Delivery</title>

<!-- =========================================================
GOOGLE FONT
========================================================= -->

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- =========================================================
FONT AWESOME
========================================================= -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- =========================================================
CSS FILES
========================================================= -->

<link rel="stylesheet" href="assets/css/navbar.css">

<link rel="stylesheet" href="assets/css/home.css">

</head>

<body>

<!-- =========================================================
NAVBAR
========================================================= -->

<?php include "Navbar.php"; ?>

<!-- =========================================================
TOAST NOTIFICATION
========================================================= -->

<div class="toast" id="toast">

    <div class="toast-icon"><i class="fa-solid fa-check"></i></div>

    <span>Added to cart</span>

</div>

<!-- =========================================================
DELIVERY STRIP
========================================================= -->

<div class="delivery-strip-top">

    <div class="delivery-strip-inner">

        <div class="delivery-strip-left">

            <i class="fa-solid fa-location-dot"></i>

            <div>

                <span class="delivery-label">Delivering to</span>

                <strong>Home — Sector 21, Gurugram</strong>

            </div>

        </div>

        <div class="delivery-strip-right">

            <span class="delivery-time-badge">

                <i class="fa-solid fa-bolt"></i> 10 mins

            </span>

        </div>

    </div>

</div>

<!-- =========================================================
HERO SECTION
========================================================= -->

<section class="hero">

    <div class="hero-bg">

        <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?q=80&w=2000&auto=format&fit=crop" alt="Café">

        <div class="hero-overlay"></div>

    </div>

    <div class="hero-content">

        <div class="hero-badge">

            <i class="fa-solid fa-fire"></i> Now Open — Order Fresh

        </div>

        <h1>

            Taste The Best<br>Food In Town

        </h1>

        <p>

            Experience premium café vibes with delicious burgers, pizzas, desserts, coffee and refreshing drinks — delivered in minutes.

        </p>

        <div class="hero-search">

            <div class="hero-search-box">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input type="text" placeholder="Search for burgers, pizza, coffee..." id="heroSearch">

            </div>

        </div>

        <div class="hero-buttons">

            <a href="menu.php" class="hero-btn primary">

                <i class="fa-solid fa-utensils"></i> Explore Menu

            </a>

            <a href="offers.php" class="hero-btn secondary">

                <i class="fa-solid fa-tags"></i> Today's Offers

            </a>

        </div>

    </div>

</section>

<!-- =========================================================
OFFER BANNERS CAROUSEL
========================================================= -->

<section class="offers-section">

    <div class="offers-track" id="offersTrack">

        <?php foreach ($offers as $i => $offer): ?>

        <div class="offer-card" style="--accent: <?php echo $offer['color']; ?>;">

            <div class="offer-bg">

                <img src="<?php echo $offer['bg']; ?>" alt="">

                <div class="offer-overlay"></div>

            </div>

            <div class="offer-content">

                <div class="offer-code">

                    <i class="fa-solid fa-ticket"></i> <?php echo $offer['code']; ?>

                </div>

                <h3><?php echo $offer['title']; ?></h3>

                <p><?php echo $offer['sub']; ?></p>

            </div>

        </div>

        <?php endforeach; ?>

        <div class="offer-card" style="--accent: #e17055;">

            <div class="offer-bg">

                <img src="https://images.unsplash.com/photo-1544145945-f90425340c7e?q=80&w=1200&auto=format&fit=crop" alt="">

                <div class="offer-overlay"></div>

            </div>

            <div class="offer-content">

                <div class="offer-code">

                    <i class="fa-solid fa-ticket"></i> SWEET50

                </div>

                <h3>50% OFF Desserts</h3>

                <p>On all sweet treats this weekend</p>

            </div>

        </div>

    </div>

    <div class="offers-nav">

        <button class="offer-nav-btn" id="offerPrev"><i class="fa-solid fa-chevron-left"></i></button>

        <div class="offer-dots" id="offerDots"></div>

        <button class="offer-nav-btn" id="offerNext"><i class="fa-solid fa-chevron-right"></i></button>

    </div>

</section>

<!-- =========================================================
CATEGORIES
========================================================= -->

<section class="section">

    <div class="section-head">

        <div>

            <h2>Shop by Category</h2>

            <p>Find exactly what you're craving</p>

        </div>

        <a href="menu.php" class="see-all-link">

            See All <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>

    <div class="categories-scroll-wrap">

        <div class="categories">

            <a href="menu.php?category=Burgers" class="category-card">

                <div class="category-img-wrap">

                    <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=400&auto=format&fit=crop" alt="Burgers">

                </div>

                <h3>Burgers</h3>

                <span class="category-count">12 Items</span>

            </a>

            <a href="menu.php?category=Pizza" class="category-card">

                <div class="category-img-wrap">

                    <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=400&auto=format&fit=crop" alt="Pizza">

                </div>

                <h3>Pizza</h3>

                <span class="category-count">8 Items</span>

            </a>

            <a href="menu.php?category=Coffee" class="category-card">

                <div class="category-img-wrap">

                    <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=400&auto=format&fit=crop" alt="Coffee">

                </div>

                <h3>Coffee</h3>

                <span class="category-count">15 Items</span>

            </a>

            <a href="menu.php?category=Desserts" class="category-card">

                <div class="category-img-wrap">

                    <img src="https://images.unsplash.com/photo-1544145945-f90425340c7e?q=80&w=400&auto=format&fit=crop" alt="Desserts">

                </div>

                <h3>Desserts</h3>

                <span class="category-count">10 Items</span>

            </a>

            <a href="menu.php?category=Cold Drinks" class="category-card">

                <div class="category-img-wrap">

                    <img src="https://images.unsplash.com/photo-1499636136210-6f4ee915583e?q=80&w=400&auto=format&fit=crop" alt="Cold Drinks">

                </div>

                <h3>Cold Drinks</h3>

                <span class="category-count">9 Items</span>

            </a>

            <a href="menu.php?category=Snacks" class="category-card">

                <div class="category-img-wrap">

                    <img src="https://images.unsplash.com/photo-1482049016688-2d3e1b311543?q=80&w=400&auto=format&fit=crop" alt="Snacks">

                </div>

                <h3>Snacks</h3>

                <span class="category-count">14 Items</span>

            </a>

            <a href="menu.php?category=Wraps" class="category-card">

                <div class="category-img-wrap">

                    <img src="https://images.unsplash.com/photo-1626700051175-6818013e1d4f?q=80&w=400&auto=format&fit=crop" alt="Wraps">

                </div>

                <h3>Wraps</h3>

                <span class="category-count">6 Items</span>

            </a>

            <a href="menu.php?category=Breakfast" class="category-card">

                <div class="category-img-wrap">

                    <img src="https://images.unsplash.com/photo-1533089860892-a7c6f0a88666?q=80&w=400&auto=format&fit=crop" alt="Breakfast">

                </div>

                <h3>Breakfast</h3>

                <span class="category-count">11 Items</span>

            </a>

        </div>

    </div>

</section>

<!-- =========================================================
TRENDING PRODUCTS
========================================================= -->

<section class="section">

    <div class="section-head">

        <div>

            <div class="section-tag">

                <i class="fa-solid fa-fire-flame-curved"></i> Trending

            </div>

            <h2>Trending Right Now</h2>

            <p>Most loved food by our customers</p>

        </div>

        <a href="menu.php" class="see-all-link">

            See All <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>

    <div class="products-grid">

        <?php

        while ($row = mysqli_fetch_assoc($trendingProducts)):

            $inCart = false;

            $qty = 0;

            $cartData = json_decode($_COOKIE['cart'] ?? '[]', true);

            if (!$cartData) {

                $cartData = json_decode($_SESSION['cart'] ?? '[]', true);

            }

            if (is_array($cartData)) {

                foreach ($cartData as $ci) {

                    if ($ci['id'] == $row['id']) {

                        $inCart = true;

                        $qty = $ci['quantity'];

                        break;

                    }

                }

            }

        ?>

        <div class="product-card" data-product-id="<?php echo $row['id']; ?>">

            <div class="product-image">

                <img

                    src="<?php echo !empty($row['image']) ? htmlspecialchars($row['image']) : 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=600&auto=format&fit=crop'; ?>"

                    alt="<?php echo htmlspecialchars($row['name']); ?>"

                    loading="lazy"

                >

                <div class="badge-row">

                    <span class="badge badge-discount">20% OFF</span>

                    <span class="badge badge-rating"><i class="fa-solid fa-star"></i> 4.8</span>

                </div>

                <div class="time-tag"><i class="fa-regular fa-clock"></i> 10 min</div>

            </div>

            <div class="product-content">

                <h3><?php echo htmlspecialchars($row['name']); ?></h3>

                <p><?php echo htmlspecialchars(substr($row['description'], 0, 60)); ?><?php echo strlen($row['description']) > 60 ? '...' : ''; ?></p>

                <div class="product-bottom">

                    <div class="product-price">

                        <span class="original-price">₹<?php echo $row['price'] + 80; ?></span>

                        <span class="current-price">₹<?php echo $row['price']; ?></span>

                    </div>

                    <?php if ($inCart): ?>

                    <div class="qty-controls" data-id="<?php echo $row['id']; ?>">

                        <button class="qty-btn qty-minus" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-minus"></i></button>

                        <span class="qty-num"><?php echo $qty; ?></span>

                        <button class="qty-btn qty-plus" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-plus"></i></button>

                    </div>

                    <?php else: ?>

                    <button

                        class="add-btn"

                        data-id="<?php echo $row['id']; ?>"

                        data-name="<?php echo htmlspecialchars($row['name']); ?>"

                        data-price="<?php echo $row['price']; ?>"

                        data-image="<?php echo htmlspecialchars(!empty($row['image']) ? $row['image'] : 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=600&auto=format&fit=crop'); ?>"

                    >

                        ADD

                    </button>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <?php endwhile; ?>

    </div>

</section>

<!-- =========================================================
PROMO STRIP
========================================================= -->

<section class="promo-strip">

    <div class="promo-strip-inner">

        <div class="promo-item">

            <i class="fa-solid fa-truck-fast"></i>

            <div>

                <strong>10 Min Delivery</strong>

                <span>Superfast at your door</span>

            </div>

        </div>

        <div class="promo-item">

            <i class="fa-solid fa-shield-halved"></i>

            <div>

                <strong>Safe & Hygienic</strong>

                <span>FSSAI certified kitchen</span>

            </div>

        </div>

        <div class="promo-item">

            <i class="fa-solid fa-rotate-left"></i>

            <div>

                <strong>Easy Refunds</strong>

                <span>No questions asked</span>

            </div>

        </div>

        <div class="promo-item">

            <i class="fa-solid fa-headset"></i>

            <div>

                <strong>24/7 Support</strong>

                <span>We're always here</span>

            </div>

        </div>

    </div>

</section>

<!-- =========================================================
FEATURED PRODUCTS
========================================================= -->

<section class="section">

    <div class="section-head">

        <div>

            <div class="section-tag">

                <i class="fa-solid fa-crown"></i> Featured

            </div>

            <h2>Featured Specials</h2>

            <p>Handpicked premium dishes by our chef</p>

        </div>

        <a href="menu.php" class="see-all-link">

            See All <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>

    <div class="products-grid">

        <?php

        while ($row = mysqli_fetch_assoc($featuredProducts)):

            $inCart = false;

            $qty = 0;

            $cartData = json_decode($_COOKIE['cart'] ?? '[]', true);

            if (!$cartData) {

                $cartData = json_decode($_SESSION['cart'] ?? '[]', true);

            }

            if (is_array($cartData)) {

                foreach ($cartData as $ci) {

                    if ($ci['id'] == $row['id']) {

                        $inCart = true;

                        $qty = $ci['quantity'];

                        break;

                    }

                }

            }

        ?>

        <div class="product-card featured" data-product-id="<?php echo $row['id']; ?>">

            <div class="product-image">

                <img

                    src="<?php echo !empty($row['image']) ? htmlspecialchars($row['image']) : 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=600&auto=format&fit=crop'; ?>"

                    alt="<?php echo htmlspecialchars($row['name']); ?>"

                    loading="lazy"

                >

                <div class="badge-row">

                    <span class="badge badge-bestseller"><i class="fa-solid fa-crown"></i> Bestseller</span>

                    <span class="badge badge-rating"><i class="fa-solid fa-star"></i> 4.9</span>

                </div>

                <div class="time-tag"><i class="fa-solid fa-bolt"></i> Fast</div>

            </div>

            <div class="product-content">

                <h3><?php echo htmlspecialchars($row['name']); ?></h3>

                <p><?php echo htmlspecialchars(substr($row['description'], 0, 60)); ?><?php echo strlen($row['description']) > 60 ? '...' : ''; ?></p>

                <div class="product-bottom">

                    <div class="product-price">

                        <span class="original-price">₹<?php echo $row['price'] + 100; ?></span>

                        <span class="current-price">₹<?php echo $row['price']; ?></span>

                    </div>

                    <?php if ($inCart): ?>

                    <div class="qty-controls" data-id="<?php echo $row['id']; ?>">

                        <button class="qty-btn qty-minus" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-minus"></i></button>

                        <span class="qty-num"><?php echo $qty; ?></span>

                        <button class="qty-btn qty-plus" data-id="<?php echo $row['id']; ?>"><i class="fa-solid fa-plus"></i></button>

                    </div>

                    <?php else: ?>

                    <button

                        class="add-btn"

                        data-id="<?php echo $row['id']; ?>"

                        data-name="<?php echo htmlspecialchars($row['name']); ?>"

                        data-price="<?php echo $row['price']; ?>"

                        data-image="<?php echo htmlspecialchars(!empty($row['image']) ? $row['image'] : 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=600&auto=format&fit=crop'); ?>"

                    >

                        ADD

                    </button>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <?php endwhile; ?>

    </div>

</section>

<!-- =========================================================
APP DOWNLOAD CTA
========================================================= -->

<section class="app-cta">

    <div class="app-cta-bg">

        <img src="https://images.unsplash.com/photo-1493857671505-72967e2e2760?q=80&w=1600&auto=format&fit=crop" alt="">

        <div class="app-cta-overlay"></div>

    </div>

    <div class="app-cta-content">

        <h2>Get The Hungroo App</h2>

        <p>Faster ordering, exclusive deals, and real-time tracking — all in one app.</p>

        <div class="app-btns">

            <a href="#" class="app-store-btn">

                <i class="fa-brands fa-apple"></i>

                <div>

                    <small>Download on the</small>

                    <strong>App Store</strong>

                </div>

            </a>

            <a href="#" class="app-store-btn">

                <i class="fa-brands fa-google-play"></i>

                <div>

                    <small>Get it on</small>

                    <strong>Google Play</strong>

                </div>

            </a>

        </div>

    </div>

</section>

<!-- =========================================================
CUSTOMER REVIEWS
========================================================= -->

<section class="section">

    <div class="section-head">

        <div>

            <div class="section-tag">

                <i class="fa-solid fa-heart"></i> Reviews

            </div>

            <h2>What Customers Say</h2>

            <p>Loved by thousands across the city</p>

        </div>

    </div>

    <div class="reviews">

        <div class="review-card">

            <div class="review-stars">

                <i class="fa-solid fa-star"></i>

                <i class="fa-solid fa-star"></i>

                <i class="fa-solid fa-star"></i>

                <i class="fa-solid fa-star"></i>

                <i class="fa-solid fa-star"></i>

            </div>

            <p>"Amazing quality food and premium vibe. The burgers and coffee are absolutely perfect. Best café delivery in the city!"</p>

            <div class="review-top">

                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Priya">

                <div>

                    <h4>Priya Sharma</h4>

                    <span>Ordered 12 times</span>

                </div>

                <div class="review-verified">

                    <i class="fa-solid fa-circle-check"></i> Verified

                </div>

            </div>

        </div>

        <div class="review-card">

            <div class="review-stars">

                <i class="fa-solid fa-star"></i>

                <i class="fa-solid fa-star"></i>

                <i class="fa-solid fa-star"></i>

                <i class="fa-solid fa-star"></i>

                <i class="fa-solid fa-star"></i>

            </div>

            <p>"Fast delivery and premium experience. The UI and food both feel top class. Never disappointed with Hungroo."</p>

            <div class="review-top">

                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Rahul">

                <div>

                    <h4>Rahul Verma</h4>

                    <span>Ordered 8 times</span>

                </div>

                <div class="review-verified">

                    <i class="fa-solid fa-circle-check"></i> Verified

                </div>

            </div>

        </div>

        <div class="review-card">

            <div class="review-stars">

                <i class="fa-solid fa-star"></i>

                <i class="fa-solid fa-star"></i>

                <i class="fa-solid fa-star"></i>

                <i class="fa-solid fa-star"></i>

                <i class="fa-regular fa-star"></i>

            </div>

            <p>"Best café website experience I have seen. Very smooth and modern. The desserts are to die for!"</p>

            <div class="review-top">

                <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Anjali">

                <div>

                    <h4>Anjali Singh</h4>

                    <span>Ordered 5 times</span>

                </div>

                <div class="review-verified">

                    <i class="fa-solid fa-circle-check"></i> Verified

                </div>

            </div>

        </div>

    </div>

</section>

<!-- =========================================================
SLIDE CART
========================================================= -->

<div class="side-cart" id="slideCart">

    <div class="side-cart-top">

        <div>

            <h2>My Cart</h2>

            <span class="cart-item-count" id="sideCartCount">0 items</span>

        </div>

        <button class="close-cart-btn" id="closeCartBtn">

            <i class="fa-solid fa-xmark"></i>

        </button>

    </div>

    <div class="side-cart-items" id="sideCartItems"></div>

    <div class="cart-bottom">

        <div class="delivery-strip">

            <i class="fa-solid fa-bolt"></i>

            Delivery in 10 mins

        </div>

        <div class="cart-total-row">

            <span>Total Amount</span>

            <h3 id="cartTotal">₹0</h3>

        </div>

        <a href="cart.php" class="checkout-btn">

            Proceed to Checkout <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>

</div>

<!-- =========================================================
OVERLAY
========================================================= -->

<div id="cartOverlay"></div>

<!-- =========================================================
FOOTER
========================================================= -->

<?php include "footer.php"; ?>

<!-- =========================================================
SCRIPTS
========================================================= -->

<script>

/* =========================================================
CART STATE
========================================================= */

let cart = JSON.parse(localStorage.getItem('cart')) || [];

function saveCart() {

    localStorage.setItem('cart', JSON.stringify(cart));

}

/* =========================================================
CART COUNT
======================================================== */

function updateCartCount() {

    let total = 0;

    cart.forEach(item => { total += item.quantity; });

    document.querySelectorAll('.cart-count').forEach(el => {

        el.textContent = total;

        el.style.display = total > 0 ? 'flex' : 'none';

    });

    const sideCount = document.getElementById('sideCartCount');

    if (sideCount) sideCount.textContent = total + (total === 1 ? ' item' : ' items');

}

/* =========================================================
TOAST
======================================================== */

function showToast(msg) {

    const toast = document.getElementById('toast');

    if (msg) toast.querySelector('span').textContent = msg;

    toast.classList.add('show');

    setTimeout(() => toast.classList.remove('show'), 2200);

}

/* =========================================================
RENDER SLIDE CART
======================================================== */

function renderCart() {

    const cartItems = document.getElementById('sideCartItems');

    const totalBox = document.getElementById('cartTotal');

    if (!cartItems) return;

    cartItems.innerHTML = '';

    let total = 0;

    if (cart.length === 0) {

        cartItems.innerHTML = `

            <div class="cart-empty">

                <i class="fa-solid fa-cart-shopping"></i>

                <p>Your cart is empty</p>

                <span>Add items to get started</span>

            </div>`;

        totalBox.textContent = '₹0';

        return;

    }

    cart.forEach((item, index) => {

        total += item.price * item.quantity;

        cartItems.innerHTML += `

            <div class="cart-item">

                <img src="${item.image}" alt="${item.name}">

                <div class="cart-content">

                    <h4>${item.name}</h4>

                    <div class="cart-price">₹${item.price}</div>

                    <div class="cart-qty">

                        <button class="cart-qty-btn" onclick="changeQty(${index}, -1)"><i class="fa-solid fa-minus"></i></button>

                        <span>${item.quantity}</span>

                        <button class="cart-qty-btn" onclick="changeQty(${index}, 1)"><i class="fa-solid fa-plus"></i></button>

                    </div>

                </div>

            </div>`;

    });

    totalBox.textContent = '₹' + total;

}

/* =========================================================
SLIDE CART QTY CHANGE
========================================================= */

function changeQty(index, delta) {

    cart[index].quantity += delta;

    if (cart[index].quantity <= 0) cart.splice(index, 1);

    saveCart();

    renderCart();

    updateCartCount();

    updateProductButtons();

}

/* =========================================================
UPDATE PRODUCT BUTTONS (no reload)
======================================================== */

function updateProductButtons() {

    document.querySelectorAll('.product-card').forEach(card => {

        const id = card.dataset.productId;

        const bottom = card.querySelector('.product-bottom');

        if (!bottom) return;

        const existing = cart.find(item => item.id == id);

        const currentBtn = bottom.querySelector('.add-btn');

        const currentQty = bottom.querySelector('.qty-controls');

        if (existing && currentBtn) {

            currentBtn.outerHTML = `

                <div class="qty-controls" data-id="${id}">

                    <button class="qty-btn qty-minus" data-id="${id}"><i class="fa-solid fa-minus"></i></button>

                    <span class="qty-num">${existing.quantity}</span>

                    <button class="qty-btn qty-plus" data-id="${id}"><i class="fa-solid fa-plus"></i></button>

                </div>`;

            attachQtyListeners(bottom);

        } else if (existing && currentQty) {

            currentQty.querySelector('.qty-num').textContent = existing.quantity;

        } else if (!existing && currentQty) {

            const cardData = card.querySelector('.add-btn')?.dataset;

            currentQty.outerHTML = `

                <button class="add-btn"

                    data-id="${id}"

                    data-name="${currentQty.dataset.name || ''}"

                    data-price="${currentQty.dataset.price || ''}"

                    data-image="${currentQty.dataset.image || ''}"

                >ADD</button>`;

            attachAddListeners();

        }

    });

}

/* =========================================================
ATTACH QTY LISTENERS
======================================================== */

function attachQtyListeners(container) {

    container.querySelectorAll('.qty-minus').forEach(btn => {

        btn.onclick = function (e) {

            e.stopPropagation();

            const id = this.dataset.id;

            const item = cart.find(i => i.id == id);

            if (item) {

                item.quantity--;

                if (item.quantity <= 0) {

                    cart = cart.filter(i => i.id != id);

                }

                saveCart();

                renderCart();

                updateCartCount();

                updateProductButtons();

            }

        };

    });

    container.querySelectorAll('.qty-plus').forEach(btn => {

        btn.onclick = function (e) {

            e.stopPropagation();

            const id = this.dataset.id;

            const item = cart.find(i => i.id == id);

            if (item) {

                item.quantity++;

                saveCart();

                renderCart();

                updateCartCount();

                updateProductButtons();

            }

        };

    });

}

/* =========================================================
ADD TO CART LISTENERS
========================================================= */

function attachAddListeners() {

    document.querySelectorAll('.add-btn').forEach(button => {

        button.onclick = function (e) {

            e.stopPropagation();

            const id = this.dataset.id;

            const name = this.dataset.name;

            const price = parseFloat(this.dataset.price);

            const image = this.dataset.image;

            const existing = cart.find(item => item.id == id);

            if (existing) {

                existing.quantity++;

            } else {

                cart.push({ id, name, price, image, quantity: 1 });

            }

            saveCart();

            renderCart();

            updateCartCount();

            showToast();

            updateProductButtons();

        };

    });

}

/* =========================================================
SLIDE CART OPEN / CLOSE
======================================================== */

function openSlideCart() {

    document.getElementById('slideCart').classList.add('active');

    document.getElementById('cartOverlay').classList.add('active');

    document.body.style.overflow = 'hidden';

}

function closeSlideCart() {

    document.getElementById('slideCart').classList.remove('active');

    document.getElementById('cartOverlay').classList.remove('active');

    document.body.style.overflow = '';

}

document.getElementById('desktopOpenCart')?.addEventListener('click', openSlideCart);

document.getElementById('mobileOpenCart')?.addEventListener('click', openSlideCart);

document.getElementById('closeCartBtn')?.addEventListener('click', closeSlideCart);

document.getElementById('cartOverlay')?.addEventListener('click', closeSlideCart);

/* =========================================================
OFFERS CAROUSEL
======================================================== */

(function () {

    const track = document.getElementById('offersTrack');

    const prevBtn = document.getElementById('offerPrev');

    const nextBtn = document.getElementById('offerNext');

    const dotsWrap = document.getElementById('offerDots');

    if (!track) return;

    const cards = track.querySelectorAll('.offer-card');

    let current = 0;

    const total = cards.length;

    function getVisible() {

        if (window.innerWidth < 640) return 1;

        if (window.innerWidth < 1024) return 2;

        return 3;

    }

    function buildDots() {

        dotsWrap.innerHTML = '';

        const max = Math.max(1, total - getVisible());

        for (let i = 0; i <= max; i++) {

            const dot = document.createElement('span');

            dot.className = 'offer-dot' + (i === current ? ' active' : '');

            dot.onclick = () => goTo(i);

            dotsWrap.appendChild(dot);

        }

    }

    function goTo(index) {

        const max = Math.max(0, total - getVisible());

        current = Math.max(0, Math.min(index, max));

        const card = cards[0];

        const gap = 16;

        const width = card.offsetWidth + gap;

        track.style.transform = `translateX(-${current * width}px)`;

        buildDots();

    }

    prevBtn.onclick = () => goTo(current - 1);

    nextBtn.onclick = () => goTo(current + 1);

    window.addEventListener('resize', () => goTo(current));

    buildDots();

})();

/* =========================================================
HERO SEARCH REDIRECT
========================================================= */

document.getElementById('heroSearch')?.addEventListener('keydown', function (e) {

    if (e.key === 'Enter' && this.value.trim()) {

        window.location.href = 'menu.php?search=' + encodeURIComponent(this.value.trim());

    }

});

/* =========================================================
INIT
======================================================== */

updateCartCount();

renderCart();

attachAddListeners();

document.querySelectorAll('.qty-controls').forEach(el => attachQtyListeners(el));

</script>

</body>

</html>