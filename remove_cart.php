<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {  
    header("Location: login.php");
    exit();
}

include 'components/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['ID']; // Use the correct session key for the user ID

    $sql = "DELETE FROM cart WHERE Product_ID = '$product_id' AND User_ID = '$user_id'";
    if (mysqli_query($con, $sql)) {
        header("Location: cart.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
?>
