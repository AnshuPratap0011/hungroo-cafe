<?php

require_once "db.php";

/* =====================================================
SEARCH
===================================================== */

$search = trim($_GET["search"] ?? "");
$category = trim($_GET["category"] ?? "");

/* =====================================================
CATEGORIES
===================================================== */

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

if (
    $category !== "" &&
    !in_array($category, $allowedCategories, true)
) {
    $category = "";
}

/* =====================================================
QUERY
===================================================== */

$query = "SELECT * FROM menu_items WHERE 1";

$params = [];
$types = "";

/* SEARCH */

if ($search !== "") {

    $query .= " AND name LIKE ?";

    $params[] = "%" . $search . "%";

    $types .= "s";
}

/* CATEGORY */

if ($category !== "") {

    $query .= " AND category = ?";

    $params[] = $category;

    $types .= "s";
}

$query .= " ORDER BY id DESC";

/* =====================================================
EXECUTE
===================================================== */

$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    die("Query Error");
}

if (!empty($params)) {

    mysqli_stmt_bind_param(
        $stmt,
        $types,
        ...$params
    );
}

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$totalItems = mysqli_num_rows($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Hungroo Café | Premium Menu</title>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/menu.css">

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
TOP OFFERS
===================================================== -->

<div class="menu-top-offers">

    <div class="menu-offer-track">

        <div class="menu-offer-card">
            <i class="fa-solid fa-truck-fast"></i>

            <div>
                <h4>Free Delivery</h4>
                <p>Orders Above ₹299</p>
            </div>
        </div>

        <div class="menu-offer-card">
            <i class="fa-solid fa-burger"></i>

            <div>
                <h4>Burger Combo</h4>
                <p>Fries + Drink Included</p>
            </div>
        </div>

        <div class="menu-offer-card">
            <i class="fa-solid fa-pizza-slice"></i>

            <div>
                <h4>Pizza Festival</h4>
                <p>Flat 20% OFF Today</p>
            </div>
        </div>

        <div class="menu-offer-card">
            <i class="fa-solid fa-mug-hot"></i>

            <div>
                <h4>Café Coffee</h4>
                <p>Freshly Brewed Everyday</p>
            </div>
        </div>

    </div>

</div>

<!-- =====================================================
PAGE
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
            Discover handcrafted burgers,
            refreshing drinks, desserts,
            coffees and delicious café meals
            prepared fresh every day.
        </p>

        <!-- BUTTONS -->

        <div class="hero-buttons">

            <a
                href="#menu-items"
                class="hero-btn">

                <i class="fa-solid fa-utensils"></i>
                Order Now

            </a>

            <a
                href="Cart.php"
                class="hero-btn-outline">

                <i class="fa-solid fa-cart-shopping"></i>
                View Cart

            </a>

        </div>

        <!-- STATS -->

        <div class="menu-hero-stats">

            <div class="hero-stat-box">
                <h3><?php echo $totalItems; ?>+</h3>
                <span>Menu Items</span>
            </div>

            <div class="hero-stat-box">
                <h3>4.9★</h3>
                <span>Customer Rating</span>
            </div>

            <div class="hero-stat-box">
                <h3>15 Min</h3>
                <span>Fast Delivery</span>
            </div>

        </div>

    </div>

    <!-- RIGHT -->

    <div class="menu-hero-image">

        <!-- ONLY TOP IMAGE -->

        <img
            src="resturant.png"
            alt="Hungroo Café">

    </div>

</section>

<!-- =====================================================
WRAPPER
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

            <?php if ($category !== "") { ?>

                <input
                    type="hidden"
                    name="category"
                    value="<?php echo htmlspecialchars($category); ?>">

            <?php } ?>

            <label>Search Food</label>

            <div class="menu-search-input">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    name="search"
                    placeholder="Burger, Pizza..."
                    value="<?php echo htmlspecialchars($search); ?>">

            </div>

            <button type="submit">
                Search Menu
            </button>

        </form>

        <!-- CATEGORY -->

        <div class="menu-categories">

            <div class="sidebar-title">

                <span>Categories</span>

                <h2>Browse</h2>

            </div>

            <!-- LIST -->

            <div class="category-scroll">

                <a
                    href="menu.php"
                    class="<?php echo $category === "" ? "active" : ""; ?>">

                    <i class="fa-solid fa-border-all"></i>

                    All Items

                </a>

                <?php foreach ($allowedCategories as $cat) { ?>

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
                        : "Popular Menu";
                    ?>

                </h2>

            </div>

            <div class="menu-result">

                <i class="fa-solid fa-utensils"></i>

                <p>
                    <?php echo $totalItems; ?> Items Available
                </p>

            </div>

        </div>

        <!-- GRID -->

        <div class="menu-grid">

            <?php if ($totalItems === 0) { ?>

                <div class="empty-menu">

                    <h2>No Food Found</h2>

                    <p>
                        Try another category or search keyword.
                    </p>

                </div>

            <?php } ?>

            <!-- LOOP -->

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <article class="food-card">

                    <!-- CONTENT -->

                    <div class="food-content">

                        <!-- TOP -->

                        <div class="food-top">

                            <div>

                                <h3>
                                    <?php echo htmlspecialchars($row["name"]); ?>
                                </h3>

                                <span class="food-category">

                                    <i class="fa-solid <?php echo $categoryIcons[$row["category"]] ?? "fa-utensils"; ?>"></i>

                                    <?php echo htmlspecialchars($row["category"]); ?>

                                </span>

                            </div>

                            <!-- PRICE -->

                            <div class="food-price">

                                <span class="new-price">
                                    ₹<?php echo htmlspecialchars($row["price"]); ?>
                                </span>

                            </div>

                        </div>

                        <!-- DESCRIPTION -->

                        <p class="food-desc">

                            <?php echo htmlspecialchars($row["description"]); ?>

                        </p>

                        <!-- META -->

                        <div class="food-meta">

                            <span>⭐ 4.8</span>

                            <span>⏱ 15 Min</span>

                        </div>

                        <!-- CART -->

                        <div class="cart-action">

                            <!-- ADD BUTTON -->

                            <button
                                class="food-btn add-cart"

                                data-name="<?php echo htmlspecialchars($row["name"]); ?>"

                                data-price="<?php echo htmlspecialchars($row["price"]); ?>">

                                <i class="fa-solid fa-cart-shopping"></i>

                                Add To Cart

                            </button>

                            <!-- QTY -->

                            <div class="qty-wrap hidden">

                                <button class="qty-btn minus">
                                    -
                                </button>

                                <span class="qty-number">
                                    1
                                </span>

                                <button class="qty-btn plus">
                                    +
                                </button>

                            </div>

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
CART JS
===================================================== -->

<script src="cart.js"></script>

<!-- =====================================================
TOP BUTTON JS
===================================================== -->

<script>

const topBtn = document.getElementById("topBtn");

window.addEventListener("scroll", () => {

    if (window.scrollY > 300) {

        topBtn.classList.add("show");

    } else {

        topBtn.classList.remove("show");

    }

});

topBtn.onclick = () => {

    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });

};

</script>

</body>
</html>