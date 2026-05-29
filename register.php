<?php

/* =========================================================
REGISTER.PHP — OTP BASED EMAIL REGISTRATION
Hungroo Café
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
SMTP SETTINGS
========================================================= */

// define('SMTP_HOST',     'smtp.gmail.com');
// define('SMTP_PORT',     587);
// define('SMTP_USER',     'your email@gmail.com');
// define('SMTP_PASS',     'your app password');
// define('SMTP_FROM_NAME','Hungroo Café');

/* =========================================================
ALREADY LOGGED IN
========================================================= */

if (isset($_SESSION['user_id'])) {

    echo "<script>window.location.href='home.php'</script>";

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

function sendOTPEmail($toEmail, $otp, $purpose) {

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

        $subject = 'Verify Your Email — Hungroo Café';

        $body    = '

        <div style="max-width:480px;margin:0 auto;font-family:Poppins,sans-serif;background:#09090b;border-radius:16px;overflow:hidden;border:1px solid rgba(255,255,255,0.08)">

            <div style="background:linear-gradient(135deg,#6C5CE7,#a29bfe);padding:32px;text-align:center">

                <h1 style="color:#fff;margin:0;font-size:28px;font-weight:800">HUNGROO</h1>

                <p style="color:rgba(255,255,255,0.8);margin:4px 0 0;font-size:12px;letter-spacing:3px">CAFÉ</p>

            </div>

            <div style="padding:32px">

                <h2 style="color:#fff;margin:0 0 8px;font-size:20px">Verify Your Email</h2>

                <p style="color:#a1a1aa;margin:0 0 24px;font-size:14px;line-height:1.6">Use this OTP to complete your registration:</p>

                <div style="background:rgba(108,92,231,0.1);border:2px dashed rgba(108,92,231,0.3);border-radius:12px;padding:20px;text-align:center;margin-bottom:24px">

                    <span style="font-size:36px;font-weight:800;color:#a29bfe;letter-spacing:8px">' . $otp . '</span>

                </div>

                <p style="color:#71717a;margin:0;font-size:12px">This OTP expires in <strong style="color:#a29bfe">5 minutes</strong>. Do not share it with anyone.</p>

            </div>

        </div>';

        $mail->Subject = $subject;

        $mail->Body    = $body;

        $mail->AltBody = "Your Hungroo Café OTP is: " . $otp . "\n\nThis OTP expires in 5 minutes.";

        $mail->send();

        return ['success' => true];

    } catch (Exception $e) {

        return ['success' => false, 'error' => $mail->ErrorInfo];

    }

}

/* =========================================================
STATE
========================================================= */

 $step     = 'form';

 $alert    = '';

 $alertType = 'error';

/* Keep form values after error */

 $formName  = '';

 $formEmail = '';

 $formPhone = '';

/* =========================================================
STEP 1: REGISTER FORM — SEND OTP
======================================================== */

if (isset($_POST['send_otp'])) {

    $formName  = clean($_POST['full_name']);

    $formEmail = clean($_POST['email']);

    $formPhone = clean($_POST['phone']);

    $password  = $_POST['password'];

    /* Validations */

    if (empty($formName) || strlen($formName) < 2) {

        $alert = 'Please enter your full name (min 2 characters)';

    } elseif (empty($formEmail) || !filter_var($formEmail, FILTER_VALIDATE_EMAIL)) {

        $alert = 'Please enter a valid email address';

    } elseif (empty($formPhone) || !preg_match('/^[0-9]{10,15}$/', $formPhone)) {

        $alert = 'Please enter a valid phone number (10-15 digits)';

    } elseif (empty($password) || strlen($password) < 6) {

        $alert = 'Password must be at least 6 characters';

    } else {

        /* Check if email already exists */

        $chk = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");

        $chk->bind_param('s', $formEmail);

        $chk->execute();

        if ($chk->get_result()->num_rows > 0) {

            $alert = 'An account with this email already exists. <a href="login.php" style="color:inherit;text-decoration:underline;font-weight:700">Login instead</a>';

        } else {

            /* Hash password */

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            /* Prepare temp data */

            $tempData = json_encode([

                'full_name' => $formName,

                'phone'     => $formPhone,

                'password'  => $hashedPassword

            ]);

            /* Generate OTP */

            $otp     = generateOTP();

            $expires = date('Y-m-d H:i:s', strtotime('+5 minutes'));

            $ip      = $_SERVER['REMOTE_ADDR'];

            /* Delete old unverified OTPs for this email */

            $del = $conn->prepare("DELETE FROM otp_verifications WHERE email = ? AND purpose = 'register' AND is_verified = 0");

            $del->bind_param('s', $formEmail);

            $del->execute();

            /* Insert new OTP */

            $ins = $conn->prepare("INSERT INTO otp_verifications (email, otp, purpose, temp_data, expires_at, ip_address) VALUES (?, ?, 'register', ?, ?, ?)");

            $ins->bind_param('sssss', $formEmail, $otp, $tempData, $expires, $ip);

            $ins->execute();

            /* Send email */

            $mailResult = sendOTPEmail($formEmail, $otp, 'register');

            if ($mailResult['success']) {

                $step      = 'otp';

                $alert     = 'OTP sent to ' . $formEmail;

                $alertType = 'success';

            } else {

                $alert = 'Failed to send OTP. Please try again.';

            }

        }

    }

}

