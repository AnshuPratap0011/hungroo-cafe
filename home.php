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
        "image" => "https://images.unsplash.com/photo-1568901346375-23c9450c58cd?q=80&w=1400&auto=format&fit=crop",
        "tag"   => "Best Seller"
    ],

    [
        "id"    => 2,
        "name"  => "Cold Coffee",
        "price" => 229,
        "image" => "https://images.unsplash.com/photo-1517701604599-bb29b565090c?q=80&w=1400&auto=format&fit=crop",
        "tag"   => "Popular"
    ],

    [
        "id"    => 3,
        "name"  => "Italian Pizza",
        "price" => 599,
        "image" => "https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=1400&auto=format&fit=crop",
        "tag"   => "Hot"
    ],

    [
        "id"    => 4,
        "name"  => "Chocolate Dessert",
        "price" => 279,
        "image" => "https://images.unsplash.com/photo-1551024601-bec78aea704b?q=80&w=1400&auto=format&fit=crop",
        "tag"   => "Sweet"
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

<?php include "Navbar.php"; ?>

<!-- =========================================================
BACKGROUND BLUR
========================================================= -->

<div class="bg-blur blur-1"></div>
<div class="bg-blur blur-2"></div>

<!-- =========================================================
HERO
========================================================= -->

<section class="hero">

    <!-- LEFT -->

    <div class="hero-left">

        <div class="hero-badge">

            <i class="fa-solid fa-fire"></i>

            Premium Café Experience

        </div>

        <h1>

            Delicious Food

            <span>

                Modern Vibes

            </span>

        </h1>

        <p>

            Experience handcrafted burgers,
            luxury coffee and premium café
            atmosphere at Hungroo Café.

        </p>

        <!-- BUTTONS -->

        <div class="hero-buttons">

            <a
            href="menu.php"

            class="hero-btn primary">

                Explore Menu

            </a>

            <a
            href="contact.php"

            class="hero-btn secondary">

                Reserve Table

            </a>

        </div>

        <!-- STATS -->

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
            src="https://images.unsplash.com/photo-1552566626-52f8b828add9?q=80&w=1600&auto=format&fit=crop"
            alt="Hungroo Café">

        </div>

        <!-- FLOATING -->

        <div class="floating-card card-one">

            <i class="fa-solid fa-burger"></i>

            Best Burger

        </div>

        <div class="floating-card card-two">

            <i class="fa-solid fa-mug-hot"></i>

            Fresh Coffee

        </div>

    </div>

</section>

<!-- =========================================================
POPULAR
========================================================= -->

<section class="home-section">

    <!-- TOP -->

    <div class="section-top">

        <span>

            Popular Dishes

        </span>

        <h2>

            Featured Menu

        </h2>

        <p>

            Premium handcrafted meals
            with luxury café vibes.

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

                <!-- TAG -->

                <div class="food-tag">

                    <?php echo $item['tag']; ?>

                </div>

                <!-- OVERLAY -->

                <div class="food-overlay">

                    <button
                    type="button"

                    class="overlay-btn"

                    onclick='addToCart({

                        id: <?php echo $item["id"]; ?>,

                        name: <?php echo json_encode($item["name"]); ?>,

                        price: <?php echo $item["price"]; ?>,

                        image: <?php echo json_encode($item["image"]); ?>

                    })'>

                        <i class="fa-solid fa-cart-plus"></i>

                    </button>

                </div>

            </div>

            <!-- CONTENT -->

            <div class="food-content">

                <div class="food-rating">

                    <i class="fa-solid fa-star"></i>

                    4.9

                </div>

                <h3>

                    <?php echo $item['name']; ?>

                </h3>

                <p>

                    Premium handcrafted
                    food with unforgettable taste.

                </p>

                <!-- BOTTOM -->

                <div class="food-bottom">

                    <div class="food-price">

                        ₹<?php echo $item['price']; ?>

                    </div>

                    <!-- CART ACTION -->

                    <div
                    class="cart-action"

                    id="action-<?php echo $item['id']; ?>">

                        <button
                        type="button"

                        class="food-btn"

                        onclick='addToCart({

                            id: <?php echo $item["id"]; ?>,

                            name: <?php echo json_encode($item["name"]); ?>,

                            price: <?php echo $item["price"]; ?>,

                            image: <?php echo json_encode($item["image"]); ?>

                        })'>

                            Add To Cart

                        </button>

                    </div>

                </div>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</section>

<?php include "footer.php"; ?>

<!-- =========================================================
PRODUCT DATA
========================================================= -->

<script>

const featuredItemsData =

<?php echo json_encode($featuredItems); ?>;

</script>

<!-- =========================================================
JS
========================================================= -->

<script src="assets/js/theme.js"></script>

<script src="assets/js/cart.js"></script>

<script src="assets/js/preloader.js"></script>

<!-- =========================================================
INIT
========================================================= -->

<script>

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
<script>

/* =========================================================
REGISTER SERVICE WORKER
========================================================= */

if("serviceWorker" in navigator){

    window.addEventListener(

        "load",

        ()=>{

            navigator.serviceWorker.register(

                "service-worker.js"

            );

        }

    );

}

</script>
</body>
</html>