<?php

require_once "db.php";

/* =====================================================
SEARCH & CATEGORY
===================================================== */

$search =
trim($_GET["search"] ?? "");

$category =
trim($_GET["category"] ?? "");

$allowedCategories = [

    "Veg",
    "Non Veg",
    "Boba",
    "Coffee",
    "Dessert",
    "Cold Drinks"

];

$categoryIcons = [

    "Veg" => "fa-leaf",
    "Non Veg" => "fa-drumstick-bite",
    "Boba" => "fa-glass-water",
    "Coffee" => "fa-mug-hot",
    "Dessert" => "fa-ice-cream",
    "Cold Drinks" => "fa-wine-glass"

];

/* =====================================================
VALIDATE CATEGORY
===================================================== */

if(
    $category !== "" &&
    !in_array($category,$allowedCategories,true)
){

    $category = "";

}

/* =====================================================
QUERY
===================================================== */

$query =
"SELECT * FROM menu_items WHERE 1";

$params = [];
$types = "";

/* SEARCH */

if($search !== ""){

    $query .=
    " AND name LIKE ?";

    $params[] =
    "%" . $search . "%";

    $types .= "s";

}

/* CATEGORY */

if($category !== ""){

    $query .=
    " AND category = ?";

    $params[] =
    $category;

    $types .= "s";

}

$query .=
" ORDER BY id DESC";

/* =====================================================
PREPARE
===================================================== */

$stmt =
mysqli_prepare($conn,$query);

if(!empty($params)){

    mysqli_stmt_bind_param(
        $stmt,
        $types,
        ...$params
    );

}

mysqli_stmt_execute($stmt);

$result =
mysqli_stmt_get_result($stmt);

$totalItems =
mysqli_num_rows($result);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Hungroo Cafe | Menu

</title>

<!-- CSS -->

<link
rel="stylesheet"
href="Style.css?v=100">

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

</head>

<body>

<!-- =====================================================
NAVBAR
===================================================== -->

<?php include "Navbar.php"; ?>

<!-- =====================================================
TOP OFFER
===================================================== -->

<div class="top-offer-strip">

    🍔 Free Delivery On Orders Above ₹299

</div>

<!-- =====================================================
MAIN
===================================================== -->

<main class="menu-page">

<!-- =====================================================
HERO
===================================================== -->

<section class="menu-hero">

    <div class="hero-glow"></div>

    <!-- LEFT -->

    <div class="menu-hero-content">

        <span class="menu-badge">

            🔥 Hungroo Café Specials

        </span>

        <h1>

            Fresh Food <br>
            Crafted Daily

        </h1>

        <p>

            Explore handcrafted burgers,
            refreshing drinks, desserts,
            coffees and delicious café meals
            prepared fresh every single day.

        </p>

        <!-- BUTTONS -->

        <div class="hero-buttons">

            <a
                href="#menu-items"
                class="hero-btn">

                Order Now

            </a>

            <a
                href="home.php"
                class="hero-btn-outline">

                Explore More

            </a>

        </div>

        <!-- STATS -->

        <div class="menu-hero-stats">

            <div class="hero-stat-box">

                <h3>

                    <?php echo $totalItems; ?>+

                </h3>

                <span>

                    Menu Items

                </span>

            </div>

            <div class="hero-stat-box">

                <h3>

                    4.9★

                </h3>

                <span>

                    Customer Rating

                </span>

            </div>

            <div class="hero-stat-box">

                <h3>

                    15 Min

                </h3>

                <span>

                    Fast Delivery

                </span>

            </div>

        </div>

    </div>

    <!-- RIGHT -->

    <div class="menu-hero-image">

        <img
            src="resturant.png"
            alt="Hungroo Cafe">

        <!-- FLOATING CARD -->

        <div class="floating-card">

            <i class="fa-solid fa-burger"></i>

            <div>

                <h4>

                    Hot & Fresh

                </h4>

                <p>

                    Burgers & Café Meals

                </p>

            </div>

        </div>

    </div>

</section>

