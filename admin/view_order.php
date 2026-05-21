<?php

session_start();

/* =========================================================
LOGIN CHECK
========================================================= */

if(!isset($_SESSION['admin_id'])){

    header(
    "Location: login.php"
    );

    exit();

}

/* =========================================================
CONFIG
========================================================= */

include "../config/config.php";

/* =========================================================
ORDER ID
========================================================= */

if(!isset($_GET['id'])){

    header(
    "Location: orders.php"
    );

    exit();

}

$order_id =

intval(
$_GET['id']
);

/* =========================================================
GET ORDER
========================================================= */

$orderQuery =

"SELECT * FROM orders
WHERE id='$order_id'
LIMIT 1";

$orderResult =

mysqli_query(
$conn,
$orderQuery
);

if(mysqli_num_rows($orderResult) < 1){

    header(
    "Location: orders.php"
    );

    exit();

}

$order =

mysqli_fetch_assoc(
$orderResult
);

/* =========================================================
GET ITEMS
========================================================= */

$itemQuery =

"SELECT * FROM order_items
WHERE order_id='$order_id'
ORDER BY id DESC";

$itemResult =

mysqli_query(
$conn,
$itemQuery
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

View Order

</title>

<!-- FONT -->

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<!-- ICON -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

/* =========================================================
ROOT
========================================================= */

:root{

    --bg:#070707;

    --sidebar:#0f0f0f;

    --card:#151515;

    --white:#ffffff;

    --text:#bdbdbd;

    --primary:#ff9a3d;

    --gold:#ffd27a;

    --border:
    rgba(255,255,255,.08);

}

/* =========================================================
RESET
========================================================= */

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

}

body{

    background:var(--bg);

    color:var(--white);

    font-family:'Poppins',sans-serif;

}

/* =========================================================
LAYOUT
========================================================= */

.admin-layout{

    display:flex;

    min-height:100vh;

}

/* =========================================================
SIDEBAR
========================================================= */

.sidebar{

    width:280px;

    background:var(--sidebar);

    border-right:
    1px solid var(--border);

    padding:26px 18px;

    position:fixed;

    top:0;
    left:0;

    height:100vh;

}

.sidebar-logo{

    display:flex;

    align-items:center;

    gap:14px;

    margin-bottom:40px;

}

.sidebar-logo img{

    width:58px;
    height:58px;

    border-radius:18px;

    object-fit:cover;

}

.sidebar-logo h2{

    font-size:28px;

}

.sidebar-logo span{

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    -webkit-background-clip:text;

    -webkit-text-fill-color:
    transparent;

}

.sidebar-menu{

    display:flex;

    flex-direction:column;

    gap:12px;

}

.sidebar-menu a{

    height:58px;

    display:flex;

    align-items:center;

    gap:14px;

    padding:
    0 18px;

    border-radius:18px;

    text-decoration:none;

    color:#fff;

    transition:.35s;

    font-size:15px;

    font-weight:600;

}

.sidebar-menu a.active,
.sidebar-menu a:hover{

    background:
    rgba(255,154,61,.12);

}

.sidebar-menu a i{

    color:var(--primary);

}

/* =========================================================
CONTENT
========================================================= */

.main-content{

    flex:1;

    margin-left:280px;

    padding:30px;

}

/* =========================================================
TOP
========================================================= */

.page-top{

    display:flex;

    align-items:center;
    justify-content:space-between;

    gap:20px;

    margin-bottom:30px;

    flex-wrap:wrap;

}

.page-top h1{

    font-size:42px;

}

.page-top p{

    color:var(--text);

    margin-top:8px;

}

.back-btn{

    min-width:170px;

    height:54px;

    border:none;

    border-radius:18px;

    display:flex;

    align-items:center;
    justify-content:center;

    gap:10px;

    text-decoration:none;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

    font-size:14px;

    font-weight:700;

}

/* =========================================================
GRID
========================================================= */

.order-grid{

    display:grid;

    grid-template-columns:
    .9fr 1.1fr;

    gap:28px;

}

/* =========================================================
CARD
========================================================= */

