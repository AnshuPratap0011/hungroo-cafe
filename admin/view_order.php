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
GET ID
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
WHERE order_id='$order_id'";

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

:root{

    --bg:#070707;
    --sidebar:#0f0f0f;
    --card:#121212;
    --white:#ffffff;
    --text:#bdbdbd;
    --primary:#ff9a3d;
    --gold:#ffd27a;
    --border:rgba(255,255,255,.08);

}

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

    padding:0 18px;

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

/* =========================================================
BUTTON
========================================================= */

.back-btn{

    min-width:180px;

    height:56px;

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
ORDER CARD
========================================================= */

.order-card{

    padding:34px;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    margin-bottom:30px;

}

.order-info{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(240px,1fr));

    gap:24px;

}

.info-box{

    padding:22px;

    border-radius:22px;

    background:
    rgba(255,255,255,.03);

    border:
    1px solid var(--border);

}

.info-box span{

    display:block;

    color:var(--text);

    margin-bottom:10px;

    font-size:13px;

}

.info-box h3{

    font-size:20px;

    word-break:break-word;

}

/* =========================================================
ITEMS
========================================================= */

.items-box{

    padding:34px;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

.items-box h2{

    font-size:34px;

    margin-bottom:30px;

}

.item-card{

    display:flex;

    align-items:center;
    justify-content:space-between;

    gap:20px;

    padding:22px;

    border-radius:24px;

    background:
    rgba(255,255,255,.03);

    border:
    1px solid var(--border);

    margin-bottom:20px;

}

.item-card:last-child{

    margin-bottom:0;

}

.item-left h3{

    font-size:22px;

    margin-bottom:8px;

}

.item-left p{

    color:var(--text);

}

.item-price{

    text-align:right;

}

.item-price h2{

    font-size:26px;

    margin-bottom:8px;

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

.item-price span{

    color:var(--text);

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:992px){

    .sidebar{

        width:100%;
        height:auto;

        position:relative;

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

    .page-top h1{

        font-size:32px;

    }

    .order-card,
    .items-box{

        padding:24px;

        border-radius:24px;

    }

    .item-card{

        flex-direction:column;

        align-items:flex-start;

    }

    .item-price{

        text-align:left;

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

                    Order Details

                </h1>

                <p>

                    Full customer order information

                </p>

            </div>

            <a
            href="orders.php"

            class="back-btn">

                <i class="fa-solid fa-arrow-left"></i>

                Back

            </a>

        </div>

        <!-- ORDER INFO -->

        <div class="order-card">

            <div class="order-info">

                <div class="info-box">

                    <span>

                        Customer Name

                    </span>

                    <h3>

                        <?php echo $order['customer_name']; ?>

                    </h3>

                </div>

                <div class="info-box">

                    <span>

                        Phone Number

                    </span>

                    <h3>

                        <?php echo $order['customer_phone']; ?>

                    </h3>

                </div>

                <div class="info-box">

                    <span>

                        Payment Method

                    </span>

                    <h3>

                        <?php echo $order['payment_method']; ?>

                    </h3>

                </div>

                <div class="info-box">

                    <span>

                        Order Status

                    </span>

                    <h3>

                        <?php echo ucfirst($order['order_status']); ?>

                    </h3>

                </div>

                <div class="info-box">

                    <span>

                        Total Amount

                    </span>

                    <h3>

                        ₹<?php echo number_format($order['total_amount']); ?>

                    </h3>

                </div>

                <div class="info-box">

                    <span>

                        Delivery Address

                    </span>

                    <h3>

                        <?php echo $order['customer_address']; ?>

                    </h3>

                </div>

            </div>

        </div>

        <!-- ORDER ITEMS -->

        <div class="items-box">

            <h2>

                Ordered Items

            </h2>

            <?php while($item = mysqli_fetch_assoc($itemResult)): ?>

            <div class="item-card">

                <div class="item-left">

                    <h3>

                        <?php echo $item['product_name']; ?>

                    </h3>

                    <p>

                        Quantity:
                        <?php echo $item['quantity']; ?>

                    </p>

                </div>

                <div class="item-price">

                    <h2>

                        ₹<?php echo number_format($item['subtotal']); ?>

                    </h2>

                    <span>

                        ₹<?php echo $item['product_price']; ?>
                        each

                    </span>

                </div>

            </div>

            <?php endwhile; ?>

        </div>

    </main>

</div>

</body>
</html>