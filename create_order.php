<?php
session_start();
include 'db.php';

if (empty($_SESSION['cart'])) {
    header("Location: restaurants.php");
    exit;
}

$user_id = $_SESSION['user_id'] ?? 1;
$zone = $_SESSION['cart'][0]['zone'];

$sql = "INSERT INTO orders (user_id, status, zone) VALUES ($user_id, 'pending', '$zone')";
mysqli_query($conn, $sql);
$order_id = mysqli_insert_id($conn);

foreach ($_SESSION['cart'] as $item) {
    $rid = $item['restaurant_id'];
    $name = mysqli_real_escape_string($conn, $item['name']);
    $price = isset($item['price']) ? $item['price'] : 0;
    $sql = "INSERT INTO order_items (order_id, restaurant_id, product_name, price, quantity) VALUES ($order_id, $rid, '$name', $price, 1)";
    mysqli_query($conn, $sql);
}

unset($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Created</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #1a0800, #0d0d0f); padding: 30px; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .container { max-width: 500px; width: 100%; background: white; padding: 40px; border-radius: 14px; box-shadow: 0 8px 25px rgba(0,0,0,0.3); text-align: center; }
        .icon { font-size: 50px; margin-bottom: 15px; }
        h1 { color: #222; margin-bottom: 10px; }
        .info { background: #fff4ef; border-left: 4px solid #ff6b35; padding: 12px 16px; border-radius: 6px; text-align: left; margin: 20px 0; color: #444; font-size: 14px; line-height: 1.8; }
        .btn { display: inline-block; padding: 12px 28px; background: #ff6b35; color: white; text-decoration: none; border-radius: 7px; font-weight: bold; font-size: 15px; margin-top: 10px; }
        .btn:hover { background: #e85a28; }
    </style>
</head>
<body>
<div class="container">
    <div class="icon">📦</div>
    <h1>Order Created!</h1>
    <p style="color:#777;">Your order has been placed successfully.</p>
    <div class="info">
        <b>Order ID:</b> #<?php echo $order_id; ?><br>
        <b>Zone:</b> <?php echo htmlspecialchars($zone); ?><br>
        <b>Status:</b> Pending
    </div>
    <a class="btn" href="assign_courier.php?order_id=<?php echo $order_id; ?>">Assign Courier →</a>
</div>
</body>
</html>
