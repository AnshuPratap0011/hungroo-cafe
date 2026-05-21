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
TOTAL PRODUCTS
========================================================= */

$productQuery =

"SELECT COUNT(*) AS total_products
FROM products";

$productResult =

mysqli_query(
$conn,
$productQuery
);

$totalProducts =

mysqli_fetch_assoc(
$productResult
)['total_products'];

/* =========================================================
TOTAL ORDERS
========================================================= */

$orderQuery =

"SELECT COUNT(*) AS total_orders
FROM orders";

$orderResult =

mysqli_query(
$conn,
$orderQuery
);

$totalOrders =

mysqli_fetch_assoc(
$orderResult
)['total_orders'];

/* =========================================================
TOTAL USERS
========================================================= */

$userQuery =

"SELECT COUNT(*) AS total_users
FROM users";

$userResult =

mysqli_query(
$conn,
$userQuery
);

$totalUsers =

mysqli_fetch_assoc(
$userResult
)['total_users'];

/* =========================================================
TOTAL REVENUE
========================================================= */

$revenueQuery =

"SELECT SUM(total_amount)
AS total_revenue

FROM orders

WHERE order_status != 'cancelled'";

$revenueResult =

mysqli_query(
$conn,
$revenueQuery
);

$totalRevenue =

mysqli_fetch_assoc(
$revenueResult
)['total_revenue'];

if(!$totalRevenue){

    $totalRevenue = 0;

}

/* =========================================================
RECENT ORDERS
========================================================= */

$recentOrdersQuery =

"SELECT * FROM orders
ORDER BY id DESC
LIMIT 6";

$recentOrders =

mysqli_query(
$conn,
$recentOrdersQuery
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

Hungroo Admin Dashboard

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

    overflow-x:hidden;

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

/* =========================================================
LOGO
========================================================= */

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

/* =========================================================
MENU
========================================================= */

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

    color:var(--white);

    transition:.35s;

    font-size:15px;

    font-weight:600;

}

.sidebar-menu a i{

    width:22px;

    text-align:center;

    color:var(--primary);

}

