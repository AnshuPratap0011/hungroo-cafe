<?php

session_start();

$pageTitle =
"Hungroo Café | Forgot Password";

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

            <i class="fa-solid fa-lock"></i>

            Secure Account Recovery

        </div>

        <h1>

            Reset Password

        </h1>

        <p>

            Forgot your password?
            Recover your Hungroo Café account
            securely in just a few steps.

        </p>

        <!-- FEATURES -->

        <div class="auth-features">

            <!-- FEATURE -->

            <div class="auth-feature">

                <div class="auth-feature-icon">

                    <i class="fa-solid fa-shield"></i>

                </div>

                <div class="auth-feature-text">

                    <h3>

                        Secure Recovery

                    </h3>

                    <p>

                        Protected password reset
                        with secure verification.

                    </p>

                </div>

            </div>

            <!-- FEATURE -->

            <div class="auth-feature">

                <div class="auth-feature-icon">

                    <i class="fa-solid fa-envelope"></i>

                </div>

                <div class="auth-feature-text">

                    <h3>

                        Email Support

                    </h3>

                    <p>

                        Receive recovery link
                        directly on your email.

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

                        Fast Access

                    </h3>

                    <p>

                        Quickly regain access
                        to your premium account.

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

                Forgot Password

            </h2>

            <p>

                Enter your email address
                to receive a password reset link.

            </p>

        </div>

        <!-- FORM -->

        <form
        class="auth-form"

        action="forgot-password-process.php"

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
                    "Enter your email address"

                    required>

                </div>

            </div>

            <!-- BUTTON -->

            <button
            type="submit"

            class="auth-btn">

                Send Reset Link

            </button>

        </form>

        <!-- BOTTOM -->

        <div class="auth-bottom">

            Remember your password?

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