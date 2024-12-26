<?php
include '../components/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $query = "DELETE FROM products WHERE Name = '$name'";
    if (mysqli_query($con, $query)) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . mysqli_error($con);
    }
    mysqli_close($con);
}
?>
