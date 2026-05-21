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
    "Location: reservations.php"
    );

    exit();

}

$id =

intval(
$_GET['id']
);

/* =========================================================
GET RESERVATION
========================================================= */

$query =

"SELECT * FROM reservations
WHERE id='$id'
LIMIT 1";

$result =

mysqli_query(
$conn,
$query
);

if(mysqli_num_rows($result) < 1){

    header(
    "Location: reservations.php"
    );

    exit();

}

$reservation =

mysqli_fetch_assoc(
$result
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

View Reservation

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
CARD
========================================================= */

.reservation-card{

    width:100%;

    max-width:900px;

    padding:34px;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

/* =========================================================
INFO
========================================================= */

.info-row{

    display:flex;

    justify-content:space-between;

    gap:20px;

    padding:
    20px 0;

    border-bottom:
    1px solid var(--border);

}

.info-row span{

    color:var(--text);

}

.info-row strong{

    text-align:right;

    max-width:500px;

}

/* =========================================================
STATUS
========================================================= */

.status{

    width:max-content;

    padding:
    8px 16px;

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
    rgba(76,175,80,.12);

    color:#4caf50;

}

.cancelled{

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

    .reservation-card{

        padding:24px;

        border-radius:24px;

    }

    .page-top h1{

        font-size:32px;

    }

    .info-row{

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

            <a href="orders.php">

                <i class="fa-solid fa-cart-shopping"></i>

                Orders

            </a>

            <a
            href="reservations.php"

            class="active">

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

                    Reservation Details

                </h1>

                <p>

                    Full reservation information

                </p>

            </div>

            <a
            href="reservations.php"

            class="back-btn">

                <i class="fa-solid fa-arrow-left"></i>

                Back

            </a>

        </div>

        <!-- CARD -->

        <div class="reservation-card">

            <div class="info-row">

                <span>

                    Customer Name

                </span>

                <strong>

                    <?php echo $reservation['full_name']; ?>

                </strong>

            </div>

            <div class="info-row">

                <span>

                    Phone Number

                </span>

                <strong>

                    <?php echo $reservation['phone']; ?>

                </strong>

            </div>

            <div class="info-row">

                <span>

                    Email Address

                </span>

                <strong>

                    <?php echo $reservation['email']; ?>

                </strong>

            </div>

            <div class="info-row">

                <span>

                    Total People

                </span>

                <strong>

                    <?php echo $reservation['total_people']; ?>

                </strong>

            </div>

            <div class="info-row">

                <span>

                    Reservation Date

                </span>

                <strong>

                    <?php echo $reservation['reservation_date']; ?>

                </strong>

            </div>

            <div class="info-row">

                <span>

                    Reservation Time

                </span>

                <strong>

                    <?php echo $reservation['reservation_time']; ?>

                </strong>

            </div>

            <div class="info-row">

                <span>

                    Special Note

                </span>

                <strong>

                    <?php echo $reservation['special_note']; ?>

                </strong>

            </div>

            <div class="info-row">

                <span>

                    Status

                </span>

                <strong>

                    <div
                    class="status <?php echo $reservation['status']; ?>">

                        <?php echo ucfirst($reservation['status']); ?>

                    </div>

                </strong>

            </div>

        </div>

    </main>

</div>

</body>
</html>