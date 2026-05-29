<?php
/* =========================================================
FILE: edit-profile.php (REDESIGNED)
========================================================= */

// Include Config (Handles Session Start automatically)
include "config/config.php";

/* =========================================================
LOGIN CHECK
========================================================= */
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

/* =========================================================
FETCH USER DATA
========================================================= */
 $userId = intval($_SESSION['user_id']);

// Secure Fetch
 $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
 $stmt->bind_param("i", $userId);
 $stmt->execute();
 $result = $stmt->get_result();

if(!$result || $result->num_rows == 0){
    session_destroy();
    header("Location: login.php");
    exit;
}

 $user = $result->fetch_assoc();

/* =========================================================
FORM HANDLING
========================================================= */
 $message = "";
 $msgType = ""; // success or error

if(isset($_POST['save_profile'])){
    
    $full_name = trim($_POST['full_name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);

    // Basic Validation
    if(empty($full_name) || empty($email)){
        $message = "Name and Email are required.";
        $msgType = "error";
    } else {
        
        // Check if Email exists for ANOTHER user
        $checkEmail = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
        $checkEmail->bind_param("si", $email, $userId);
        $checkEmail->execute();
        $emailRes = $checkEmail->get_result();

        // Check if Phone exists for ANOTHER user (only if phone is provided)
        $phoneRes = null;
        if(!empty($phone)){
            $checkPhone = $conn->prepare("SELECT id FROM users WHERE phone = ? AND id != ?");
            $checkPhone->bind_param("si", $phone, $userId);
            $checkPhone->execute();
            $phoneRes = $checkPhone->get_result();
        }

        if($emailRes && $emailRes->num_rows > 0){
            $message = "Email is already used by another account.";
            $msgType = "error";
        } elseif($phoneRes && $phoneRes->num_rows > 0){
            $message = "Phone number is already used by another account.";
            $msgType = "error";
        } else {
            // Update Profile (Prepared Statement)
            $update = $conn->prepare("UPDATE users SET full_name = ?, phone = ?, email = ? WHERE id = ?");
            $update->bind_param("sssi", $full_name, $phone, $email, $userId);
            
            if($update->execute()){
                // Update Session Name
                $_SESSION['user_name'] = $full_name;
                
                $message = "Profile updated successfully!";
                $msgType = "success";
                
                // Refresh User Data
                $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
                $stmt->bind_param("i", $userId);
                $stmt->execute();
                $user = $stmt->get_result()->fetch_assoc();
            } else {
                $message = "Failed to update profile. Please try again.";
                $msgType = "error";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile | Hungroo Café</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Navbar/Footer -->
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/footer.css">

    <style>
        /* =========================================================
           VARIABLES & THEME (PURPLE)
           ========================================================= */
        :root {
            --primary: #6C5CE7;
            --primary-glow: rgba(108, 92, 231, 0.4);
            --secondary: #a29bfe;
            --bg-body: #09090b;
            --bg-card: rgba(23, 23, 28, 0.7);
            --border: rgba(255, 255, 255, 0.08);
            --text-main: #ffffff;
            --text-muted: #a1a1aa;
            --danger: #ff7675;
            --success: #00b894;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Background Ambience */
        .bg-blob {
            position: fixed;
            width: 500px;
            height: 500px;
            background: var(--primary);
            filter: blur(150px);
            border-radius: 50%;
            opacity: 0.1;
            z-index: -1;
        }
        .blob-1 { top: -100px; left: -100px; }
        .blob-2 { bottom: -100px; right: -100px; background: var(--secondary); }

        /* =========================================================
           LAYOUT
           ========================================================= */
        .profile-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 140px 20px 80px;
        }

        .profile-card {
            width: 100%;
            max-width: 500px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 32px;
            padding: 40px;
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Header */
        .card-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .avatar-container {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #fff;
            box-shadow: 0 10px 30px var(--primary-glow);
            position: relative;
        }

        .card-header h2 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .card-header p {
            color: var(--text-muted);
            font-size: 14px;
        }

        /* Form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .input-wrapper {
            position: relative;
            height: 54px;
        }

        .input-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 16px;
            transition: 0.3s;
        }

        .input-field {
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.03);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 0 18px 0 50px; /* Left padding for icon */
            color: #fff;
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(255,255,255,0.06);
            box-shadow: 0 0 0 4px rgba(108, 92, 231, 0.1);
        }
        
        .input-field:focus + i {
            color: var(--primary);
        }

        /* Buttons */
        .actions {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            flex: 1;
            height: 54px;
            border-radius: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            text-align: center;
            line-height: 54px;
            text-decoration: none;
            border: none;
            font-size: 15px;
        }

        .btn-cancel {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--text-muted);
        }

        .btn-cancel:hover {
            background: rgba(255,255,255,0.05);
            color: #fff;
        }

        .btn-save {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            box-shadow: 0 10px 25px var(--primary-glow);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px var(--primary-glow);
        }

        /* Alerts */
        .alert {
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            text-align: center;
            justify-content: center;
        }

        .alert.success {
            background: rgba(0, 184, 148, 0.15);
            color: var(--success);
            border: 1px solid rgba(0, 184, 148, 0.3);
        }

        .alert.error {
            background: rgba(255, 118, 117, 0.15);
            color: var(--danger);
            border: 1px solid rgba(255, 118, 117, 0.3);
        }

        /* Responsive */
        @media (max-width: 600px) {
            .profile-section { padding-top: 120px; }
            .actions { flex-direction: column-reverse; }
        }
    </style>
</head>
<body>

    <!-- Background Effects -->
    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>

    <?php include "Navbar.php"; ?>

    <section class="profile-section">
        
        <div class="profile-card">
            
            <div class="card-header">
                <div class="avatar-container">
                    <i class="fa-solid fa-user"></i>
                </div>
                <h2>Edit Profile</h2>
                <p>Update your personal information</p>
            </div>

            <form method="POST">
                
                <!-- Alert Message -->
                <?php if(!empty($message)): ?>
                <div class="alert <?php echo $msgType; ?>">
                    <i class="fa-solid <?php echo $msgType == 'success' ? 'fa-circle-check' : 'fa-circle-exclamation'; ?>"></i>
                    <?php echo $message; ?>
                </div>
                <?php endif; ?>

                <!-- Full Name -->
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <div class="input-wrapper">
                        <input type="text" name="full_name" class="input-field" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <div class="input-wrapper">
                        <input type="email" name="email" class="input-field" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <div class="input-wrapper">
                        <input type="text" name="phone" class="input-field" value="<?php echo htmlspecialchars($user['phone']); ?>" placeholder="Enter phone number">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                </div>

                <!-- Actions -->
                <div class="actions">
                    <a href="profile.php" class="btn btn-cancel">Cancel</a>
                    <button type="submit" name="save_profile" class="btn btn-save">Save Changes</button>
                </div>

            </form>

        </div>

    </section>

    <?php include "footer.php"; ?>

</body>
</html>