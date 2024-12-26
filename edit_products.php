<?php
include "../components/connection.php";

if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $description = $_POST['discreption'];
    $price = $_POST['price'];
    $img = $_POST['img'];

    $query = "UPDATE products SET Price = '$price' WHERE Name = '$name'";
    if (mysqli_query($con, $query)) {
        echo "Product updated successfully";
    } else {
        echo "Error updating product: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
