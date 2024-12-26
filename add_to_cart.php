<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

include 'components/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email'];
    $product_id = $_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    // Fetch product details
    $sql = "SELECT * FROM products WHERE ID = $product_id";
    $result = mysqli_query($con, $sql);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
        $name = $product['Name'];
        $price = $product['Price'];
        $img = $product['Picture'];

        // Initialize cart session if not set
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add new product to cart if it doesn't exist
        if (!$product_exists) {
            $_SESSION['cart'][] = [
                'product_id' => $product_id,
                'name' => $name,
                'price' => $price,
                'quantity' => $quantity,
                'image' => $img
            ];
        }
    }

    mysqli_close($con);
    header("Location: cart.php");
    exit();
}
?>
