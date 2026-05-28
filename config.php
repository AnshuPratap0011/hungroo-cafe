<?php
ob_start();
 $host = "localhost";
 $username = "root";
 $password = "";
 $database = "boba_hungroo";
 $conn = mysqli_connect($host, $username, $password, $database);
if(!$conn){ die("Database Connection Failed : " . mysqli_connect_error()); }
mysqli_set_charset($conn, "utf8mb4");
if(session_status() === PHP_SESSION_NONE){ session_start(); }
date_default_timezone_set("Asia/Kolkata");
 $base_url = "http://localhost/viru/Hungroo-Cafe/";
function cleanInput($data){ global $conn; return mysqli_real_escape_string($conn, trim($data)); }
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'hungroocafe@gmail.com');
define('SMTP_PASS', 'yzlf rgcm skcw zkjg');
define('SMTP_FROM_NAME', 'Hungroo Café');