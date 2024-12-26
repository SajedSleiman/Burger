<?php
include '../components/connection.php'; 

if (isset($_POST['update_payment'])) {
    $order_id = $_POST['order_id'];
    $payment_status = $_POST['payment_status'];

    if (!empty($order_id) && !empty($payment_status)) {
        if ($payment_status == 'completed') {
            // Move the order to the completed_orders table
            $move_query = "INSERT INTO completed_orders (user_id, user_name, email, address, total_products, total_price, method, payment_status, placed_on)
                           SELECT user_id, user_name, email, address, total_products, total_price, method, payment_status, placed_on
                           FROM orders WHERE id='$order_id'";
            if (mysqli_query($con, $move_query)) {
                // Delete the order from the orders table
                $delete_query = "DELETE FROM orders WHERE id='$order_id'";
                mysqli_query($con, $delete_query);
            } else {
                echo "Error moving order: " . mysqli_error($con);
            }
        } else {
            // Update the payment status in the orders table
            $query = "UPDATE orders SET payment_status='$payment_status' WHERE id='$order_id'";
            if (mysqli_query($con, $query)) {
                echo "Order updated successfully!";
            } else {
                echo "Error updating order: " . mysqli_error($con);
            }
        }
    } else {
        echo "Order ID and payment status are required.";
    }
}

$sql = "SELECT * FROM orders";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
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
                    <form action="" method="POST">
                        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['id']); ?>">
                        <select name="payment_status" class="drop-down">
                            <option value="" selected disabled><?php echo htmlspecialchars($order['payment_status']); ?></option>
                            <option value="pending" <?php if ($order['payment_status'] == 'pending') echo 'selected'; ?>>Pending</option>
                            <option value="completed" <?php if ($order['payment_status'] == 'completed') echo 'selected'; ?>>Completed</option>
                        </select>
                        <div class="flex-btn">
                            <input type="submit" value="Update" class="btn" name="update_payment">
                        </div>
                    </form>
                <?php
                    }
                } else {
                    echo "<p class='empty'>No Orders Placed Yet!</p>";
                }
                ?>
            </div>
        </div>
    </section>
    <?php mysqli_close($con); ?>
</body>
<script src="../js/admin_script.js"></script>
</html>
