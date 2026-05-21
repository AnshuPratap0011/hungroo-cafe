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

if(isset($_GET['id'])){

    $id =

    intval(
    $_GET['id']
    );

    /* =====================================================
    GET IMAGE
    ====================================================== */

    $getQuery =

    "SELECT product_image
    FROM products
    WHERE id='$id'
    LIMIT 1";

    $getResult =

    mysqli_query(
    $conn,
    $getQuery
    );

    if(mysqli_num_rows($getResult) > 0){

        $product =

        mysqli_fetch_assoc(
        $getResult
        );

        /* =================================================
        IMAGE DELETE
        ================================================== */

        $imagePath =

        "../assets/images/" .
        $product['product_image'];

        if(file_exists($imagePath)){

            unlink($imagePath);

        }

    }

    /* =====================================================
    DELETE QUERY
    ====================================================== */

    $deleteQuery =

    "DELETE FROM products
    WHERE id='$id'";

    mysqli_query(
    $conn,
    $deleteQuery
    );

}

/* =========================================================
REDIRECT
========================================================= */

header(
"Location: products.php"
);

exit();

?>