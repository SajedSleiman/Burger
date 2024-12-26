<?php
include '../components/connection.php'; 

$sql = "SELECT * FROM completed_orders";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Orders</title>
    <link rel="stylesheet" href="../admin_styles.css">
</head>
<body>
    <?php include "../components/admin_header.php"; ?>
    <section class="placed-orders">
        <div class="box-container">
            <div class="box">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($order = mysqli_fetch_assoc($result)) {
                ?>
                    <p> Order ID : <span><?php echo htmlspecialchars($order['id']); ?></span> </p>
                    <p> User ID : <span><?php echo htmlspecialchars($order['user_id']); ?></span> </p>
                    <p> Name : <span><?php echo htmlspecialchars($order['user_name']); ?></span> </p>
                    <p> Email : <span><?php echo htmlspecialchars($order['email']); ?></span> </p>
                    <p> Address : <span><?php echo htmlspecialchars($order['address']); ?></span> </p>
                    <p> Total Products : <span><?php echo htmlspecialchars($order['total_products']); ?></span> </p>
                    <p> Total Price : <span>$<?php echo htmlspecialchars($order['total_price']); ?>/-</span> </p>
                    <p> Placed On : <span><?php echo htmlspecialchars($order['placed_on']); ?></span> </p>
                    <p> Method : <span><?php echo htmlspecialchars($order['method']); ?></span> </p>
                <?php
                    }
                } else {
                    echo "<p class='empty'>No Completed Orders Yet!</p>";
                }
                ?>
            </div>
        </div>
    </section>
    <?php mysqli_close($con); ?>
</body>
<script src="../js/admin_script.js"></script>
</html>
