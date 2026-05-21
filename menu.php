<?php

session_start();

/* =========================================================
CONFIG
========================================================= */

include "config/config.php";

$pageTitle =
"Hungroo Café | Menu";

/* =========================================================
GET CATEGORIES
========================================================= */

$categoryQuery =

"SELECT * FROM categories
ORDER BY name ASC";

$categoryResult =

mysqli_query(
$conn,
$categoryQuery
);

/* =========================================================
GET PRODUCTS
========================================================= */

$productQuery =

"SELECT * FROM products
WHERE status='active'
ORDER BY id DESC";

$productResult =

mysqli_query(
$conn,
$productQuery
);

/* =========================================================
PRODUCT ARRAY FOR JS
========================================================= */

$productArray = [];

while($row = mysqli_fetch_assoc($productResult)){

    $productArray[] = $row;

}

/* =========================================================
RESET POINTER
========================================================= */

mysqli_data_seek(
$productResult,
0
);

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
href="assets/css/menu.css">

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =========================================================
BLUR
========================================================= -->

<div class="menu-blur blur-1"></div>
<div class="menu-blur blur-2"></div>

<!-- =========================================================
HERO
========================================================= -->

<section class="menu-hero">

    <div class="menu-hero-content">

        <span>

            Premium Café Menu

        </span>

        <h1>

            Discover Delicious

            <span>

                Flavours

            </span>

        </h1>

        <p>

            Explore handcrafted burgers,
            pizzas, drinks, desserts and
            premium café vibes.

        </p>

    </div>

</section>

<!-- =========================================================
MENU
========================================================= -->

<section class="menu-section">

    <!-- =====================================================
    TOP
    ====================================================== -->

    <div class="menu-top">

        <!-- SEARCH -->

        <div class="menu-search">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
            type="text"

            id="menuSearch"

            placeholder="Search delicious food...">

        </div>

        <!-- FILTER -->

        <div class="menu-filters">

            <button
            class="filter-btn active"

            data-filter="all">

                All

            </button>

            <?php while($category = mysqli_fetch_assoc($categoryResult)): ?>

            <button
            class="filter-btn"

            data-filter="<?php echo $category['name']; ?>">

                <?php echo $category['name']; ?>

            </button>

            <?php endwhile; ?>

        </div>

    </div>

    <!-- =====================================================
    GRID
    ====================================================== -->

    <div
    class="menu-grid"

    id="menuGrid">

        <?php while($product = mysqli_fetch_assoc($productResult)): ?>

        <div
        class="menu-card"

        data-category="<?php echo $product['category']; ?>"

        data-name="<?php echo strtolower($product['name']); ?>">

            <!-- IMAGE -->

            <div class="menu-image">

                <img
                src="<?php echo $product['image']; ?>"
                alt="<?php echo $product['name']; ?>">

                <!-- TAG -->

                <?php if(!empty($product['tag'])): ?>

                <div class="menu-tag">

                    <?php echo $product['tag']; ?>

                </div>

                <?php endif; ?>

                <!-- OVERLAY -->

                <div class="menu-overlay">

                    <button
                    type="button"

                    class="menu-overlay-btn"

                    onclick='addToCart({

                        id: <?php echo $product["id"]; ?>,

                        name: <?php echo json_encode($product["name"]); ?>,

                        price: <?php echo $product["price"]; ?>,

                        image: <?php echo json_encode($product["image"]); ?>

                    })'>

                        <i class="fa-solid fa-cart-plus"></i>

                    </button>

                </div>

            </div>

            <!-- CONTENT -->

            <div class="menu-content">

                <!-- CATEGORY -->

                <div class="menu-category">

                    <?php echo $product['category']; ?>

                </div>

                <!-- TITLE -->

                <h3>

                    <?php echo $product['name']; ?>

                </h3>

                <!-- DESCRIPTION -->

                <p>

                    <?php echo $product['short_description']; ?>

                </p>

                <!-- BOTTOM -->

                <div class="menu-bottom">

                    <!-- PRICE -->

                    <div class="menu-price">

                        ₹<?php echo number_format($product['price']); ?>

                    </div>

                    <!-- CART ACTION -->

                    <div
                    class="cart-action"

                    id="action-<?php echo $product['id']; ?>">

                        <button
                        type="button"

                        class="menu-btn"

                        onclick='addToCart({

                            id: <?php echo $product["id"]; ?>,

                            name: <?php echo json_encode($product["name"]); ?>,

                            price: <?php echo $product["price"]; ?>,

                            image: <?php echo json_encode($product["image"]); ?>

                        })'>

                            Add To Cart

                        </button>

                    </div>

                </div>

            </div>

        </div>

        <?php endwhile; ?>

    </div>

</section>

<?php include "footer.php"; ?>

<!-- =========================================================
PRODUCT DATA
========================================================= -->

<script>

const featuredItemsData =

<?php echo json_encode($productArray); ?>;

</script>

<!-- =========================================================
JS
========================================================= -->

<script src="assets/js/theme.js"></script>

<script src="assets/js/cart.js"></script>

<script src="assets/js/preloader.js"></script>

<!-- =========================================================
FILTER
========================================================= -->

<script>

/* =========================================================
FILTER
========================================================= */

const filterButtons =

document.querySelectorAll(
".filter-btn"
);

const menuCards =

document.querySelectorAll(
".menu-card"
);

filterButtons.forEach(button=>{

    button.addEventListener(

        "click",

        ()=>{

            filterButtons.forEach(btn=>{

                btn.classList.remove(
                "active"
                );

            });

            button.classList.add(
            "active"
            );

            const filter =

            button.dataset.filter;

            menuCards.forEach(card=>{

                if(

                    filter === "all" ||

                    card.dataset.category
                    === filter

                ){

                    card.style.display =
                    "block";

                }

                else{

                    card.style.display =
                    "none";

                }

            });

        }

    );

});

/* =========================================================
SEARCH
========================================================= */

const menuSearch =

document.getElementById(
"menuSearch"
);

menuSearch.addEventListener(

    "keyup",

    ()=>{

        const value =

        menuSearch.value
        .toLowerCase();

        menuCards.forEach(card=>{

            const itemName =

            card.dataset.name;

            if(itemName.includes(value)){

                card.style.display =
                "block";

            }

            else{

                card.style.display =
                "none";

            }

        });

    }

);

/* =========================================================
LOAD
========================================================= */

window.addEventListener(

    "DOMContentLoaded",

    ()=>{

        if(

            typeof renderCardControllers
            === "function"

        ){

            renderCardControllers();

        }

    }

);

</script>

</body>
</html>