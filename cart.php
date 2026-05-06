<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$id = intval($_GET['restaurant_id']);
$zone = $_GET['zone'];
$name = $_GET['name'];
$price = floatval($_GET['price']);

if (!empty($_SESSION['cart'])) {
    $first_zone = $_SESSION['cart'][0]['zone'];
    if ($first_zone != $zone) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zone Error</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #1a0800, #0d0d0f); padding: 30px; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .container { max-width: 500px; width: 100%; background: white; padding: 40px; border-radius: 14px; box-shadow: 0 8px 25px rgba(0,0,0,0.3); text-align: center; }
        .icon { font-size: 50px; margin-bottom: 15px; }
        h1 { color: #222; margin-bottom: 10px; }
        .error { background: #fff0f0; border-left: 4px solid #e74c3c; padding: 12px 16px; border-radius: 6px; color: #c0392b; margin: 20px 0; text-align: left; font-size: 14px; line-height: 1.8; }
        .btn { display: inline-block; padding: 12px 28px; background: #ff6b35; color: white; text-decoration: none; border-radius: 7px; font-weight: bold; font-size: 15px; margin: 5px; }
        .btn-secondary { background: #555; }
        .btn:hover { background: #e85a28; }
        .btn-secondary:hover { background: #333; }
    </style>
</head>
<body>
<div class="container">
    <div class="icon">⚠️</div>
    <h1>Zone Mismatch</h1>
    <div class="error">
        Your cart already has items from zone <b><?php echo htmlspecialchars($first_zone); ?></b>.<br>
        You cannot add items from zone <b><?php echo htmlspecialchars($zone); ?></b>.<br><br>
        All items in a cart must be from the same delivery zone.
    </div>
    <a class="btn btn-secondary" href="view_cart.php">View Cart</a>
    <a class="btn" href="restaurants.php">Browse Restaurants</a>
</div>
</body>
</html>
<?php
        exit;
    }
}

$_SESSION['cart'][] = [
    "restaurant_id" => $id,
    "zone" => $zone,
    "name" => $name,
    "price" => $price
];

header("Location: /IT306_project/restaurants/restaurant_menu.php?restaurant_id=$id&zone=" . urlencode($zone) . "&name=" . urlencode($name));
exit();
?>
