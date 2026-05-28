<?php

/* =========================================================
FILE: check-auth.php
SECURE AUTH CHECK SYSTEM
USE THIS FILE IN:
- profile.php
- cart.php
- checkout.php
- orders.php
- admin/
========================================================= */

include "config/config.php";

/* =========================================================
NOT LOGIN
========================================================= */

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit;

}

/* =========================================================
GET USER
========================================================= */

$userId = intval($_SESSION['user_id']);

$query = mysqli_query(

    $conn,

    "SELECT *
    FROM users
    WHERE id='$userId'
    LIMIT 1"

);

/* =========================================================
USER NOT FOUND
========================================================= */

if(

    !$query

    ||

    mysqli_num_rows($query) == 0

){

    session_destroy();

    header("Location: login.php");
    exit;

}

/* =========================================================
USER DATA
========================================================= */

$currentUser =
mysqli_fetch_assoc($query);

/* =========================================================
BLOCK CHECK
========================================================= */

if($currentUser['status'] == 'blocked'){

    session_destroy();

    header("Location: login.php");
    exit;

}

/* =========================================================
SESSION REFRESH
========================================================= */

$_SESSION['user_id'] =
$currentUser['id'];

$_SESSION['user_name'] =
$currentUser['full_name'];

$_SESSION['user_email'] =
$currentUser['email'];

$_SESSION['user_phone'] =
$currentUser['phone'];

$_SESSION['profile_image'] =
$currentUser['profile_image'];

$_SESSION['user_role'] =
$currentUser['role'];

?>