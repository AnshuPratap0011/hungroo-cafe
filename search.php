<?php

require_once "db.php";

/* =========================================================
PAGE TITLE
========================================================= */

$pageTitle =
"Hungroo Café | Search";

/* =========================================================
DUMMY ITEMS
========================================================= */

$menuItems = [

    [
        "name"  => "Classic Burger",
        "price" => "₹299",
        "image" => "assets/images/burger.jpg"
    ],

    [
        "name"  => "Cold Coffee",
        "price" => "₹199",
        "image" => "assets/images/coffee.jpg"
    ],

    [
        "name"  => "Italian Pizza",
        "price" => "₹499",
        "image" => "assets/images/pizza.jpg"
    ],

    [
        "name"  => "Chocolate Dessert",
        "price" => "₹249",
        "image" => "assets/images/dessert.jpg"
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

<!-- =====================================================
GOOGLE FONT
===================================================== -->

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

<!-- =====================================================
FONT AWESOME
===================================================== -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- =====================================================
CSS
===================================================== -->

<link
rel="stylesheet"
href="assets/css/navbar.css">

<link
rel="stylesheet"
href="assets/css/footer.css">

<link
rel="stylesheet"
href="assets/css/animations.css">

<link
rel="stylesheet"
href="assets/css/effects.css">

<style>

/* =====================================================
ROOT
===================================================== */

:root{

    --bg:#070707;

    --card:#121212;

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

/* =====================================================
RESET
===================================================== */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

}

/* =====================================================
BODY
===================================================== */

body{

    overflow-x:hidden;

    background:
    radial-gradient(
    circle at top right,
    rgba(255,154,61,.08),
    transparent 30%
    ),
    var(--bg);

    color:var(--white);

    font-family:'Poppins',sans-serif;

}

/* =====================================================
PAGE
===================================================== */

.search-page{

    width:100%;

    max-width:1400px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =====================================================
TOP
===================================================== */

.search-top{

    text-align:center;

    margin-bottom:44px;

}

.search-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.search-top h1{

    font-size:
    clamp(38px,6vw,78px);

    margin:
    10px 0 16px;

}

.search-top p{

    max-width:760px;

    margin:auto;

    color:var(--text);

    line-height:1.9;

}

/* =====================================================
SEARCH BAR
===================================================== */

.search-box{

    width:100%;

    max-width:760px;

    margin:
    0 auto 50px;

    position:relative;

}

.search-input{

    width:100%;

    height:72px;

    border:none;

    outline:none;

    border-radius:24px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:var(--white);

    padding:
    0 72px 0 24px;

    font-size:16px;

    font-family:'Poppins',sans-serif;

}

.search-input::placeholder{

    color:#999;

}

.search-btn{

    position:absolute;

    top:50%;
    right:10px;

    transform:
    translateY(-50%);

    width:54px;
    height:54px;

    border:none;

    cursor:pointer;

    border-radius:18px;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

    font-size:18px;

}

/* =====================================================
GRID
===================================================== */

.search-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(280px,1fr));

    gap:26px;

}

/* =====================================================
CARD
===================================================== */

.search-card{

    overflow:hidden;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    transition:.35s;

    backdrop-filter:
    blur(18px);

}

.search-card:hover{

    transform:
    translateY(-8px);

}

/* =====================================================
IMAGE
===================================================== */

.search-image{

    width:100%;

    height:240px;

    overflow:hidden;

}

.search-image img{

    width:100%;
    height:100%;

    object-fit:cover;

    transition:.4s;

}

.search-card:hover
.search-image img{

    transform:
    scale(1.08);

}

/* =====================================================
CONTENT
===================================================== */

.search-content{

    padding:22px;

}

.search-content h2{

    font-size:26px;

    margin-bottom:10px;

}

.search-content p{

    color:var(--text);

    line-height:1.9;

    margin-bottom:20px;

}

/* =====================================================
BOTTOM
===================================================== */

.search-bottom{

    display:flex;

    align-items:center;
    justify-content:space-between;

    gap:16px;

    flex-wrap:wrap;

}

/* =====================================================
PRICE
===================================================== */

.search-price{

    font-size:32px;

    font-weight:700;

}

/* =====================================================
BUTTON
===================================================== */

.search-order-btn{

    height:54px;

    padding:
    0 22px;

    border:none;

    cursor:pointer;

    border-radius:18px;

    font-size:14px;

    font-weight:700;

    transition:.35s;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

}

.search-order-btn:hover{

    transform:
    translateY(-4px);

}

/* =====================================================
RESPONSIVE
===================================================== */

@media(max-width:768px){

    .search-page{

        padding:
        120px 14px 70px;

    }

    .search-grid{

        grid-template-columns:1fr;

    }

    .search-input{

        height:64px;

        border-radius:20px;

    }

    .search-btn{

        width:48px;
        height:48px;

        border-radius:16px;

    }

    .search-card{

        border-radius:24px;

    }

    .search-image{

        height:220px;

    }

    .search-content{

        padding:18px;

    }

    .search-content h2{

        font-size:22px;

    }

    .search-bottom{

        flex-direction:column;

        align-items:flex-start;

    }

    .search-order-btn{

        width:100%;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<!-- =====================================================
MAIN
===================================================== -->

<main class="search-page">

    <!-- TOP -->

    <div class="search-top">

        <span>

            Find Premium Meals

        </span>

        <h1>

            Search Menu

        </h1>

        <p>

            Search handcrafted burgers,
            artisan coffee, pizzas,
            desserts and café specials.

        </p>

    </div>

    <!-- SEARCH -->

    <div class="search-box">

        <input
        type="text"

        class="search-input"

        placeholder=
        "Search your favorite meals...">

        <button class="search-btn">

            <i class="fa-solid fa-magnifying-glass"></i>

        </button>

    </div>

    <!-- GRID -->

    <div class="search-grid">

        <?php foreach($menuItems as $item): ?>

        <article class="search-card">

            <!-- IMAGE -->

            <div class="search-image">

                <img
                src="<?php echo $item['image']; ?>"
                alt="<?php echo $item['name']; ?>">

            </div>

            <!-- CONTENT -->

            <div class="search-content">

                <h2>

                    <?php echo $item['name']; ?>

                </h2>

                <p>

                    Premium handcrafted flavor
                    with luxury café experience.

                </p>

                <div class="search-bottom">

                    <div class="search-price">

                        <?php echo $item['price']; ?>

                    </div>

                    <button class="search-order-btn">

                        Order Now

                    </button>

                </div>

            </div>

        </article>

        <?php endforeach; ?>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

</body>
</html>