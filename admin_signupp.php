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
   <link rel="stylesheet" href="../admin_styles.css">
   <title>login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<section class="form-container">

   <form action="" method="POST">
      <h3>Signup now</h3>
      <input type="text" name="name" maxlength="20" required placeholder="Creat your username" class="box">
      <input type="password" name="pass" maxlength="20" required placeholder="Creat your password" class="box" >
      <p>Already have an account? <a href="admin_loginn.php">Log in</a></p>
      <input type="submit" value="Signup now" name="submit" class="btn">
   </form>

</section>
</body>
</html>

<?php
include '../components/connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name=$_POST['name'];
    $pass=$_POST['pass'];

    $check = "SELECT * FROM admin WHERE Name = '$name'";
    $result = mysqli_query($con, $check);

    if (mysqli_num_rows($result) > 0) {
        
        echo "<script>
                alert('You already have an account! Log in now.');
                window.location.href='admin_loginn.php';
              </script>";
    } else {
        
        $insert = "INSERT INTO admin (Name, Password) VALUES ('$name', '$pass')";
        
        if (mysqli_query($con, $insert)) {
            echo "<script>
                    alert('Account created successfully! Please log in.');
                    window.location.href='admin_loginn.php';
                  </script>";
        } else {
            echo "<script>
                    alert('An error occurred. Please try again.');
                    window.location.href='admin_signupp.php';
                  </script>";
        }
    }
    mysqli_close($con);
}

?>