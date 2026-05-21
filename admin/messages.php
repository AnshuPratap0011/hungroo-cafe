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
DELETE MESSAGE
========================================================= */

if(isset($_GET['delete'])){

    $id =

    intval(
    $_GET['delete']
    );

    $deleteQuery =

    "DELETE FROM contact_messages
    WHERE id='$id'";

    mysqli_query(
    $conn,
    $deleteQuery
    );

    header(
    "Location: messages.php"
    );

    exit();

}

/* =========================================================
GET MESSAGES
========================================================= */

$query =

"SELECT * FROM contact_messages
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

Customer Messages

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
GRID
========================================================= */

.message-grid{

    display:grid;

    grid-template-columns:
    repeat(auto-fill,minmax(360px,1fr));

    gap:24px;

}

/* =========================================================
CARD
========================================================= */

.message-card{

    padding:28px;

    border-radius:30px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

.message-card-top{

    display:flex;

    align-items:flex-start;
    justify-content:space-between;

    gap:14px;

    margin-bottom:24px;

}

.message-card-top h3{

    font-size:22px;

    margin-bottom:8px;

}

.message-card-top p{

    color:var(--text);

    font-size:14px;

}

.message-subject{

    margin-bottom:20px;

    padding:14px 18px;

    border-radius:18px;

    background:
    rgba(255,154,61,.08);

    border:
    1px solid rgba(255,154,61,.10);

    color:#ffb15e;

    font-size:14px;

    font-weight:600;

}

.message-text{

    color:#d7d7d7;

    line-height:1.9;

    font-size:14px;

    margin-bottom:24px;

}

.message-actions{

    display:flex;

    gap:12px;

}

.action-btn{

    flex:1;

    height:52px;

    border:none;

    cursor:pointer;

    border-radius:16px;

    text-decoration:none;

    display:flex;

    align-items:center;
    justify-content:center;

    font-size:14px;

    font-weight:700;

}

.reply-btn{

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

}

.delete-btn{

    background:
    rgba(255,77,77,.12);

    border:
    1px solid rgba(255,77,77,.16);

    color:#ff4d4d;

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

    .message-grid{

        grid-template-columns:1fr;

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

            <a href="orders.php">

                <i class="fa-solid fa-cart-shopping"></i>

                Orders

            </a>

            <a href="reservations.php">

                <i class="fa-solid fa-calendar-check"></i>

                Reservations

            </a>

            <a
            href="messages.php"

            class="active">

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

        <div class="page-top">

            <h1>

                Customer Messages

            </h1>

            <p>

                Manage all customer contact messages

            </p>

        </div>

        <!-- GRID -->

        <div class="message-grid">

            <?php while($row = mysqli_fetch_assoc($result)): ?>

            <div class="message-card">

                <div class="message-card-top">

                    <div>

                        <h3>

                            <?php echo $row['full_name']; ?>

                        </h3>

                        <p>

                            <?php echo $row['email']; ?>

                        </p>

                    </div>

                </div>

                <div class="message-subject">

                    <?php echo $row['subject']; ?>

                </div>

                <div class="message-text">

                    <?php echo nl2br($row['message']); ?>

                </div>

                <div class="message-actions">

                    <a
                    href="mailto:<?php echo $row['email']; ?>"

                    class="action-btn reply-btn">

                        Reply

                    </a>

                    <a
                    href="?delete=<?php echo $row['id']; ?>"

                    class="action-btn delete-btn">

                        Delete

                    </a>

                </div>

            </div>

            <?php endwhile; ?>

        </div>

    </main>

</div>

</body>
</html>