/* =========================================================
STEP 2: VERIFY OTP — CREATE ACCOUNT
======================================================== */

if (isset($_POST['verify_otp'])) {

    $formEmail = clean($_POST['email']);

    $otp   = '';

    for ($i = 1; $i <= 6; $i++) {

        $otp .= isset($_POST['otp_' . $i]) ? clean($_POST['otp_' . $i]) : '';

    }

    if (strlen($otp) !== 6 || !ctype_digit($otp)) {

        $step      = 'otp';

        $alert     = 'Please enter the complete 6-digit OTP';

    } else {

        /* Find OTP record */

        $stmt = $conn->prepare("SELECT * FROM otp_verifications WHERE email = ? AND purpose = 'register' AND is_verified = 0 ORDER BY created_at DESC LIMIT 1");

        $stmt->bind_param('s', $formEmail);

        $stmt->execute();

        $otpRow = $stmt->get_result()->fetch_assoc();

        if (!$otpRow) {

            $step  = 'form';

            $alert = 'Session expired. Please register again.';

        } elseif ($otpRow['attempts'] >= $otpRow['max_attempts']) {

            $step  = 'form';

            $alert = 'Too many wrong attempts. Please register again.';

        } elseif (strtotime($otpRow['expires_at']) < time()) {

            $step  = 'form';

            $alert = 'OTP has expired. Please register again.';

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

            /* Get temp data */

            $data = json_decode($otpRow['temp_data'], true);

            if (!$data) {

                $step  = 'form';

                $alert = 'Registration data corrupted. Please try again.';

            } else {

                /* Insert user */

                $ins = $conn->prepare("INSERT INTO users (full_name, email, phone, password, email_verified) VALUES (?, ?, ?, ?, 1)");

                $ins->bind_param('ssss', $data['full_name'], $formEmail, $data['phone'], $data['password']);

                $ins->execute();

                /* Set session */

 $_SESSION['user_id']       = $newUserId;

 $_SESSION['user_name']     = $data['full_name'];

 $_SESSION['name']          = $data['full_name'];

 $_SESSION['user_email']    = $formEmail;

 $_SESSION['email']         = $formEmail;

 $_SESSION['user_phone']    = $data['phone'];

 $_SESSION['profile_image'] = 'https://i.imgur.com/2DhmtJ4.png';

 $_SESSION['user_role']     = 'user';

/* YE LINE ADD KARO */

session_write_close();

header("Location: home.php");

exit;

            }

        }

    }

}

/* =========================================================
RESEND OTP (keeps same temp_data)
======================================================== */

