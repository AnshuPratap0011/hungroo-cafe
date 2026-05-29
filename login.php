<?php

include "config/config.php";

if (isset($_SESSION['user_id'])) {

    echo "<script>window.location.href='home.php'</script>";

    exit;

}

 $alert     = '';

 $alertType = 'error';

 $emailPhone = '';

if (isset($_POST['login'])) {

    $emailPhone = trim($_POST['email_phone']);

    $password  = $_POST['password'];

    if (empty($emailPhone) || empty($password)) {

        $alert = 'Please fill in all fields';

    } else {

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR phone = ? LIMIT 1");

        $stmt->bind_param('ss', $emailPhone, $emailPhone);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {

            $alert = 'Account not found with this email or phone';

        } else {

            $user = $result->fetch_assoc();

            if ($user['status'] === 'blocked') {

                $alert = 'Your account is blocked. Contact support.';

            } elseif (!password_verify($password, $user['password'])) {

                $alert = 'Wrong password. Try again.';

            } else {

                $_SESSION['user_id']       = $user['id'];

                $_SESSION['user_name']     = $user['full_name'];

                $_SESSION['name']          = $user['full_name'];

                $_SESSION['user_email']    = $user['email'];

                $_SESSION['email']         = $user['email'];

                $_SESSION['user_phone']    = $user['phone'];

                $_SESSION['profile_image'] = $user['profile_image'];

                $_SESSION['user_role']     = $user['role'];

                $upd = $conn->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");

                $upd->bind_param('i', $user['id']);

                $upd->execute();

                echo "<script>window.location.href='home.php'</script>";

                exit;

            }

        }

    }

}

 $regMsg = '';

if (isset($_GET['msg']) && $_GET['msg'] === 'registered') {

    $regMsg = 'Account created successfully! Please login.';

}

