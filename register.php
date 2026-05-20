<?php

session_start();

$pageTitle =
"Hungroo Café | Register";

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

            <i class="fa-solid fa-crown"></i>

            Join Hungroo Café

        </div>

        <h1>

            Create Account

        </h1>

        <p>

            Register now and enjoy premium
            café meals, loyalty rewards,
            fast delivery and exclusive offers.

        </p>

        <!-- FEATURES -->

        <div class="auth-features">

            <!-- FEATURE -->

            <div class="auth-feature">

                <div class="auth-feature-icon">

                    <i class="fa-solid fa-pizza-slice"></i>

                </div>

                <div class="auth-feature-text">

                    <h3>

                        Luxury Food

                    </h3>

                    <p>

                        Enjoy handcrafted meals
                        with premium quality.

                    </p>

                </div>

            </div>

            <!-- FEATURE -->

            <div class="auth-feature">

                <div class="auth-feature-icon">

                    <i class="fa-solid fa-mug-hot"></i>

                </div>

                <div class="auth-feature-text">

                    <h3>

                        Café Drinks

                    </h3>

                    <p>

                        Refreshing coffee and
                        signature boba drinks.

                    </p>

                </div>

            </div>

            <!-- FEATURE -->

            <div class="auth-feature">

                <div class="auth-feature-icon">

                    <i class="fa-solid fa-star"></i>

                </div>

                <div class="auth-feature-text">

                    <h3>

                        Premium Rewards

                    </h3>

                    <p>

                        Earn points and unlock
                        member-only offers.

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

                Register

            </h2>

            <p>

                Create your Hungroo Café account.

            </p>

        </div>

        <!-- FORM -->

        <form
        class="auth-form"

        action="register-process.php"

        method="POST">

            <!-- NAME -->

            <div class="auth-group">

                <label class="auth-label">

                    Full Name

                </label>

                <div class="auth-input-wrap">

                    <i class="fa-solid fa-user"></i>

                    <input
                    type="text"

                    name="name"

                    class="auth-input"

                    placeholder=
                    "Enter your full name"

                    required>

                </div>

            </div>

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

            <!-- PHONE -->

            <div class="auth-group">

                <label class="auth-label">

                    Phone Number

                </label>

                <div class="auth-input-wrap">

                    <i class="fa-solid fa-phone"></i>

                    <input
                    type="tel"

                    name="phone"

                    class="auth-input"

                    placeholder=
                    "Enter your phone number"

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
                    "Create password"

                    required>

                </div>

            </div>

            <!-- CONFIRM PASSWORD -->

            <div class="auth-group">

                <label class="auth-label">

                    Confirm Password

                </label>

                <div class="auth-input-wrap">

                    <i class="fa-solid fa-shield-halved"></i>

                    <input
                    type="password"

                    name="confirm_password"

                    class="auth-input"

                    placeholder=
                    "Confirm password"

                    required>

                </div>

            </div>

            <!-- TERMS -->

            <div class="auth-row">

                <label class="auth-check">

                    <input
                    type="checkbox"
                    required>

                    I agree to Terms & Conditions

                </label>

            </div>

            <!-- BUTTON -->

            <button
            type="submit"

            class="auth-btn">

                Create Account

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

            Already have an account?

            <a href="login.php">

                Login Here

            </a>

        </div>

    </div>

</div>

<script src="assets/js/theme.js"></script>

<script src="assets/js/preloader.js"></script>

</body>
</html>