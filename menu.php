<?php

/* =========================================================
   menu.php — Hungroo Café
   Blinkit-style menu page. Prepared statements. No reload.
   Theme: data-theme on <html> (matches Navbar.php toggle).
========================================================= */

include "config/config.php";

if (session_status() === PHP_SESSION_NONE) {

    session_start();

}

/* ── INPUTS ─────────────────────────────────────────── */

 $search   = isset($_GET['search'])   ? trim($_GET['search'])   : '';

 $category = isset($_GET['category']) ? trim($_GET['category']) : '';

/* ── PRODUCTS — prepared statement ─────────────────── */

 $params = [];

 $types  = '';

 $where  = [];

if ($search !== '') {

    $like    = '%' . $search . '%';

    $where[] = '(name LIKE ? OR category LIKE ? OR description LIKE ?)';

    $types  .= 'sss';

    array_push($params, $like, $like, $like);

}

if ($category !== '') {

    $where[] = 'category = ?';

    $types  .= 's';

    $params[] = $category;

}

 $whereSQL = $where ? 'WHERE ' . implode(' AND ', $where) : '';

 $sql      = "SELECT * FROM products $whereSQL ORDER BY id DESC";

 $stmt = $conn->prepare($sql);

if ($types) $stmt->bind_param($types, ...$params);

 $stmt->execute();

 $products      = $stmt->get_result();

 $totalProducts = $products->num_rows;

/* ── CATEGORIES ─────────────────────────────────────── */

 $catResult = $conn->query(

    "SELECT DISTINCT category FROM products
     WHERE category IS NOT NULL AND category != ''
     ORDER BY category ASC"

);

/* ── CATEGORY IMAGES ─────────────────────────────────── */

 $catImages = [

    'default'  => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=300&auto=format&fit=crop',

    'coffee'   => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=300&auto=format&fit=crop',

    'burger'   => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=300&auto=format&fit=crop',

    'pizza'    => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?q=80&w=300&auto=format&fit=crop',

    'drink'    => 'https://images.unsplash.com/photo-1544145945-f90425340c7e?q=80&w=300&auto=format&fit=crop',

    'cold'     => 'https://images.unsplash.com/photo-1499636136210-6f4ee915583e?q=80&w=300&auto=format&fit=crop',

    'dessert'  => 'https://images.unsplash.com/photo-1551024601-bec78aea704b?q=80&w=300&auto=format&fit=crop',

    'snack'    => 'https://images.unsplash.com/photo-1621939514649-280e2ee25f60?q=80&w=300&auto=format&fit=crop',

    'salad'    => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=300&auto=format&fit=crop',

    'pasta'    => 'https://images.unsplash.com/photo-1563379926898-05f4575a45d8?q=80&w=300&auto=format&fit=crop',

    'sandwich' => 'https://images.unsplash.com/photo-1481070414801-51fd732d7184?q=80&w=300&auto=format&fit=crop',

    'wrap'     => 'https://images.unsplash.com/photo-1626700051175-6818013e1d4f?q=80&w=300&auto=format&fit=crop',

    'breakfast'=> 'https://images.unsplash.com/photo-1533089860892-a7c6f0a88666?q=80&w=300&auto=format&fit=crop',

];

