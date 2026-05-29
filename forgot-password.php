<?php

/* =========================================================
FORGOT-PASSWORD.PHP — OTP BASED PASSWORD RESET
Hungroo Café
Flow: Email → OTP → New Password → Login
========================================================= */

include "config/config.php";

/* =========================================================
PHPMAILER
========================================================= */

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/* =========================================================
ALREADY LOGGED IN
========================================================= */

if (isset($_SESSION['user_id'])) {

    header("Location: profile.php");

    exit;

}

/* =========================================================
HELPERS
========================================================= */

function clean($val) {

    return htmlspecialchars(trim($val), ENT_QUOTES, 'UTF-8');

}

function generateOTP() {

    return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

}

/* =========================================================
SEND OTP EMAIL
========================================================= */

function sendOTPEmail($toEmail, $otp) {

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();

        $mail->Host       = SMTP_HOST;

        $mail->SMTPAuth   = true;

        $mail->Username   = SMTP_USER;

        $mail->Password   = SMTP_PASS;

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port       = SMTP_PORT;

        $mail->setFrom(SMTP_USER, SMTP_FROM_NAME);

        $mail->addAddress($toEmail);

        $mail->isHTML(true);

        $subject = 'Reset Your Password — Hungroo Café';

        $body    = '

        <div style="max-width:480px;margin:0 auto;font-family:Poppins,sans-serif;background:#09090b;border-radius:16px;overflow:hidden;border:1px solid rgba(255,255,255,0.08)">

            <div style="background:linear-gradient(135deg,#e74c3c,#ff7675);padding:32px;text-align:center">

                <h1 style="color:#fff;margin:0;font-size:28px;font-weight:800">HUNGROO</h1>

                <p style="color:rgba(255,255,255,0.8);margin:4px 0 0;font-size:12px;letter-spacing:3px">CAFÉ</p>

            </div>

            <div style="padding:32px">

                <h2 style="color:#fff;margin:0 0 8px;font-size:20px">Reset Your Password</h2>

                <p style="color:#a1a1aa;margin:0 0 24px;font-size:14px;line-height:1.6">Use this OTP to set a new password:</p>

                <div style="background:rgba(231,76,60,0.1);border:2px dashed rgba(231,76,60,0.3);border-radius:12px;padding:20px;text-align:center;margin-bottom:24px">

                    <span style="font-size:36px;font-weight:800;color:#ff7675;letter-spacing:8px">' . $otp . '</span>

                </div>

                <p style="color:#71717a;margin:0;font-size:12px">This OTP expires in <strong style="color:#ff7675">5 minutes</strong>. If you didn\'t request this, ignore this email.</p>

            </div>

        </div>';

        $mail->Subject = $subject;

        $mail->Body    = $body;

        $mail->AltBody = "Your Hungroo Café password reset OTP is: " . $otp . "\n\nThis OTP expires in 5 minutes.";

        $mail->send();

        return ['success' => true];

    } catch (Exception $e) {

        return ['success' => false, 'error' => $mail->ErrorInfo];

    }

}

/* =========================================================
STATE
========================================================= */

 $step     = 'email';

 $email    = '';

 $alert    = '';

 $alertType = 'error';

/* =========================================================
STEP 1: SEND OTP
======================================================== */