if (isset($_GET['msg']) && $_GET['msg'] === 'password_reset') {

    $regMsg = 'Password reset successful! Please login with new password.';

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | Hungroo Café</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
:root,[data-theme="dark"]{--a-bg:#09090b;--a-card:rgba(255,255,255,.04);--a-cb:rgba(255,255,255,.07);--a-ib:rgba(255,255,255,.05);--a-ibrd:rgba(255,255,255,.08);--a-if:rgba(108,92,231,.3);--a-t:#fff;--a-ts:#a1a1aa;--a-td:#71717a;--a-ac:#6C5CE7;--a-acl:#a29bfe;--a-ach:#5b4bd5;--a-g:#00b894;--a-r:#e74c3c;--a-rb:rgba(231,76,60,.08);--a-rbr:rgba(231,76,60,.16);--a-gb:rgba(0,184,148,.08);--a-gbr:rgba(0,184,148,.16);--a-b1:rgba(108,92,231,.12);--a-b2:rgba(162,155,254,.08)}
[data-theme="light"]{--a-bg:#f4f4f5;--a-card:rgba(255,255,255,.8);--a-cb:rgba(0,0,0,.08);--a-ib:rgba(0,0,0,.04);--a-ibrd:rgba(0,0,0,.1);--a-if:rgba(108,92,231,.25);--a-t:#09090b;--a-ts:#52525b;--a-td:#a1a1aa;--a-ac:#6C5CE7;--a-acl:#6C5CE7;--a-ach:#5b4bd5;--a-g:#00a884;--a-r:#dc2626;--a-rb:rgba(220,38,38,.06);--a-rbr:rgba(220,38,38,.12);--a-gb:rgba(0,168,132,.06);--a-gbr:rgba(0,168,132,.12);--a-b1:rgba(108,92,231,.08);--a-b2:rgba(162,155,254,.06)}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Poppins',sans-serif;background:var(--a-bg);color:var(--a-t);overflow-x:hidden;-webkit-font-smoothing:antialiased;transition:background .35s ease,color .35s ease}
a{text-decoration:none;color:inherit}
.ab{position:fixed;inset:0;z-index:0;pointer-events:none;overflow:hidden}
.ab div{position:absolute;border-radius:50%;filter:blur(130px)}
.ab-1{width:500px;height:500px;background:var(--a-b1);top:-200px;right:-150px}
.ab-2{width:400px;height:400px;background:var(--a-b2);bottom:-150px;left:-100px}
.as{position:relative;z-index:1;min-height:100vh;padding:120px 24px 80px;display:flex;align-items:center;justify-content:center}
.ac{width:100%;max-width:1000px;display:grid;grid-template-columns:1fr 1fr;border-radius:24px;background:var(--a-card);border:1px solid var(--a-cb);backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.2);transition:all .35s ease}
.af{background:linear-gradient(135deg,#6C5CE7 0%,#a29bfe 50%,#6C5CE7 100%);background-size:200% 200%;animation:ag 6s ease infinite;padding:60px 48px;display:flex;flex-direction:column;justify-content:center;position:relative;overflow:hidden}
@keyframes ag{0%,100%{background-position:0% 50%}50%{background-position:100% 50%}}
.af::before{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E")}
.afc{position:relative;z-index:1}
.afb{display:inline-flex;align-items:center;gap:8px;padding:8px 18px;border-radius:50px;background:rgba(255,255,255,.15);backdrop-filter:blur(10px);color:#fff;font-size:12px;font-weight:600;margin-bottom:28px;width:fit-content}
.af h1{font-size:clamp(32px,4vw,48px);font-weight:900;color:#fff;line-height:1.1;margin-bottom:16px}
.af p{font-size:15px;color:rgba(255,255,255,.75);line-height:1.7;max-width:360px}
.aff{margin-top:36px;display:flex;flex-direction:column;gap:14px}
.afi{display:flex;align-items:center;gap:12px;color:rgba(255,255,255,.85);font-size:13px;font-weight:500}
.afi i{width:32px;height:32px;border-radius:8px;background:rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0}
.ar{padding:48px 40px;display:flex;flex-direction:column;justify-content:center}
.arh{margin-bottom:32px}
.arh h2{font-size:28px;font-weight:800;margin-bottom:6px;transition:color .35s ease}
.arh p{font-size:14px;color:var(--a-ts);transition:color .35s ease}
.aa{width:100%;padding:14px 18px;border-radius:12px;display:flex;align-items:center;gap:10px;font-size:13px;font-weight:500;margin-bottom:24px;animation:ai .35s ease}
@keyframes ai{from{opacity:0;transform:translateY(-8px)}to{opacity:1;transform:translateY(0)}}
.aa.error{background:var(--a-rb);border:1px solid var(--a-rbr);color:var(--a-r)}
.aa.success{background:var(--a-gb);border:1px solid var(--a-gbr);color:var(--a-g)}
.aa i{font-size:16px;flex-shrink:0}
.ig{margin-bottom:20px}
.ig label{display:block;font-size:13px;font-weight:600;color:var(--a-ts);margin-bottom:8px;transition:color .35s ease}
.iw{width:100%;height:54px;padding:0 18px;border-radius:14px;display:flex;align-items:center;gap:12px;background:var(--a-ib);border:1px solid var(--a-ibrd);transition:all .3s ease}
.iw:focus-within{border-color:var(--a-ac);box-shadow:0 0 0 3px var(--a-if)}
.iw i.ic{color:var(--a-td);font-size:16px;transition:color .3s ease;width:20px;text-align:center}
.iw:focus-within i.ic{color:var(--a-acl)}
.iw input{flex:1;height:100%;border:none;outline:none;background:transparent;color:var(--a-t);font-family:inherit;font-size:14px;transition:color .35s ease}
.iw input::placeholder{color:var(--a-td)}
.tp{background:none;border:none;color:var(--a-td);cursor:pointer;font-size:15px;padding:4px;transition:color .25s ease}
.tp:hover{color:var(--a-ts)}
.arb{display:flex;justify-content:flex-end;margin-bottom:24px}
.al{font-size:13px;font-weight:600;color:var(--a-acl);transition:color .25s ease}
.al:hover{color:var(--a-ac)}
.abtn{width:100%;height:54px;border:none;outline:none;cursor:pointer;border-radius:14px;background:var(--a-ac);color:#fff;font-family:inherit;font-size:15px;font-weight:600;display:flex;align-items:center;justify-content:center;gap:10px;transition:all .3s ease;box-shadow:0 4px 20px rgba(108,92,231,.35)}
.abtn:hover{background:var(--a-ach);transform:translateY(-2px);box-shadow:0 6px 28px rgba(108,92,231,.45)}
.abtn:active{transform:translateY(0) scale(.98)}
.adv{display:flex;align-items:center;gap:14px;margin:24px 0}
.adv span{font-size:12px;color:var(--a-td);white-space:nowrap;transition:color .35s ease}
.adv::before,.adv::after{content:'';flex:1;height:1px;background:var(--a-cb)}
.abt{text-align:center;font-size:13px;color:var(--a-ts);margin-top:24px;transition:color .35s ease}
.abt a{font-weight:700;color:var(--a-acl);transition:color .25s ease}
.abt a:hover{color:var(--a-ac)}
@media(max-width:900px){.ac{grid-template-columns:1fr}.af{padding:40px 32px}.aff{display:none}}
@media(max-width:600px){.as{padding:100px 16px 60px}.ar{padding:32px 24px}.af{padding:32px 24px}.af h1{font-size:28px}.arh h2{font-size:24px}.iw{height:50px}}

.admin-login-btn{

    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;

    width:100%;
    height:55px;

    border-radius:16px;

    background:linear-gradient(
    135deg,
    #6C5CE7,
    #8B7BFF
    );

    color:#fff;
    text-decoration:none;

    font-size:15px;
    font-weight:700;

    margin-top:15px;

    transition:.3s ease;

    box-shadow:
    0 10px 25px
    rgba(108,92,231,.25);

}

.admin-login-btn:hover{

    transform:translateY(-2px);

    box-shadow:
    0 15px 35px
    rgba(108,92,231,.35);

}
</style>
</head>
<body>

<div class="ab">
    <div class="ab-1"></div>
    <div class="ab-2"></div>
</div>

<section class="as">

    <div class="ac">

        <div class="af">
            <div class="afc">
                <div class="afb"><i class="fa-solid fa-lock"></i> Secure Login</div>
                <h1>Welcome<br>Back to<br>Hungroo</h1>
                <p>Login with your email or phone number and password to access your account.</p>
                <div class="aff">
                    <div class="afi"><i class="fa-solid fa-bolt"></i><span>Fast & secure access</span></div>
                    <div class="afi"><i class="fa-solid fa-bag-shopping"></i><span>Track your orders</span></div>
                    <div class="afi"><i class="fa-solid fa-gift"></i><span>View rewards & offers</span></div>
                </div>
            </div>
        </div>

        <div class="ar">

            <?php if ($regMsg): ?>
            <div class="aa success">
                <i class="fa-solid fa-circle-check"></i>
                <span><?php echo $regMsg; ?></span>
            </div>
            <?php endif; ?>

            <?php if ($alert): ?>
            <div class="aa <?php echo $alertType; ?>">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span><?php echo $alert; ?></span>
            </div>
            <?php endif; ?>

            <div class="arh">
                <h2>Login</h2>
                <p>Enter your credentials to continue</p>
            </div>

            <form method="POST">

                <div class="ig">
                    <label>Email or Phone</label>
                    <div class="iw">
                        <i class="fa-solid fa-user ic"></i>
                        <input type="text" name="email_phone" placeholder="you@example.com or 9999999999" value="<?php echo $emailPhone; ?>" required autofocus>
                    </div>
                </div>

                <div class="ig">
                    <label>Password</label>
                    <div class="iw">
                        <i class="fa-solid fa-lock ic"></i>
                        <input type="password" name="password" id="lp" placeholder="Enter your password" required>
                        <button type="button" class="tp" onclick="var x=document.getElementById('lp'),i=this.querySelector('i');if(x.type==='password'){x.type='text';i.className='fa-solid fa-eye-slash'}else{x.type='password';i.className='fa-solid fa-eye'}">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="arb">
                    <a href="forgot-password.php" class="al">Forgot Password?</a>
                </div>

                <button type="submit" name="login" class="abtn">
                    <i class="fa-solid fa-right-to-bracket"></i> Login
                </button>

                <div class="adv"><span>OR</span></div>

                <div class="abt">
                    Don't have an account? <a href="register.php">Register</a>
                </div>
               <div style="margin-top:20px;text-align:center;">

    <a href="admin/login.php" class="admin-login-btn">

        <i class="fa-solid fa-user-shield"></i>

        Admin Login

    </a>

</div>
            </form>

        </div>

    </div>

</section>

<!-- =========================================================
VERCEL SPEED INSIGHTS
========================================================= -->
<script src="assets/js/speed-insights-init.js" defer></script>

</body>
</html>
