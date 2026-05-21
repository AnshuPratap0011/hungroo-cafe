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
ADD PRODUCT
========================================================= */

if(isset($_POST['add_product'])){

    $product_name =

    mysqli_real_escape_string(
    $conn,
    $_POST['product_name']
    );

    $product_category =

    mysqli_real_escape_string(
    $conn,
    $_POST['product_category']
    );

    $product_price =

    mysqli_real_escape_string(
    $conn,
    $_POST['product_price']
    );

    $product_description =

    mysqli_real_escape_string(
    $conn,
    $_POST['product_description']
    );

    /* =====================================================
    IMAGE
    ====================================================== */

    $image_name =

    $_FILES['product_image']['name'];

    $image_tmp =

    $_FILES['product_image']['tmp_name'];

    $image_ext =

    strtolower(
    pathinfo(
    $image_name,
    PATHINFO_EXTENSION
    )
    );

    $new_image_name =

    time() .
    rand(1000,9999) .
    "." .
    $image_ext;

    $upload_path =

    "../assets/images/" .
    $new_image_name;

    move_uploaded_file(

        $image_tmp,
        $upload_path

    );

    /* =====================================================
    INSERT
    ====================================================== */

    $insertQuery =

    "INSERT INTO products (

        product_name,
        product_category,
        product_price,
        product_description,
        product_image

    )

    VALUES (

        '$product_name',
        '$product_category',
        '$product_price',
        '$product_description',
        '$new_image_name'

    )";

    mysqli_query(
    $conn,
    $insertQuery
    );

    $success = true;

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Add Product

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
FORM
========================================================= */

.form-box{

    width:100%;

    max-width:900px;

    padding:34px;

    border-radius:34px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

}

.form-grid{

    display:grid;

    grid-template-columns:
    repeat(2,1fr);

    gap:22px;

}

.form-group{

    display:flex;

    flex-direction:column;

    gap:10px;

}

.form-group.full{

    grid-column:1/-1;

}

.form-group label{

    font-size:14px;

    font-weight:600;

}

.form-group input,
.form-group textarea,
.form-group select{

    width:100%;

    border:none;

    outline:none;

    padding:18px;

    border-radius:18px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:#fff;

    font-size:14px;

    font-family:'Poppins',sans-serif;

}

.form-group textarea{

    height:150px;

    resize:none;

}

.form-group select option{

    background:#111;

}

/* =========================================================
BUTTON
========================================================= */

.submit-btn{

    width:100%;

    height:60px;

    margin-top:28px;

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

    .form-box{

        padding:24px;

        border-radius:24px;

    }

    .form-grid{

        grid-template-columns:1fr;

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

            <a
            href="products.php"

            class="active">

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

                Add Product

            </h1>

            <p>

                Add new café menu item

            </p>

        </div>

        <div class="form-box">

            <?php if(isset($success)): ?>

            <div class="success-box">

                Product added successfully.

            </div>

            <?php endif; ?>

            <form
            method="POST"

            enctype="multipart/form-data">

                <div class="form-grid">

                    <div class="form-group">

                        <label>

                            Product Name

                        </label>

                        <input
                        type="text"

                        name="product_name"

                        required>

                    </div>

                    <div class="form-group">

                        <label>

                            Category

                        </label>

                        <select
                        name="product_category"

                        required>

                            <option value="Burger">

                                Burger

                            </option>

                            <option value="Pizza">

                                Pizza

                            </option>

                            <option value="Coffee">

                                Coffee

                            </option>

                            <option value="Dessert">

                                Dessert

                            </option>

                            <option value="Drinks">

                                Drinks

                            </option>

                        </select>

                    </div>

                    <div class="form-group">

                        <label>

                            Product Price

                        </label>

                        <input
                        type="number"

                        name="product_price"

                        required>

                    </div>

                    <div class="form-group">

                        <label>

                            Product Image

                        </label>

                        <input
                        type="file"

                        name="product_image"

                        required>

                    </div>

                    <div class="form-group full">

                        <label>

                            Product Description

                        </label>

                        <textarea
                        name="product_description"

                        required></textarea>

                    </div>

                </div>

                <button
                type="submit"

                name="add_product"

                class="submit-btn">

                    Add Product

                </button>

            </form>

        </div>

    </main>

</div>

</body>
</html>