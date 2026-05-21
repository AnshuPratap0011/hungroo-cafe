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
DELETE RESERVATION
========================================================= */

if(isset($_GET['id'])){

    $id =

    intval(
    $_GET['id']
    );

    $deleteQuery =

    "DELETE FROM reservations
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
"Location: reservations.php"
);

exit();

?>