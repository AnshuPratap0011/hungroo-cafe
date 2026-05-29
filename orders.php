<?php
/* =========================================================
FILE: orders.php (REDESIGNED)
THEME: PURPLE PROFESSIONAL
========================================================= */

include "check-auth.php";

/* =========================================================
DB CONNECTION (Check connection)
========================================================= */
// Assuming $conn is available from check-auth.php or config included in it.
// If not, include config.php here if check-auth doesn't.
if (!isset($conn)) {
    include "config/config.php";
}

/* =========================================================
USER ID
========================================================= */
 $userId = intval($_SESSION['user_id']);

/* =========================================================
GET ORDERS (SECURE PREPARED STATEMENT)
========================================================= */
// Fetching all columns described in your schema
 $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
 $stmt->bind_param("i", $userId);
 $stmt->execute();
 $ordersQuery = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders | Hungroo Café</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Navbar Styles (Keep your file, or define inline if missing) -->
    <link rel="stylesheet" href="assets/css/navbar.css">

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
            
            --status-pending: #fdcb6e;
            --status-processing: #74b9ff;
            --status-delivered: #00b894;
            --status-cancelled: #ff7675;
        }

        /* =========================================================
           RESET & BASE
           ========================================================= */
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
            overflow-x: hidden;
        }

        /* Background Effects */
        .bg-blob {
            position: fixed;
            width: 500px;
            height: 500px;
            background: var(--primary);
            filter: blur(150px);
            border-radius: 50%;
            opacity: 0.15;
            z-index: -1;
        }
        .blob-1 { top: -100px; right: -100px; }
        .blob-2 { bottom: -100px; left: -100px; background: var(--secondary); }

        /* =========================================================
           LAYOUT
           ========================================================= */
        .orders-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 140px 20px 80px;
        }

        .header-area {
            text-align: center;
            margin-bottom: 60px;
            position: relative;
        }

        .header-area h1 {
            font-size: 48px;
            font-weight: 800;
            background: linear-gradient(to right, #fff, var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .header-area p {
            color: var(--text-muted);
            font-size: 16px;
        }

        /* =========================================================
           GRID & CARDS
           ========================================================= */
        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 25px;
        }

        .order-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 24px;
            backdrop-filter: blur(12px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
            border-color: rgba(108, 92, 231, 0.3);
        }

        /* Decorative Top Border */
        .order-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            opacity: 0;
            transition: opacity 0.3s;
        }
        .order-card:hover::before { opacity: 1; }

        /* Card Header */
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }

        .order-id-box h3 {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
        }
        .order-id-box span {
            font-size: 12px;
            color: var(--text-muted);
        }

        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Status Colors */
        .status-pending { background: rgba(253, 203, 110, 0.15); color: var(--status-pending); }
        .status-processing { background: rgba(116, 185, 255, 0.15); color: var(--status-processing); }
        .status-delivered { background: rgba(0, 184, 148, 0.15); color: var(--status-delivered); }
        .status-cancelled { background: rgba(255, 118, 117, 0.15); color: var(--status-cancelled); }

        /* Card Body */
        .card-body {
            flex: 1;
            margin-bottom: 20px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .detail-label { color: var(--text-muted); }
        .detail-value { font-weight: 600; color: #fff; }

        .payment-method {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.03);
            padding: 6px 12px;
            border-radius: 10px;
            font-size: 12px;
            margin-top: 15px;
            color: var(--secondary);
        }

        /* Price Section */
        .price-section {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid var(--border);
        }

        .total-label { color: var(--text-muted); font-size: 13px; margin-bottom: 4px; }
        .total-amount { 
            font-size: 24px; 
            font-weight: 800; 
            color: var(--text-main); 
        }

        /* Actions */
        .card-actions {
            margin-top: 20px;
            display: flex;
            gap: 12px;
        }

        .btn-action {
            flex: 1;
            height: 44px;
            border-radius: 12px;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
        }
        .btn-primary:hover { filter: brightness(1.1); }

        .btn-secondary {
            background: rgba(255,255,255,0.05);
            color: var(--text-muted);
            border: 1px solid var(--border);
        }
        .btn-secondary:hover { background: rgba(255,255,255,0.1); color: #fff; }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 32px;
        }
        .empty-state i {
            font-size: 60px;
            color: var(--primary);
            margin-bottom: 20px;
        }
        .empty-state h2 { font-size: 28px; margin-bottom: 10px; }
        .empty-state p { color: var(--text-muted); margin-bottom: 30px; }
        .btn-menu {
            display: inline-block;
            padding: 14px 32px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #fff;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(108, 92, 231, 0.4);
        }

        /* Responsive */
        @media (max-width: 600px) {
            .orders-section { padding-top: 120px; }
            .header-area h1 { font-size: 32px; }
            .orders-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- Background Ambience -->
    <div class="bg-blob blob-1"></div>
    <div class="bg-blob blob-2"></div>

    <!-- Navbar -->
    <?php include "Navbar.php"; ?>

    <section class="orders-section">
        
        <div class="header-area">
            <h1>Order History</h1>
            <p>Track your delicious journey with Hungroo Café</p>
        </div>

        <?php if ($ordersQuery && $ordersQuery->num_rows > 0): ?>
            
            <div class="orders-grid">
                
                <?php while($order = $ordersQuery->fetch_assoc()): 
                    
                    // Determine Status Class
                    $statusClass = 'status-pending';
                    $statusClean = strtolower($order['status']);
                    
                    if($statusClean == 'processing') $statusClass = 'status-processing';
                    if($statusClean == 'delivered' || $statusClean == 'completed') $statusClass = 'status-delivered';
                    if($statusClean == 'cancelled') $statusClass = 'status-cancelled';

                    // Format Date
                    $orderDate = date("d M Y, h:i A", strtotime($order['created_at']));
                    
                    // Order Number Priority (use order_number if exists, else ID)
                    $displayId = isset($order['order_number']) ? $order['order_number'] : '#' . $order['id'];

                ?>

                <div class="order-card">
                    
                    <!-- Header: ID & Status -->
                    <div class="card-header">
                        <div class="order-id-box">
                            <h3><?php echo $displayId; ?></h3>
                            <span><?php echo $orderDate; ?></span>
                        </div>
                        <span class="status-badge <?php echo $statusClass; ?>">
                            <?php echo ucfirst($order['status']); ?>
                        </span>
                    </div>

                    <!-- Body: Details -->
                    <div class="card-body">
                        <?php if(isset($order['customer_name'])): ?>
                        <div class="detail-row">
                            <span class="detail-label">Customer</span>
                            <span class="detail-value"><?php echo htmlspecialchars($order['customer_name']); ?></span>
                        </div>
                        <?php endif; ?>

                        <div class="detail-row">
                            <span class="detail-label">Items</span>
                            <span class="detail-value">Multiple Items</span>
                        </div>

                        <?php if(isset($order['payment_method'])): ?>
                        <div class="payment-method">
                            <i class="fa-solid fa-credit-card"></i>
                            <?php echo ucfirst($order['payment_method']); ?>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Footer: Price -->
                    <div class="price-section">
                        <div>
                            <div class="total-label">Total Amount</div>
                            <?php if(isset($order['total_amount']) && isset($order['delivery_fee'])): ?>
                                <div style="font-size:11px; color:var(--text-muted);">
                                    (Subtotal: ₹<?php echo number_format($order['total_amount'] - $order['delivery_fee']); ?> + Fee: ₹<?php echo number_format($order['delivery_fee']); ?>)
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="total-amount">
                            ₹<?php echo number_format($order['total_amount']); ?>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="card-actions">
                        <a href="order-details.php?id=<?php echo $order['id']; ?>" class="btn-action btn-primary">
                            View Details
                        </a>
                        <!-- Only show track if not cancelled -->
                        <?php if($statusClean != 'cancelled'): ?>
                        <a href="track-order.php" class="btn-action btn-secondary">
                            <i class="fa-solid fa-truck"></i> Track
                        </a>
                        <?php endif; ?>
                    </div>

                </div>

                <?php endwhile; ?>

            </div>

        <?php else: ?>

            <!-- Empty State -->
            <div class="empty-state">
                <i class="fa-solid fa-basket-shopping"></i>
                <h2>No Orders Found</h2>
                <p>You haven't placed any orders yet. Start exploring our menu!</p>
                <a href="menu.php" class="btn-menu">Browse Menu</a>
            </div>

        <?php endif; ?>

    </section>

</body>
</html>