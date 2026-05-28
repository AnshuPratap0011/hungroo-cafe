<?php
session_start();
ob_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "boba_hungroo";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Database Connection Failed : " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");

// Get order ID from URL
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

// Fetch order details
$order_result = mysqli_query($conn, "SELECT * FROM orders WHERE id = '$order_id' AND user_id = '{$_SESSION['user_id']}'");
if (mysqli_num_rows($order_result) == 0) {
    echo "Order not found.";
    exit;
}
$order = mysqli_fetch_assoc($order_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Order Successful | Hungroo Café</title>
<!-- Include styles and fonts here -->
</head>
<body>

<?php include "Navbar.php"; ?>

<div class="ct-header">
    <h1>Thank You for Your Order!</h1>
    <p>Your order #<?php echo $order['id']; ?> has been placed successfully.</p>
</div>

<div class="order-details">
    <h2>Order Details</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($order['name']); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($order['phone']); ?></p>
    <p><strong>Address:</strong> <?php echo htmlspecialchars($order['address']); ?></p>
    <p><strong>Total Amount:</strong> ₹<?php echo number_format($order['total_amount'], 2); ?></p>
    <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?></p>
</div>

<a href="index.php" class="btn">Continue Shopping</a>

<?php include "footer.php"; ?>

</body>
</html>