if (isset($_POST['send_otp'])) {

    $email = clean($_POST['email']);

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $alert = 'Please enter a valid email address';

    } else {

        /* Check if user exists */

        $stmt = $conn->prepare("SELECT id, status FROM users WHERE email = ? LIMIT 1");

        $stmt->bind_param('s', $email);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {

            $alert = 'No account found with this email';

        } else {

            $user = $result->fetch_assoc();

            if ($user['status'] === 'blocked') {

                $alert = 'Your account is blocked. Contact support.';

            } else {

                /* Generate OTP */

                $otp     = generateOTP();

                $expires = date('Y-m-d H:i:s', strtotime('+5 minutes'));

                $ip      = $_SERVER['REMOTE_ADDR'];

                /* Delete old */

                $del = $conn->prepare("DELETE FROM otp_verifications WHERE email = ? AND purpose = 'forgot_password' AND is_verified = 0");

                $del->bind_param('s', $email);

                $del->execute();

                /* Insert new */

                $ins = $conn->prepare("INSERT INTO otp_verifications (email, otp, purpose, expires_at, ip_address) VALUES (?, ?, 'forgot_password', ?, ?)");

                $ins->bind_param('ssss', $email, $otp, $expires, $ip);

                $ins->execute();

                /* Send email */

                $mailResult = sendOTPEmail($email, $otp);

                if ($mailResult['success']) {

                    $step      = 'otp';

                    $alert     = 'OTP sent to ' . $email;

                    $alertType = 'success';

                } else {

                    $alert = 'Failed to send OTP. Please try again.';

                }

            }

        }

    }

}

/* =========================================================
STEP 2: VERIFY OTP
========================================================= */

if (isset($_POST['verify_otp'])) {

    $email = clean($_POST['email']);

    $otp   = '';

    for ($i = 1; $i <= 6; $i++) {

        $otp .= isset($_POST['otp_' . $i]) ? clean($_POST['otp_' . $i]) : '';

    }

    if (strlen($otp) !== 6 || !ctype_digit($otp)) {

        $step      = 'otp';

        $alert     = 'Please enter the complete 6-digit OTP';

    } else {

        $stmt = $conn->prepare("SELECT * FROM otp_verifications WHERE email = ? AND purpose = 'forgot_password' AND is_verified = 0 ORDER BY created_at DESC LIMIT 1");

        $stmt->bind_param('s', $email);

        $stmt->execute();

        $otpRow = $stmt->get_result()->fetch_assoc();

        if (!$otpRow) {

            $step  = 'email';

            $alert = 'OTP expired or not found. Please try again.';

        } elseif ($otpRow['attempts'] >= $otpRow['max_attempts']) {

            $step  = 'email';

            $alert = 'Too many wrong attempts. Please request a new OTP.';

        } elseif (strtotime($otpRow['expires_at']) < time()) {

            $step  = 'email';

            $alert = 'OTP has expired. Please request a new one.';

        } elseif ($otpRow['otp'] !== $otp) {

            $upd = $conn->prepare("UPDATE otp_verifications SET attempts = attempts + 1 WHERE id = ?");

            $upd->bind_param('i', $otpRow['id']);

            $upd->execute();

            $remaining = $otpRow['max_attempts'] - $otpRow['attempts'] - 1;

            $step  = 'otp';

            $alert = 'Incorrect OTP. ' . $remaining . ' attempt' . ($remaining !== 1 ? 's' : '') . ' remaining.';

        } else {

            /* OTP CORRECT */

            $upd = $conn->prepare("UPDATE otp_verifications SET is_verified = 1 WHERE id = ?");

            $upd->bind_param('i', $otpRow['id']);

            $upd->execute();

            $step = 'reset';

            $alert     = 'OTP verified. Set your new password.';

            $alertType = 'success';

        }

    }

}

/* =========================================================
STEP 3: SET NEW PASSWORD
======================================================== */

if (isset($_POST['reset_password'])) {

    $email           = clean($_POST['email']);

    $new_password    = $_POST['new_password'];

    $confirm_password = $_POST['confirm_password'];

    if (empty($new_password) || strlen($new_password) < 6) {

        $step  = 'reset';

        $alert = 'Password must be at least 6 characters';

    } elseif ($new_password !== $confirm_password) {

        $step  = 'reset';

        $alert = 'Passwords do not match';

    } else {

        /* Check if OTP was verified for this email */

        $chk = $conn->prepare("SELECT id FROM otp_verifications WHERE email = ? AND purpose = 'forgot_password' AND is_verified = 1 ORDER BY created_at DESC LIMIT 1");

        $chk->bind_param('s', $email);

        $chk->execute();

        if ($chk->get_result()->num_rows === 0) {

            $step  = 'email';

            $alert = 'Session expired. Please start again.';

        } else {

            /* Update password */

            $hashed = password_hash($new_password, PASSWORD_DEFAULT);

            $upd = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");

            $upd->bind_param('ss', $hashed, $email);

            $upd->execute();

            /* Mark OTP as used (set a fake expired time) */

            $done = $conn->prepare("UPDATE otp_verifications SET expires_at = DATE_SUB(NOW(), INTERVAL 1 HOUR) WHERE email = ? AND purpose = 'forgot_password' AND is_verified = 1");

            $done->bind_param('s', $email);

            $done->execute();

            /* Redirect to login with success */

            header("Location: login.php?msg=password_reset");

            exit;

        }

    }

}