.order-card{

    padding:30px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

.order-card h2{

    font-size:28px;

    margin-bottom:24px;

}

/* =========================================================
INFO
========================================================= */

.order-info{

    display:flex;

    flex-direction:column;

    gap:18px;

}

.order-info-row{

    display:flex;

    justify-content:space-between;

    gap:20px;

    padding-bottom:18px;

    border-bottom:
    1px solid var(--border);

}

.order-info-row span{

    color:var(--text);

}

.order-info-row strong{

    text-align:right;

}

/* =========================================================
ITEMS
========================================================= */

.order-items{

    display:flex;

    flex-direction:column;

    gap:18px;

}

.order-item{

    padding:22px;

    border-radius:24px;

    background:
    rgba(255,255,255,.03);

    border:
    1px solid var(--border);

}

.order-item-top{

    display:flex;

    justify-content:space-between;

    gap:16px;

    margin-bottom:16px;

}

.order-item h3{

    font-size:20px;

}

.order-item p{

    color:var(--text);

    line-height:1.8;

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:1100px){

    .order-grid{

        grid-template-columns:1fr;

    }

}

@media(max-width:992px){

    .sidebar{

        position:relative;

        width:100%;

        height:auto;

    }

    .main-content{

        margin-left:0;

    }

    .admin-layout{

        flex-direction:column;

    }

}

@media(max-width:768px){

    .main-content{

        padding:18px;

    }

    .order-card{

        padding:22px;

        border-radius:24px;

    }

    .page-top h1{

        font-size:32px;

    }

    .order-info-row{

        flex-direction:column;

    }

}

</style>

</head>

<body>

<div class="admin-layout">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="sidebar-logo">

            <img
            src="../assets/images/logo.png"
            alt="Logo">

            <h2>

                <span>

                    Hungroo

                </span>

                Admin

            </h2>

        </div>

        <div class="sidebar-menu">

            <a href="dashboard.php">

                <i class="fa-solid fa-chart-line"></i>

                Dashboard

            </a>

            <a href="products.php">

                <i class="fa-solid fa-burger"></i>

                Products

            </a>

            <a
            href="orders.php"

            class="active">

                <i class="fa-solid fa-cart-shopping"></i>

                Orders

            </a>

            <a href="reservations.php">

                <i class="fa-solid fa-calendar-check"></i>

                Reservations

            </a>

            <a href="messages.php">

                <i class="fa-solid fa-envelope"></i>

                Messages

            </a>

            <a href="settings.php">

                <i class="fa-solid fa-gear"></i>

                Settings

            </a>

            <a href="logout.php">

                <i class="fa-solid fa-right-from-bracket"></i>

                Logout

            </a>

        </div>

    </aside>

    <!-- CONTENT -->

    <main class="main-content">

        <div class="page-top">

            <div>

                <h1>

                    Order #<?php echo $order['id']; ?>

                </h1>

                <p>

                    Full order details and items

                </p>

            </div>

            <a
            href="orders.php"

            class="back-btn">

                <i class="fa-solid fa-arrow-left"></i>

                Back To Orders

            </a>

        </div>

        <!-- GRID -->

        <div class="order-grid">

            <!-- ORDER INFO -->

            <div class="order-card">

                <h2>

                    Customer Details

                </h2>

                <div class="order-info">

                    <div class="order-info-row">

                        <span>

                            Customer Name

                        </span>

                        <strong>

                            <?php echo $order['customer_name']; ?>

                        </strong>

                    </div>

                    <div class="order-info-row">

                        <span>

                            Phone Number

                        </span>

                        <strong>

                            <?php echo $order['customer_phone']; ?>

                        </strong>

                    </div>

                    <div class="order-info-row">

                        <span>

                            Email Address

                        </span>

                        <strong>

                            <?php echo $order['customer_email']; ?>

                        </strong>

                    </div>

                    <div class="order-info-row">

                        <span>

                            City

                        </span>

                        <strong>

                            <?php echo $order['city']; ?>

                        </strong>

                    </div>

                    <div class="order-info-row">

                        <span>

                            Address

                        </span>

                        <strong>

                            <?php echo $order['address']; ?>

                        </strong>

                    </div>

                    <div class="order-info-row">

                        <span>

                            Payment Method

                        </span>

                        <strong>

                            <?php echo $order['payment_method']; ?>

                        </strong>

                    </div>

                    <div class="order-info-row">

                        <span>

                            Order Status

                        </span>

                        <strong>

                            <?php echo ucfirst(str_replace('_',' ',$order['order_status'])); ?>

                        </strong>

                    </div>

                    <div class="order-info-row">

                        <span>

                            Total Amount

                        </span>

                        <strong>

                            ₹<?php echo number_format($order['total_amount']); ?>

                        </strong>

                    </div>

                </div>

            </div>

            <!-- ORDER ITEMS -->

            <div class="order-card">

                <h2>

                    Ordered Items

                </h2>

                <div class="order-items">

                    <?php while($item = mysqli_fetch_assoc($itemResult)): ?>

                    <div class="order-item">

                        <div class="order-item-top">

                            <h3>

                                <?php echo $item['product_name']; ?>

                            </h3>

                            <strong>

                                ₹<?php echo number_format($item['total_price']); ?>

                            </strong>

                        </div>

                        <p>

                            Quantity :
                            <?php echo $item['quantity']; ?>

                        </p>

                        <p>

                            Price :
                            ₹<?php echo number_format($item['product_price']); ?>

                        </p>

                    </div>

                    <?php endwhile; ?>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>