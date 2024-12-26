<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}

include 'components/connection.php'; // Update path as needed

// Fetch user details
$user_id = $_SESSION['ID'];
$sql = "SELECT Name, Email, Address FROM user WHERE ID = '$user_id'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    die("User not found.");
}

$userName = mysqli_real_escape_string($con, $user['Name']);
$userEmail = mysqli_real_escape_string($con, $user['Email']);
$userAddress = mysqli_real_escape_string($con, $user['Address']);

// Fetch cart items for display
$cart_items = [];
$sql = "SELECT * FROM cart WHERE User_ID = '$user_id'";
$result = mysqli_query($con, $sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['Product_ID'];
        $productQuery = "SELECT Name, Price FROM products WHERE ID = '$product_id'";
        $productResult = mysqli_query($con, $productQuery);
        if ($productResult && $productResult->num_rows > 0) {
            $productRow = mysqli_fetch_assoc($productResult);
            $row['ProductName'] = $productRow['Name'];
            $row['Price'] = $productRow['Price'];
        } else {
            $row['ProductName'] = 'Unknown Product';
            $row['Price'] = 0;
        }
        $cart_items[] = $row;
    }
}

// Calculate total products and price
$total_products = count($cart_items);
$total_price = isset($_POST['total_price']) ? $_POST['total_price'] : 0;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $method = isset($_POST['method']);
    
    $query = "INSERT INTO orders (user_id, user_name, email, address, total_products, total_price, method) 
              VALUES ('$user_id', '$userName', '$userEmail', '$userAddress', '$total_products', '$total_price', '$method')";
    
    if (mysqli_query($con, $query)) {
        
        $clear_cart = "DELETE FROM cart WHERE User_ID = '$user_id'";
        mysqli_query($con, $clear_cart);
        echo "Order placed successfully!";
        
    } else {
        die("Error placing the order: " . mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="styles.css">
   <style>
    :root {
    --primary-color: #42200b;
    --secondary-color: #ffc135;
    --tertiary-color: #df1c1c;
    --text-dark: #212529;
    --white: #ffffff;
    --max-width: 1200px;
    --header-font-1: "Alfa Slab One", serif;
    --header-font-2: "Bebas Neue", sans-serif;
    --border:.2rem solid var(--black);
}
      body.back {
         background-image: url("assets/header-bg.png");
         background-size: cover;
         background-repeat: no-repeat;
      }

      .checkout form {
         max-width: 50rem;
         margin: 0 auto;
         border: var(--border);
         padding: 2rem;
         background-color: var(--white);
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
         border-radius: 10px;
      }

      .checkout form h3 {
         font-size: 2.5rem;
         text-transform: capitalize;
         padding: 2rem 0;
         color: var(--black);
         text-align: center;
         border-bottom: 1px solid var(--light-color);
         margin-bottom: 2rem;
      }

      .checkout form .cart-items {
         background-color: var(--black);
         padding: 2rem;
         padding-top: 0;
         border-radius: 10px;
         margin-bottom: 2rem;
      }

      .checkout form .cart-items h3 {
         color: var(--white);
         text-align: center;
         margin-bottom: 1rem;
         border-bottom: 1px solid var(--light-color);
         padding-bottom: 1rem;
      }

      .checkout form .cart-items p {
         display: flex;
         align-items: center;
         gap: 1.5rem;
         justify-content: space-between;
         margin: 1rem 0;
         line-height: 1.5;
         font-size: 2rem;
         color: var(--black);
      }

      .checkout form .cart-items p .name {
         color: var(--light-color);
      }

      .checkout form .cart-items p .price {
         color: var(--yellow);
      }

      .checkout form .cart-items .grand-total {
         background-color: var(--white);
         padding: .5rem 1.5rem;
         border-radius: 5px;
         text-align: center;
      }

      .checkout form .cart-items .grand-total .price {
         color: var(--red);
         font-size: 2rem;
         font-weight: bold;
      }

      .checkout form .user-info p {
         font-size: 2rem;
         line-height: 1.5;
         padding: 1rem 0;
      }

      .checkout form .user-info p i {
         color: var(--light-color);
         margin-right: 1rem;
      }

      .checkout form .user-info p span {
         color: var(--black);
      }

      .checkout form .user-info .btn {
         display: block;
         width: 100%;
         text-align: center;
         background-color: var(--primary-color);
         color: var(--white);
         padding: 1rem;
         margin: 1rem 0;
         border: none;
         cursor: pointer;
         border-radius: 5px;
         text-transform: uppercase;
      }

      .checkout form .user-info .btn:hover {
         background-color: var(--secondary-color);
      }

      .checkout form input[type="radio"] {
         transform: scale(1.5);
         padding-right: 6px;
         margin: auto 0;
      }

      .checkout form label {
         font-size: 1.2em;
         margin: auto 0;
         padding-left: 5px;
      }

      .checkout form .submit-btn {
         width: 100%;
         background: var(--primary-color);
         color: var(--white);
         padding: 1rem;
         font-size: 2rem;
         border: none;
         cursor: pointer;
         border-radius: 5px;
         text-align: center;
         margin-top: 2rem;
      }

      .checkout form .submit-btn:hover {
         background: var(--secondary-color);
      }
      </style>
</head>
<body>
<header class="header">
    <nav>
        <div class="nav__header">
            <div class="nav__logo">
                <a href="#">
                    <img src="../assets/logo-dark.png" alt="logo" class="nav__logo-dark"/>
                    <img src="../assets/logo-white.png" alt="logo" class="nav__logo-white"/>
                </a>
            </div>
            <div class="nav__menu__btn" id="menu-btn">
                <i class="ri-menu-line"></i>
            </div>
        </div>
        <ul class="nav__links" id="nav-links">
            <li><a href="../index..php">HOME</a></li>
            <li><a href="#special">SPECIAL</a></li>
            <li><a href="menu.php">MENU</a></li>
            <li><a href="#event">EVENTS</a></li>
            <li><a href="#contact">CONTACT US</a></li>
            <li><a href="signup.php">SIGNUP</a></li>
            <li class="cart-header">
                <a href="cart.php"><img src="../assets/cart.png" alt="Cart"/></a>
                <div class="cart-counter" id="cart-counter">0</div>
            </li>
            <li class="logout"><form action="logout.php" method post>
                <input type="submit" id="logout" value="logout">
            </form></li>
        </ul>
    </nav>
    </div>
</header>

<section class="checkout">
    <form action="checkout.php" method="post">
        <div class="user-info">
            <h3>Your Info</h3>
            <p><i class="fas fa-user"></i> <span><?php echo htmlspecialchars($userName); ?></span></p>
            <p><i class="fas fa-envelope"></i> <span><?php echo htmlspecialchars($userEmail); ?></span></p>

            <h3>Delivery Address</h3>
            <p><i class="fas fa-map-marker-alt"></i> <span><?php echo htmlspecialchars($userAddress); ?></span></p>

            <h3>Order Info</h3>
            <div class="cart-items">
                <?php foreach ($cart_items as $item): ?>
                    <p><span class="name"><?php echo htmlspecialchars($item['ProductName']); ?></span> <span class="price"><?php echo htmlspecialchars($item['Price']); ?></span></p>
                <?php endforeach; ?>
            </div>
            <div class="grand-total">
                <p>Total: $<span class="price"><?php echo number_format($total_price, 2); ?></span></p>
            </div>

            <h3>Select Order Type</h3>
            <input type="radio" id="delivery" name="method" value="delivery" required>
            <label for="delivery">Delivery</label>

            <input type="radio" id="take_away" name="method" value="take_away" required>
            <label for="take_away">Take Away</label>

            <input type="radio" id="dine_in" name="method" value="dine_in" required>
            <label for="dine_in">Dine In</label>

            <input type="submit" value="Place Order" class="submit-btn" name="submit">
        </div>
    </form>
</section>
<?php include'components/footer.php'; ?>
</body>
</html>