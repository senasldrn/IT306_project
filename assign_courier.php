<?php
include 'db.php';

if (!isset($_GET['order_id'])) {
    die("No order specified.");
}

$order_id = intval($_GET['order_id']);

$result = mysqli_query($conn, "SELECT zone FROM orders WHERE id=$order_id");
$row = mysqli_fetch_assoc($result);
$zone = $row['zone'];

$sql = "SELECT * FROM couriers
        WHERE zone='$zone' AND availability=1
        ORDER BY active_order_count ASC
        LIMIT 1";

$result = mysqli_query($conn, $sql);
$courier = ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;

if ($courier) {
    $cid = $courier['courier_id'];
    mysqli_query($conn, "UPDATE orders SET courier_id=$cid, status='assigned' WHERE id=$order_id");
    mysqli_query($conn, "UPDATE couriers SET active_order_count = active_order_count + 1 WHERE courier_id=$cid");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Courier Assignment</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #1a0800, #0d0d0f); padding: 30px; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .container { max-width: 500px; width: 100%; background: white; padding: 40px; border-radius: 14px; box-shadow: 0 8px 25px rgba(0,0,0,0.3); text-align: center; }
        .icon { font-size: 50px; margin-bottom: 15px; }
        h1 { color: #222; margin-bottom: 10px; }
        .info { background: #fff4ef; border-left: 4px solid #ff6b35; padding: 12px 16px; border-radius: 6px; text-align: left; margin: 20px 0; color: #444; font-size: 14px; line-height: 1.8; }
        .rules { background: #f0fdf4; border-left: 4px solid #0f766e; padding: 12px 16px; border-radius: 6px; text-align: left; margin: 15px 0; color: #444; font-size: 13px; line-height: 1.8; }
        .error { background: #fff0f0; border-left: 4px solid #e74c3c; padding: 12px 16px; border-radius: 6px; color: #c0392b; margin: 20px 0; }
        .btn { display: inline-block; padding: 12px 28px; background: #ff6b35; color: white; text-decoration: none; border-radius: 7px; font-weight: bold; font-size: 15px; margin-top: 10px; }
        .btn:hover { background: #e85a28; }
    </style>
</head>
<body>
<div class="container">
    <?php if ($courier): ?>
        <div class="icon">🛵</div>
        <h1>Courier Assigned!</h1>

        <div class="info">
            <b>Courier:</b> <?php echo htmlspecialchars($courier['name']); ?><br>
            <b>Zone:</b> <?php echo htmlspecialchars($courier['zone']); ?><br>
            <b>Active Orders:</b> <?php echo $courier['active_order_count']; ?><br>
            <b>Order #:</b> <?php echo $order_id; ?>
        </div>

        <div class="rules">
            <b>Assignment Rules:</b><br>
            ✓ Same delivery zone<br>
            ✓ Courier is available<br>
            ✓ Lowest active order count selected
        </div>
    <?php else: ?>
        <div class="icon">⚠️</div>
        <h1>No Courier Available</h1>
        <div class="error">
            No available courier found in zone <b><?php echo htmlspecialchars($zone); ?></b> at the moment.
        </div>
    <?php endif; ?>

    <a class="btn" href="index.php">← Back to Home</a>
</div>
</body>
</html>