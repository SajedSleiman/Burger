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
   <title>admins accounts</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../admin_styles.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- admins accounts section starts  -->

<section class="accounts">

   <h1 class="heading">admins account</h1>

   <div class="box-container">

   <div class="box">
      <p>register new admin</p>
      <a href="admin_signupp.php" class="option-btn">register</a>
   </div>

   <div class="box">
      <p>admin ID:</p><?php
      $query="SELECT ID FROM admin";
      $result=mysqli_query($con,$query);
      while($row=mysqli_fetch_array($result)){
         echo $row['ID'];
      }
      ?>
      <p>admin Name:</p><?php
      $sql="SELECT Name FROM admin";
      $result=mysqli_query($con,$sql);
      while($row=mysqli_fetch_array($result)){
         echo $row['Name'];
      }
      ?>
      </div>
   </div>


   </div>

</section>















</body>
</html>