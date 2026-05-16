<?php

/* =====================================================
   Database connection
   ===================================================== */

$host = "localhost";
$user = "root";
$password = "";
$database = "boba_hungroo";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Database connection failed. Please check your database settings.");
}

mysqli_set_charset($conn, "utf8mb4");

function clean_output($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}