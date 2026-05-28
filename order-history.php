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

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user's orders
$orders_result = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY order_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Order History | Hungroo Café</title>
<!-- Include styles and fonts here -->
</head>
<body>

<?php include "Navbar.php"; ?>

<div class="ct-header">
    <h1>Your Order History</h1>
</div>

<div class="order-list">
    <?php if(mysqli_num_rows($orders_result) == 0): ?>
        <p>You have no orders yet.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php while($order = mysqli_fetch_assoc($orders_result)): ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo date('d M Y H:i', strtotime($order['order_date'])); ?></td>
                        <td>₹<?php echo number_format($order['total_amount'], 2); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td><a href="order_details.php?order_id=<?php echo $order['id']; ?>">View</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include "footer.php"; ?>

</body>
</html>