<?php
session_start();
include '../components/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM admin WHERE Name = '$name' AND Password = '$pass'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['admin_login'] = true;
        echo "<script>
                alert('Success');
                window.location.href = 'dashboardd.php';
              </script>";
    } else {
        echo "<script>
                alert('Failed to login');
                window.location.href = 'admin_loginn.php';
              </script>";
    }

    mysqli_close($con);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="../admin_styles.css">
   <title>login</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>

<section class="form-container">
   <form action="" method="POST">
      <h3>login now</h3>
      <input type="text" name="name" maxlength="20" required placeholder="enter your username" class="box">
      <input type="password" name="pass" maxlength="20" required placeholder="enter your password" class="box">
      <p>Dont have an account? <a href="admin_signup.php">Sign up</a></p>
      <input type="submit" value="login now" name="submit" class="btn">
   </form>
</section>

</body>
</html>
