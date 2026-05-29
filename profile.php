<?php

/* =========================================================
PROFILE.PHP — Premium Dynamic Profile
Hungroo Café
========================================================= */

include "config/config.php";

/* =========================================================
AUTH CHECK
========================================================= */

if (!isset($_SESSION['user_id'])) {

    echo "<script>window.location.href='login.php'</script>";

    exit;

}

/* =========================================================
GET USER
========================================================= */

 $userId = (int) $_SESSION['user_id'];

 $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");

 $stmt->bind_param('i', $userId);

 $stmt->execute();

 $userResult = $stmt->get_result();

if ($userResult->num_rows === 0) {

    echo "<script>window.location.href='login.php'</script>";

    exit;

}

 $user = $userResult->fetch_assoc();

/* =================================================--------
PROFILE IMAGE
========================================================= */

 $profileImage = !empty($user['profile_image']) ? $user['profile_image'] : 'https://i.imgur.com/2DhmtJ4.png';

/* =========================================================
TOTAL ORDERS
========================================================= */

 $orderStmt = $conn->prepare("SELECT COUNT(*) as total_orders FROM orders WHERE user_id = ?");

 $orderStmt->bind_param('i', $userId);

 $orderStmt->execute();

 $totalOrders = $orderStmt->get_result()->fetch_assoc()['total_orders'];

/* =========================================================
TOTAL SPENT
======================================================== */

 $spentStmt = $conn->prepare("SELECT COALESCE(SUM(total), 0) as total_spent FROM orders WHERE user_id = ?");

 $spentStmt->bind_param('i', $userId);

 $spentStmt->execute();

 $totalSpent = $spentStmt->get_result()->fetch_assoc()['total_spent'];

/* =========================================================
REWARD POINTS
========================================================= */

 $points = floor($totalSpent / 10);

/* =========================================================
MESSAGE
========================================================= */

 $alert = '';

 $alertType = '';

/* =========================================================
UPLOAD PHOTO
========================================================= */

