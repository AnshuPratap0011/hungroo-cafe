<?php
/* =========================================================
   CONFIG & SESSION
========================================================= */

include "../config/config.php";

// LOGIN CHECK
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

/* =========================================================
   HELPERS
========================================================= */

function formatCurrency($amount)
{
    return '₹' . number_format((float)$amount, 2);
}

$currentPage = basename($_SERVER['PHP_SELF']);

/* =========================================================
   DATABASE COLUMN DETECTION
========================================================= */

$possible_price_columns = [
    'total_amount',
    'total',
    'subtotal',
    'sub_total',
    'amount',
    'price',
    'grand_total'
];

$working_price_column = null;

foreach ($possible_price_columns as $col) {

    $test = $conn->query("SHOW COLUMNS FROM orders LIKE '$col'");

    if ($test && $test->num_rows > 0) {

        $working_price_column = $col;
        break;
    }
}

// FALLBACK
if (!$working_price_column) {
    $working_price_column = 'total_amount';
}

/* =========================================================
   FETCH DATA
========================================================= */

// TOTAL PRODUCTS
$totalProducts = 0;

$productResult = $conn->query("
    SELECT COUNT(*) AS total 
    FROM products
");

if ($productResult) {

    $totalProducts =
        $productResult->fetch_assoc()['total'];
}

// TOTAL ORDERS
$totalOrders = 0;

$orderResult = $conn->query("
    SELECT COUNT(*) AS total 
    FROM orders
");

if ($orderResult) {

    $totalOrders =
        $orderResult->fetch_assoc()['total'];
}

// TOTAL USERS
$totalUsers = 0;

$userResult = $conn->query("
    SELECT COUNT(*) AS total 
    FROM users
");

if ($userResult) {

    $totalUsers =
        $userResult->fetch_assoc()['total'];
}

// TOTAL REVENUE
$totalRevenue = 0;

$revenueResult = $conn->query("
    SELECT SUM($working_price_column) AS total 
    FROM orders 
    WHERE status != 'cancelled'
");

if ($revenueResult) {

    $row = $revenueResult->fetch_assoc();

    $totalRevenue = $row['total'] ?? 0;
}

// RECENT ORDERS
$recentOrders = $conn->query("
    SELECT *,
    $working_price_column AS display_amount
    FROM orders
    ORDER BY id DESC
    LIMIT 5
");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Hungroo Admin Dashboard</title>

    <!-- GOOGLE FONT -->
    <link rel="preconnect"
        href="https://fonts.googleapis.com">

    <link rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CHART JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>

:root{

    --bg:#0b0b12;

    --card:#171726;

    --card2:#1d1d31;

    --sidebar:#131320;

    --white:#ffffff;

    --text:#9ca3af;

    --primary:#9b5cff;

    --primary2:#c084fc;

    --green:#10b981;

    --red:#ef4444;

    --blue:#3b82f6;

    --yellow:#facc15;

    --border:
    rgba(255,255,255,.06);

    --glass:
    rgba(255,255,255,.03);

}

*{

    margin:0;
    padding:0;

    box-sizing:border-box;

    font-family:'Poppins',sans-serif;

}

body{

    background:
    radial-gradient(circle at top right,#231942,#0b0b12 40%);

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

    width:270px;

    background:
    rgba(19,19,32,.88);

    backdrop-filter:blur(18px);

    border-right:
    1px solid rgba(255,255,255,.08);

    padding:26px 18px;

    position:fixed;

    top:0;
    left:0;

    height:100vh;

    box-shadow:
    0 0 40px rgba(0,0,0,.2);

}

.logo{

    font-size:26px;

    font-weight:800;

    margin-bottom:42px;

    padding-left:10px;

}

.logo span{

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--primary2)
    );

    -webkit-background-clip:text;

    -webkit-text-fill-color:
    transparent;

}

.menu-item{

    height:58px;

    display:flex;

    align-items:center;

    gap:14px;

    padding:0 18px;

    border-radius:18px;

    color:#d1d5db;

    transition:.35s;

    font-size:15px;

    font-weight:600;

    margin-bottom:10px;

    position:relative;

    overflow:hidden;

}

.menu-item::before{

    content:"";

    position:absolute;

    left:0;
    top:0;

    width:0;

    height:100%;

    background:
    linear-gradient(
    90deg,
    rgba(155,92,255,.18),
    transparent
    );

    transition:.35s;

}

.menu-item:hover::before,
.menu-item.active::before{

    width:100%;

}

.menu-item:hover,
.menu-item.active{

    color:#fff;

    transform:translateX(4px);

}

.menu-item i{

    color:var(--primary2);

    position:relative;

    z-index:2;

}

.menu-item span{

    position:relative;

    z-index:2;

}

/* =========================================================
MAIN
========================================================= */

.main{

    flex:1;

    margin-left:270px;

    padding:34px;

}

/* =========================================================
TOPBAR
========================================================= */

.topbar{

    display:flex;

    justify-content:space-between;

    align-items:center;

    margin-bottom:35px;

    flex-wrap:wrap;

    gap:20px;

}

.topbar h1{

    font-size:36px;

    margin-bottom:6px;

}

.topbar p{

    color:var(--text);

    font-size:14px;

}

.profile{

    display:flex;

    align-items:center;

    gap:14px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    padding:10px 18px;

    border-radius:60px;

    backdrop-filter:blur(14px);

}

.profile img{

    width:48px;
    height:48px;

    border-radius:50%;

    border:
    2px solid var(--primary2);

}

/* =========================================================
CARDS
========================================================= */

.cards{

    display:grid;

    grid-template-columns:
    repeat(auto-fit,minmax(240px,1fr));

    gap:22px;

    margin-bottom:32px;

}

.card{

    background:
    rgba(255,255,255,.04);

    border:
    1px solid rgba(255,255,255,.07);

    backdrop-filter:blur(18px);

    padding:28px;

    border-radius:26px;

    transition:.35s;

    position:relative;

    overflow:hidden;

}

.card::before{

    content:"";

    position:absolute;

    top:-50px;
    right:-50px;

    width:120px;
    height:120px;

    border-radius:50%;

    background:
    rgba(155,92,255,.08);

}

.card:hover{

    transform:
    translateY(-6px);

    border-color:
    rgba(155,92,255,.25);

}

.icon{

    width:65px;
    height:65px;

    border-radius:20px;

    display:flex;

    align-items:center;
    justify-content:center;

    margin-bottom:18px;

    font-size:24px;

}

.orange{

    background:
    rgba(251,146,60,.15);

    color:#fb923c;

}

.blue{

    background:
    rgba(59,130,246,.15);

    color:#3b82f6;

}

.green{

    background:
    rgba(16,185,129,.15);

    color:#10b981;

}

.purple{

    background:
    rgba(155,92,255,.15);

    color:#c084fc;

}

.card h2{

    font-size:32px;

    margin-bottom:6px;

}

.card p{

    color:var(--text);

    font-size:14px;

}

/* =========================================================
CHART + TABLE
========================================================= */

.chart-box,
.table-box{

    background:
    rgba(255,255,255,.04);

    border:
    1px solid rgba(255,255,255,.07);

    backdrop-filter:blur(18px);

    border-radius:28px;

    padding:28px;

    margin-bottom:30px;

}

.section-title{

    font-size:22px;

    margin-bottom:24px;

}

/* =========================================================
TABLE
========================================================= */

table{

    width:100%;

    border-collapse:collapse;

}

th,
td{

    padding:18px;

    text-align:left;

    border-bottom:
    1px solid rgba(255,255,255,.06);

}

th{

    color:var(--text);

    font-size:12px;

    text-transform:uppercase;

    letter-spacing:1px;

}

td{

    font-size:14px;

}

tr{

    transition:.25s;

}

tr:hover{

    background:
    rgba(255,255,255,.02);

}

/* =========================================================
BADGE
========================================================= */

.badge{

    padding:8px 14px;

    border-radius:999px;

    font-size:11px;

    font-weight:700;

    text-transform:uppercase;

}

.completed{

    background:
    rgba(16,185,129,.15);

    color:var(--green);

}

.pending{

    background:
    rgba(250,204,21,.15);

    color:var(--yellow);

}

.cancelled{

    background:
    rgba(239,68,68,.15);

    color:var(--red);

}

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:992px){

    .sidebar{

        width:100%;

        position:relative;

        height:auto;

    }

    .main{

        margin-left:0;

    }

    .admin-layout{

        flex-direction:column;

    }

}

@media(max-width:768px){

    .main{

        padding:18px;

    }

    .cards{

        grid-template-columns:1fr;

    }

    .topbar h1{

        font-size:30px;

    }

}

</style>

</head>

<body>

    <!-- SIDEBAR -->

    <div class="sidebar">

        <div class="logo">
            Hungroo <span>Admin</span>
        </div>

        <a href="dashboard.php"
            class="menu-item active">

            <i class="fa-solid fa-chart-pie"></i>
            Dashboard

        </a>

        <a href="products.php"
            class="menu-item">

            <i class="fa-solid fa-burger"></i>
            Products

        </a>

        <a href="orders.php"
            class="menu-item">

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

    <div class="main">

        <!-- TOPBAR -->

        <div class="topbar">

            <div>

                <h1>Dashboard Overview</h1>

                <p>
                    Welcome back,
                    <?php echo htmlspecialchars($_SESSION['admin_name'] ?? 'Admin'); ?>
                </p>

            </div>

            <div class="profile">

                <div>

                    <strong>Admin</strong>

                    <div style="font-size:12px;color:#9ca3af;">
                        Super Admin
                    </div>

                </div>

                <img src="https://i.pravatar.cc/150?img=11">

            </div>

        </div>

        <!-- STATS -->

        <div class="cards">

            <div class="card">

                <div class="icon orange">
                    <i class="fa-solid fa-burger"></i>
                </div>

                <h2><?php echo $totalProducts; ?></h2>

                <p>Total Products</p>

            </div>

            <div class="card">

                <div class="icon blue">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>

                <h2><?php echo $totalOrders; ?></h2>

                <p>Total Orders</p>

            </div>

            <div class="card">

                <div class="icon purple">
                    <i class="fa-solid fa-users"></i>
                </div>

                <h2><?php echo $totalUsers; ?></h2>

                <p>Total Users</p>

            </div>

            <div class="card">

                <div class="icon green">
                    <i class="fa-solid fa-indian-rupee-sign"></i>
                </div>

                <h2><?php echo formatCurrency($totalRevenue); ?></h2>

                <p>Total Revenue</p>

            </div>

        </div>

        <!-- CHART -->

        <div class="chart-box">

            <h2 class="section-title">
                Revenue Analytics
            </h2>

            <canvas id="revenueChart"></canvas>

        </div>

        <!-- RECENT ORDERS -->

        <div class="table-box">

            <h2 class="section-title">
                Recent Orders
            </h2>

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Payment</th>
                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                <?php if ($recentOrders && $recentOrders->num_rows > 0): ?>

                    <?php while ($order = $recentOrders->fetch_assoc()): ?>

                        <?php

                        $status =
                            strtolower($order['status']);

                        $badgeClass = "pending";

                        if (
                            $status == "completed" ||
                            $status == "delivered"
                        ) {
                            $badgeClass = "completed";
                        }

                        if ($status == "cancelled") {
                            $badgeClass = "cancelled";
                        }

                        ?>

                        <tr>

                            <td>
                                #<?php echo $order['id']; ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($order['customer_name']); ?>
                            </td>

                            <td>
                                <?php echo formatCurrency($order['display_amount']); ?>
                            </td>

                            <td>
                                <?php echo ucfirst($order['payment_method']); ?>
                            </td>

                            <td>

                                <span class="badge <?php echo $badgeClass; ?>">

                                    <?php echo ucfirst($status); ?>

                                </span>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="5"
                            style="text-align:center;color:#9ca3af;">

                            No orders found

                        </td>

                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- CHART JS -->

    <script>

        const ctx =
            document.getElementById('revenueChart');

        new Chart(ctx, {

            type: 'line',

            data: {

                labels: [
                    'Mon',
                    'Tue',
                    'Wed',
                    'Thu',
                    'Fri',
                    'Sat',
                    'Sun'
                ],

                datasets: [{

                    label: 'Revenue',

                    data: [
                        12000,
                        19000,
                        15000,
                        25000,
                        22000,
                        30000,
                        45000
                    ],

                    borderColor: '#ff9a3d',

                    backgroundColor: 'rgba(255,154,61,0.15)',

                    fill: true,

                    tension: 0.4

                }]

            },

            options: {

                responsive: true,

                plugins: {

                    legend: {
                        display: false
                    }

                },

                scales: {

                    x: {

                        ticks: {
                            color: '#9ca3af'
                        },

                        grid: {
                            display: false
                        }

                    },

                    y: {

                        ticks: {
                            color: '#9ca3af'
                        },

                        grid: {
                            color: 'rgba(255,255,255,0.05)'
                        }

                    }

                }

            }

        });

    </script>

</body>

</html>