/* =========================================================
CHECK FOR LOGIN REDIRECT MSG
========================================================= */

 $loginMsg = '';

if (isset($_GET['msg']) && $_GET['msg'] === 'password_reset') {

    $loginMsg = 'Password reset successful! Please login with your new password.';

}

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Forgot Password | Hungroo Café</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
/* =========================================================
AUTH VARIABLES — DARK
========================================================= */

:root,

[data-theme="dark"] {

    --auth-bg: #09090b;

    --auth-bg-alt: #111113;

    --auth-card: rgba(255,255,255,0.04);

    --auth-card-border: rgba(255,255,255,0.07);

    --auth-input-bg: rgba(255,255,255,0.05);

    --auth-input-border: rgba(255,255,255,0.08);

    --auth-input-focus: rgba(108,92,231,0.3);

    --auth-text: #ffffff;

    --auth-text-sec: #a1a1aa;

    --auth-text-dim: #71717a;

    --auth-accent: #6C5CE7;

    --auth-accent-light: #a29bfe;

    --auth-accent-hover: #5b4bd5;

    --auth-green: #00b894;

    --auth-red: #e74c3c;

    --auth-red-bg: rgba(231,76,60,0.08);

    --auth-red-border: rgba(231,76,60,0.16);

    --auth-green-bg: rgba(0,184,148,0.08);

    --auth-green-border: rgba(0,184,148,0.16);

    --auth-blur-1: rgba(231,76,60,0.1);

    --auth-blur-2: rgba(255,118,117,0.08);

}

/* =========================================================
AUTH VARIABLES — LIGHT
========================================================= */

[data-theme="light"] {

    --auth-bg: #f4f4f5;

    --auth-bg-alt: #ffffff;

    --auth-card: rgba(255,255,255,0.8);

    --auth-card-border: rgba(0,0,0,0.08);

    --auth-input-bg: rgba(0,0,0,0.04);

    --auth-input-border: rgba(0,0,0,0.1);

    --auth-input-focus: rgba(108,92,231,0.25);

    --auth-text: #09090b;

    --auth-text-sec: #52525b;

    --auth-text-dim: #a1a1aa;

    --auth-accent: #6C5CE7;

    --auth-accent-light: #6C5CE7;

    --auth-accent-hover: #5b4bd5;

    --auth-green: #00a884;

    --auth-red: #dc2626;

    --auth-red-bg: rgba(220,38,38,0.06);

    --auth-red-border: rgba(220,38,38,0.12);

    --auth-green-bg: rgba(0,168,132,0.06);

    --auth-green-border: rgba(0,168,132,0.12);

    --auth-blur-1: rgba(231,76,60,0.06);

    --auth-blur-2: rgba(255,118,117,0.04);

}

/* =========================================================
BASE
========================================================= */

* { margin:0; padding:0; box-sizing:border-box; }

body {

    font-family:'Poppins',sans-serif;

    background:var(--auth-bg);

    color:var(--auth-text);

    overflow-x:hidden;

    -webkit-font-smoothing:antialiased;

    transition:background 0.35s ease,color 0.35s ease;

}

a { text-decoration:none; color:inherit; }

/* =========================================================
BACKGROUND
========================================================= */

