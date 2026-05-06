<?php
session_start();
require_once(__DIR__ . "/../db.php");

$restaurant_id = intval($_GET['restaurant_id']);
$zone = $_GET['zone'];
$restaurant_name = $_GET['name'];

$result = mysqli_query($conn, "SELECT * FROM products WHERE restaurant_id=$restaurant_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($restaurant_name); ?> - Menu</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #1a0800, #0d0d0f); padding: 30px; }
        .container { max-width: 700px; margin: auto; background: white; padding: 25px; border-radius: 12px; box-shadow: 0 8px 25px rgba(0,0,0,0.25); }
        h1 { color: #222; margin-bottom: 5px; }
        .zone { color: #888; font-size: 13px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #f3f3f3; }
        .btn { padding: 6px 14px; background: #ff6b35; color: white; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; font-weight: bold; display: inline-block; }
        .btn:hover { background: #e85a28; }
        .back { display: inline-block; margin-bottom: 15px; color: #ff6b35; text-decoration: none; font-weight: bold; }
        .cart-bar { margin-top: 20px; padding: 12px; background: #fff4ef; border-left: 4px solid #ff6b35; border-radius: 6px; }
    </style>
</head>
<body>
<div class="container">
    <a class="back" href="../restaurants.php">← Back to Restaurants</a>
    <h1><?php echo htmlspecialchars($restaurant_name); ?></h1>
    <div class="zone">Zone: <?php echo htmlspecialchars($zone); ?></div>

    <table>
        <tr><th>Product</th><th>Price</th><th>Action</th></tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo $row['price']; ?> TL</td>
            <td>
                <a class="btn" href="../cart.php?restaurant_id=<?php echo $restaurant_id; ?>&zone=<?php echo urlencode($zone); ?>&name=<?php echo urlencode($row['name']); ?>&price=<?php echo $row['price']; ?>">Add to Cart</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="cart-bar">
        <?php $count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
        Items in cart: <b><?php echo $count; ?></b> &nbsp;
        <a class="btn" href="../view_cart.php">View Cart</a>
    </div>
</div>
</body>
</html>