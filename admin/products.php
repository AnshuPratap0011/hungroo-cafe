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
   IMAGE UPLOAD
========================================================= */

$uploadDir = "../uploads/";

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

/* =========================================================
   DELETE PRODUCT
========================================================= */

if (isset($_GET['delete'])) {

    $deleteId = intval($_GET['delete']);

    mysqli_query(
        $conn,
        "DELETE FROM products WHERE id='$deleteId'"
    );

    header("Location: products.php");
    exit();
}

/* =========================================================
   ADD PRODUCT
========================================================= */

if (isset($_POST['add_product'])) {

    $name = mysqli_real_escape_string(
        $conn,
        $_POST['name']
    );

    $slug = strtolower(
        trim(
            preg_replace(
                '/[^A-Za-z0-9-]+/',
                '-',
                $name
            )
        )
    );

    $category = mysqli_real_escape_string(
        $conn,
        $_POST['category']
    );

    $description = mysqli_real_escape_string(
        $conn,
        $_POST['description']
    );

    $price = $_POST['price'];

    $original_price = !empty($_POST['original_price'])
        ? $_POST['original_price']
        : 0;

    $preparation_time = !empty($_POST['preparation_time'])
        ? $_POST['preparation_time']
        : 10;

    /* =====================================================
       IMAGE URL OR FILE
    ===================================================== */

    $image = "";

    // IMAGE URL
    if (!empty($_POST['image_url'])) {

        $image = mysqli_real_escape_string(
            $conn,
            $_POST['image_url']
        );
    }

    // IMAGE FILE
    if (
        isset($_FILES['image_file']) &&
        $_FILES['image_file']['error'] == 0
    ) {

        $fileName = time() . "_" .
        basename($_FILES["image_file"]["name"]);

        $targetFile =
        $uploadDir . $fileName;

        move_uploaded_file(
            $_FILES["image_file"]["tmp_name"],
            $targetFile
        );

        $image =
        "../uploads/" . $fileName;
    }

    /* =====================================================
       INSERT
    ===================================================== */

    $insertQuery = "

    INSERT INTO products (

        name,
        slug,
        category,
        description,
        price,
        original_price,
        image,
        status,
        is_featured,
        is_trending,
        rating,
        preparation_time

    )

    VALUES (

        '$name',
        '$slug',
        '$category',
        '$description',
        '$price',
        '$original_price',
        '$image',
        'active',
        1,
        1,
        4.5,
        '$preparation_time'

    )

    ";

    mysqli_query(
        $conn,
        $insertQuery
    );

    header("Location: products.php");
    exit();
}

/* =========================================================
   GET PRODUCTS
========================================================= */

$productQuery = "

SELECT *
FROM products
ORDER BY id DESC

";

$productResult = mysqli_query(
    $conn,
    $productQuery
);

/* =========================================================
   CATEGORIES
========================================================= */

$categories = [

    "Burgers",
    "Pizza",
    "Coffee",
    "Desserts",
    "Cold Drinks",
    "Snacks",
    "Wraps",
    "Breakfast"

];

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Hungroo Products

</title>

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

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

    display:flex;

    justify-content:space-between;

    align-items:center;

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

    background:var(--card);

    border:
    1px solid var(--border);

    margin-bottom:30px;

    transition:.3s;

    backdrop-filter:blur(14px);

}

.product-form:hover{

    border-color:
    rgba(155,92,255,.3);

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

    background:#0d0d16;

    border:
    1px solid rgba(255,255,255,.08);

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
    var(--primary2)
    );

    color:#fff;

    font-size:15px;

    font-weight:800;

    transition:.3s;

    box-shadow:
    0 10px 30px
    rgba(155,92,255,.3);

}

.submit-btn:hover{

    transform:translateY(-2px);

}

/* =========================================================
   TABLE
========================================================= */

.table-box{

    padding:26px;

    border-radius:28px;

    background:var(--card);

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

    background:#111;

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

    padding:0 16px;

    border-radius:14px;

    color:#fff;

    font-size:13px;

    font-weight:700;

}

.edit-btn{

    background:var(--blue);

}

.delete-btn{

    background:var(--red);

}

.status-active{

    color:var(--green);

    font-weight:700;

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
            class="menu-item active">

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

    <main class="main-content">

        <div class="page-top">

            <div>

                <h1>

                    Manage Products

                </h1>

                <p>

                    Add and manage café products

                </p>

            </div>

        </div>

        <!-- FORM -->

        <div class="product-form">

            <form
            method="POST"
            enctype="multipart/form-data">

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

                            <?php foreach($categories as $category): ?>

                            <option
                            value="<?php echo $category; ?>">

                                <?php echo $category; ?>

                            </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- PRICE -->

                    <div class="form-group">

                        <label>

                            Price

                        </label>

                        <input
                        type="number"
                        step="0.01"
                        name="price"
                        required>

                    </div>

                    <!-- ORIGINAL -->

                    <div class="form-group">

                        <label>

                            Original Price

                        </label>

                        <input
                        type="number"
                        step="0.01"
                        name="original_price">

                    </div>

                    <!-- IMAGE URL -->

                    <div class="form-group">

                        <label>

                            Image URL

                        </label>

                        <input
                        type="text"
                        name="image_url"
                        placeholder="https://example.com/image.jpg">

                    </div>

                    <!-- IMAGE FILE -->

                    <div class="form-group">

                        <label>

                            Upload Image

                        </label>

                        <input
                        type="file"
                        name="image_file"
                        accept="image/*">

                    </div>

                    <!-- PREPARATION -->

                    <div class="form-group">

                        <label>

                            Preparation Time

                        </label>

                        <input
                        type="number"
                        name="preparation_time"
                        value="10">

                    </div>

                    <!-- DESCRIPTION -->

                    <div class="form-group full">

                        <label>

                            Description

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

        <!-- TABLE -->

        <div class="table-box">

            <table>

                <thead>

                    <tr>

                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Action</th>

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

                            ⭐ <?php echo $product['rating']; ?>

                        </td>

                        <td>

                            <span class="status-active">

                                <?php echo ucfirst($product['status']); ?>

                            </span>

                        </td>

                        <td>

                            <div class="action-buttons">

                                <button
                                type="button"
                                class="action-btn edit-btn">

                                    Edit

                                </button>

                                <a
                                href="?delete=<?php echo $product['id']; ?>"

                                onclick=
                                "return confirm(
                                'Delete Product?'
                                )">

                                    <button
                                    type="button"
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