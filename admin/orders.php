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

    intval(
    $_GET['id']
    );

    $updateQuery =

    "UPDATE orders SET

    order_status='$status'

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

$query =

"SELECT * FROM orders
ORDER BY id DESC";

$result =

mysqli_query(
$conn,
$query
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

Orders

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

    overflow-x:auto;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

table{

    width:100%;

    border-collapse:collapse;

}

table th{

    padding:22px;

    text-align:left;

    font-size:14px;

    color:var(--text);

    border-bottom:
    1px solid var(--border);

}

table td{

    padding:22px;

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

.processing{

    background:
    rgba(0,123,255,.12);

    color:#4da3ff;

}

.completed{

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

.actions{

    display:flex;

    flex-wrap:wrap;

    gap:10px;

}

.action-btn{

    min-width:90px;

    height:42px;

    border:none;

    border-radius:14px;

    display:flex;

    align-items:center;
    justify-content:center;

    text-decoration:none;

    font-size:12px;

    font-weight:700;

}

.view-btn{

    background:
    rgba(255,154,61,.12);

    color:#ffb15e;

}

.complete-btn{

    background:
    rgba(76,175,80,.12);

    color:#4caf50;

}

.cancel-btn{

    background:
    rgba(255,77,77,.12);

    color:#ff4d4d;

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

            <a href="profile.php">

                <i class="fa-solid fa-user"></i>

                Profile

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

            <h1>

                Orders

            </h1>

            <p>

                Manage all customer orders

            </p>

        </div>

        <!-- TABLE -->

        <div class="table-box">

            <table>

                <thead>

                    <tr>

                        <th>ID</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while($row = mysqli_fetch_assoc($result)): ?>

                    <tr>

                        <td>

                            #<?php echo $row['id']; ?>

                        </td>

                        <td>

                            <?php echo $row['customer_name']; ?>

                        </td>

                        <td>

                            <?php echo $row['customer_phone']; ?>

                        </td>

                        <td>

                            ₹<?php echo number_format($row['total_amount']); ?>

                        </td>

                        <td>

                            <?php echo $row['payment_method']; ?>

                        </td>

                        <td>

                            <div
                            class="status <?php echo $row['order_status']; ?>">

                                <?php echo ucfirst($row['order_status']); ?>

                            </div>

                        </td>

                        <td>

                            <div class="actions">

                                <a
                                href="view_order.php?id=<?php echo $row['id']; ?>"

                                class="action-btn view-btn">

                                    View

                                </a>

                                <a
                                href="?id=<?php echo $row['id']; ?>&status=completed"

                                class="action-btn complete-btn">

                                    Done

                                </a>

                                <a
                                href="?id=<?php echo $row['id']; ?>&status=cancelled"

                                class="action-btn cancel-btn">

                                    Cancel

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