<!-- =====================================================
MENU WRAPPER
===================================================== -->

<section class="menu-wrapper">

    <!-- =====================================================
    SIDEBAR
    ===================================================== -->

    <aside class="menu-sidebar">

        <!-- SEARCH -->

        <form
            method="GET"
            action="menu.php"
            class="menu-search-box">

            <?php if($category !== ""){ ?>

                <input
                    type="hidden"
                    name="category"
                    value="<?php echo htmlspecialchars($category); ?>">

            <?php } ?>

            <label>

                Search Menu

            </label>

            <div class="menu-search-input">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    name="search"

                    placeholder="Burger, Coffee..."

                    value="<?php echo htmlspecialchars($search); ?>">

            </div>

            <button type="submit">

                Search

            </button>

        </form>

        <!-- CATEGORY -->

        <div class="menu-categories">

            <div class="sidebar-title">

                <span>

                    Categories

                </span>

                <h2>

                    Browse Food

                </h2>

            </div>

            <!-- CATEGORY LIST -->

            <div class="category-scroll">

                <!-- ALL -->

                <a
                    href="menu.php"

                    class="<?php echo $category === "" ? "active" : ""; ?>">

                    <i class="fa-solid fa-border-all"></i>

                    All Items

                </a>

                <!-- LOOP -->

                <?php foreach($allowedCategories as $cat){ ?>

                    <a
                        href="menu.php?category=<?php echo urlencode($cat); ?>"

                        class="<?php echo $category === $cat ? "active" : ""; ?>">

                        <i class="fa-solid <?php echo $categoryIcons[$cat]; ?>"></i>

                        <?php echo htmlspecialchars($cat); ?>

                    </a>

                <?php } ?>

            </div>

        </div>

    </aside>

    <!-- =====================================================
    CONTENT
    ===================================================== -->

    <section
        class="menu-content-area"
        id="menu-items">

        <!-- TOPBAR -->

        <div class="menu-topbar">

            <div>

                <span class="menu-small-title">

                    Fresh Picks

                </span>

                <h2>

                    <?php

                    echo $category !== ""
                    ? htmlspecialchars($category)
                    : "All Menu Items";

                    ?>

                </h2>

            </div>

            <div class="menu-result">

                <i class="fa-solid fa-utensils"></i>

                <p>

                    <?php echo $totalItems; ?>

                    Items Available

                </p>

            </div>

        </div>

        <!-- GRID -->

        <div class="menu-grid">

            <!-- EMPTY -->

            <?php if($totalItems === 0){ ?>

                <div class="empty-menu">

                    <img
                        src="assets/images/empty-cart.png"
                        alt="No Food">

                    <h2>

                        No Delicious Food Found

                    </h2>

                    <p>

                        Try another category or search keyword.

                    </p>

                </div>

            <?php } ?>

            <!-- LOOP -->

            <?php while($row = mysqli_fetch_assoc($result)){ ?>

                <article class="food-card">

                    <!-- GLOW -->

                    <div class="card-glow"></div>

                    <!-- IMAGE -->

                    <div class="food-image">

                        <!-- OFFER -->

                        <div class="offer-badge">

                            20% OFF

                        </div>

                        <!-- BG -->

                        <div class="food-bg-shape"></div>

                        <!-- IMAGE INNER -->

                        <div class="food-image-inner">

                            <img

                                src="images/<?php echo htmlspecialchars($row["image"]); ?>"

                                alt="<?php echo htmlspecialchars($row["name"]); ?>"

                                onerror="this.src='https://images.unsplash.com/photo-1546069901-ba9599a7e63c?q=80&w=900&auto=format&fit=crop'">

                        </div>

                        <!-- CATEGORY -->

                        <span class="food-tag">

                            <i class="fa-solid <?php echo $categoryIcons[$row["category"]] ?? "fa-utensils"; ?>"></i>

                            <?php echo htmlspecialchars($row["category"]); ?>

                        </span>

                        <!-- OVERLAY -->

                        <div class="food-overlay">

                            <button>

                                Quick View

                            </button>

                        </div>

                    </div>

                    <!-- CONTENT -->

                    <div class="food-content">

                        <!-- TOP -->

                        <div class="food-top">

                            <h3>

                                <?php echo htmlspecialchars($row["name"]); ?>

                            </h3>

                            <!-- PRICE -->

                            <div class="food-price">

                                <span class="new-price">

                                    ₹<?php echo htmlspecialchars($row["price"]); ?>

                                </span>

                                <del>

                                    ₹<?php echo htmlspecialchars($row["price"] + 80); ?>

                                </del>

                            </div>

                        </div>

                        <!-- DESC -->

                        <p>

                            <?php echo htmlspecialchars($row["description"]); ?>

                        </p>

                        <!-- META -->

                        <div class="food-meta">

                            <span>

                                <i class="fa-solid fa-star"></i>

                                4.8 Rating

                            </span>

                            <span>

                                <i class="fa-solid fa-clock"></i>

                                15 Min

                            </span>

                        </div>

                        <!-- DELIVERY -->

                        <div class="delivery-pill">

                            <i class="fa-solid fa-bolt"></i>

                            Free Delivery

                        </div>

                        <!-- CART -->

                        <div
                            class="menu-cart-box"

                            data-name="<?php echo htmlspecialchars($row["name"]); ?>"

                            data-price="<?php echo htmlspecialchars($row["price"]); ?>"

                            data-image="images/<?php echo htmlspecialchars($row["image"]); ?>">

                        </div>

                    </div>

                </article>

            <?php } ?>

        </div>

    </section>

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
CART
===================================================== */

