<?php

session_start();

/* =========================================================
DESTROY USER SESSION
========================================================= */

unset($_SESSION['user_id']);
unset($_SESSION['user_name']);
unset($_SESSION['user_email']);

/* =========================================================
REDIRECT
========================================================= */

header(
"Location: login.php"
);

exit();

?>