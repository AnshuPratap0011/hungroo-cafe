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

$admin_id =

$_SESSION['admin_id'];

/* =========================================================
UPDATE PROFILE
========================================================= */

if(isset($_POST['update_profile'])){

    $admin_name =

    mysqli_real_escape_string(
    $conn,
    $_POST['admin_name']
    );

    $admin_email =

    mysqli_real_escape_string(
    $conn,
    $_POST['admin_email']
    );

    /* =====================================================
    PASSWORD
    ====================================================== */

    $new_password =

    $_POST['new_password'];

    /* =====================================================
    UPDATE WITH PASSWORD
    ====================================================== */

    if(!empty($new_password)){

        $hashedPassword =

        md5($new_password);

        $updateQuery =

        "UPDATE admins SET

        admin_name='$admin_name',
        admin_email='$admin_email',
        admin_password='$hashedPassword'

        WHERE id='$admin_id'";

    }

    /* =====================================================
    UPDATE NORMAL
    ====================================================== */

    else{

        $updateQuery =

        "UPDATE admins SET

        admin_name='$admin_name',
        admin_email='$admin_email'

        WHERE id='$admin_id'";

    }

    mysqli_query(
    $conn,
    $updateQuery
    );

    $success = true;

}

/* =========================================================
GET ADMIN
========================================================= */

$query =

"SELECT * FROM admins
WHERE id='$admin_id'
LIMIT 1";

$result =

mysqli_query(
$conn,
$query
);

$admin =

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

Admin Profile

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
PROFILE BOX
========================================================= */

.profile-box{

    width:100%;

    max-width:850px;

    padding:34px;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

/* =========================================================
SUCCESS
========================================================= */

.success-box{

    margin-bottom:24px;

    padding:18px;

    border-radius:18px;

    background:
    rgba(76,175,80,.12);

    border:
    1px solid rgba(76,175,80,.18);

    color:#4caf50;

    font-size:14px;

    font-weight:600;

}

/* =========================================================
FORM
========================================================= */

.form-group{

    margin-bottom:24px;

}

.form-group label{

    display:block;

    margin-bottom:10px;

    font-size:14px;

    font-weight:600;

}

.form-group input{

    width:100%;

    height:60px;

    border:none;

    outline:none;

    padding:
    0 18px;

    border-radius:18px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:#fff;

    font-size:14px;

    font-family:'Poppins',sans-serif;

}

/* =========================================================
BUTTON
========================================================= */

.update-btn{

    width:100%;

    height:60px;

    border:none;

    cursor:pointer;

    border-radius:18px;

    background:
    linear-gradient(
    135deg,
    var(--primary),
    var(--gold)
    );

    color:#000;

    font-size:15px;

    font-weight:800;

}

/* =========================================================
RESPONSIVE
========================================================= */

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

    .profile-box{

        padding:24px;

        border-radius:24px;

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

            <a
            href="profile.php"

            class="active">

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

                Admin Profile

            </h1>

            <p>

                Manage admin account details

            </p>

        </div>

        <div class="profile-box">

            <?php if(isset($success)): ?>

            <div class="success-box">

                Profile updated successfully.

            </div>

            <?php endif; ?>

            <form method="POST">

                <div class="form-group">

                    <label>

                        Admin Name

                    </label>

                    <input
                    type="text"

                    name="admin_name"

                    value="<?php echo $admin['admin_name']; ?>"

                    required>

                </div>

                <div class="form-group">

                    <label>

                        Admin Email

                    </label>

                    <input
                    type="email"

                    name="admin_email"

                    value="<?php echo $admin['admin_email']; ?>"

                    required>

                </div>

                <div class="form-group">

                    <label>

                        New Password

                    </label>

                    <input
                    type="password"

                    name="new_password"

                    placeholder="Leave empty if no change">

                </div>

                <button
                type="submit"

                name="update_profile"

                class="update-btn">

                    Update Profile

                </button>

            </form>

        </div>

    </main>

</div>

</body>
</html>