let cart =
JSON.parse(
localStorage.getItem("hungroo-cart")
) || [];

/* SAVE */

function saveCart(){

    localStorage.setItem(
        "hungroo-cart",
        JSON.stringify(cart)
    );

}

/* COUNT */

function updateCartCount(){

    const countEl =
    document.getElementById("cart-count");

    if(!countEl) return;

    let total = 0;

    cart.forEach(item => {

        total += item.qty;

    });

    countEl.textContent = total;

}

/* =====================================================
BUTTONS
===================================================== */

function renderCartButtons(){

    document
    .querySelectorAll(".menu-cart-box")
    .forEach(box => {

        const name =
        box.dataset.name;

        const existing =
        cart.find(
        item => item.name === name
        );

        /* EXISTS */

        if(existing){

            box.innerHTML = `

            <div class="qty-wrapper">

                <button
                    class="qty-btn minus">

                    -

                </button>

                <span>

                    ${existing.qty}

                </span>

                <button
                    class="qty-btn plus">

                    +

                </button>

            </div>

            `;

            /* PLUS */

            box
            .querySelector(".plus")
            .onclick = () => {

                existing.qty++;

                saveCart();

                renderCartButtons();

                updateCartCount();

            };

            /* MINUS */

            box
            .querySelector(".minus")
            .onclick = () => {

                existing.qty--;

                if(existing.qty <= 0){

                    cart =
                    cart.filter(
                    item => item.name !== name
                    );

                }

                saveCart();

                renderCartButtons();

                updateCartCount();

            };

        } else {

            box.innerHTML = `

            <button class="food-btn">

                <i class="fa-solid fa-plus"></i>

                Add

            </button>

            `;

            box
            .querySelector(".food-btn")
            .onclick = () => {

                cart.push({

                    name:
                    box.dataset.name,

                    price:
                    parseInt(
                    box.dataset.price
                    ),

                    image:
                    box.dataset.image,

                    qty:1

                });

                saveCart();

                renderCartButtons();

                updateCartCount();

            };

        }

    });

}

/* =====================================================
TOP BUTTON
===================================================== */

const topButton =
document.getElementById("topBtn");

window.addEventListener(
"scroll",
()=>{

    topButton.classList.toggle(
    "show",

    document.documentElement.scrollTop > 300
    );

});

topButton.addEventListener(
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

renderCartButtons();

updateCartCount();

</script>

</body>
</html>