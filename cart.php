<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {  
    header("Location: login.php");
    exit();
}

include 'components/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['ID'];
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['product_image'];

    $sql = "INSERT INTO cart (User_ID, Product_ID, Name, Price, Quantity, Image) 
            VALUES ('$user_id', '$product_id', '$name', '$price', '$quantity', '$image')";

    if (mysqli_query($con, $sql)) {
        header("Location: cart.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}

// Fetch cart items for display
$user_id = $_SESSION['ID'];
$sql = "SELECT * FROM cart WHERE User_ID = '$user_id'";
$result = mysqli_query($con, $sql);
$cart_items = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="styles.css">
    <title>Cart</title>
</head>
<body class="back">
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
            <li><a href="../index.php">HOME</a></li>
            <li><a href="#special">SPECIAL</a></li>
            <li><a href="menu.php">MENU</a></li>
            <li><a href="#event">EVENTS</a></li>
            <li><a href="#contact">CONTACT US</a></li>
            <li><a href="signup.php">SIGNUP</a></li>
            <li class="cart-header">
                <a href="cart.php"><img src="../assets/cart.png" alt="Cart"/></a>
                <div class="cart-counter" id="cart-counter">0</div>
            </li>
            <li class="logout">
                <form action="logout.php" method="post">
                    <input type="submit" id="logout" value="Logout">
                </form>
            </li>
        </ul>
    </nav>
</header>
<section class="samir">
    <div class="container">
        <div class="cart">
            <div class="cart_header">
                <p class="cart_header_id">Product ID</p>
                <p class="cart_header_title">Product Title</p>
                <p class="cart_header_image">Product Image</p>
                <p class="cart_header_price">Price</p>
                <p class="cart_header_quantity">Quantity</p>
                <p class="cart_header_total">Total</p>
                <p class="cart_header_delete">Delete</p>
            </div>
            <div class="cart-items">
                <?php if (!empty($cart_items)): ?>
                    <?php foreach ($cart_items as $item): ?>
                        <div class="cart_item">
                            <p class="cart_item_id"><?php echo htmlspecialchars($item['Product_ID']); ?></p>
                            <p class="cart_item_title"><?php echo htmlspecialchars($item['Name']); ?></p>
                            <img class="cart_item_image" src="<?php echo htmlspecialchars($item['Image']); ?>" alt="product image">
                            <p class="cart_item_price"><?php echo htmlspecialchars($item['Price']); ?></p>
                            <p class="cart_item_quantity"><?php echo htmlspecialchars($item['Quantity']); ?></p>
                            <p class="cart_item_total"><?php echo htmlspecialchars($item['Price'] * $item['Quantity']); ?></p>
                            <form method="POST" action="remove_cart.php">
                                <input type="hidden" name="product_id" value="<?php echo $item['Product_ID']; ?>">
                                <input type="submit" class="btn delete-btn" value="Delete">
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No items in the cart.</p>
                <?php endif; ?>
            </div>
<div class="cart_total">
    <?php
    $total = 0;
    if (!empty($cart_items)) {
        foreach ($cart_items as $item) {
            $total += $item['Price'] * $item['Quantity'];
        }
    }
    ?>
    <p>Total: $<span id="cart-total"><?php echo number_format($total, 2); ?></span></p>
    <form action="checkout.php" method="post">
        <input type="hidden" name="total_price" value="<?php echo $total; ?>">
        <button id="checkout-btn">Checkout</button>
    </form>
</div>

        </div>
    </div>
</section>
<?php include 'components/footer.php'; ?>
</body>
</html>
