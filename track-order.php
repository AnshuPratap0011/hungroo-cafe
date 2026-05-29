<?php
/* =========================================================
FILE: track-order.php (REDESIGNED)
FUNCTIONALITY: DYNAMIC DATABASE TRACKING
========================================================= */

// Include Config
include "config/config.php"; 

// Include Navbar/Footer (assuming these exist in your root)
// If check-auth.php handles auth, include that instead. 
// For public tracking, usually auth isn't required, but let's keep it simple.
 $pageTitle = "Hungroo Café | Track Order";

/* =========================================================
LOGIC: FETCH ORDER
========================================================= */
 $order = null;
 $error = "";

// 1. Check if coming from Orders page (URL Parameter)
if (isset($_GET['id'])) {
    $searchId = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->bind_param("i", $searchId);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        $error = "Order not found.";
    }
}

// 2. Check if coming from Search Form (POST)
if (isset($_POST['track_order'])) {
    $searchInput = trim($_POST['order_id']);
    // Allow searching by ID or Order Number if column exists
    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ? OR order_number = ?");
    $stmt->bind_param("is", $searchInput, $searchInput);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        // Reset error if found
        $error = ""; 
    } else {
        $error = "No order found with ID: " . htmlspecialchars($searchInput);
    }
}

/* =========================================================
HELPER: DETERMINE TIMELINE STATE
========================================================= */
function getStepClass($currentStatus, $stepStatus) {
    $current = strtolower($currentStatus);
    
    // Map database statuses to steps
    // Step 1: Confirmed (pending, processing, etc.)
    // Step 2: Preparing
    // Step 3: Out For Delivery (shipped, out_for_delivery)
    // Step 4: Delivered
    
    if ($current == 'cancelled') return 'cancelled';
    
    switch ($stepStatus) {
        case 'confirmed':
            return 'active'; // Always active if order exists
        case 'preparing':
            return ($current == 'processing' || $current == 'shipped' || $current == 'out_for_delivery' || $current == 'delivered') ? 'active' : 'pending';
        case 'shipping':
            return ($current == 'shipped' || $current == 'out_for_delivery' || $current == 'delivered') ? 'active' : 'pending';
        case 'delivered':
            return ($current == 'delivered') ? 'active' : 'pending';
        default:
            return 'pending';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Navbar/Footer Styles -->
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/footer.css">

    <style>
        /* =========================================================
           VARIABLES & THEME (PURPLE)
           ========================================================= */
        :root {
            --primary: #6C5CE7;
            --secondary: #a29bfe;
            --bg-body: #09090b;
            --bg-card: rgba(23, 23, 28, 0.7);
            --border: rgba(255, 255, 255, 0.08);
            --text-main: #ffffff;
            --text-muted: #a1a1aa;
            
            --success: #00b894;
            --warning: #fdcb6e;
            --danger: #ff7675;
        }

        /* =========================================================
           BASE
           ========================================================= */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Background Blobs */
        .bg-blob {
            position: fixed;
            width: 400px;
            height: 400px;
            background: var(--primary);
            filter: blur(120px);
            border-radius: 50%;
            opacity: 0.15;
            z-index: -1;
        }
        .blob-1 { top: -100px; left: -100px; }
        .blob-2 { bottom: -100px; right: -100px; background: var(--secondary); }

        /* =========================================================
           LAYOUT
           ========================================================= */
        .track-page {
            max-width: 800px;
            margin: 0 auto;
            padding: 140px 20px 80px;
        }

        .hero {
            text-align: center;
            margin-bottom: 50px;
        }

        .hero h1 {
            font-size: 42px;
            font-weight: 800;
            background: linear-gradient(to right, #fff, var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
        }

        .hero p { color: var(--text-muted); }

        /* =========================================================
           SEARCH BAR
           ========================================================= */
        .search-container {
            display: flex;
            gap: 15px;
            background: var(--bg-card);
            padding: 10px;
            border-radius: 20px;
            border: 1px solid var(--border);
            backdrop-filter: blur(10px);
            margin-bottom: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .search-input {
            flex: 1;
            background: transparent;
            border: none;
            padding: 15px 20px;
            color: #fff;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;
        }
        .search-input::placeholder { color: var(--text-muted); }
        .search-input:focus { outline: none; }

        .search-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            border: none;
            padding: 0 35px;
            border-radius: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }
        .search-btn:hover { box-shadow: 0 0 15px rgba(108, 92, 231, 0.5); }

        /* =========================================================
           TRACKING CARD
           ========================================================= */
        .track-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 32px;
            padding: 40px;
            backdrop-filter: blur(20px);
            position: relative;
            overflow: hidden;
            display: none; /* Hidden by default */
            animation: slideUp 0.5s ease;
        }

        .track-card.show { display: block; }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .order-id h3 { font-size: 24px; margin-bottom: 5px; }
        .order-id span { color: var(--text-muted); font-size: 14px; }

        .current-status {
            text-align: right;
        }
        .status-label { color: var(--text-muted); font-size: 12px; text-transform: uppercase; letter-spacing: 1px; }
        .status-text { font-size: 20px; font-weight: 700; color: var(--primary); }

        /* =========================================================
           TIMELINE
           ========================================================= */
        .timeline {
            position: relative;
            padding-left: 40px;
        }

        /* Vertical Line */
        .timeline::before {
            content: '';
            position: absolute;
            left: 23px;
            top: 10px;
            bottom: 10px;
            width: 2px;
            background: var(--border);
            z-index: 0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 45px;
            z-index: 1;
        }

        .timeline-item:last-child { margin-bottom: 0; }

        .timeline-icon {
            position: absolute;
            left: -40px;
            top: 0;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--bg-body);
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-muted);
            font-size: 18px;
            transition: 0.3s;
        }

        /* Active State */
        .timeline-item.active .timeline-icon {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
            box-shadow: 0 0 20px rgba(108, 92, 231, 0.6);
            animation: pulse 2s infinite;
        }

        /* Completed State (Previous steps) */
        .timeline-item.completed .timeline-icon {
            background: var(--success);
            border-color: var(--success);
            color: #fff;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(108, 92, 231, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(108, 92, 231, 0); }
            100% { box-shadow: 0 0 0 0 rgba(108, 92, 231, 0); }
        }

        .timeline-content h4 { font-size: 18px; margin-bottom: 5px; }
        .timeline-content p { color: var(--text-muted); font-size: 14px; line-height: 1.5; }
        .timeline-date { font-size: 12px; color: var(--primary); margin-top: 8px; display: inline-block; opacity: 0; transition: 0.3s; }
        
        .timeline-item.active .timeline-date,
        .timeline-item.completed .timeline-date { opacity: 1; }

        /* Error Message */
        .error-msg {
            background: rgba(255, 118, 117, 0.1);
            color: var(--danger);
            padding: 20px;
            border-radius: 16px;
            text-align: center;
            border: 1px solid rgba(255, 118, 117, 0.3);
            display: none;
        }
        .error-msg.show { display: block; }

        /* Responsive */
        @media (max-width: 600px) {
            .track-page { padding-top: 120px; }
            .search-container { flex-direction: column; }
            .search-btn { padding: 15px; width: 100%; }
            .card-header { flex-direction: column; align-items: flex-start; gap: 15px; }
            .current-status { text-align: left; }
        }
    </style>
