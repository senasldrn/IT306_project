<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #1a0800, #0d0d0f); padding: 30px; min-height: 100vh; }
        .container { max-width: 700px; margin: auto; background: white; padding: 30px; border-radius: 14px; box-shadow: 0 8px 25px rgba(0,0,0,0.3); }
        h1 { color: #222; margin-bottom: 5px; }
        .zone-badge { display: inline-block; background: #fff4ef; color: #ff6b35; padding: 4px 12px; border-radius: 20px; font-size: 13px; font-weight: bold; margin-bottom: 25px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #eee; padding: 12px; text-align: left; }
        th { background: #f8f8f8; color: #444; font-size: 13px; }
        tr:nth-child(even) { background: #fafafa; }
        .total-row { font-weight: bold; background: #fff4ef !important; }
        .btn { display: inline-block; padding: 10px 20px; background: #ff6b35; color: white; text-decoration: none; border-radius: 7px; font-weight: bold; border: none; cursor: pointer; font-size: 15px; }
        .btn:hover { background: #e85a28; }
        .btn-secondary { background: #555; margin-right: 10px; }
        .btn-secondary:hover { background: #333; }
        .empty { text-align: center; padding: 40px; color: #888; }
        .actions { margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <h1>🛒 Your Cart</h1>
    <?php if (empty($_SESSION['cart'])): ?>
        <div class="empty">
            <p>Your cart is empty.</p>
            <a class="btn" href="restaurants.php">Browse Restaurants</a>
        </div>
    <?php else: ?>
        <?php $zone = $_SESSION['cart'][0]['zone']; ?>
        <div class="zone-badge">Zone: <?php echo htmlspecialchars($zone); ?></div>
        <table>
            <tr><th>Product</th><th>Price</th></tr>
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $item):
                $price = isset($item['price']) ? $item['price'] : 0;
                $total += $price;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo number_format($price, 2); ?> TL</td>
            </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td>Total</td>
                <td><?php echo number_format($total, 2); ?> TL</td>
            </tr>
        </table>
        <div class="actions">
            <a class="btn btn-secondary" href="restaurants.php">← Add More</a>
            <a class="btn" href="create_order.php">Create Order</a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
