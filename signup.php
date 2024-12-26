<?php
session_start();
include 'components/connection.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $address = trim($_POST['address']);

    // Check if the email already exists
    $check = "SELECT * FROM user WHERE Email = '$email'";
    $result = mysqli_query($con, $check);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
                alert('You already have an account! Log in now.');
                window.location.href='login.php';
              </script>";
    } else {
        $encrypted = md5($password);
        $insert = "INSERT INTO user (Name, Email, Password, Address) VALUES ('$name', '$email', '$encrypted', '$address')";
        
        if (mysqli_query($con, $insert)) {
            // Store user details in session
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['address'] = $address;
            
            echo "<script>
                    alert('Account created successfully! Please log in.');
                    window.location.href='login.php';
                  </script>";
        } else {
            echo "<script>
                    alert('An error occurred. Please try again.');
                    window.location.href='signup.php';
                  </script>";
        }
    }
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>Sign Up | Ludiflex</title>
</head>
<body>
    <div class="login-box">
        <div class="login-header">
            <header>Sign up</header>
        </div>
        <form method="post" action="">
            <div class="input-box">
                <input type="text" name="name" class="input-field" placeholder="Enter Name" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="text" name="email" class="input-field" placeholder="Enter Email" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="password" name="password" class="input-field" placeholder="Enter Password" autocomplete="off" required>
            </div>
            <div class="input-box">
                <input type="text" name="address" class="input-field" placeholder="Enter Address" autocomplete="off" required>
            </div>
            <div class="input-submit">
                <button class="submit-btn" id="submit" type="submit">Sign up</button>
            </div>
            <div class="sign-up-link">
                <p>Already have an account? <a href="login.php">Sign In</a></p>
            </div>
        </form>
    </div>
</body>
</html>
