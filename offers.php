<?php

include "config/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* =========================================================
OFFERS DATA
========================================================= */

 $offers = [
    [
        'title' => 'Flat 30% OFF', 
        'sub' => 'On all Burgers today', 
        'code' => 'BURGER30', 
        'bg' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=1200&auto=format&fit=crop', 
        'color' => '#6C5CE7'
    ],
    [
        'title' => 'Buy 1 Get 1 Free', 
        'sub' => 'On all Coffee drinks', 
        'code' => 'COFFEEBOGO', 
        'bg' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1200&auto=format&fit=crop', 
        'color' => '#00b894'
    ],
    [
        'title' => '₹100 OFF', 
        'sub' => 'On orders above ₹499', 
        'code' => 'HUNGRY100', 
        'bg' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=1200&auto=format&fit=crop', 
        'color' => '#fdcb6e'
    ],
    [
        'title' => 'Midnight Cravings', 
        'sub' => 'Free delivery on orders above ₹299', 
        'code' => 'MIDNIGHT', 
        'bg' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1200&auto=format&fit=crop', 
        'color' => '#e84393'
    ]
];

/* =========================================================
TRENDING PRODUCTS (For bottom section to enable JS)
========================================================= */

 $trendingProducts = mysqli_query(
    $conn,
    "SELECT * FROM products ORDER BY id DESC LIMIT 8"
);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Offers | Hungroo Café</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="assets/css/navbar.css">

<style>
/* =========================================================
THEME VARIABLES (Matching menu.php)
======================================================== */
:root,[data-theme="dark"]{
    --co-bg:#09090b;
    --co-bg2:#18181b;
    --co-card:#1e1e22;
    --co-card-h:#26262b;
    --co-border:rgba(255,255,255,.06);
    --co-border-h:rgba(255,255,255,.12);
    --co-text:#fff;
    --co-text2:#a1a1aa;
    --co-text3:#71717a;
    --co-accent:#6C5CE7; /* PURPLE THEME */
    --co-accent-l:#a29bfe;
    --co-accent-h:#5b4bd5;
    --co-green:#00b894;
    --co-red:#e74c3c;
    --co-input:rgba(255,255,255,.05);
    --co-input-b:rgba(255,255,255,.08);
    --co-scroll:#27272a;
}

*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Poppins',sans-serif;background:var(--co-bg);color:var(--co-text);-webkit-font-smoothing:antialiased}
a{text-decoration:none;color:inherit}
img{display:block;max-width:100%}

/* =========================================================
LAYOUT UTILS
========================================================= */
.co-container{max-width:1200px;margin:0 auto;padding:0 24px 80px}
.co-section{display:flex;flex-direction:column;gap:30px}

/* =========================================================
PAGE HEADER
======================================================== */
.menu-page-header{position:relative;width:100%;height:350px;border-radius:0 0 40px 40px;overflow:hidden;margin-bottom:40px}
.menu-page-header-bg img{width:100%;height:100%;object-fit:cover}
.menu-page-header-overlay{position:absolute;inset:0;background:linear-gradient(to bottom, rgba(9,9,11,0.3), rgba(9,9,11,1))}
.menu-page-header-content{position:absolute;bottom:0;left:0;right:0;padding:40px 24px;text-align:center}
.menu-page-header-content h1{font-size:clamp(32px,5vw,48px);font-weight:800;margin-bottom:10px;text-shadow:0 2px 10px rgba(0,0,0,0.5)}
.menu-page-header-content p{font-size:16px;color:var(--co-text2)}

