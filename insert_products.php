<?php
include '../components/connection.php';

    $name = $_POST['name'];
    $dis = $_POST['discreption'];
    $price = $_POST['price'];
    
    $file = rand(1000, 100000) . "-" . $_FILES['img']['name'];
    $file_loc = $_FILES['img']['tmp_name'];
    $file_size = $_FILES['img']['size'];
    $file_type = $_FILES['img']['type'];
    $folder = "../uploaded_img/";

    if (move_uploaded_file($file_loc, $folder . $file)) {
        $img = $folder . $file;
        $sql = "INSERT INTO products (Name, Description, Price, Picture) VALUES ('$name', '$dis', '$price', '$img')";
        if (mysqli_query($con, $sql)) {
            echo "Product added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } else {
        echo "Error uploading file";
    }

    mysqli_close($con);
?>