</head>
<body>

    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>

    <?php include "Navbar.php"; ?>

    <main class="track-page">
        
        <div class="hero">
            <h1>Track Your Order</h1>
            <p>Enter your Order ID to see real-time updates.</p>
        </div>

        <!-- SEARCH FORM -->
        <form method="POST" class="search-container">
            <input type="text" name="order_id" class="search-input" placeholder="Enter Order ID (e.g. 105)" required value="<?php echo isset($order) ? $order['id'] : ''; ?>">
            <button type="submit" name="track_order" class="search-btn">
                <i class="fa-solid fa-magnifying-glass"></i> Track
            </button>
        </form>

        <!-- ERROR MESSAGE -->
        <?php if($error): ?>
        <div class="error-msg show">
            <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?>
        </div>
        <?php endif; ?>

        <!-- TRACKING RESULT CARD -->
        <?php if($order): 
            $status = strtolower($order['status']);
            $cancelled = ($status == 'cancelled');
            
            // Logic for timeline classes
            $s1 = 'active'; 
            if($cancelled) $s1 = 'cancelled';

            $s2 = 'pending';
            if($status == 'processing' || $status == 'shipped' || $status == 'out_for_delivery' || $status == 'delivered') $s2 = 'active';
            if($status == 'shipped' || $status == 'out_for_delivery' || $status == 'delivered') $s2 = 'completed';
            if($cancelled) $s2 = 'cancelled';

            $s3 = 'pending';
            if($status == 'shipped' || $status == 'out_for_delivery' || $status == 'delivered') $s3 = 'active';
            if($status == 'delivered') $s3 = 'completed';
            if($cancelled) $s3 = 'cancelled';

            $s4 = 'pending';
            if($status == 'delivered') $s4 = 'active';
            if($cancelled) $s4 = 'cancelled';
        ?>

        <div class="track-card show">
            
            <div class="card-header">
                <div class="order-id">
                    <h3>Order #<?php echo $order['id']; ?></h3>
                    <span>Placed on <?php echo date("d M Y, h:i A", strtotime($order['created_at'])); ?></span>
                </div>
                <div class="current-status">
                    <div class="status-label">Current Status</div>
                    <div class="status-text" style="color: <?php echo $cancelled ? 'var(--danger)' : 'var(--primary)'; ?>">
                        <?php echo ucfirst($order['status']); ?>
                    </div>
                </div>
            </div>

            <div class="timeline">
                
                <!-- Step 1 -->
                <div class="timeline-item <?php echo $s1; ?>">
                    <div class="timeline-icon">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div class="timeline-content">
                        <h4>Order Confirmed</h4>
                        <p>We have received your order and sent it to the kitchen.</p>
                        <div class="timeline-date">Processing Started</div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="timeline-item <?php echo $s2; ?>">
                    <div class="timeline-icon">
                        <i class="fa-solid fa-fire-burner"></i>
                    </div>
                    <div class="timeline-content">
                        <h4>Preparing</h4>
                        <p>Our chefs are expertly preparing your delicious meal.</p>
                        <div class="timeline-date">Kitchen Time</div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="timeline-item <?php echo $s3; ?>">
                    <div class="timeline-icon">
                        <i class="fa-solid fa-motorcycle"></i>
                    </div>
                    <div class="timeline-content">
                        <h4>Out for Delivery</h4>
                        <p>Your order has been picked up by our delivery partner.</p>
                        <div class="timeline-date">On the way</div>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="timeline-item <?php echo $s4; ?>">
                    <div class="timeline-icon">
                        <i class="fa-solid fa-house-chimney"></i>
                    </div>
                    <div class="timeline-content">
                        <h4>Delivered</h4>
                        <p>Order has been delivered successfully. Enjoy your meal!</p>
                        <div class="timeline-date">Arrived</div>
                    </div>
                </div>

            </div>

        </div>

        <?php endif; ?>

    </main>

    <?php include "footer.php"; ?>
    <script src="assets/js/theme.js"></script>
</body>
</html>