.auth-blobs { position:fixed; inset:0; z-index:0; pointer-events:none; overflow:hidden; }

.auth-blob { position:absolute; border-radius:50%; filter:blur(130px); }

.auth-blob-1 { width:500px; height:500px; background:var(--auth-blur-1); top:-200px; right:-150px; }

.auth-blob-2 { width:400px; height:400px; background:var(--auth-blur-2); bottom:-150px; left:-100px; }

/* =========================================================
SECTION & CARD
========================================================= */

.auth-section { position:relative; z-index:1; min-height:100vh; padding:120px 24px 80px; display:flex; align-items:center; justify-content:center; }

.auth-card { width:100%; max-width:480px; border-radius:24px; background:var(--auth-card); border:1px solid var(--auth-card-border); backdrop-filter:blur(24px); -webkit-backdrop-filter:blur(24px); overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,0.2); transition:all 0.35s ease; }

/* =========================================================
CARD HEADER
========================================================= */

.auth-card-header { background:linear-gradient(135deg,#e74c3c 0%,#ff7675 100%); padding:40px 32px; text-align:center; position:relative; overflow:hidden; }

.auth-card-header::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.06'%3E%3Cpath d='M20 20.5V18H0v-2h20v-2l4 3.25-4 3.25z'/%3E%3C/g%3E%3C/svg%3E"); }

.auth-card-header-content { position:relative; z-index:1; }

.auth-card-header .icon-circle { width:64px; height:64px; border-radius:50%; background:rgba(255,255,255,0.2); display:flex; align-items:center; justify-content:center; margin:0 auto 16px; font-size:26px; color:#fff; }

.auth-card-header h2 { font-size:22px; font-weight:800; color:#fff; margin-bottom:4px; }

.auth-card-header p { font-size:13px; color:rgba(255,255,255,0.8); }

/* =========================================================
FORM BODY
========================================================= */

.auth-card-body { padding:32px; }

.auth-form-header { margin-bottom:24px; text-align:center; }

.auth-form-header h3 { font-size:20px; font-weight:700; margin-bottom:4px; transition:color 0.35s ease; }

.auth-form-header p { font-size:13px; color:var(--auth-text-sec); transition:color 0.35s ease; }

/* =========================================================
ALERT
========================================================= */

.auth-alert { width:100%; padding:14px 18px; border-radius:12px; display:flex; align-items:flex-start; gap:10px; font-size:13px; font-weight:500; margin-bottom:20px; animation:alertIn 0.35s ease; line-height:1.5; }

@keyframes alertIn { from { opacity:0; transform:translateY(-8px); } to { opacity:1; transform:translateY(0); } }

.auth-alert.error { background:var(--auth-red-bg); border:1px solid var(--auth-red-border); color:var(--auth-red); }

.auth-alert.success { background:var(--auth-green-bg); border:1px solid var(--auth-green-border); color:var(--auth-green); }

.auth-alert i { font-size:16px; flex-shrink:0; margin-top:1px; }

/* =========================================================
STEPS
========================================================= */

.auth-step { display:none; animation:stepIn 0.4s ease; }

.auth-step.active { display:block; }

@keyframes stepIn { from { opacity:0; transform:translateX(16px); } to { opacity:1; transform:translateX(0); } }

/* =========================================================
INPUTS
========================================================= */

.input-group { margin-bottom:18px; }

.input-group label { display:block; font-size:13px; font-weight:600; color:var(--auth-text-sec); margin-bottom:8px; transition:color 0.35s ease; }

.input-wrap { width:100%; height:54px; padding:0 18px; border-radius:14px; display:flex; align-items:center; gap:12px; background:var(--auth-input-bg); border:1px solid var(--auth-input-border); transition:all 0.3s ease; }

.input-wrap:focus-within { border-color:var(--auth-accent); box-shadow:0 0 0 3px var(--auth-input-focus); }

.input-wrap i.icon { color:var(--auth-text-dim); font-size:16px; transition:color 0.3s ease; width:20px; text-align:center; }

.input-wrap:focus-within i.icon { color:var(--auth-accent-light); }

.input-wrap input { flex:1; height:100%; border:none; outline:none; background:transparent; color:var(--auth-text); font-family:inherit; font-size:14px; transition:color 0.35s ease; }

.input-wrap input::placeholder { color:var(--auth-text-dim); }

.toggle-pass { background:none; border:none; color:var(--auth-text-dim); cursor:pointer; font-size:15px; padding:4px; transition:color 0.25s ease; }

.toggle-pass:hover { color:var(--auth-text-sec); }

/* =========================================================
BUTTONS
========================================================= */

.auth-btn { width:100%; height:54px; border:none; outline:none; cursor:pointer; border-radius:14px; background:var(--auth-accent); color:#fff; font-family:inherit; font-size:15px; font-weight:600; display:flex; align-items:center; justify-content:center; gap:10px; transition:all 0.3s ease; box-shadow:0 4px 20px rgba(108,92,231,0.35); margin-top:8px; }

.auth-btn:hover { background:var(--auth-accent-hover); transform:translateY(-2px); box-shadow:0 6px 28px rgba(108,92,231,0.45); }

.auth-btn:active { transform:translateY(0) scale(0.98); }

.auth-btn:disabled { opacity:0.5; cursor:not-allowed; transform:none !important; }

.auth-btn-outline { background:transparent; border:1px solid var(--auth-card-border); color:var(--auth-text-sec); box-shadow:none; }

.auth-btn-outline:hover { background:var(--auth-input-bg); border-color:var(--auth-card-border); color:var(--auth-text); box-shadow:none; }

/* =========================================================
BOTTOM LINKS
========================================================= */

.auth-bottom-text { text-align:center; font-size:13px; color:var(--auth-text-sec); margin-top:24px; transition:color 0.35s ease; }

.auth-bottom-text a { font-weight:700; color:var(--auth-accent-light); transition:color 0.25s ease; }

.auth-bottom-text a:hover { color:var(--auth-accent); }

/* =========================================================
OTP BOXES
========================================================= */

.otp-boxes { display:flex; gap:10px; justify-content:center; margin:24px 0; }

.otp-box { width:52px; height:60px; border-radius:14px; text-align:center; font-size:24px; font-weight:700; font-family:inherit; background:var(--auth-input-bg); border:2px solid var(--auth-input-border); color:var(--auth-text); outline:none; caret-color:var(--auth-accent); transition:all 0.25s ease; }

.otp-box:focus { border-color:var(--auth-accent); box-shadow:0 0 0 3px var(--auth-input-focus); transform:translateY(-2px); }

.otp-box.filled { border-color:var(--auth-accent-light); background:rgba(108,92,231,0.08); }

.otp-info { text-align:center; margin-bottom:20px; }

.otp-email-show { font-size:14px; color:var(--auth-text); font-weight:600; transition:color 0.35s ease; }

.otp-email-show span { color:var(--auth-accent-light); }

.otp-timer-text { font-size:12px; color:var(--auth-text-dim); margin-top:4px; transition:color 0.35s ease; }

.otp-timer-text strong { color:var(--auth-accent-light); }

.auth-back-btn { display:inline-flex; align-items:center; gap:6px; font-size:13px; font-weight:500; color:var(--auth-text-dim); margin-bottom:20px; cursor:pointer; transition:color 0.25s ease; background:none; border:none; font-family:inherit; }

.auth-back-btn:hover { color:var(--auth-text-sec); }

.otp-actions { display:flex; align-items:center; justify-content:center; margin-top:20px; }

/* =========================================================
PASSWORD STRENGTH
========================================================= */

.pass-strength { display:flex; gap:6px; margin-top:8px; }

.pass-bar { flex:1; height:4px; border-radius:2px; background:var(--auth-input-border); transition:background 0.3s ease; }

.pass-bar.weak { background:#e74c3c; }

.pass-bar.medium { background:#f39c12; }

.pass-bar.strong { background:#00b894; }

.pass-label { font-size:11px; margin-top:6px; color:var(--auth-text-dim); transition:color 0.35s ease; }

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:600px) {

    .auth-section { padding:100px 16px 60px; }

    .auth-card-body { padding:24px 20px; }

    .auth-card-header { padding:32px 24px; }

    .auth-card-header h2 { font-size:20px; }

    .otp-box { width:44px; height:52px; font-size:20px; border-radius:10px; }

    .otp-boxes { gap:7px; }

    .input-wrap { height:50px; }

}

</style>

</head>

<body>

<!-- BACKGROUND -->

<div class="auth-blobs">

    <div class="auth-blob auth-blob-1"></div>

    <div class="auth-blob auth-blob-2"></div>

</div>

<!-- SECTION -->

<section class="auth-section">

    <div class="auth-card">

        <!-- HEADER -->

        <div class="auth-card-header">

            <div class="auth-card-header-content">

                <div class="icon-circle">

                    <i class="fa-solid fa-key"></i>

                </div>

                <h2>Forgot Password?</h2>

                <p>No worries, we'll send you an OTP to reset it</p>

            </div>

        </div>

        <!-- BODY -->

        <div class="auth-card-body">

            <!-- ALERT -->

            <?php if ($alert): ?>

            <div class="auth-alert <?php echo $alertType; ?>">

                <i class="fa-solid <?php echo $alertType === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'; ?>"></i>

                <span><?php echo $alert; ?></span>

            </div>

            <?php endif; ?>

            <!-- =========================================================
            STEP 1: ENTER EMAIL
            ========================================================= -->

            <div class="auth-step <?php echo $step === 'email' ? 'active' : ''; ?>" id="stepEmail">

                <form method="POST">

                    <div class="input-group">

                        <label>Email Address</label>

                        <div class="input-wrap">

                            <i class="fa-solid fa-envelope icon"></i>

                            <input type="email" name="email" placeholder="you@example.com" value="<?php echo $email; ?>" required autofocus>

                        </div>

                    </div>

                    <button type="submit" name="send_otp" class="auth-btn">

                        <i class="fa-solid fa-paper-plane"></i>

                        Send OTP

                    </button>

                    <div class="auth-bottom-text">

                        Remember your password? <a href="login.php">Login</a>

                    </div>

                </form>

            </div>

            <!-- =========================================================
            STEP 2: VERIFY OTP
            ========================================================= -->

            <div class="auth-step <?php echo $step === 'otp' ? 'active' : ''; ?>" id="stepOtp">

                <button type="button" class="auth-back-btn" onclick="goBack('email')">

                    <i class="fa-solid fa-arrow-left"></i>

                    Back

                </button>

                <div class="auth-form-header">

                    <h3>Verify OTP</h3>

                    <p>Enter the 6-digit code sent to your email</p>

                </div>

                <div class="otp-info">

                    <div class="otp-email-show">

                        Sent to <span><?php echo $email; ?></span>

                    </div>

                    <div class="otp-timer-text" id="otpTimer">

                        OTP expires in <strong id="timerCount">5:00</strong>

                    </div>

                </div>

                <form method="POST" id="otpForm">

                    <input type="hidden" name="email" value="<?php echo $email; ?>">

                    <div class="otp-boxes">

                        <input type="text" class="otp-box" name="otp_1" maxlength="1" inputmode="numeric" pattern="[0-9]" autofocus>

                        <input type="text" class="otp-box" name="otp_2" maxlength="1" inputmode="numeric" pattern="[0-9]">

                        <input type="text" class="otp-box" name="otp_3" maxlength="1" inputmode="numeric" pattern="[0-9]">

                        <input type="text" class="otp-box" name="otp_4" maxlength="1" inputmode="numeric" pattern="[0-9]">

                        <input type="text" class="otp-box" name="otp_5" maxlength="1" inputmode="numeric" pattern="[0-9]">

                        <input type="text" class="otp-box" name="otp_6" maxlength="1" inputmode="numeric" pattern="[0-9]">

                    </div>

                    <button type="submit" name="verify_otp" class="auth-btn">

                        <i class="fa-solid fa-check-circle"></i>

                        Verify OTP

                    </button>

                    <div class="otp-actions">

                        <form method="POST" style="display:inline">

                            <input type="hidden" name="email" value="<?php echo $email; ?>">

                            <button type="submit" name="resend_otp" class="auth-btn-outline auth-btn" id="resendBtn" disabled style="height:42px;font-size:13px;padding:0 20px;width:auto;">

                                <i class="fa-solid fa-rotate-right"></i>

                                Resend

                            </button>

                        </form>

                    </div>

                </form>

            </div>

            <!-- =========================================================
            STEP 3: SET NEW PASSWORD
            ========================================================= -->

            <div class="auth-step <?php echo $step === 'reset' ? 'active' : ''; ?>" id="stepReset">

                <button type="button" class="auth-back-btn" onclick="goBack('otp')">

                    <i class="fa-solid fa-arrow-left"></i>

                    Back

                </button>

                <div class="auth-form-header">

                    <h3>Set New Password</h3>

                    <p>Create a strong password for your account</p>

                </div>

                <form method="POST">

                    <input type="hidden" name="email" value="<?php echo $email; ?>">

                    <div class="input-group">

                        <label>New Password</label>

                        <div class="input-wrap">

                            <i class="fa-solid fa-lock icon"></i>

                            <input type="password" name="new_password" id="newPass" placeholder="Min 6 characters" required minlength="6" oninput="checkStrength(this.value)">

                            <button type="button" class="toggle-pass" onclick="togglePassword('newPass', this)">

                                <i class="fa-solid fa-eye"></i>

                            </button>

                        </div>

                        <div class="pass-strength" id="passStrength">

                            <div class="pass-bar" id="bar1"></div>

                            <div class="pass-bar" id="bar2"></div>

                            <div class="pass-bar" id="bar3"></div>

                            <div class="pass-bar" id="bar4"></div>

                        </div>

                        <div class="pass-label" id="passLabel"></div>

                    </div>

                    <div class="input-group">

                        <label>Confirm Password</label>

                        <div class="input-wrap">

                            <i class="fa-solid fa-lock icon"></i>

                            <input type="password" name="confirm_password" id="confirmPass" placeholder="Re-enter password" required minlength="6">

                            <button type="button" class="toggle-pass" onclick="togglePassword('confirmPass', this)">

                                <i class="fa-solid fa-eye"></i>

                            </button>

                        </div>

                    </div>

                    <button type="submit" name="reset_password" class="auth-btn">

                        <i class="fa-solid fa-shield-halved"></i>

                        Reset Password

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>

<script>
/* =========================================================
PASSWORD TOGGLE
========================================================= */

function togglePassword(id, btn) {

    const input = document.getElementById(id);

    const icon = btn.querySelector('i');

    if (input.type === 'password') {

        input.type = 'text';

        icon.className = 'fa-solid fa-eye-slash';

    } else {

        input.type = 'password';

        icon.className = 'fa-solid fa-eye';

    }

}

/* =========================================================
PASSWORD STRENGTH
========================================================= */

function checkStrength(pass) {

    let score = 0;

    if (pass.length >= 6) score++;

    if (pass.length >= 10) score++;

    if (/[A-Z]/.test(pass) && /[a-z]/.test(pass)) score++;

    if (/[0-9]/.test(pass) && /[^A-Za-z0-9]/.test(pass)) score++;

    const bars = [document.getElementById('bar1'), document.getElementById('bar2'), document.getElementById('bar3'), document.getElementById('bar4')];

    const label = document.getElementById('passLabel');

    const levels = ['', 'Weak', 'Fair', 'Good', 'Strong'];

    const colors = ['', 'weak', 'medium', 'medium', 'strong'];

    bars.forEach((bar, i) => {

        bar.className = 'pass-bar';

        if (i < score) bar.classList.add(colors[score]);

    });

    label.textContent = pass.length > 0 ? levels[score] : '';

}

/* =========================================================
OTP BOXES
========================================================= */

const boxes = document.querySelectorAll('.otp-box');

boxes.forEach((box, idx) => {

    box.addEventListener('input', (e) => {

        const val = e.target.value.replace(/[^0-9]/g, '');

        e.target.value = val;

        if (val) {

            box.classList.add('filled');

            if (idx < boxes.length - 1) boxes[idx + 1].focus();

        } else {

            box.classList.remove('filled');

        }

    });

    box.addEventListener('keydown', (e) => {

        if (e.key === 'Backspace' && !box.value && idx > 0) {

            boxes[idx - 1].focus();

            boxes[idx - 1].value = '';

            boxes[idx - 1].classList.remove('filled');

        }

        if (e.key === 'Enter') document.getElementById('otpForm').requestSubmit();

    });

    box.addEventListener('paste', (e) => {

        e.preventDefault();

        const data = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '').slice(0, 6);

        data.split('').forEach((char, i) => {

            if (boxes[i]) { boxes[i].value = char; boxes[i].classList.add('filled'); }

        });

        if (data.length > 0) boxes[Math.min(data.length, boxes.length) - 1].focus();

    });

    box.addEventListener('focus', () => box.select());

});

/* =========================================================
TIMER
========================================================= */

let totalSeconds = 300;

const timerEl = document.getElementById('timerCount');

const resendBtn = document.getElementById('resendBtn');

if (timerEl) {

    const timerInterval = setInterval(() => {

        if (totalSeconds <= 0) {

            clearInterval(timerInterval);

            timerEl.textContent = 'Expired';

            if (resendBtn) resendBtn.disabled = false;

            return;

        }

        totalSeconds--;

        const m = Math.floor(totalSeconds / 60);

        const s = totalSeconds % 60;

        timerEl.textContent = m + ':' + String(s).padStart(2, '0');

    }, 1000);

}

/* =========================================================
RESEND OTP (forgot password)
========================================================= */

<?php

if (isset($_POST['resend_otp'])) {

    $email = clean($_POST['email']);

    $stmt = $conn->prepare("SELECT created_at FROM otp_verifications WHERE email = ? AND purpose = 'forgot_password' AND is_verified = 0 ORDER BY created_at DESC LIMIT 1");

    $stmt->bind_param('s', $email);

    $stmt->execute();

    $lastOtp = $stmt->get_result()->fetch_assoc();

    if ($lastOtp && (time() - strtotime($lastOtp['created_at'])) < 60) {

        echo "alert('Please wait 60 seconds before requesting a new OTP');";

    } else {

        $otp     = generateOTP();

        $expires = date('Y-m-d H:i:s', strtotime('+5 minutes'));

        $ip      = $_SERVER['REMOTE_ADDR'];

        $del = $conn->prepare("DELETE FROM otp_verifications WHERE email = ? AND purpose = 'forgot_password' AND is_verified = 0");

        $del->bind_param('s', $email);

        $del->execute();

        $ins = $conn->prepare("INSERT INTO otp_verifications (email, otp, purpose, expires_at, ip_address) VALUES (?, ?, 'forgot_password', ?, ?)");

        $ins->bind_param('ssss', $email, $otp, $expires, $ip);

        $ins->execute();

        sendOTPEmail($email, $otp);

        echo "document.getElementById('timerCount').textContent = '5:00';";

        echo "totalSeconds = 300;";

    }

}

?>

/* =========================================================
GO BACK
========================================================= */

function goBack(to) {

    if (to === 'email') window.location.href = 'forgot-password.php';

    else window.location.href = 'forgot-password.php?email=<?php echo urlencode($email); ?>';

}
</script>

<!-- =========================================================
VERCEL SPEED INSIGHTS
========================================================= -->
<script src="assets/js/speed-insights-init.js" defer></script>

</body>

</html>