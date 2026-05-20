<?php

session_start();

$pageTitle =
"Hungroo Café | Reset Password";

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

            <i class="fa-solid fa-key"></i>

            Secure Password Update

        </div>

        <h1>

            Create New Password

        </h1>

        <p>

            Choose a strong password
            to secure your Hungroo Café
            account and premium rewards.

        </p>

        <!-- FEATURES -->

        <div class="auth-features">

            <!-- FEATURE -->

            <div class="auth-feature">

                <div class="auth-feature-icon">

                    <i class="fa-solid fa-lock"></i>

                </div>

                <div class="auth-feature-text">

                    <h3>

                        Strong Security

                    </h3>

                    <p>

                        Keep your account protected
                        with secure passwords.

                    </p>

                </div>

            </div>

            <!-- FEATURE -->

            <div class="auth-feature">

                <div class="auth-feature-icon">

                    <i class="fa-solid fa-user-shield"></i>

                </div>

                <div class="auth-feature-text">

                    <h3>

                        Safe Account

                    </h3>

                    <p>

                        Protect your orders,
                        rewards and payment details.

                    </p>

                </div>

            </div>

            <!-- FEATURE -->

            <div class="auth-feature">

                <div class="auth-feature-icon">

                    <i class="fa-solid fa-check"></i>

                </div>

                <div class="auth-feature-text">

                    <h3>

                        Easy Recovery

                    </h3>

                    <p>

                        Quickly recover access
                        anytime securely.

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

                Reset Password

            </h2>

            <p>

                Enter your new password below.

            </p>

        </div>

        <!-- FORM -->

        <form
        class="auth-form"

        action="reset-password-process.php"

        method="POST">

            <!-- PASSWORD -->

            <div class="auth-group">

                <label class="auth-label">

                    New Password

                </label>

                <div class="auth-input-wrap">

                    <i class="fa-solid fa-lock"></i>

                    <input
                    type="password"

                    name="password"

                    class="auth-input"

                    placeholder=
                    "Enter new password"

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
                    "Confirm new password"

                    required>

                </div>

            </div>

            <!-- BUTTON -->

            <button
            type="submit"

            class="auth-btn">

                Update Password

            </button>

        </form>

        <!-- BOTTOM -->

        <div class="auth-bottom">

            Remembered your password?

            <a href="login.php">

                Back To Login

            </a>

        </div>

    </div>

</div>

<script src="assets/js/theme.js"></script>

<script src="assets/js/preloader.js"></script>

</body>
</html>