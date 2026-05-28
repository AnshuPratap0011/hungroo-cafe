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
   UPDATE STATUS
========================================================= */

if (isset($_GET['status']) && isset($_GET['id'])) {

    $status = mysqli_real_escape_string(
        $conn,
        $_GET['status']
    );

    $id = intval($_GET['id']);

    $updateQuery = "

    UPDATE orders SET

    status='$status'

    WHERE id='$id'

    ";

    mysqli_query(
        $conn,
        $updateQuery
    );

    header("Location: orders.php");
    exit();
}

/* =========================================================
   GET ORDERS
========================================================= */

$query = "

SELECT *
FROM orders
ORDER BY id DESC

";

$result = mysqli_query(
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

Hungroo Orders

</title>

<!-- GOOGLE FONT -->

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

    background:var(--card);

    border:
    1px solid var(--border);

    backdrop-filter:blur(12px);

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

    vertical-align:top;

}

table tr:hover{

    background:
    rgba(255,255,255,.02);

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
    rgba(250,204,21,.12);

    color:var(--yellow);

}

.confirmed{

    background:
    rgba(59,130,246,.12);

    color:var(--blue);

}

.completed{

    background:
    rgba(16,185,129,.12);

    color:var(--green);

}

.cancelled{

    background:
    rgba(239,68,68,.12);

    color:var(--red);

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

    transition:.3s;

}

.view-btn{

    background:
    rgba(155,92,255,.12);

    color:var(--primary2);

}

.complete-btn{

    background:
    rgba(16,185,129,.12);

    color:var(--green);

}

.cancel-btn{

    background:
    rgba(239,68,68,.12);

    color:var(--red);

}

.action-btn:hover{

    transform:translateY(-2px);

}

/* =========================================================
   CUSTOMER
========================================================= */

.customer-box{

    display:flex;

    flex-direction:column;

    gap:4px;

}

.customer-name{

    font-weight:700;

}

.customer-address{

    color:var(--text);

    font-size:12px;

    line-height:1.5;

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

                        <th>Order</th>
                        <th>Customer</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while($row = mysqli_fetch_assoc($result)): ?>

                    <?php

                    $statusClass = strtolower(
                        $row['status']
                    );

                    ?>

                    <tr>

                        <!-- ORDER -->

                        <td>

                            <strong>

                                #<?php echo $row['order_number']; ?>

                            </strong>

                            <br><br>

                            <span
                            style="color:var(--text);font-size:12px;">

                                <?php echo $row['created_at']; ?>

                            </span>

                        </td>

                        <!-- CUSTOMER -->

                        <td>

                            <div class="customer-box">

                                <div class="customer-name">

                                    <?php

                                    echo !empty(
                                        $row['customer_name']
                                    )

                                    ? $row['customer_name']

                                    : "Guest";

                                    ?>

                                </div>

                                <div class="customer-address">

                                    <?php

                                    echo $row['delivery_address'];

                                    ?>

                                </div>

                            </div>

                        </td>

                        <!-- TOTAL -->

                        <td>

                            <strong>

                                ₹<?php

                                echo number_format(
                                    $row['total']
                                );

                                ?>

                            </strong>

                        </td>

                        <!-- PAYMENT -->

                        <td>

                            <?php

                            echo strtoupper(
                                $row['payment_method']
                            );

                            ?>

                            <br><br>

                            <span
                            style="color:var(--green);font-size:12px;">

                                <?php

                                echo ucfirst(
                                    $row['payment_status']
                                );

                                ?>

                            </span>

                        </td>

                        <!-- STATUS -->

                        <td>

                            <div
                            class="status <?php echo $statusClass; ?>">

                                <?php

                                echo ucfirst(
                                    $row['status']
                                );

                                ?>

                            </div>

                        </td>

                        <!-- ACTION -->

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