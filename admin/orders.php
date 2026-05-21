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
UPDATE STATUS
========================================================= */

if(isset($_GET['status']) && isset($_GET['id'])){

    $status =

    mysqli_real_escape_string(
    $conn,
    $_GET['status']
    );

    $id =

    intval($_GET['id']);

    $updateQuery =

    "UPDATE orders

    SET order_status='$status'

    WHERE id='$id'";

    mysqli_query(
    $conn,
    $updateQuery
    );

    header(
    "Location: orders.php"
    );

    exit();

}

/* =========================================================
GET ORDERS
========================================================= */

$orderQuery =

"SELECT * FROM orders
ORDER BY id DESC";

$orderResult =

mysqli_query(
$conn,
$orderQuery
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

Manage Orders

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

}

.page-top h1{

    font-size:42px;

}

.page-top p{

    color:var(--text);

    margin-top:8px;

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

table{

    width:100%;

    border-collapse:collapse;

}

table th{

    text-align:left;

    padding:16px;

    border-bottom:
    1px solid var(--border);

    color:var(--text);

    font-size:14px;

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

.pending{

    background:
    rgba(255,193,7,.12);

    color:#ffc107;

}

.confirmed{

    background:
    rgba(33,150,243,.12);

    color:#2196f3;

}

.preparing{

    background:
    rgba(255,152,0,.12);

    color:#ff9800;

}

.out_for_delivery{

    background:
    rgba(156,39,176,.12);

    color:#9c27b0;

}

.delivered{

    background:
    rgba(76,175,80,.12);

    color:#4caf50;

}

.cancelled{

    background:
    rgba(255,77,77,.12);

    color:#ff4d4d;

}

/* =========================================================
BUTTONS
========================================================= */

.action-buttons{

    display:flex;

    flex-wrap:wrap;

    gap:10px;

}

.action-btn{

    min-width:120px;

    height:40px;

    border:none;

    cursor:pointer;

    padding:
    0 14px;

    border-radius:14px;

    color:#000;

    font-size:12px;

    font-weight:700;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

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

}

</style>

</head>

<body>

<div class="admin-layout">

    <!-- =====================================================
    SIDEBAR
    ====================================================== -->

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

        <!-- TOP -->

        <div class="page-top">

            <div>

                <h1>

                    Manage Orders

                </h1>

                <p>

                    Track and manage customer orders

                </p>

            </div>

        </div>

        <!-- =================================================
        TABLE
        ================================================== -->

        <div class="table-box">

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

                            Phone

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

                    <?php while($order = mysqli_fetch_assoc($orderResult)): ?>

                    <tr>

                        <td>

                            #<?php echo $order['id']; ?>

                        </td>

                        <td>

                            <?php echo $order['customer_name']; ?>

                        </td>

                        <td>

                            <?php echo $order['customer_phone']; ?>

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

                                <?php echo ucfirst(str_replace('_',' ',$order['order_status'])); ?>

                            </div>

                        </td>

                        <td>

                            <div class="action-buttons">

                                <a
                                href="?id=<?php echo $order['id']; ?>&status=confirmed">

                                    <button
                                    class="action-btn">

                                        Confirm

                                    </button>

                                </a>

                                <a
                                href="?id=<?php echo $order['id']; ?>&status=preparing">

                                    <button
                                    class="action-btn">

                                        Preparing

                                    </button>

                                </a>

                                <a
                                href="?id=<?php echo $order['id']; ?>&status=out_for_delivery">

                                    <button
                                    class="action-btn">

                                        Delivery

                                    </button>

                                </a>

                                <a
                                href="?id=<?php echo $order['id']; ?>&status=delivered">

                                    <button
                                    class="action-btn">

                                        Delivered

                                    </button>

                                </a>

                                <a
                                href="?id=<?php echo $order['id']; ?>&status=cancelled">

                                    <button
                                    class="action-btn">

                                        Cancel

                                    </button>

                                </a>

                            </div>

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