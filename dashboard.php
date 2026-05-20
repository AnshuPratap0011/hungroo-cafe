<?php

session_start();

$pageTitle =
"Hungroo Café | Dashboard";

/* =========================================================
STATS
========================================================= */

$totalOrders = 24;
$totalPoints = 2450;
$totalReservations = 8;
$totalSpent = 18500;

/* =========================================================
RECENT ORDERS
========================================================= */

$orders = [

    [
        "id" => "#ORD1024",
        "item" => "Premium Burger Combo",
        "status" => "Delivered",
        "price" => "₹699"
    ],

    [
        "id" => "#ORD1025",
        "item" => "Cold Coffee",
        "status" => "Preparing",
        "price" => "₹249"
    ],

    [
        "id" => "#ORD1026",
        "item" => "Pizza Feast",
        "status" => "Cancelled",
        "price" => "₹899"
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
href="assets/css/responsive.css">

<style>

/* =========================================================
ROOT
========================================================= */

:root{

    --bg:#070707;
    --card:#121212;
    --white:#ffffff;
    --text:#bdbdbd;
    --primary:#ff9a3d;
    --gold:#ffd27a;
    --green:#2ecc71;
    --red:#ff5e5e;
    --orange:#ffb347;
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

/* =========================================================
RESET
========================================================= */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

}

/* =========================================================
BODY
========================================================= */

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

/* =========================================================
PAGE
========================================================= */

.dashboard-page{

    width:100%;

    max-width:1450px;

    margin:auto;

    padding:
    130px 16px 80px;

}

/* =========================================================
TOP
========================================================= */

.dashboard-top{

    margin-bottom:50px;

}

.dashboard-top span{

    color:var(--primary);

    font-size:13px;

    font-weight:600;

}

.dashboard-top h1{

    font-size:
    clamp(40px,6vw,82px);

    margin:
    10px 0 14px;

}

.dashboard-top p{

    color:var(--text);

    line-height:1.9;

}

/* =========================================================
STATS
========================================================= */

.dashboard-stats{

    display:grid;

    grid-template-columns:
    repeat(4,1fr);

    gap:24px;

    margin-bottom:40px;

}

/* =========================================================
STAT CARD
========================================================= */

.stat-card{

    padding:28px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

}

.stat-icon{

    width:72px;
    height:72px;

    margin-bottom:22px;

    border-radius:22px;

    display:flex;
    align-items:center;
    justify-content:center;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

    font-size:28px;

}

.stat-card h2{

    font-size:
    clamp(34px,5vw,52px);

    margin-bottom:10px;

}

.stat-card p{

    color:var(--text);

    line-height:1.8;

}

/* =========================================================
ORDERS
========================================================= */

.dashboard-orders{

    padding:34px;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    backdrop-filter:
    blur(18px);

}

.dashboard-orders h2{

    font-size:34px;

    margin-bottom:28px;

}

/* =========================================================
ORDER CARD
========================================================= */

.order-card{

    padding:24px;

    border-radius:24px;

    background:
    rgba(255,255,255,.03);

    border:
    1px solid var(--border);

    display:flex;

    align-items:center;
    justify-content:space-between;

    gap:20px;

    flex-wrap:wrap;

    margin-bottom:20px;

}

.order-left h3{

    font-size:24px;

    margin-bottom:10px;

}

.order-left p{

    color:var(--text);

    line-height:1.8;

}

/* =========================================================
STATUS
========================================================= */

.order-status{

    padding:
    10px 18px;

    border-radius:999px;

    font-size:13px;

    font-weight:700;

}

.delivered{

    background:
    rgba(46,204,113,.12);

    color:var(--green);

}

.preparing{

    background:
    rgba(255,179,71,.12);

    color:var(--orange);

}

.cancelled{

    background:
    rgba(255,94,94,.12);

    color:var(--red);

}

/* =========================================================
PRICE
========================================================= */

.order-price{

    font-size:26px;

    font-weight:700;

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:1100px){

    .dashboard-stats{

        grid-template-columns:
        repeat(2,1fr);

    }

}

@media(max-width:768px){

    .dashboard-page{

        padding:
        120px 14px 70px;

    }

    .dashboard-stats{

        grid-template-columns:1fr;

    }

    .stat-card{

        padding:24px 18px;

        border-radius:24px;

    }

    .dashboard-orders{

        padding:22px 18px;

        border-radius:24px;

    }

    .order-card{

        padding:18px;

        border-radius:20px;

    }

    .order-left h3{

        font-size:20px;

    }

}

</style>

</head>

<body>

<?php include "Navbar.php"; ?>

<main class="dashboard-page">

    <!-- TOP -->

    <div class="dashboard-top">

        <span>

            Premium Dashboard

        </span>

        <h1>

            Welcome Back, Mahavir

        </h1>

        <p>

            Track your orders,
            rewards and reservations
            from your Hungroo Café dashboard.

        </p>

    </div>

    <!-- STATS -->

    <div class="dashboard-stats">

        <!-- CARD -->

        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-cart-shopping"></i>

            </div>

            <h2>

                <?php echo $totalOrders; ?>

            </h2>

            <p>

                Total Orders

            </p>

        </div>

        <!-- CARD -->

        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-star"></i>

            </div>

            <h2>

                <?php echo $totalPoints; ?>

            </h2>

            <p>

                Reward Points

            </p>

        </div>

        <!-- CARD -->

        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-utensils"></i>

            </div>

            <h2>

                <?php echo $totalReservations; ?>

            </h2>

            <p>

                Reservations

            </p>

        </div>

        <!-- CARD -->

        <div class="stat-card">

            <div class="stat-icon">

                <i class="fa-solid fa-wallet"></i>

            </div>

            <h2>

                ₹<?php echo $totalSpent; ?>

            </h2>

            <p>

                Total Spent

            </p>

        </div>

    </div>

    <!-- ORDERS -->

    <div class="dashboard-orders">

        <h2>

            Recent Orders

        </h2>

        <?php foreach($orders as $order): ?>

        <div class="order-card">

            <!-- LEFT -->

            <div class="order-left">

                <h3>

                    <?php echo $order['id']; ?>

                </h3>

                <p>

                    <?php echo $order['item']; ?>

                </p>

            </div>

            <!-- RIGHT -->

            <div>

                <div class="order-status

                <?php echo strtolower($order['status']); ?>

                ">

                    <?php echo $order['status']; ?>

                </div>

            </div>

            <!-- PRICE -->

            <div class="order-price">

                <?php echo $order['price']; ?>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</main>

<?php include "footer.php"; ?>

<script src="assets/js/theme.js"></script>

<script src="assets/js/preloader.js"></script>

</body>
</html>