function getCatImage(string $cat, array $map): string {

    $key = strtolower(trim($cat));

    foreach ($map as $k => $v) {

        if ($k !== 'default' && str_contains($key, $k)) return $v;

    }

    return $map['default'];

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="assets/css/navbar.css">
<title>Menu — Hungroo Café</title>

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
CSS — navbar.css is inside Navbar.php
========================================================= -->

<link rel="stylesheet" href="assets/css/menu.css">

</head>

<body>

<!-- =========================================================
NAVBAR
========================================================= -->

<?php include "Navbar.php"; ?>

<!-- =========================================================
PAGE HEADER
========================================================= -->

<div class="menu-page-header">

    <div class="menu-page-header-bg">

        <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?q=80&w=2000&auto=format&fit=crop" alt="">

        <div class="menu-page-header-overlay"></div>

    </div>

    <div class="menu-page-header-content">

        <div class="menu-breadcrumb">

            <a href="home.php">Home</a>

            <i class="fa-solid fa-chevron-right"></i>

            <span>Menu</span>

            <?php if ($category): ?>

                <i class="fa-solid fa-chevron-right"></i>

                <span><?php echo htmlspecialchars($category); ?></span>

            <?php endif; ?>

        </div>

        <h1>

            <?php

                if ($category) echo htmlspecialchars($category);

                elseif ($search) echo 'Search Results';

                else echo 'Explore Our Menu';

            ?>

        </h1>

        <p>

            <?php

                if ($search) echo 'Showing results for "' . htmlspecialchars($search) . '"';

                elseif ($category) echo 'Browse our best ' . strtolower(htmlspecialchars($category));

                else echo 'Premium burgers, pizza, coffee, desserts and more';

            ?>

        </p>

    </div>

</div>

<!-- =========================================================
SEARCH BAR (STICKY)
========================================================= -->

<div class="menu-search-sticky">

    <div class="menu-search-inner">

        <form method="GET" class="menu-search-form" autocomplete="off">

            <div class="menu-search-box">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input

                    type="text"

                    name="search"

                    placeholder="Search for burgers, pizza, coffee..."

                    value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>"

                    id="menuSearchInput"

                >

                <?php if ($category): ?>

                    <input type="hidden" name="category" value="<?php echo htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?>">

                <?php endif; ?>

                <?php if ($search): ?>

                    <button type="button" class="search-clear-btn" onclick="clearSearch()" title="Clear">

                        <i class="fa-solid fa-xmark"></i>

                    </button>

                <?php endif; ?>

            </div>

            <button type="submit" class="search-submit-btn">

                <i class="fa-solid fa-magnifying-glass"></i>

                <span>Search</span>

            </button>

        </form>

    </div>

</div>

<!-- =========================================================
MAIN LAYOUT
========================================================= -->

<div class="menu-layout">

    <!-- =====================================================
    CATEGORY SIDEBAR
    ====================================================== -->

    <aside class="category-sidebar" id="categorySidebar">

        <div class="sidebar-label">

            <i class="fa-solid fa-grid-2"></i>

            Categories

        </div>

        <a

            href="menu.php<?php echo $search ? '?search='.urlencode($search) : ''; ?>"

            class="cat-item <?php echo empty($category) ? 'active' : ''; ?>"

        >

            <div class="cat-img">

                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=300&auto=format&fit=crop" alt="All" loading="lazy">

            </div>

            <div class="cat-info">

                <span class="cat-name">All Items</span>

                <span class="cat-count"><?php echo $totalProducts; ?></span>

            </div>

        </a>

        <?php

        /* Re-run count per category for badges */

        $catCounts = [];

        if ($catResult && $catResult->num_rows > 0) {

            $catResult->data_seek(0);

            while ($cat = $catResult->fetch_assoc()) {

                $cName = $cat['category'];

                $countStmt = $conn->prepare("SELECT COUNT(*) AS cnt FROM products WHERE category = ?");

                $countStmt->bind_param('s', $cName);

                $countStmt->execute();

                $countRes = $countStmt->get_result()->fetch_assoc();

                $catCounts[$cName] = (int)$countRes['cnt'];

            }

            $catResult->data_seek(0);

            while ($cat = $catResult->fetch_assoc()):

                $cName  = $cat['category'];

                $cSafe  = htmlspecialchars($cName, ENT_QUOTES, 'UTF-8');

                $cImg   = getCatImage($cName, $catImages);

                $active = ($category === $cName) ? 'active' : '';

                $href   = 'menu.php?category=' . urlencode($cName) . ($search ? '&search='.urlencode($search) : '');

                $count  = $catCounts[$cName] ?? 0;

        ?>

        <a href="<?php echo $href; ?>" class="cat-item <?php echo $active; ?>">

            <div class="cat-img">

                <img src="<?php echo $cImg; ?>" alt="<?php echo $cSafe; ?>" loading="lazy">

            </div>

            <div class="cat-info">

                <span class="cat-name"><?php echo $cSafe; ?></span>

                <span class="cat-count"><?php echo $count; ?></span>

            </div>

        </a>

        <?php endwhile; } ?>

    </aside>

    <!-- =====================================================
    PRODUCTS AREA
    ====================================================== -->

    <main class="products-area">

        <!-- SECTION HEADER -->

        <div class="products-header">

            <div class="products-header-left">

                <h2>

                    <?php

                        if ($category) echo htmlspecialchars($category);

                        elseif ($search) echo 'Results';

                        else echo 'All Items';

                    ?>

                </h2>

                <span class="products-count">

                    <?php echo $totalProducts; ?> item<?php echo $totalProducts !== 1 ? 's' : ''; ?>

                </span>

            </div>

            <div class="products-header-right">

                <?php if ($search || $category): ?>

                    <a href="menu.php" class="clear-filter-btn">

                        <i class="fa-solid fa-xmark"></i>

                        Clear Filters

                    </a>

                <?php endif; ?>

            </div>

        </div>

        <!-- GRID -->

        <div class="products-grid">

            <?php if ($totalProducts > 0): ?>

                <?php while ($p = $products->fetch_assoc()): ?>

                    <?php

                        $pid    = (int)$p['id'];

                        $pname  = htmlspecialchars($p['name'], ENT_QUOTES, 'UTF-8');

                        $pdesc  = htmlspecialchars($p['description'] ?? '', ENT_QUOTES, 'UTF-8');

                        $pprice = (float)$p['price'];

                        $pimg   = !empty($p['image'])

                                  ? htmlspecialchars($p['image'], ENT_QUOTES, 'UTF-8')

                                  : 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=600&auto=format&fit=crop';

                    ?>

                    <div class="product-card" data-pid="<?php echo $pid; ?>">

                        <div class="product-image">

                            <img

                                src="<?php echo $pimg; ?>"

                                alt="<?php echo $pname; ?>"

                                loading="lazy"

                                onerror="this.src='https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=600&auto=format&fit=crop'"

                            >

                            <div class="badge-row">

                                <span class="badge badge-rating">

                                    <i class="fa-solid fa-star"></i> 4.8

                                </span>

                            </div>

                            <div class="time-tag">

                                <i class="fa-solid fa-bolt"></i> 10 min

                            </div>

                        </div>

                        <div class="product-content">

                            <h3><?php echo $pname; ?></h3>

                            <p><?php echo $pdesc ?: 'Freshly prepared just for you.'; ?></p>

                            <div class="product-bottom">

                                <div class="product-price">

                                    <span class="original-price">₹<?php echo number_format($pprice + 60, 0); ?></span>

                                    <span class="current-price">₹<?php echo number_format($pprice, 0); ?></span>

                                </div>

                                <div

                                    class="card-action"

                                    data-id="<?php echo $pid; ?>"

                                    data-name="<?php echo $pname; ?>"

                                    data-price="<?php echo $pprice; ?>"

                                    data-image="<?php echo $pimg; ?>"

                                ></div>

                            </div>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="empty-state">

                    <div class="empty-icon">

                        <i class="fa-solid fa-bowl-food"></i>

                    </div>

                    <h3>Nothing found</h3>

                    <p>We couldn't find anything matching your search or filter.</p>

                    <a href="menu.php" class="empty-btn">

                        <i class="fa-solid fa-arrow-left"></i>

                        Browse Full Menu

                    </a>

                </div>

            <?php endif; ?>

        </div>

    </main>

</div>

<!-- =========================================================
MOBILE CATEGORY BAR (bottom fixed)
========================================================= -->

<div class="mobile-cat-bar" id="mobileCatBar">

    <button class="mobile-cat-toggle" id="mobileCatToggle">

        <i class="fa-solid fa-grid-2"></i>

        <span>Categories</span>

        <i class="fa-solid fa-chevron-up mobile-cat-arrow"></i>

    </button>

    <div class="mobile-cat-drawer" id="mobileCatDrawer">

        <a

            href="menu.php<?php echo $search ? '?search='.urlencode($search) : ''; ?>"

            class="mcat-chip <?php echo empty($category) ? 'active' : ''; ?>"

        >

            All

        </a>

        <?php

        if ($catResult && $catResult->num_rows > 0) {

            $catResult->data_seek(0);

            while ($cat = $catResult->fetch_assoc()):

                $cName  = $cat['category'];

                $cSafe  = htmlspecialchars($cName, ENT_QUOTES, 'UTF-8');

                $active = ($category === $cName) ? 'active' : '';

                $href   = 'menu.php?category=' . urlencode($cName) . ($search ? '&search='.urlencode($search) : '');

        ?>

        <a href="<?php echo $href; ?>" class="mcat-chip <?php echo $active; ?>">

            <?php echo $cSafe; ?>

        </a>

        <?php endwhile; } ?>

    </div>

</div>

<!-- =========================================================
SLIDE CART
========================================================= -->

<div class="side-cart" id="slideCart">

    <div class="side-cart-top">

        <div>

            <h2>My Cart</h2>

            <span class="cart-item-count" id="sideCartCount">0 items</span>

        </div>

        <button class="close-cart-btn" id="closeCartBtn" aria-label="Close cart">

            <i class="fa-solid fa-xmark"></i>

        </button>

    </div>

    <div class="side-cart-items" id="sideCartItems"></div>

    <div class="cart-bottom" id="cartBottom">

        <div class="delivery-strip">

            <i class="fa-solid fa-bolt"></i>

            Free delivery on orders above ₹299

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
TOAST
========================================================= -->

<div class="toast" id="toast">

    <div class="toast-icon"><i class="fa-solid fa-check"></i></div>

    <span></span>

</div>

<!-- =========================================================
FOOTER
========================================================= -->

<?php include "footer.php"; ?>

<!-- =========================================================
SCRIPTS
========================================================= -->

<script>

/* =========================================================
HELPERS
========================================================= */

function esc(s) {

    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;')

        .replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#039;');

}

function escA(s) {

    return String(s).replace(/\\/g,'\\\\').replace(/'/g,"\\'").replace(/"/g,'\\"');

}

/* =========================================================
CLEAR SEARCH
========================================================= */

function clearSearch() {

    const base = '<?php echo $category ? "menu.php?category=" . urlencode($category) : "menu.php"; ?>';

    window.location.href = base;

}

/* =========================================================
CART STATE
========================================================= */

let cart = [];

try { cart = JSON.parse(localStorage.getItem('cart')) || []; }

catch(e) { cart = []; }

function saveCart() { localStorage.setItem('cart', JSON.stringify(cart)); }

function cartItemCount() { return cart.reduce((n, i) => n + i.quantity, 0); }

function cartTotalAmt()  { return cart.reduce((n, i) => n + i.price * i.quantity, 0); }

function findItem(id)    { return cart.find(i => i.id == id); }

/* =========================================================
TOAST
========================================================= */

let _tt;

function showToast(msg) {

    const t = document.getElementById('toast');

    t.querySelector('span').textContent = msg;

    t.classList.add('show');

    clearTimeout(_tt);

    _tt = setTimeout(() => t.classList.remove('show'), 2200);

}

/* =========================================================
RENDER CART PANEL
======================================================== */

function renderCart() {

    const box = document.getElementById('sideCartItems');

    const tot = document.getElementById('cartTotal');

    const bot = document.getElementById('cartBottom');

    const cnt = document.getElementById('sideCartCount');

    if (!box) return;

    const total = cartItemCount();

    if (cnt) cnt.textContent = total + (total === 1 ? ' item' : ' items');

    if (cart.length === 0) {

        box.innerHTML = `

            <div class="cart-empty">

                <i class="fa-solid fa-cart-shopping"></i>

                <p>Your cart is empty</p>

                <span>Add something tasty!</span>

            </div>`;

        if (tot) tot.textContent = '₹0';

        if (bot) bot.style.display = 'none';

        return;

    }

    if (bot) bot.style.display = '';

    box.innerHTML = cart.map((item, idx) => `

        <div class="cart-item">

            <img src="${esc(item.image)}" alt="${esc(item.name)}"

                 onerror="this.src='https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=200&auto=format&fit=crop'">

            <div class="cart-content">

                <h4>${esc(item.name)}</h4>

                <p class="cart-price">₹${(item.price * item.quantity).toFixed(0)}</p>

                <div class="cart-qty">

                    <button class="cart-qty-btn" onclick="cartDec(${idx})"><i class="fa-solid fa-minus"></i></button>

                    <span>${item.quantity}</span>

                    <button class="cart-qty-btn" onclick="cartInc(${idx})"><i class="fa-solid fa-plus"></i></button>

                </div>

            </div>

        </div>

    `).join('');

    if (tot) tot.textContent = '₹' + cartTotalAmt().toFixed(0);

}

/* =========================================================
RENDER CARD BUTTONS
======================================================== */

function renderCardButtons() {

    document.querySelectorAll('.card-action').forEach(wrap => {

        const { id, name, price, image } = wrap.dataset;

        const item = findItem(id);

        if (item) {

            wrap.innerHTML = `

                <div class="qty-controls">

                    <button class="qty-btn qty-minus" onclick="cardDec('${id}')"><i class="fa-solid fa-minus"></i></button>

                    <span class="qty-num">${item.quantity}</span>

                    <button class="qty-btn qty-plus" onclick="cardInc('${id}','${escA(name)}',${parseFloat(price)},'${escA(image)}')"><i class="fa-solid fa-plus"></i></button>

                </div>`;

        } else {

            wrap.innerHTML = `

                <button class="add-btn"

                    onclick="cartAdd('${id}','${escA(name)}',${parseFloat(price)},'${escA(image)}')">

                    ADD

                </button>`;

        }

    });

}

/* =========================================================
SYNC ALL UI
======================================================== */

function syncUI() {

    renderCart();

    renderCardButtons();

    const n = cartItemCount();

    document.querySelectorAll('.cart-count').forEach(el => {

        el.textContent = n;

        el.style.display = n > 0 ? 'flex' : 'none';

    });

}

/* =========================================================
CART ACTIONS
========================================================= */

function cartAdd(id, name, price, image) {

    const ex = findItem(id);

    if (ex) { ex.quantity++; }

    else { cart.push({ id, name, price: parseFloat(price), image, quantity: 1 }); }

    saveCart();

    syncUI();

    showToast(name + ' added to cart');

}

function cartInc(idx) { cart[idx].quantity++; saveCart(); syncUI(); }

function cartDec(idx) {

    if (cart[idx].quantity > 1) cart[idx].quantity--;

    else cart.splice(idx, 1);

    saveCart();

    syncUI();

}

function cardInc(id, name, price, image) { cartAdd(id, name, price, image); }

function cardDec(id) {

    const idx = cart.findIndex(i => i.id == id);

    if (idx === -1) return;

    if (cart[idx].quantity > 1) cart[idx].quantity--;

    else cart.splice(idx, 1);

    saveCart();

    syncUI();

}

/* =========================================================
SLIDE CART
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

document.getElementById('closeCartBtn').addEventListener('click', closeSlideCart);

document.getElementById('cartOverlay').addEventListener('click', closeSlideCart);

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeSlideCart(); });

/* Hook navbar cart buttons */

document.getElementById('desktopOpenCart')?.addEventListener('click', openSlideCart);

document.getElementById('mobileOpenCart')?.addEventListener('click', openSlideCart);

/* =========================================================
MOBILE CATEGORY DRAWER
========================================================= */

const mobileCatToggle = document.getElementById('mobileCatToggle');

const mobileCatDrawer = document.getElementById('mobileCatDrawer');

const mobileCatArrow  = document.querySelector('.mobile-cat-arrow');

if (mobileCatToggle) {

    mobileCatToggle.addEventListener('click', () => {

        const isOpen = mobileCatDrawer.classList.toggle('open');

        mobileCatArrow.style.transform = isOpen ? 'rotate(180deg)' : '';

    });

}

/* =========================================================
SEARCH AUTOFOCUS ON MOBILE
========================================================= */

if (window.innerWidth < 768 && !document.getElementById('menuSearchInput').value) {

    /* Don't auto-open keyboard, just ready */

}

/* =========================================================
INIT
======================================================== */

syncUI();

</script>

</body>

</html>