/* =========================================================
OFFERS CAROUSEL
======================================================== */
.offers-slider-wrap{position:relative;overflow:hidden;padding:10px 0}
.offers-track{display:flex;gap:20px;transition:transform 0.5s ease}
.offer-slide{min-width:300px;flex-shrink:0}
.offer-card-lg{position:relative;height:200px;border-radius:20px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.3)}
.offer-card-lg img{width:100%;height:100%;object-fit:cover;transition:transform 0.5s}
.offer-card-lg:hover img{transform:scale(1.05)}
.offer-overlay-lg{position:absolute;inset:0;background:linear-gradient(to top, rgba(0,0,0,0.8), transparent);display:flex;flex-direction:column;justify-content:center;align-items:center;padding:20px;text-align:center}
.offer-badge-lg{background:var(--co-accent);color:#fff;padding:6px 16px;border-radius:20px;font-size:13px;font-weight:700;margin-bottom:10px;backdrop-filter:blur(5px)}
.offer-card-lg h3{font-size:22px;color:#fff;margin-bottom:5px}
.offer-card-lg p{font-size:14px;color:#ddd}

/* Slider Controls */
.slider-controls{display:flex;align-items:center;justify-content:center;gap:20px;margin-top:10px}
.slider-btn{width:40px;height:40px;border-radius:50%;background:var(--co-card);border:1px solid var(--co-border);color:var(--co-text);cursor:pointer;transition:0.3s}
.slider-btn:hover{background:var(--co-accent);color:#fff;border-color:var(--co-accent)}

/* =========================================================
GRID LAYOUT (Like menu.php)
======================================================== */
.products-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px}

/* =========================================================
CARD STYLES
======================================================== */
.product-card{background:var(--co-card);border:1px solid var(--co-border);border-radius:20px;overflow:hidden;transition:all .3s}
.product-card:hover{transform:translateY(-5px);border-color:var(--co-border-h)}
.product-image{position:relative;height:200px;overflow:hidden}
.product-image img{width:100%;height:100%;object-fit:cover}
.badge-row{position:absolute;top:10px;left:10px;display:flex;gap:8px}
.badge{padding:4px 10px;border-radius:8px;font-size:11px;font-weight:700}
.badge-purple{background:var(--co-accent);color:#fff}
.badge-green{background:var(--co-green);color:#fff}
.product-content{padding:16px}
.product-content h3{font-size:16px;font-weight:600;margin-bottom:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.product-content p{font-size:12px;color:var(--co-text2);margin-bottom:12px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
.product-bottom{display:flex;align-items:center;justify-content:space-between}
.product-price{font-size:18px;font-weight:800;color:var(--co-accent-l)}
.add-btn{width:36px;height:36px;border-radius:10px;background:var(--co-accent);border:none;color:#fff;font-size:14px;cursor:pointer;transition:0.2s;display:flex;align-items:center;justify-content:center}
.add-btn:hover{background:var(--co-accent-h)}
.qty-controls{display:flex;align-items:center;gap:8px;background:var(--co-input);padding:4px;border-radius:10px}
.qty-btn{width:28px;height:28px;border-radius:8px;border:none;background:#fff;color:#000;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700}
.qty-num{font-size:14px;font-weight:700;min-width:20px;text-align:center}

/* =========================================================
SLIDE CART (Purple Theme)
========================================================= */
.side-cart{position:fixed;top:0;right:-400px;width:380px;height:100vh;background:var(--co-card);z-index:1000;transition:0.4s;border-left:1px solid var(--co-border);display:flex;flex-direction:column}
.side-cart.active{right:0}
.side-cart-top{padding:20px;border-bottom:1px solid var(--co-border);display:flex;justify-content:space-between;align-items:center}
.side-cart-top h2{font-size:20px}
.cart-item-count{background:var(--co-accent);color:#fff;padding:2px 8px;border-radius:10px;font-size:12px}
.close-cart-btn{width:32px;height:32px;border-radius:50%;border:none;background:var(--co-input);color:var(--co-text);cursor:pointer}
.side-cart-items{flex:1;overflow-y:auto;padding:20px}
.cart-item{display:flex;gap:12px;margin-bottom:20px}
.cart-item img{width:60px;height:60px;border-radius:10px;object-fit:cover}
.cart-content h4{font-size:14px;margin-bottom:4px}
.cart-content .price{font-size:13px;color:var(--co-accent-l);margin-bottom:8px}
.cart-qty{display:flex;align-items:center;gap:10px;background:var(--co-bg);padding:4px;border-radius:8px}
.cart-qty-btn{width:24px;height:24px;border:none;background:var(--co-card);color:#fff;border-radius:4px;cursor:pointer}
.cart-bottom{padding:20px;border-top:1px solid var(--co-border)}
.cart-total-row{display:flex;justify-content:space-between;font-size:18px;font-weight:700;margin-bottom:20px}
.checkout-btn{width:100%;padding:16px;text-align:center;border-radius:12px;background:var(--co-accent);color:#fff;font-weight:700;text-decoration:none;display:block;box-shadow:0 4px 20px rgba(108,92,231,.3)}
.checkout-btn:hover{background:var(--co-accent-h)}
#cartOverlay{position:fixed;inset:0;background:rgba(0,0,0,0.6);z-index:999;opacity:0;visibility:hidden;transition:0.3s}
#cartOverlay.active{opacity:1;visibility:visible}

/* Toast */
.toast{position:fixed;bottom:30px;left:50%;transform:translateX(-50%) translateY(100px);background:#333;color:#fff;padding:12px 24px;border-radius:50px;display:flex;align-items:center;gap:10px;box-shadow:0 10px 30px rgba(0,0,0,0.5);z-index:9999;opacity:0;transition:0.4s}
.toast.show{transform:translateX(-50%) translateY(0);opacity:1}

@media(max-width:768px){
    .side-cart{width:100%;right:-100%}
    .menu-page-header{height:250px;border-radius:0 0 24px 24px}
    .menu-page-header-content{padding:20px}
    .products-grid{grid-template-columns:1fr}
}
</style>
</head>
<body>

<?php include "Navbar.php"; ?>

<!-- TOAST -->
<div class="toast" id="toast">
    <div class="toast-icon" style="color:var(--co-accent-l)"><i class="fa-solid fa-check"></i></div>
    <span>Added to cart</span>
</div>

<!-- PAGE HEADER -->
<div class="menu-page-header">
    <div class="menu-page-header-bg">
        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1600&auto=format&fit=crop" alt="Offers">
    </div>
    <div class="menu-page-header-overlay"></div>
    <div class="menu-page-header-content">
        <h1>Exclusive Offers</h1>
        <p>Grab the best deals on your favorite meals today!</p>
    </div>
</div>

<div class="co-container">

    <!-- HERO OFFERS SLIDER -->
    <div class="offers-slider-wrap">
        <div class="offers-track" id="offersTrack">
            <?php foreach ($offers as $offer): ?>
            <div class="offer-slide">
                <div class="offer-card-lg">
                    <img src="<?php echo $offer['bg']; ?>" alt="">
                    <div class="offer-overlay-lg">
                        <div class="offer-badge-lg"><?php echo $offer['code']; ?></div>
                        <h3><?php echo $offer['title']; ?></h3>
                        <p><?php echo $offer['sub']; ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="slider-controls">
            <button class="slider-btn" id="offerPrev"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="slider-btn" id="offerNext"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
    </div>

    <!-- SECTION HEADER -->
    <div style="display:flex;justify-content:space-between;align-items:end;margin-bottom:20px;">
        <div>
            <h2 style="font-size:24px;font-weight:700;">All Offers</h2>
            <p style="font-size:14px;color:var(--co-text2);">Available deals for you</p>
        </div>
        <a href="menu.php" style="color:var(--co-accent);font-weight:600;font-size:14px;">View Menu <i class="fa-solid fa-arrow-right"></i></a>
    </div>

    <!-- OFFERS GRID -->
    <div class="products-grid">
        <?php 
        // Repeating offers for grid view
        foreach ($offers as $offer): ?>
        <div class="product-card">
            <div class="product-image">
                <img src="<?php echo $offer['bg']; ?>" alt="">
                <div class="badge-row">
                    <span class="badge badge-purple">Limited Time</span>
                </div>
            </div>
            <div class="product-content">
                <h3><?php echo $offer['title']; ?></h3>
                <p><?php echo $offer['sub']; ?></p>
                <div class="product-bottom">
                    <button class="add-btn" style="width:100%;height:40px;border-radius:12px;" onclick="window.location.href='menu.php'">
                        Claim Offer
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- TRENDING PRODUCTS (To make Cart JS work) -->
    <div style="display:flex;justify-content:space-between;align-items:end;margin:40px 0 20px;">
        <div>
            <h2 style="font-size:24px;font-weight:700;">Trending Now</h2>
            <p style="font-size:14px;color:var(--co-text2);">Most ordered items</p>
        </div>
    </div>

    <div class="products-grid">
        <?php
        while ($row = mysqli_fetch_assoc($trendingProducts)):
            $inCart = false;
            $qty = 0;
            $cartData = json_decode($_COOKIE['cart'] ?? '[]', true);
            if (!$cartData) $cartData = json_decode($_SESSION['cart'] ?? '[]', true);
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
                <img src="<?php echo !empty($row['image']) ? htmlspecialchars($row['image']) : 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=400'; ?>" alt="">
                <div class="badge-row">
                    <span class="badge badge-purple">Bestseller</span>
                </div>
            </div>
            <div class="product-content">
                <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                <p><?php echo htmlspecialchars(substr($row['description'], 0, 50)) . '...'; ?></p>
                <div class="product-bottom">
                    <div class="product-price">₹<?php echo $row['price']; ?></div>
                    <?php if ($inCart): ?>
                    <div class="qty-controls" data-id="<?php echo $row['id']; ?>" data-name="<?php echo htmlspecialchars($row['name']); ?>" data-price="<?php echo $row['price']; ?>" data-image="<?php echo htmlspecialchars($row['image']); ?>">
                        <button class="qty-btn qty-minus"><i class="fa-solid fa-minus"></i></button>
                        <span class="qty-num"><?php echo $qty; ?></span>
                        <button class="qty-btn qty-plus"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <?php else: ?>
                    <button class="add-btn" data-id="<?php echo $row['id']; ?>" data-name="<?php echo htmlspecialchars($row['name']); ?>" data-price="<?php echo $row['price']; ?>" data-image="<?php echo htmlspecialchars($row['image']); ?>">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

</div>

<!-- SLIDE CART -->
<div class="side-cart" id="slideCart">
    <div class="side-cart-top">
        <div style="display:flex;align-items:center;gap:10px;">
            <h2>My Cart</h2>
            <span class="cart-item-count" id="sideCartCount">0 items</span>
        </div>
        <button class="close-cart-btn" id="closeCartBtn"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="side-cart-items" id="sideCartItems"></div>
    <div class="cart-bottom">
        <div class="cart-total-row">
            <span>Total</span>
            <span id="cartTotal">₹0</span>
        </div>
        <a href="cart.php" class="checkout-btn">Checkout</a>
    </div>
</div>
<div id="cartOverlay"></div>

<?php include "footer.php"; ?>

<script>
/* =========================================================
CART STATE & LOGIC (From menu.php)
========================================================= */
let cart = JSON.parse(localStorage.getItem('cart')) || [];

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function updateCartCount() {
    let total = 0;
    cart.forEach(item => { total += item.quantity; });
    document.querySelectorAll('.cart-count').forEach(el => {
        el.textContent = total;
        el.style.display = total > 0 ? 'flex' : 'none';
    });
    const sideCount = document.getElementById('sideCartCount');
    if(sideCount) sideCount.textContent = total + ' items';
}

function showToast(msg) {
    const toast = document.getElementById('toast');
    if(msg) toast.querySelector('span').textContent = msg;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 2200);
}

function renderCart() {
    const box = document.getElementById('sideCartItems');
    const tot = document.getElementById('cartTotal');
    if(!box) return;
    box.innerHTML = '';
    let total = 0;
    if(cart.length === 0){
        box.innerHTML = '<p style="text-align:center;color:#666;padding:20px;">Cart is empty</p>';
        tot.textContent = '₹0';
        return;
    }
    cart.forEach((item, idx) => {
        total += item.price * item.quantity;
        box.innerHTML += `
            <div class="cart-item">
                <img src="${item.image}">
                <div class="cart-content" style="flex:1;">
                    <h4>${item.name}</h4>
                    <div class="price">₹${item.price}</div>
                    <div class="cart-qty" data-idx="${idx}">
                        <button class="cart-qty-btn" onclick="changeQty(${idx}, -1)"><i class="fa-solid fa-minus"></i></button>
                        <span style="font-size:14px;">${item.quantity}</span>
                        <button class="cart-qty-btn" onclick="changeQty(${idx}, 1)"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
            </div>`;
    });
    tot.textContent = '₹' + total;
}

function changeQty(idx, delta) {
    cart[idx].quantity += delta;
    if(cart[idx].quantity <= 0) cart.splice(idx, 1);
    saveCart();
    renderCart();
    updateCartCount();
    updateProductButtons();
}

function updateProductButtons() {
    document.querySelectorAll('.product-card').forEach(card => {
        const id = card.dataset.productId;
        const bottom = card.querySelector('.product-bottom');
        if(!bottom) return;
        const existing = cart.find(item => item.id == id);
        const currentBtn = bottom.querySelector('.add-btn');
        const currentQty = bottom.querySelector('.qty-controls');
        
        if(existing && currentBtn) {
            currentBtn.outerHTML = `
                <div class="qty-controls" data-id="${id}">
                    <button class="qty-btn qty-minus"><i class="fa-solid fa-minus"></i></button>
                    <span class="qty-num">${existing.quantity}</span>
                    <button class="qty-btn qty-plus"><i class="fa-solid fa-plus"></i></button>
                </div>`;
            attachQtyListeners(bottom.querySelector('.qty-controls'));
        } else if (existing && currentQty) {
            currentQty.querySelector('.qty-num').textContent = existing.quantity;
        } else if (!existing && currentQty) {
             const cardData = currentQty.dataset;
            currentQty.outerHTML = `
                <button class="add-btn" data-id="${id}" data-name="${cardData.name}" data-price="${cardData.price}" data-image="${cardData.image}">
                    <i class="fa-solid fa-plus"></i>
                </button>`;
            attachAddListeners();
        }
    });
}

function attachQtyListeners(container) {
    container.querySelectorAll('.qty-minus').forEach(btn => {
        btn.onclick = function(e) {
            e.stopPropagation();
            const id = this.parentElement.dataset.id;
            const item = cart.find(i => i.id == id);
            if(item) {
                item.quantity--;
                if(item.quantity <= 0) cart = cart.filter(i => i.id != id);
                saveCart();
                renderCart();
                updateCartCount();
                updateProductButtons();
            }
        };
    });
    container.querySelectorAll('.qty-plus').forEach(btn => {
        btn.onclick = function(e) {
            e.stopPropagation();
            const id = this.parentElement.dataset.id;
            const item = cart.find(i => i.id == id);
            if(item) {
                item.quantity++;
                saveCart();
                renderCart();
                updateCartCount();
                updateProductButtons();
            }
        };
    });
}

function attachAddListeners() {
    document.querySelectorAll('.add-btn').forEach(button => {
        button.onclick = function(e) {
            e.stopPropagation();
            const id = this.dataset.id;
            const name = this.dataset.name;
            const price = parseFloat(this.dataset.price);
            const image = this.dataset.image;
            const existing = cart.find(item => item.id == id);
            if(existing) {
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

/* CAROUSEL LOGIC */
(function () {
    const track = document.getElementById('offersTrack');
    const prevBtn = document.getElementById('offerPrev');
    const nextBtn = document.getElementById('offerNext');
    if (!track) return;
    const cards = track.querySelectorAll('.offer-slide');
    let current = 0;
    const total = cards.length;

    function getVisible() {
        if (window.innerWidth < 640) return 1;
        if (window.innerWidth < 1024) return 2;
        return 3;
    }

    function goTo(index) {
        const max = Math.max(0, total - getVisible());
        current = Math.max(0, Math.min(index, max));
        const card = cards[0];
        const gap = 20;
        const width = card.offsetWidth + gap;
        track.style.transform = `translateX(-${current * width}px)`;
    }

    prevBtn.onclick = () => goTo(current - 1);
    nextBtn.onclick = () => goTo(current + 1);
    window.addEventListener('resize', () => goTo(current));
})();

/* INIT */
updateCartCount();
renderCart();
attachAddListeners();
document.querySelectorAll('.qty-controls').forEach(el => attachQtyListeners(el));
</script>

</body>
</html>