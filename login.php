<?php
session_start();
include 'components/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $rememberMe = isset($_POST['remember_me']);

    // Skip authentication if admin credentials are detected
    if ($email === 'admin@admin.com' && $password === 'password123') {
        $_SESSION['loggedin'] = true;
        $_SESSION['ID'] = 'admin'; // Assign a placeholder ID for admin
        header('Location: admin/admin_loginn.php');
        exit();
    }

    $encrypted = md5($password);

    $sql = "SELECT * FROM user WHERE Email = '$email' AND Password = '$encrypted'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['loggedin'] = true;
        $_SESSION['ID'] = $user['ID']; // Store the user ID in the session

        if ($rememberMe) {
            setcookie('email', $email, time() + (86400 * 30), "/"); // 30 days
            setcookie('password', $password, time() + (86400 * 30), "/"); // 30 days
        }

        header('Location: menu.php');
        exit();
    } else {
        $loginError = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="" onsubmit="return CheckAdmin()">
        <div class="input-box">
            <input type="text" class="input-field" name="email" id="email" placeholder="Enter Email" required>
        </div>
        <div class="input-box">
            <input type="password" class="input-field" placeholder="Enter Password" name="password" id="password" required>
        </div>
        <div class="forgot">
            <section>
                <input type="checkbox" name="remember_me" id="remember_me">
                <label for="remember_me">Remember me</label>
            </section>
        </div>
        <div class="input-submit">
            <input type="submit" value="Login" class="submit-btn">
        </div>
        <div class="sign-up-link">
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </div>
        <?php
        if (isset($loginError)) {
            echo "<p style='color: red;'>$loginError</p>";
        }
        ?>
    </form>
</body>
<script>
    function CheckAdmin() {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        if (email == 'admin@admin.com' && password == 'password123') {
            alert('Welcome Admin!');
            window.location.href = 'admin/admin_loginn.php';
            return false; // Prevent form submission
        }
        return true; // Allow form submission for other users
    }
</script>
</html>
