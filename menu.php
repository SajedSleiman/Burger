<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {  
    header("Location: login.php");
    exit();
}

include 'components/connection.php';
include 'components/header.php';

$sql = "SELECT * FROM products";
$result = mysqli_query($con, $sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burger Company</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section class="section__container order__container" id="menu">
        <h3>ALWAYS TASTY BURGER</h3>
        <h2 class="section__header">CHOOSE & ENJOY</h2>
        <p class="section__description">
            Whether you crave classic flavors or daring combinations, this is where
            your culinary journey begins. Indulge your cravings and savor every bite
            as you create your personalized burger experience with Burger Company.
        </p>
        <div class="order__grid">
            <?php foreach ($products as $product): ?>
                <div class="order__card">
                    <form method="POST" action="cart.php">
                        <img src="<?php echo htmlspecialchars($product['Picture']); ?>" alt="order">
                        <h4><?php echo htmlspecialchars($product['Name']); ?></h4>
                        <p><?php echo htmlspecialchars($product['Description']); ?></p>
                        <p><?php echo htmlspecialchars($product['Price']); ?></p>
                        <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($product['Picture']); ?>">
                        <input type="hidden" name="name" value="<?php echo htmlspecialchars($product['Name']); ?>">
                        <input type="hidden" name="description" value="<?php echo htmlspecialchars($product['Description']); ?>">
                        <input type="hidden" name="price" value="<?php echo htmlspecialchars($product['Price']); ?>">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="quantity" value="1" min="1">
                        <input type="submit" class="btn" value="Order Now">
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php include 'components/footer.php';?>
</body>
<script src="main.js"></script>
</html>