.sidebar-menu a:hover,
.sidebar-menu a.active{

    background:
    linear-gradient(
    135deg,
    rgba(255,154,61,.14),
    rgba(255,210,122,.08)
    );

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
TOPBAR
========================================================= */

.topbar{

    display:flex;

    align-items:center;
    justify-content:space-between;

    gap:20px;

    margin-bottom:34px;

}

.topbar h1{

    font-size:42px;

}

.topbar p{

    color:var(--text);

    margin-top:8px;

}

/* =========================================================
PROFILE
========================================================= */

.admin-profile{

    display:flex;

    align-items:center;

    gap:14px;

    padding:
    12px 18px;

    border-radius:18px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

.admin-profile img{

    width:52px;
    height:52px;

    border-radius:50%;

    object-fit:cover;

}

/* =========================================================
CARDS
========================================================= */

.dashboard-cards{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(240px,1fr));

    gap:22px;

    margin-bottom:34px;

}

.dashboard-card{

    position:relative;

    overflow:hidden;

    padding:26px;

    border-radius:28px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

.dashboard-card::before{

    content:"";

    position:absolute;

    top:-40px;
    right:-40px;

    width:120px;
    height:120px;

    border-radius:50%;

    background:
    rgba(255,154,61,.08);

}

.dashboard-card i{

    width:64px;
    height:64px;

    margin-bottom:22px;

    border-radius:20px;

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

    font-size:24px;

}

.dashboard-card h2{

    font-size:40px;

    margin-bottom:10px;

}

.dashboard-card p{

    color:var(--text);

}

/* =========================================================
TABLE
========================================================= */

.table-box{

    padding:26px;

    border-radius:28px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    overflow-x:auto;

}

.table-top{

    display:flex;

    align-items:center;
    justify-content:space-between;

    gap:20px;

    margin-bottom:24px;

}

.table-top h2{

    font-size:32px;

}

/* =========================================================
TABLE
========================================================= */

table{

    width:100%;

    border-collapse:collapse;

}

table th{

    text-align:left;

    padding:16px;

    color:var(--text);

    font-size:14px;

    font-weight:600;

    border-bottom:
    1px solid var(--border);

}

table td{

    padding:18px 16px;

    border-bottom:
    1px solid var(--border);

    font-size:14px;

}

/* =========================================================
STATUS
========================================================= */

.status{

    width:max-content;

    padding:
    8px 14px;

    border-radius:999px;

    font-size:12px;

    font-weight:700;

}

.status.pending{

    background:
    rgba(255,193,7,.12);

    color:#ffc107;

}

.status.delivered{

    background:
    rgba(40,167,69,.12);

    color:#28a745;

}

.status.cancelled{

    background:
    rgba(255,77,77,.12);

    color:#ff4d4d;

}

/* =========================================================
BUTTON
========================================================= */

.action-btn{

    min-width:100px;

    height:42px;

    border:none;

    cursor:pointer;

    padding:
    0 18px;

    border-radius:14px;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

    font-size:13px;

    font-weight:700;

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

    .topbar{

        flex-direction:column;

        align-items:flex-start;

    }

    .topbar h1{

        font-size:34px;

    }

    .dashboard-cards{

        grid-template-columns:1fr 1fr;

    }

}

@media(max-width:480px){

    .dashboard-cards{

        grid-template-columns:1fr;

    }

    .table-box{

        padding:18px;

    }

}

</style>

</head>

<body>

<!-- =========================================================
LAYOUT
========================================================= -->

<div class="admin-layout">

    <!-- =====================================================
    SIDEBAR
    ====================================================== -->

    <aside class="sidebar">

        <!-- LOGO -->

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

        <!-- MENU -->

        <div class="sidebar-menu">

            <a
            href="dashboard.php"

            class="active">

                <i class="fa-solid fa-chart-line"></i>

                Dashboard

            </a>

            <a href="products.php">

                <i class="fa-solid fa-burger"></i>

                Products

            </a>

            <a href="orders.php">

                <i class="fa-solid fa-cart-shopping"></i>

                Orders

            </a>

            <a href="users.php">

                <i class="fa-solid fa-users"></i>

                Users

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

    <!-- =====================================================
    CONTENT
    ====================================================== -->

    <main class="main-content">

        <!-- TOPBAR -->

        <div class="topbar">

            <div>

                <h1>

                    Dashboard

                </h1>

                <p>

                    Welcome back,
                    <?php echo $_SESSION['admin_name']; ?>

                </p>

            </div>

            <div class="admin-profile">

                <img
                src="https://i.pravatar.cc/100"
                alt="Admin">

                <div>

                    <strong>

                        Admin

                    </strong>

                    <p>

                        Super Admin

                    </p>

                </div>

            </div>

        </div>

        <!-- CARDS -->

        <div class="dashboard-cards">

            <!-- PRODUCTS -->

            <div class="dashboard-card">

                <i class="fa-solid fa-burger"></i>

                <h2>

                    <?php echo $totalProducts; ?>

                </h2>

                <p>

                    Total Products

                </p>

            </div>

            <!-- ORDERS -->

            <div class="dashboard-card">

                <i class="fa-solid fa-cart-shopping"></i>

                <h2>

                    <?php echo $totalOrders; ?>

                </h2>

                <p>

                    Total Orders

                </p>

            </div>

            <!-- USERS -->

            <div class="dashboard-card">

                <i class="fa-solid fa-users"></i>

                <h2>

                    <?php echo $totalUsers; ?>

                </h2>

                <p>

                    Registered Users

                </p>

            </div>

            <!-- REVENUE -->

            <div class="dashboard-card">

                <i class="fa-solid fa-indian-rupee-sign"></i>

                <h2>

                    ₹<?php echo number_format($totalRevenue); ?>

                </h2>

                <p>

                    Total Revenue

                </p>

            </div>

        </div>

        <!-- =================================================
        TABLE
        ================================================== -->

        <div class="table-box">

            <div class="table-top">

                <h2>

                    Recent Orders

                </h2>

            </div>

            <table>

                <thead>

                    <tr>

                        <th>

                            Order ID

                        </th>

                        <th>

                            Customer

                        </th>

                        <th>

                            Amount

                        </th>

                        <th>

                            Payment

                        </th>

                        <th>

                            Status

                        </th>

                        <th>

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php while($order = mysqli_fetch_assoc($recentOrders)): ?>

                    <tr>

                        <td>

                            #<?php echo $order['id']; ?>

                        </td>

                        <td>

                            <?php echo $order['customer_name']; ?>

                        </td>

                        <td>

                            ₹<?php echo number_format($order['total_amount']); ?>

                        </td>

                        <td>

                            <?php echo $order['payment_method']; ?>

                        </td>

                        <td>

                            <div
                            class="status <?php echo $order['order_status']; ?>">

                                <?php echo ucfirst($order['order_status']); ?>

                            </div>

                        </td>

                        <td>

                            <button
                            class="action-btn">

                                View

                            </button>

                        </td>

                    </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>
</html>