<?php

session_start();

include "config/config.php";

/* =========================================================
LOGIN CHECK
========================================================= */

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit;

}

/* =========================================================
USER DATA
========================================================= */

$userId = intval($_SESSION['user_id']);

$query = mysqli_query(

    $conn,

    "SELECT *
    FROM users
    WHERE id='$userId'
    LIMIT 1"

);

if(!$query || mysqli_num_rows($query) == 0){

    session_destroy();

    header("Location: login.php");
    exit;

}

$user = mysqli_fetch_assoc($query);

/* =========================================================
MESSAGE
========================================================= */

$message = "";

/* =========================================================
UPDATE PROFILE
========================================================= */

if(isset($_POST['save_profile'])){

    $full_name = mysqli_real_escape_string(

        $conn,

        trim($_POST['full_name'])

    );

    $phone = mysqli_real_escape_string(

        $conn,

        trim($_POST['phone'])

    );

    $email = mysqli_real_escape_string(

        $conn,

        trim($_POST['email'])

    );

    /* =========================================================
    CHECK EMAIL
    ========================================================= */

    $checkEmail = mysqli_query(

        $conn,

        "SELECT id
        FROM users
        WHERE email='$email'
        AND id!='$userId'
        LIMIT 1"

    );

    /* =========================================================
    CHECK PHONE
    ========================================================= */

    $checkPhone = mysqli_query(

        $conn,

        "SELECT id
        FROM users
        WHERE phone='$phone'
        AND id!='$userId'
        LIMIT 1"

    );

    /* =========================================================
    EMAIL EXISTS
    ========================================================= */

    if(mysqli_num_rows($checkEmail) > 0){

        $message = "

        <div class='profile-alert error'>

            Email already used by another account

        </div>

        ";

    }

    /* =========================================================
    PHONE EXISTS
    ========================================================= */

    else if(

        !empty($phone)

        &&

        mysqli_num_rows($checkPhone) > 0

    ){

        $message = "

        <div class='profile-alert error'>

            Phone number already used

        </div>

        ";

    }

    /* =========================================================
    UPDATE PROFILE
    ========================================================= */

    else{

        $update = mysqli_query(

            $conn,

            "UPDATE users
            SET

            full_name='$full_name',
            phone='$phone',
            email='$email'

            WHERE id='$userId'"

        );

        if($update){

            $_SESSION['user_name'] =
            $full_name;

            $message = "

            <div class='profile-alert success'>

                Profile updated successfully

            </div>

            ";

            /* =========================================================
            REFRESH USER
            ========================================================= */

            $query = mysqli_query(

                $conn,

                "SELECT *
                FROM users
                WHERE id='$userId'
                LIMIT 1"

            );

            $user =
            mysqli_fetch_assoc($query);

        }

        else{

            $message = "

            <div class='profile-alert error'>

                Failed to update profile

            </div>

            ";

        }

    }

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

Update Profile | Hungroo Café

</title>

<!-- GOOGLE FONT -->

<link
rel="preconnect"
href="https://fonts.googleapis.com">

<link
rel="preconnect"
href="https://fonts.gstatic.com"
crossorigin>

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
rel="stylesheet">

<!-- FONT AWESOME -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- CSS -->

<link
rel="stylesheet"
href="assets/css/navbar.css">

<link
rel="stylesheet"
href="assets/css/profile.css">

</head>

<body>

<!-- =========================================================
NAVBAR
========================================================= -->

<?php include "Navbar.php"; ?>

<!-- =========================================================
BACKGROUND BLUR
========================================================= -->

<div class="profile-blur blur-1"></div>
<div class="profile-blur blur-2"></div>

<!-- =========================================================
UPDATE SECTION
========================================================= -->

<section class="profile-hero">

    <div class="profile-card">

        <form
        method="POST"
        class="edit-form">

            <!-- TOP -->

            <div class="edit-top">

                <span>

                    Update Profile

                </span>

                <h2>

                    Edit Your Account

                </h2>

            </div>

            <!-- MESSAGE -->

            <?php echo $message; ?>

            <!-- FULL NAME -->

            <div class="input-box">

                <label>

                    Full Name

                </label>

                <div class="input-wrap">

                    <i class="fa-solid fa-user"></i>

                    <input
                    type="text"
                    name="full_name"
                    value="<?php echo htmlspecialchars($user['full_name']); ?>"
                    required>

                </div>

            </div>

            <!-- PHONE -->

            <div class="input-box">

                <label>

                    Phone Number

                </label>

                <div class="input-wrap">

                    <i class="fa-solid fa-phone"></i>

                    <input
                    type="text"
                    name="phone"
                    value="<?php echo htmlspecialchars($user['phone']); ?>"
                    placeholder="Enter phone number">

                </div>

            </div>

            <!-- EMAIL -->

            <div class="input-box">

                <label>

                    Email Address

                </label>

                <div class="input-wrap">

                    <i class="fa-solid fa-envelope"></i>

                    <input
                    type="email"
                    name="email"
                    value="<?php echo htmlspecialchars($user['email']); ?>"
                    required>

                </div>

            </div>

            <!-- BUTTONS -->

            <div class="edit-buttons">

                <a
                href="profile.php"
                class="cancel-btn">

                    Back Profile

                </a>

                <button
                type="submit"
                name="save_profile"
                class="save-btn">

                    Save Changes

                </button>

            </div>

        </form>

    </div>

</section>

</body>
</html>