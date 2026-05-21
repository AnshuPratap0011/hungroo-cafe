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
DELETE PRODUCT
========================================================= */

if(isset($_GET['delete'])){

    $deleteId =

    intval($_GET['delete']);

    $deleteQuery =

    "DELETE FROM products
    WHERE id='$deleteId'";

    mysqli_query(
    $conn,
    $deleteQuery
    );

    header(
    "Location: products.php"
    );

    exit();

}

/* =========================================================
ADD PRODUCT
========================================================= */

if(isset($_POST['add_product'])){

    $name =

    mysqli_real_escape_string(
    $conn,
    $_POST['name']
    );

    $slug =

    strtolower(
    trim(
    preg_replace(
    '/[^A-Za-z0-9-]+/',
    '-',
    $name
    ))
    );

    $description =

    mysqli_real_escape_string(
    $conn,
    $_POST['description']
    );

    $short_description =

    mysqli_real_escape_string(
    $conn,
    $_POST['short_description']
    );

    $category =

    mysqli_real_escape_string(
    $conn,
    $_POST['category']
    );

    $price =

    $_POST['price'];

    $old_price =

    $_POST['old_price'];

    $tag =

    mysqli_real_escape_string(
    $conn,
    $_POST['tag']
    );

    $image =

    mysqli_real_escape_string(
    $conn,
    $_POST['image']
    );

    /* =====================
    INSERT
    ===================== */

    $insertQuery =

    "INSERT INTO products (

        name,
        slug,
        description,
        short_description,
        category,
        price,
        old_price,
        image,
        tag,
        is_featured,
        is_popular,
        status

    )

    VALUES (

        '$name',
        '$slug',
        '$description',
        '$short_description',
        '$category',
        '$price',
        '$old_price',
        '$image',
        '$tag',
        1,
        1,
        'active'

    )";

    mysqli_query(
    $conn,
    $insertQuery
    );

    header(
    "Location: products.php"
    );

    exit();

}

/* =========================================================
GET PRODUCTS
========================================================= */

$productQuery =

"SELECT * FROM products
ORDER BY id DESC";

$productResult =

mysqli_query(
$conn,
$productQuery
);

/* =========================================================
GET CATEGORIES
========================================================= */

$categoryQuery =

"SELECT * FROM categories
ORDER BY name ASC";

$categoryResult =

mysqli_query(
$conn,
$categoryQuery
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

Manage Products

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

    --card:#111111;

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
FORM
========================================================= */

.product-form{

    padding:28px;

    border-radius:28px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    margin-bottom:30px;

}

.form-grid{

    display:grid;

    grid-template-columns:
    repeat(2,1fr);

    gap:20px;

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

    padding:16px 18px;

    border-radius:18px;

    background:
    rgba(255,255,255,.04);

    border:
    1px solid var(--border);

    color:#fff;

    font-size:14px;

}

.form-group textarea{

    height:120px;

    resize:none;

}

/* =========================================================
BUTTON
========================================================= */

.submit-btn{

    width:220px;

    height:58px;

    margin-top:26px;

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

    color:var(--text);

    border-bottom:
    1px solid var(--border);

}

table td{

    padding:18px 16px;

    border-bottom:
    1px solid var(--border);

}

.product-img{

    width:72px;
    height:72px;

    border-radius:18px;

    object-fit:cover;

}

/* =========================================================
ACTION
========================================================= */

.action-buttons{

    display:flex;

    gap:10px;

}

.action-btn{

    min-width:90px;

    height:40px;

    border:none;

    cursor:pointer;

    padding:
    0 16px;

    border-radius:14px;

    color:#fff;

    font-size:13px;

    font-weight:700;

}

.edit-btn{

    background:#1e88e5;

}

.delete-btn{

    background:#ff4d4d;

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

    .form-grid{

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

                    Manage Products

                </h1>

                <p>

                    Add and manage café items

                </p>

            </div>

        </div>

        <!-- =================================================
        FORM
        ================================================== -->

        <div class="product-form">

            <form method="POST">

                <div class="form-grid">

                    <!-- NAME -->

                    <div class="form-group">

                        <label>

                            Product Name

                        </label>

                        <input
                        type="text"

                        name="name"

                        required>

                    </div>

                    <!-- CATEGORY -->

                    <div class="form-group">

                        <label>

                            Category

                        </label>

                        <select
                        name="category"

                        required>

                            <?php while($category = mysqli_fetch_assoc($categoryResult)): ?>

                            <option
                            value="<?php echo $category['name']; ?>">

                                <?php echo $category['name']; ?>

                            </option>

                            <?php endwhile; ?>

                        </select>

                    </div>

                    <!-- PRICE -->

                    <div class="form-group">

                        <label>

                            Price

                        </label>

                        <input
                        type="number"

                        name="price"

                        required>

                    </div>

                    <!-- OLD PRICE -->

                    <div class="form-group">

                        <label>

                            Old Price

                        </label>

                        <input
                        type="number"

                        name="old_price">

                    </div>

                    <!-- TAG -->

                    <div class="form-group">

                        <label>

                            Tag

                        </label>

                        <input
                        type="text"

                        name="tag"

                        placeholder="Best Seller">

                    </div>

                    <!-- IMAGE -->

                    <div class="form-group">

                        <label>

                            Image URL

                        </label>

                        <input
                        type="text"

                        name="image"

                        required>

                    </div>

                    <!-- SHORT -->

                    <div class="form-group full">

                        <label>

                            Short Description

                        </label>

                        <textarea
                        name="short_description"

                        required></textarea>

                    </div>

                    <!-- DESC -->

                    <div class="form-group full">

                        <label>

                            Full Description

                        </label>

                        <textarea
                        name="description"

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

        <!-- =================================================
        TABLE
        ================================================== -->

        <div class="table-box">

            <table>

                <thead>

                    <tr>

                        <th>

                            Image

                        </th>

                        <th>

                            Product

                        </th>

                        <th>

                            Category

                        </th>

                        <th>

                            Price

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

                    <?php while($product = mysqli_fetch_assoc($productResult)): ?>

                    <tr>

                        <td>

                            <img
                            src="<?php echo $product['image']; ?>"

                            class="product-img"

                            alt="Product">

                        </td>

                        <td>

                            <?php echo $product['name']; ?>

                        </td>

                        <td>

                            <?php echo $product['category']; ?>

                        </td>

                        <td>

                            ₹<?php echo $product['price']; ?>

                        </td>

                        <td>

                            <?php echo ucfirst($product['status']); ?>

                        </td>

                        <td>

                            <div class="action-buttons">

                                <button
                                class="action-btn edit-btn">

                                    Edit

                                </button>

                                <a
                                href="?delete=<?php echo $product['id']; ?>"

                                onclick=
                                "return confirm(
                                'Delete product?'
                                )">

                                    <button
                                    class="action-btn delete-btn">

                                        Delete

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