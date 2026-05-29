<?php
/* =========================================================
CONFIG & SECURITY
========================================================= */
// Include Config (This handles session_start() automatically)
include "config/config.php";

 $pageTitle = "Hungroo Café | Contact Us";

 $success = false;
 $error = "";

/* =========================================================
FORM HANDLING (SECURE)
========================================================= */
if(isset($_POST['send_message'])){
    // Sanitize inputs (Basic XSS prevention)
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validation
    if(empty($full_name) || empty($email) || empty($message)){
        $error = "Please fill in all required fields (Name, Email, Message).";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Please enter a valid email address.";
    } else {
        // Secure Insertion using Prepared Statements
        $stmt = $conn->prepare("INSERT INTO contact_messages (full_name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        
        if($stmt){
            $stmt->bind_param("sssss", $full_name, $email, $phone, $subject, $message);
            
            if($stmt->execute()){
                $success = true;
                // Clear form values after success
                $full_name = $email = $phone = $subject = $message = "";
            } else {
                $error = "Database error: Could not save message.";
            }
            $stmt->close();
        } else {
            $error = "System error: Please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            --bg-color: #09090b;
            --card-bg: rgba(23, 23, 28, 0.7);
            --border-color: rgba(255, 255, 255, 0.08);
            --primary: #6C5CE7;
            --primary-hover: #5b4cc4;
            --text-main: #ffffff;
            --text-muted: #a1a1aa;
            --input-bg: #111111;
            --success: #00b894;
            --error: #ff4d4d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Background Ambience */
        .bg-blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            z-index: -1;
            opacity: 0.4;
        }
        .blob-1 { width: 400px; height: 400px; background: var(--primary); top: -100px; left: -100px; }
        .blob-2 { width: 300px; height: 300px; background: #00cec9; bottom: -50px; right: -50px; }

        /* Layout */
        .contact-wrapper {
            max-width: 1100px;
            margin: 140px auto 80px;
            padding: 0 20px;
        }

        .hero-section {
            text-align: center;
            margin-bottom: 50px;
        }

        .hero-section h1 {
            font-size: 42px;
            font-weight: 700;
            background: linear-gradient(to right, #fff, #a1a1aa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .hero-section p {
            color: var(--text-muted);
            font-size: 16px;
        }

        /* Grid Layout */
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 40px;
            align-items: start;
        }

        /* Cards */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 40px;
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        /* Contact Info Column */
        .info-col h2 {
            font-size: 28px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 30px;
        }

        .icon-box {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            background: rgba(108, 92, 231, 0.15);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .info-content h4 {
            font-size: 18px;
            margin-bottom: 5px;
            color: #fff;
        }

        .info-content p {
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.6;
        }

        /* Form Column */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #d1d1d6;
            font-size: 13px;
            font-weight: 500;
        }

        .input-field {
            width: 100%;
            height: 52px;
            background: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 0 18px;
            color: #fff;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(108, 92, 231, 0.1);
        }

        textarea.input-field {
            height: 140px;
            padding: 15px 18px;
            resize: vertical;
        }

        .submit-btn {
            width: 100%;
            height: 54px;
            background: linear-gradient(135deg, var(--primary), #8c7bff);
            border: none;
            border-radius: 14px;
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 10px 20px rgba(108, 92, 231, 0.25);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(108, 92, 231, 0.35);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Alerts */
        .alert {
            padding: 16px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert.success {
            background: rgba(0, 184, 148, 0.1);
            border: 1px solid rgba(0, 184, 148, 0.3);
            color: var(--success);
        }

        .alert.error {
            background: rgba(255, 77, 77, 0.1);
            border: 1px solid rgba(255, 77, 77, 0.3);
            color: var(--error);
        }

        /* Responsive */
        @media(max-width: 900px) {
            .grid-container {
                grid-template-columns: 1fr;
            }
            .contact-wrapper {
                margin-top: 100px;
            }
        }
    </style>
</head>
<body>

    <!-- Background Effects -->
    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>

    <!-- Navbar -->
    <?php include "Navbar.php"; ?>

    <div class="contact-wrapper">
        
        <!-- Header -->
        <div class="hero-section">
            <h1>Contact Hungroo Café</h1>
            <p>Have questions? We’d love to hear from you. Send us a message and we’ll respond as soon as possible.</p>
        </div>

        <div class="grid-container">
            
            <!-- Left: Contact Information -->
            <div class="card info-col">
                <h2>Get In Touch</h2>
                
                <div class="info-item">
                    <div class="icon-box">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="info-content">
                        <h4>Our Location</h4>
                        <p>123 Flavor Street, Foodie District,<br>Mumbai, India 400001</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="icon-box">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="info-content">
                        <h4>Email Us</h4>
                        <p>support@hungroocafe.com<br>booking@hungroocafe.com</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="icon-box">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="info-content">
                        <h4>Call Us</h4>
                        <p>+91 98765 43210<br>Mon-Fri, 9am - 6pm</p>
                    </div>
                </div>

                <div style="margin-top: 40px;">
                    <p style="color: var(--text-muted); font-size: 13px; margin-bottom: 15px;">Follow us on social media</p>
                    <div style="display: flex; gap: 15px;">
                        <a href="#" style="color: #fff; font-size: 20px;"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" style="color: #fff; font-size: 20px;"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" style="color: #fff; font-size: 20px;"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
            </div>

            <!-- Right: Contact Form -->
            <div class="card form-col">
                
                <!-- PHP Alerts -->
                <?php if($success): ?>
                    <div class="alert success">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>Your message has been sent successfully! We will contact you shortly.</span>
                    </div>
                <?php endif; ?>

                <?php if($error): ?>
                    <div class="alert error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span><?php echo $error; ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <div class="form-group">
                        <label class="form-label">Full Name <span style="color:var(--primary)">*</span></label>
                        <input class="input-field" type="text" name="full_name" placeholder="e.g. John Doe" value="<?php echo isset($full_name) ? $full_name : ''; ?>" required>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label class="form-label">Email Address <span style="color:var(--primary)">*</span></label>
                            <input class="input-field" type="email" name="email" placeholder="john@example.com" value="<?php echo isset($email) ? $email : ''; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input class="input-field" type="text" name="phone" placeholder="+91 98765 43210" value="<?php echo isset($phone) ? $phone : ''; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input class="input-field" type="text" name="subject" placeholder="How can we help?" value="<?php echo isset($subject) ? $subject : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message <span style="color:var(--primary)">*</span></label>
                        <textarea class="input-field" name="message" placeholder="Type your message here..." required><?php echo isset($message) ? $message : ''; ?></textarea>
                    </div>

                    <button type="submit" name="send_message" class="submit-btn">
                        Send Message <i class="fa-solid fa-paper-plane" style="margin-left: 8px;"></i>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <?php include "footer.php"; ?>

</body>
</html>