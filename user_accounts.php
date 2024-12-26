<?php
include '../components/connection.php';

session_start();

$admin_id = $_SESSION['admin_login'];

if (!isset($admin_id)) {
    header('location:admin_loginn.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['ID'];
    $user = "DELETE FROM user WHERE ID=$id";
    mysqli_query($con, $user);
    $cart = "DELETE FROM cart WHERE User_ID=$id";
    mysqli_query($con, $cart);
    $orders = "DELETE FROM orders WHERE user_id=$id";
    mysqli_query($con, $orders);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users accounts</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../admin_styles.css">
</head>
<body>

<?php include '../components/admin_header.php' ?>

<section class="accounts">

    <h1 class="heading">users account</h1>

    <div class="box-container">

    <?php
        $select_account = "SELECT * FROM user";
        $result = mysqli_query($con, $select_account);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
    ?>
    <div class="box">
        <form action="" method="post">
            <p> user id : <span><?php echo htmlspecialchars($row['ID']); ?></span> </p>
            <p> username : <span><?php echo htmlspecialchars($row['Name']); ?></span> </p>
            <input type="hidden" name="ID" value="<?php echo $row['ID']; ?>">
            <input type="submit" value="Delete" class="delete-btn">
        </form>
    </div>
    <?php
            }
        } else {
            echo '<p class="empty">no accounts available</p>';
        }
    ?>

    </div>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