if (isset($_POST['upload_photo'])) {

    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {

        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

        $ext = strtolower(pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {

            $alert = 'Only JPG, PNG, WEBP images are allowed';

            $alertType = 'error';

        } elseif ($_FILES['profile_photo']['size'] > 2 * 1024 * 1024) {

            $alert = 'Image must be under 2MB';

            $alertType = 'error';

        } else {

            $fileName = $userId . '_' . time() . '.' . $ext;

            $targetDir = "uploads/profile/";

            if (!is_dir($targetDir)) {

                mkdir($targetDir, 0777, true);

            }

            $targetFile = $targetDir . $fileName;

            if (move_uploaded_file($_FILES['profile_photo']['tmp_name'], $targetFile)) {

                $upd = $conn->prepare("UPDATE users SET profile_image = ? WHERE id = ?");

                $upd->bind_param('si', $targetFile, $userId);

                $upd->execute();

                $_SESSION['profile_image'] = $targetFile;

                $profileImage = $targetFile;

                $alert = 'Profile photo updated!';

                $alertType = 'success';

            } else {

                $alert = 'Failed to upload image';

                $alertType = 'error';

            }

        }

    } else {

        $alert = 'Please select an image';

        $alertType = 'error';

    }

}

/* =========================================================
LATEST ORDERS
========================================================= */

 $ordersStmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC LIMIT 5");

 $ordersStmt->bind_param('i', $userId);

 $ordersStmt->execute();

 $latestOrders = $ordersStmt->get_result();

/* =========================================================
STATUS COLORS
========================================================= */

function getStatusColor($status) {

    $map = [

        'pending'       => '#fdcb6e',

        'confirmed'     => '#74b9ff',

        'preparing'     => '#a29bfe',

        'out_for_delivery' => '#00b894',

        'delivered'     => '#00b894',

        'cancelled'     => '#e74c3c',

    ];

    return $map[$status] ?? '#a1a1aa';

}

function getStatusBg($status) {

    $map = [

        'pending'       => 'rgba(253,203,110,0.1)',

        'confirmed'     => 'rgba(116,185,255,0.1)',

        'preparing'     => 'rgba(162,155,254,0.1)',

        'out_for_delivery' => 'rgba(0,184,148,0.1)',

        'delivered'     => 'rgba(0,184,148,0.1)',

        'cancelled'     => 'rgba(231,76,60,0.1)',

    ];

    return $map[$status] ?? 'rgba(161,161,170,0.1)';

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My Profile | Hungroo Café</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
:root,[data-theme="dark"]{--p-bg:#09090b;--p-bg2:#18181b;--p-card:#1e1e22;--p-card-h:#26262b;--p-border:rgba(255,255,255,.06);--p-border-h:rgba(255,255,255,.12);--p-text:#fff;--p-text2:#a1a1aa;--p-text3:#71717a;--p-accent:#6C5CE7;--p-accent-l:#a29bfe;--p-accent-h:#5b4bd5;--p-green:#00b894;--p-red:#e74c3c;--p-yellow:#fdcb6e;--p-input:rgba(255,255,255,.05);--p-input-b:rgba(255,255,255,.08);--p-shadow:0 4px 24px rgba(0,0,0,.4);--p-scroll:#27272a}
[data-theme="light"]{--p-bg:#f4f4f5;--p-bg2:#fff;--p-card:#fff;--p-card-h:#fafafa;--p-border:rgba(0,0,0,.08);--p-border-h:rgba(0,0,0,.15);--p-text:#09090b;--p-text2:#52525b;--p-text3:#a1a1aa;--p-accent:#6C5CE7;--p-accent-l:#6C5CE7;--p-accent-h:#5b4bd5;--p-green:#00a884;--p-red:#dc2626;--p-yellow:#f59e0b;--p-input:rgba(0,0,0,.04);--p-input-b:rgba(0,0,0,.1);--p-shadow:0 2px 12px rgba(0,0,0,.06);--p-scroll:#d4d4d8}
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:'Poppins',sans-serif;background:var(--p-bg);color:var(--p-text);-webkit-font-smoothing:antialiased;transition:background .35s ease,color .35s ease}
a{text-decoration:none;color:inherit}
img{display:block;max-width:100%}
::-webkit-scrollbar{width:6px}::-webkit-scrollbar-track{background:transparent}::-webkit-scrollbar-thumb{background:var(--p-scroll);border-radius:3px}

/* LAYOUT */
.pf-section{max-width:1200px;margin:0 auto;padding:100px 24px 60px;display:grid;grid-template-columns:340px 1fr;gap:24px;align-items:start}
@media(max-width:900px){.pf-section{grid-template-columns:1fr;padding:80px 16px 40px}}

/* LEFT CARD */
.pf-left{position:sticky;top:100px}
.pf-card{background:var(--p-card);border:1px solid var(--p-border);border-radius:20px;padding:32px 24px;text-align:center;transition:all .35s ease}
.pf-img-wrap{width:120px;height:120px;border-radius:50%;margin:0 auto 20px;position:relative;cursor:pointer;overflow:hidden;border:3px solid var(--p-accent);box-shadow:0 0 0 6px rgba(108,92,231,.15);transition:all .3s ease}
.pf-img-wrap:hover{transform:scale(1.05);box-shadow:0 0 0 8px rgba(108,92,231,.25)}
.pf-img-wrap img{width:100%;height:100%;object-fit:cover}
.pf-img-overlay{position:absolute;inset:0;background:rgba(0,0,0,.5);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .3s ease;border-radius:50%}
.pf-img-wrap:hover .pf-img-overlay{opacity:1}
.pf-img-overlay i{color:#fff;font-size:22px}
.pf-name{font-size:20px;font-weight:700;margin-bottom:4px;transition:color .35s ease}
.pf-email{font-size:13px;color:var(--p-text3);margin-bottom:16px;transition:color .35s ease}
.pf-phone{display:flex;align-items:center;justify-content:center;gap:8px;font-size:13px;color:var(--p-text2);background:var(--p-input);border:1px solid var(--p-border);border-radius:10px;padding:10px 16px;margin-bottom:20px;transition:all .35s ease}
.pf-phone i{color:var(--p-accent-l);font-size:14px}
.pf-joined{font-size:11px;color:var(--p-text3);margin-bottom:20px;transition:color .35s ease}
.pf-edit-btn{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:12px;border-radius:12px;background:var(--p-accent);color:#fff;font-size:14px;font-weight:600;font-family:inherit;cursor:pointer;border:none;transition:all .3s ease;box-shadow:0 4px 15px rgba(108,92,231,.3)}
.pf-edit-btn:hover{background:var(--p-accent-h);transform:translateY(-1px)}

/* ALERT */
.pf-alert{padding:14px 18px;border-radius:12px;display:flex;align-items:center;gap:10px;font-size:13px;font-weight:500;margin-bottom:20px;animation:pfIn .35s ease}
@keyframes pfIn{from{opacity:0;transform:translateY(-8px)}to{opacity:1;transform:translateY(0)}}
.pf-alert.error{background:rgba(231,76,60,.08);border:1px solid rgba(231,76,60,.16);color:var(--p-red)}
.pf-alert.success{background:rgba(0,184,148,.08);border:1px solid rgba(0,184,148,.16);color:var(--p-green)}

/* RIGHT */
.pf-right{display:flex;flex-direction:column;gap:24px}

/* STATS */
.pf-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
@media(max-width:600px){.pf-stats{grid-template-columns:1fr 1fr 1fr}}
.pf-stat{background:var(--p-card);border:1px solid var(--p-border);border-radius:16px;padding:24px 20px;text-align:center;transition:all .35s ease}
.pf-stat:hover{border-color:var(--p-border-h);transform:translateY(-3px);box-shadow:var(--p-shadow)}
.pf-stat-icon{width:48px;height:48px;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:20px}
.pf-stat-icon.orders{background:rgba(108,92,231,.1);color:#a29bfe}
.pf-stat-icon.spent{background:rgba(0,184,148,.1);color:#00b894}
.pf-stat-icon.points{background:rgba(253,203,110,.1);color:#fdcb6e}
.pf-stat h3{font-size:24px;font-weight:800;margin-bottom:2px;transition:color .35s ease}
.pf-stat p{font-size:12px;color:var(--p-text3);font-weight:500;transition:color .35s ease}

/* ORDERS BOX */
.pf-orders{background:var(--p-card);border:1px solid var(--p-border);border-radius:20px;overflow:hidden;transition:all .35s ease}
.pf-orders-top{display:flex;align-items:center;justify-content:space-between;padding:20px 24px;border-bottom:1px solid var(--p-border);transition:border-color .35s ease}
.pf-orders-top h2{font-size:18px;font-weight:700;transition:color .35s ease}
.pf-orders-top a{font-size:13px;font-weight:600;color:var(--p-accent-l);display:flex;align-items:center;gap:6px;transition:all .25s ease}
.pf-orders-top a:hover{color:var(--p-accent);gap:10px}
.pf-order-item{display:flex;align-items:center;justify-content:space-between;padding:18px 24px;border-bottom:1px solid var(--p-border);transition:all .25s ease}
.pf-order-item:last-child{border-bottom:none}
.pf-order-item:hover{background:var(--p-card-h)}
.pf-order-left h3{font-size:14px;font-weight:600;margin-bottom:2px;transition:color .35s ease}
.pf-order-left p{font-size:12px;color:var(--p-text3);transition:color .35s ease}
.pf-order-right{text-align:right;display:flex;flex-direction:column;align-items:flex-end;gap:4px}
.pf-order-status{font-size:11px;font-weight:600;padding:4px 12px;border-radius:50px;display:inline-flex;align-items:center;gap:5px}
.pf-order-status::before{content:'';width:6px;height:6px;border-radius:50%;background:currentColor}
.pf-order-price{font-size:15px;font-weight:700;transition:color .35s ease}
.pf-empty{text-align:center;padding:48px 24px;color:var(--p-text3)}
.pf-empty i{font-size:40px;opacity:.3;margin-bottom:12px}
.pf-empty p{font-size:14px}

/* QUICK ACTIONS */
.pf-quick{background:var(--p-card);border:1px solid var(--p-border);border-radius:20px;padding:24px;transition:all .35s ease}
.pf-quick h3{font-size:16px;font-weight:700;margin-bottom:16px;transition:color .35s ease}
.pf-quick-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
@media(max-width:400px){.pf-quick-grid{grid-template-columns:1fr}}
.pf-quick-btn{display:flex;align-items:center;gap:12px;padding:14px 16px;border-radius:12px;background:var(--p-input);border:1px solid var(--p-border);font-size:13px;font-weight:500;color:var(--p-text2);cursor:pointer;transition:all .25s ease;font-family:inherit;text-decoration:none}
.pf-quick-btn:hover{border-color:var(--p-border-h);color:var(--p-text);background:var(--p-card-h);transform:translateY(-2px)}
.pf-quick-btn i{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0}
.pf-quick-btn .qi-orders{background:rgba(108,92,231,.1);color:#a29bfe}
.pf-quick-btn .qi-address{background:rgba(0,184,148,.1);color:#00b894}
.pf-quick-btn .qi-pass{background:rgba(231,76,60,.1);color:#e74c3c}
.pf-quick-btn .qi-logout{background:rgba(253,203,110,.1);color:#fdcb6e}

/* MOBILE */
@media(max-width:900px){.pf-left{position:static}.pf-card{max-width:400px;margin:0 auto}
}
</style>
</head>
<body>

<?php include "Navbar.php"; ?>

<section class="pf-section">

    <!-- LEFT -->
    <div class="pf-left">

        <div class="pf-card">

            <?php if ($alert): ?>
            <div class="pf-alert <?php echo $alertType; ?>">
                <i class="fa-solid <?php echo $alertType === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'; ?>"></i>
                <span><?php echo $alert; ?></span>
            </div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data" id="photoForm">
                <div class="pf-img-wrap" onclick="document.getElementById('photoInput').click()">
                    <img src="<?php echo $profileImage; ?>" alt="Profile">
                    <div class="pf-img-overlay">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <input type="file" name="profile_photo" id="photoInput" hidden accept="image/*" onchange="document.getElementById('photoForm').submit()">
                </div>
                <input type="hidden" name="upload_photo" value="1">
            </form>

            <h2 class="pf-name"><?php echo htmlspecialchars($user['full_name']); ?></h2>

            <p class="pf-email"><?php echo htmlspecialchars($user['email']); ?></p>

            <div class="pf-phone">
                <i class="fa-solid fa-phone"></i>
                <?php echo !empty($user['phone']) ? htmlspecialchars($user['phone']) : 'No phone added'; ?>
            </div>

            <p class="pf-joined">
                <i class="fa-regular fa-calendar"></i>
                Member since <?php echo date('M Y', strtotime($user['created_at'])); ?>
            </p>

            <a href="userupdate.php" class="pf-edit-btn">
                <i class="fa-solid fa-pen"></i>
                Edit Profile
            </a>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="pf-right">

        <!-- STATS -->
        <div class="pf-stats">
            <div class="pf-stat">
                <div class="pf-stat-icon orders"><i class="fa-solid fa-bag-shopping"></i></div>
                <h3><?php echo $totalOrders; ?></h3>
                <p>Total Orders</p>
            </div>
            <div class="pf-stat">
                <div class="pf-stat-icon spent"><i class="fa-solid fa-wallet"></i></div>
                <h3>₹<?php echo number_format($totalSpent); ?></h3>
                <p>Total Spent</p>
            </div>
            <div class="pf-stat">
                <div class="pf-stat-icon points"><i class="fa-solid fa-star"></i></div>
                <h3><?php echo $points; ?></h3>
                <p>Reward Points</p>
            </div>
        </div>

        <!-- QUICK ACTIONS -->
        <div class="pf-quick">
            <h3>Quick Actions</h3>
            <div class="pf-quick-grid">
                <a href="orders.php" class="pf-quick-btn">
                    <i class="qi-orders"><i class="fa-solid fa-box"></i></i>
                    My Orders
                </a>
                <a href="userupdate.php" class="pf-quick-btn">
                    <i class="qi-address"><i class="fa-solid fa-location-dot"></i></i>
                    Edit Address
                </a>
                <a href="reset-password.php" class="pf-quick-btn">
                    <i class="qi-pass"><i class="fa-solid fa-key"></i></i>
                    Change Password
                </a>
                <a href="logout.php" class="pf-quick-btn">
                    <i class="qi-logout"><i class="fa-solid fa-right-from-bracket"></i></i>
                    Logout
                </a>
            </div>
        </div>

        <!-- ORDERS -->
        <div class="pf-orders">
            <div class="pf-orders-top">
                <h2>Recent Orders</h2>
                <a href="orders.php">View All <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            <?php if ($latestOrders->num_rows > 0): ?>
                <?php while ($order = $latestOrders->fetch_assoc()):
                    $statusColor = getStatusColor($order['status']);
                    $statusBg = getStatusBg($order['status']);
                    $statusText = str_replace('_', ' ', ucfirst($order['status']));
                ?>
                <div class="pf-order-item">
                    <div class="pf-order-left">
                        <h3>#HG<?php echo str_pad($order['id'], 5, '0', STR_PAD_LEFT); ?></h3>
                        <p><i class="fa-regular fa-calendar" style="margin-right:4px"></i> <?php echo date('d M Y, h:i A', strtotime($order['created_at'])); ?></p>
                    </div>
                    <div class="pf-order-right">
                        <span class="pf-order-status" style="color:<?php echo $statusColor; ?>;background:<?php echo $statusBg; ?>"><?php echo $statusText; ?></span>
                        <span class="pf-order-price">₹<?php echo number_format($order['total']); ?></span>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="pf-empty">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <p>No orders yet</p>
                </div>
            <?php endif; ?>

        </div>

    </div>

</section>

</body>
</html>