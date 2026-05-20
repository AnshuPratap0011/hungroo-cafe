<?php

session_start();

$pageTitle =
"Hungroo Café | Login";

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

<?php echo $pageTitle; ?>

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
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<!-- FONT AWESOME -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- CSS -->

<link
rel="stylesheet"
href="assets/css/auth.css">

<link
rel="stylesheet"
href="assets/css/responsive.css">

</head>

<body class="auth-body">

<!-- =====================================================
WRAPPER
===================================================== -->

<div class="auth-wrapper">

    <!-- LEFT -->

    <div class="auth-left">

        <div class="auth-badge">

            <i class="fa-solid fa-fire"></i>

            Premium Café Experience

        </div>

        <h1>

            Welcome Back

        </h1>

        <p>

            Login to access premium meals,
            fast checkout, loyalty rewards,
            exclusive offers and your orders.

        </p>

        <!-- FEATURES -->

        <div class="auth-features">

            <!-- FEATURE -->

            <div class="auth-feature">

                <div class="auth-feature-icon">

                    <i class="fa-solid fa-burger"></i>

                </div>

                <div class="auth-feature-text">

                    <h3>

                        Premium Meals

                    </h3>

                    <p>

                        Fresh handcrafted burgers,
                        pizzas and desserts.

                    </p>

                </div>

            </div>

            <!-- FEATURE -->

            <div class="auth-feature">

                <div class="auth-feature-icon">

                    <i class="fa-solid fa-bolt"></i>

                </div>

                <div class="auth-feature-text">

                    <h3>

                        Fast Delivery

                    </h3>

                    <p>

                        Super fast premium
                        delivery experience.

                    </p>

                </div>

            </div>

            <!-- FEATURE -->

            <div class="auth-feature">

                <div class="auth-feature-icon">

                    <i class="fa-solid fa-gift"></i>

                </div>

                <div class="auth-feature-text">

                    <h3>

                        Rewards & Offers

                    </h3>

                    <p>

                        Earn points and unlock
                        exclusive premium deals.

                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- RIGHT -->

    <div class="auth-card">

        <!-- TOP -->

        <div class="auth-top">

            <h2>

                Login

            </h2>

            <p>

                Enter your account details
                to continue.

            </p>

        </div>

        <!-- FORM -->

        <form
        class="auth-form"

        action="login-process.php"

        method="POST">

            <!-- EMAIL -->

            <div class="auth-group">

                <label class="auth-label">

                    Email Address

                </label>

                <div class="auth-input-wrap">

                    <i class="fa-solid fa-envelope"></i>

                    <input
                    type="email"

                    name="email"

                    class="auth-input"

                    placeholder=
                    "Enter your email"

                    required>

                </div>

            </div>

            <!-- PASSWORD -->

            <div class="auth-group">

                <label class="auth-label">

                    Password

                </label>

                <div class="auth-input-wrap">

                    <i class="fa-solid fa-lock"></i>

                    <input
                    type="password"

                    name="password"

                    class="auth-input"

                    placeholder=
                    "Enter your password"

                    required>

                </div>

            </div>

            <!-- ROW -->

            <div class="auth-row">

                <label class="auth-check">

                    <input
                    type="checkbox">

                    Remember Me

                </label>

                <a
                href="forgot-password.php"

                class="auth-link">

                    Forgot Password?

                </a>

            </div>

            <!-- BUTTON -->

            <button
            type="submit"

            class="auth-btn">

                Login Account

            </button>

        </form>

        <!-- SOCIAL -->

        <div class="auth-social">

            <button class="auth-social-btn">

                <i class="fa-brands fa-google"></i>

                Google

            </button>

            <button class="auth-social-btn">

                <i class="fa-brands fa-facebook-f"></i>

                Facebook

            </button>

        </div>

        <!-- BOTTOM -->

        <div class="auth-bottom">

            Don’t have an account?

            <a href="register.php">

                Create Account

            </a>

        </div>

    </div>

</div>

<script src="assets/js/theme.js"></script>

<script src="assets/js/preloader.js"></script>

</body>
</html>