if (isset($_POST['resend_otp'])) {

    $formEmail = clean($_POST['email']);

    /* 60 sec cooldown */

    $stmt = $conn->prepare("SELECT created_at, temp_data FROM otp_verifications WHERE email = ? AND purpose = 'register' AND is_verified = 0 ORDER BY created_at DESC LIMIT 1");

    $stmt->bind_param('s', $formEmail);

    $stmt->execute();

    $lastOtp = $stmt->get_result()->fetch_assoc();

    if ($lastOtp && (time() - strtotime($lastOtp['created_at'])) < 60) {

        $step      = 'otp';

        $alert     = 'Please wait 60 seconds before requesting a new OTP';

    } else {

        $otp     = generateOTP();

        $expires = date('Y-m-d H:i:s', strtotime('+5 minutes'));

        $ip      = $_SERVER['REMOTE_ADDR'];

        $tempData = $lastOtp ? $lastOtp['temp_data'] : null;

        /* Delete old */

        $del = $conn->prepare("DELETE FROM otp_verifications WHERE email = ? AND purpose = 'register' AND is_verified = 0");

        $del->bind_param('s', $formEmail);

        $del->execute();

        /* Insert new with same temp_data */

        $ins = $conn->prepare("INSERT INTO otp_verifications (email, otp, purpose, temp_data, expires_at, ip_address) VALUES (?, ?, 'register', ?, ?, ?)");

        $ins->bind_param('sssss', $formEmail, $otp, $tempData, $expires, $ip);

        $ins->execute();

        $mailResult = sendOTPEmail($formEmail, $otp, 'register');

        $step  = 'otp';

        $alert = $mailResult['success'] ? 'New OTP sent to ' . $formEmail : 'Failed to send OTP. Try again.';

        $alertType = $mailResult['success'] ? 'success' : 'error';

    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Register | Hungroo Café</title>

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

    --auth-blur-1: rgba(108,92,231,0.12);

    --auth-blur-2: rgba(162,155,254,0.08);

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

    --auth-blur-1: rgba(108,92,231,0.08);

    --auth-blur-2: rgba(162,155,254,0.06);

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
BACKGROUND BLOBS
========================================================= */

.auth-blobs { position:fixed; inset:0; z-index:0; pointer-events:none; overflow:hidden; }

.auth-blob { position:absolute; border-radius:50%; filter:blur(130px); }

.auth-blob-1 { width:500px; height:500px; background:var(--auth-blur-1); top:-200px; right:-150px; }

.auth-blob-2 { width:400px; height:400px; background:var(--auth-blur-2); bottom:-150px; left:-100px; }

/* =========================================================
SECTION & CARD
========================================================= */

.auth-section { position:relative; z-index:1; min-height:100vh; padding:120px 24px 80px; display:flex; align-items:center; justify-content:center; }

.auth-card { width:100%; max-width:1000px; display:grid; grid-template-columns:1fr 1fr; border-radius:24px; background:var(--auth-card); border:1px solid var(--auth-card-border); backdrop-filter:blur(24px); -webkit-backdrop-filter:blur(24px); overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,0.2); transition:all 0.35s ease; }

/* =========================================================
LEFT BRANDING
========================================================= */

.auth-brand { background:linear-gradient(135deg,#00b894 0%,#55efc4 50%,#00b894 100%); background-size:200% 200%; animation:authGradient 6s ease infinite; padding:60px 48px; display:flex; flex-direction:column; justify-content:center; position:relative; overflow:hidden; }

@keyframes authGradient { 0%,100% { background-position:0% 50%; } 50% { background-position:100% 50%; } }

.auth-brand::before { content:''; position:absolute; inset:0; background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E"); }

.auth-brand-content { position:relative; z-index:1; }

.auth-brand-badge { display:inline-flex; align-items:center; gap:8px; padding:8px 18px; border-radius:50px; background:rgba(255,255,255,0.15); backdrop-filter:blur(10px); color:#fff; font-size:12px; font-weight:600; margin-bottom:28px; width:fit-content; }

.auth-brand h1 { font-size:clamp(32px,4vw,48px); font-weight:900; color:#fff; line-height:1.1; margin-bottom:16px; }

.auth-brand p { font-size:15px; color:rgba(255,255,255,0.8); line-height:1.7; max-width:360px; }

.auth-brand-features { margin-top:36px; display:flex; flex-direction:column; gap:14px; }

.auth-brand-feat { display:flex; align-items:center; gap:12px; color:rgba(255,255,255,0.9); font-size:13px; font-weight:500; }

.auth-brand-feat i { width:32px; height:32px; border-radius:8px; background:rgba(255,255,255,0.15); display:flex; align-items:center; justify-content:center; font-size:13px; flex-shrink:0; }

/* =========================================================
RIGHT FORM SIDE
========================================================= */

.auth-form-side { padding:48px 40px; display:flex; flex-direction:column; justify-content:center; }

.auth-form-header { margin-bottom:28px; }

.auth-form-header h2 { font-size:28px; font-weight:800; margin-bottom:6px; transition:color 0.35s ease; }

.auth-form-header p { font-size:14px; color:var(--auth-text-sec); transition:color 0.35s ease; }

/* =========================================================
ALERT
========================================================= */

.auth-alert { width:100%; padding:14px 18px; border-radius:12px; display:flex; align-items:flex-start; gap:10px; font-size:13px; font-weight:500; margin-bottom:24px; animation:alertIn 0.35s ease; line-height:1.5; }

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

/* Password toggle */

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
DIVIDER
========================================================= */

.auth-divider { display:flex; align-items:center; gap:14px; margin:24px 0; }

.auth-divider span { font-size:12px; color:var(--auth-text-dim); white-space:nowrap; transition:color 0.35s ease; }

.auth-divider::before, .auth-divider::after { content:''; flex:1; height:1px; background:var(--auth-card-border); }

/* =========================================================
BOTTOM TEXT
========================================================= */

.auth-bottom-text { text-align:center; font-size:13px; color:var(--auth-text-sec); margin-top:24px; transition:color 0.35s ease; }

.auth-bottom-text a { font-weight:700; color:var(--auth-accent-light); transition:color 0.25s ease; }

.auth-bottom-text a:hover { color:var(--auth-accent); }

/* =========================================================
OTP BOXES
========================================================= */

.otp-boxes { display:flex; gap:10px; justify-content:center; margin:28px 0; }

.otp-box { width:52px; height:60px; border-radius:14px; text-align:center; font-size:24px; font-weight:700; font-family:inherit; background:var(--auth-input-bg); border:2px solid var(--auth-input-border); color:var(--auth-text); outline:none; caret-color:var(--auth-accent); transition:all 0.25s ease; }

.otp-box:focus { border-color:var(--auth-accent); box-shadow:0 0 0 3px var(--auth-input-focus); transform:translateY(-2px); }

.otp-box.filled { border-color:var(--auth-accent-light); background:rgba(108,92,231,0.08); }

.otp-info { text-align:center; margin-bottom:24px; }

.otp-email-show { font-size:14px; color:var(--auth-text); font-weight:600; transition:color 0.35s ease; }

.otp-email-show span { color:var(--auth-accent-light); }

.otp-timer-text { font-size:12px; color:var(--auth-text-dim); margin-top:4px; transition:color 0.35s ease; }

.otp-timer-text strong { color:var(--auth-accent-light); }

.auth-back-btn { display:inline-flex; align-items:center; gap:6px; font-size:13px; font-weight:500; color:var(--auth-text-dim); margin-bottom:24px; cursor:pointer; transition:color 0.25s ease; background:none; border:none; font-family:inherit; }

.auth-back-btn:hover { color:var(--auth-text-sec); }

.otp-actions { display:flex; align-items:center; justify-content:space-between; margin-top:20px; }

/* =========================================================
RESPONSIVE
========================================================= */

@media(max-width:900px) { .auth-card { grid-template-columns:1fr; } .auth-brand { padding:40px 32px; } .auth-brand-features { display:none; } }

@media(max-width:600px) { .auth-section { padding:100px 16px 60px; } .auth-form-side { padding:32px 24px; } .auth-brand { padding:32px 24px; } .auth-brand h1 { font-size:28px; } .auth-form-header h2 { font-size:24px; } .otp-box { width:44px; height:52px; font-size:20px; border-radius:10px; } .otp-boxes { gap:7px; } .input-wrap { height:50px; } }

</style>

</head>

<body>


<!-- BACKGROUND BLOBS -->

<div class="auth-blobs">

    <div class="auth-blob auth-blob-1"></div>

    <div class="auth-blob auth-blob-2"></div>

</div>

<!-- SECTION -->

<section class="auth-section">

    <div class="auth-card">

        <!-- LEFT BRANDING -->

        <div class="auth-brand">

            <div class="auth-brand-content">

                <div class="auth-brand-badge">

                    <i class="fa-solid fa-user-plus"></i>

                    Create Account

                </div>

                <h1>Join<br>Hungroo<br>Café</h1>

                <p>Create your account to order premium food, track deliveries, and earn rewards.</p>

                <div class="auth-brand-features">

                    <div class="auth-brand-feat">

                        <i class="fa-solid fa-gift"></i>

                        <span>Welcome rewards on signup</span>

                    </div>

                    <div class="auth-brand-feat">

                        <i class="fa-solid fa-bolt"></i>

                        <span>Fast OTP verification</span>

                    </div>

                    <div class="auth-brand-feat">

                        <i class="fa-solid fa-shield-halved"></i>

                        <span>Secure & encrypted data</span>

                    </div>

                </div>

            </div>

        </div>

        <!-- RIGHT FORM -->

        <div class="auth-form-side">

            <!-- ALERT -->

            <?php if ($alert): ?>

            <div class="auth-alert <?php echo $alertType; ?>">

                <i class="fa-solid <?php echo $alertType === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'; ?>"></i>

                <span><?php echo $alert; ?></span>

            </div>

            <?php endif; ?>

            <!-- =========================================================
            STEP 1: REGISTRATION FORM
            ========================================================= -->

            <div class="auth-step <?php echo $step === 'form' ? 'active' : ''; ?>" id="stepForm">

                <div class="auth-form-header">

                    <h2>Register</h2>

                    <p>Fill in your details to get started</p>

                </div>

                <form method="POST">

                    <div class="input-group">

                        <label>Full Name</label>

                        <div class="input-wrap">

                            <i class="fa-solid fa-user icon"></i>

                            <input type="text" name="full_name" placeholder="John Doe" value="<?php echo $formName; ?>" required>

                        </div>

                    </div>

                    <div class="input-group">

                        <label>Email Address</label>

                        <div class="input-wrap">

                            <i class="fa-solid fa-envelope icon"></i>

                            <input type="email" name="email" placeholder="you@example.com" value="<?php echo $formEmail; ?>" required>

                        </div>

                    </div>

                    <div class="input-group">

                        <label>Phone Number</label>

                        <div class="input-wrap">

                            <i class="fa-solid fa-phone icon"></i>

                            <input type="tel" name="phone" placeholder="9999999999" value="<?php echo $formPhone; ?>" required>

                        </div>

                    </div>

                    <div class="input-group">

                        <label>Password</label>

                        <div class="input-wrap">

                            <i class="fa-solid fa-lock icon"></i>

                            <input type="password" name="password" id="regPassword" placeholder="Min 6 characters" required minlength="6">

                            <button type="button" class="toggle-pass" onclick="togglePassword('regPassword', this)">

                                <i class="fa-solid fa-eye"></i>

                            </button>

                        </div>

                    </div>

                    <button type="submit" name="send_otp" class="auth-btn">

                        <i class="fa-solid fa-paper-plane"></i>

                        Send OTP & Register

                    </button>

                    <div class="auth-divider">

                        <span>OR</span>

                    </div>

                    <div class="auth-bottom-text">

                        Already have an account? <a href="login.php">Login</a>

                    </div>

                </form>

            </div>

            <!-- =========================================================
            STEP 2: OTP VERIFICATION
            ========================================================= -->

            <div class="auth-step <?php echo $step === 'otp' ? 'active' : ''; ?>" id="stepOtp">

                <button type="button" class="auth-back-btn" onclick="goBack()">

                    <i class="fa-solid fa-arrow-left"></i>

                    Back

                </button>

                <div class="auth-form-header">

                    <h2>Verify OTP</h2>

                    <p>Enter the 6-digit code sent to your email</p>

                </div>

                <div class="otp-info">

                    <div class="otp-email-show">

                        Sent to <span><?php echo $formEmail; ?></span>

                    </div>

                    <div class="otp-timer-text" id="otpTimer">

                        OTP expires in <strong id="timerCount">5:00</strong>

                    </div>

                </div>

                <form method="POST" id="otpForm">

                    <input type="hidden" name="email" value="<?php echo $formEmail; ?>">

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

                        Verify & Create Account

                    </button>

                    <div class="otp-actions">

                        <form method="POST" style="display:inline">

                            <input type="hidden" name="email" value="<?php echo $formEmail; ?>">

                            <button type="submit" name="resend_otp" class="auth-btn-outline auth-btn" id="resendBtn" disabled style="height:42px;font-size:13px;padding:0 20px;width:auto;">

                                <i class="fa-solid fa-rotate-right"></i>

                                Resend OTP

                            </button>

                        </form>

                    </div>

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
OTP BOX LOGIC
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
GO BACK
========================================================= */

function goBack() { window.location.href = 'register.php'; }
</script>

<!-- =========================================================
VERCEL SPEED INSIGHTS
========================================================= -->
<script src="assets/js/speed-insights-init.js" defer></script>

</body>

</html>
