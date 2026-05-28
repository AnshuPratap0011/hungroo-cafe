<?php

/* =========================================================
   CONFIG & SESSION
========================================================= */

include "../config/config.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");
    exit();
}

/* =========================================================
   GET ORDER ID
========================================================= */

if (!isset($_GET['id'])) {

    header("Location: orders.php");
    exit();
}

$order_id = intval($_GET['id']);

/* =========================================================
   GET ORDER
========================================================= */

$orderQuery = "

SELECT *
FROM orders
WHERE id='$order_id'
LIMIT 1

";

$orderResult = mysqli_query(
    $conn,
    $orderQuery
);

if (!$orderResult || mysqli_num_rows($orderResult) < 1) {

    header("Location: orders.php");
    exit();
}

$order = mysqli_fetch_assoc(
    $orderResult
);

/* =========================================================
   GET ITEMS
========================================================= */

$itemQuery = "

SELECT *
FROM order_items
WHERE order_id='$order_id'

";

$itemResult = mysqli_query(
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

<!-- GOOGLE FONT -->

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<!-- FONT AWESOME -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

/* =========================================================
   ROOT
========================================================= */

:root{

    --bg:#0b0b12;

    --card:#171726;

    --sidebar:#131320;

    --white:#ffffff;

    --text:#9ca3af;

    --primary:#9b5cff;

    --primary2:#b983ff;

    --green:#10b981;

    --red:#ef4444;

    --blue:#3b82f6;

    --yellow:#facc15;

    --border:
    rgba(255,255,255,.06);

}

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

    font-family:'Poppins',sans-serif;

}

body{

    background:var(--bg);

    color:var(--white);

    overflow-x:hidden;

}

a{

    text-decoration:none;

    color:inherit;

}

.admin-layout{

    display:flex;

    min-height:100vh;

}

/* =========================================================
   SIDEBAR
========================================================= */

.sidebar{

    width:260px;

    background:var(--sidebar);

    border-right:
    1px solid var(--border);

    padding:26px 18px;

    position:fixed;

    top:0;
    left:0;

    height:100vh;

}

.logo{

    font-size:24px;

    font-weight:700;

    margin-bottom:40px;

    padding-left:10px;

}

.logo span{

    color:var(--primary);

}

.menu-item{

    height:58px;

    display:flex;

    align-items:center;

    gap:14px;

    padding:0 18px;

    border-radius:18px;

    color:#fff;

    transition:.35s;

    font-size:15px;

    font-weight:600;

    margin-bottom:10px;

}

.menu-item.active,
.menu-item:hover{

    background:
    linear-gradient(
    90deg,
    rgba(155,92,255,.18),
    transparent
    );

    color:var(--primary2);

}

.menu-item i{

    color:var(--primary2);

}

/* =========================================================
   MAIN
========================================================= */

.main-content{

    flex:1;

    margin-left:260px;

    padding:30px;

}

.page-top{

    display:flex;

    align-items:center;

    justify-content:space-between;

    flex-wrap:wrap;

    gap:20px;

    margin-bottom:30px;

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
    var(--primary2)
    );

    color:#fff;

    font-size:14px;

    font-weight:700;

    box-shadow:
    0 10px 30px
    rgba(155,92,255,.3);

}

/* =========================================================
   ORDER CARD
========================================================= */

.order-card{

    padding:34px;

    border-radius:34px;

    background:var(--card);

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

    font-size:18px;

    word-break:break-word;

}

/* =========================================================
   ITEMS
========================================================= */

.items-box{

    padding:34px;

    border-radius:34px;

    background:var(--card);

    border:
    1px solid var(--border);

}

.items-box h2{

    font-size:32px;

    margin-bottom:28px;

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

.item-left{

    display:flex;

    align-items:center;

    gap:18px;

}

.item-image{

    width:90px;

    height:90px;

    border-radius:20px;

    object-fit:cover;

    background:#111;

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

    color:var(--primary2);

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

    .item-left{

        flex-direction:column;

        align-items:flex-start;

    }

}

</style>

</head>

<body>

<div class="admin-layout">

    <!-- SIDEBAR -->

    <div class="sidebar">

        <div class="logo">
            Hungroo <span>Admin</span>
        </div>

        <a href="dashboard.php"
            class="menu-item">

            <i class="fa-solid fa-chart-pie"></i>
            Dashboard

        </a>

        <a href="products.php"
            class="menu-item">

            <i class="fa-solid fa-burger"></i>
            Products

        </a>

        <a href="orders.php"
            class="menu-item active">

            <i class="fa-solid fa-cart-shopping"></i>
            Orders

        </a>

        <a href="users.php"
            class="menu-item">

            <i class="fa-solid fa-users"></i>
            Users

        </a>

        <a href="logout.php"
            class="menu-item"
            style="color:#ef4444;">

            <i class="fa-solid fa-right-from-bracket"></i>
            Logout

        </a>

    </div>

    <!-- MAIN -->

    <main class="main-content">

        <!-- TOP -->

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

                        Order Number

                    </span>

                    <h3>

                        #<?php echo $order['order_number']; ?>

                    </h3>

                </div>

                <div class="info-box">

                    <span>

                        Customer Name

                    </span>

                    <h3>

                        <?php

                        echo !empty($order['customer_name'])

                        ? $order['customer_name']

                        : "Guest";

                        ?>

                    </h3>

                </div>

                <div class="info-box">

                    <span>

                        Payment Method

                    </span>

                    <h3>

                        <?php echo strtoupper($order['payment_method']); ?>

                    </h3>

                </div>

                <div class="info-box">

                    <span>

                        Payment Status

                    </span>

                    <h3
                    style="color:var(--green);">

                        <?php

                        echo ucfirst(
                            $order['payment_status']
                        );

                        ?>

                    </h3>

                </div>

                <div class="info-box">

                    <span>

                        Order Status

                    </span>

                    <h3
                    style="color:var(--primary2);">

                        <?php

                        echo ucfirst(
                            $order['status']
                        );

                        ?>

                    </h3>

                </div>

                <div class="info-box">

                    <span>

                        Total Amount

                    </span>

                    <h3>

                        ₹<?php

                        echo number_format(
                            $order['total']
                        );

                        ?>

                    </h3>

                </div>

                <div class="info-box">

                    <span>

                        Delivery Address

                    </span>

                    <h3>

                        <?php

                        echo $order['delivery_address'];

                        ?>

                    </h3>

                </div>

                <div class="info-box">

                    <span>

                        Order Date

                    </span>

                    <h3>

                        <?php

                        echo $order['created_at'];

                        ?>

                    </h3>

                </div>

            </div>

        </div>

        <!-- ITEMS -->

        <div class="items-box">

            <h2>

                Ordered Items

            </h2>

            <?php while($item = mysqli_fetch_assoc($itemResult)): ?>

            <div class="item-card">

                <div class="item-left">

                    <img
                    src="<?php echo $item['product_image']; ?>"
                    class="item-image"
                    alt="Product">

                    <div>

                        <h3>

                            <?php echo $item['product_name']; ?>

                        </h3>

                        <p>

                            Quantity:
                            <?php echo $item['quantity']; ?>

                        </p>

                    </div>

                </div>

                <div class="item-price">

                    <h2>

                        ₹<?php

                        echo number_format(
                            $item['total']
                        );

                        ?>

                    </h2>

                    <span>

                        ₹<?php

                        echo number_format(
                            $item['price']
                        );

                        ?>

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