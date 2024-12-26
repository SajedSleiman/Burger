<?php
session_start();
include '../components/connection.php';
$admin_id = $_SESSION['admin_login'];
if (!isset($admin_id)) {
   header('location:admin_loginn.php');
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../admin_styles.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

   <div class="box">
    <h3>welcome!</h3>
    <p>
        <?php 
        $sql = "SELECT Name FROM admin WHERE ID = '$admin_id'";
        $result = mysqli_query($con, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo htmlspecialchars($row['Name']); 
        } else {
            echo "Admin name not found";
        }
        ?>
    </p>
</div>

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = "SELECT total_price FROM orders WHERE payment_status = 'pending'";
            $result = mysqli_query($con, $select_pendings);
            while ($row = mysqli_fetch_assoc($result)) {
               $total_pendings += $row['total_price'];
            }
         ?>
         <h3><span>$</span><?= $total_pendings; ?><span>/-</span></h3>
         <p>total pendings</p>
         <a href="orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
         <?php
            $total_complete = 0;
            $select_complete = "SELECT total_price FROM completed_orders WHERE payment_status = 'completed'";
            $result = mysqli_query($con, $select_complete);
            while ($row = mysqli_fetch_assoc($result)) {
               $total_complete += $row['total_price'];
            }
         ?>
         <h3><span>$</span><?= $total_complete; ?><span>/-</span></h3>
         <p>total Completed</p>
         <a href="completed_orders.php" class="btn">see orders</a>
      </div>


      <div class="box">
         <?php
            $select_orders = "SELECT * FROM orders";
            $result = mysqli_query($con, $select_orders);
            $numbers_of_orders = mysqli_num_rows($result);
         ?>
         <h3><?= $numbers_of_orders; ?></h3>
         <p>total orders</p>
         <a href="orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
         <?php
            $select_products = "SELECT * FROM products";
            $result = mysqli_query($con, $select_products);
            $numbers_of_products = mysqli_num_rows($result);
         ?>
         <h3><?= $numbers_of_products; ?></h3>
         <p>products added</p>
         <a href="productss.php" class="btn">see products</a>
      </div>

      <div class="box">
         <?php
            $select_users = "SELECT * FROM user";
            $result = mysqli_query($con, $select_users);
            $numbers_of_users = mysqli_num_rows($result);
         ?>
         <h3><?= $numbers_of_users; ?></h3>
         <p>users accounts</p>
         <a href="user_accounts.php" class="btn">see users</a>
      </div>

      <div class="box">
         <?php
            $select_admins = "SELECT * FROM admin";
            $result = mysqli_query($con, $select_admins);
            $numbers_of_admins = mysqli_num_rows($result);
         ?>
         <h3><?= $numbers_of_admins; ?></h3>
         <p>admins</p>
         <a href="admin_accounts.php" class="btn">see admins</a>
      </div>
</section>

<script src="../js/admin_script.js"></script>

</body>
</html>
