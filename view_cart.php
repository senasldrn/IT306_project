<?php
session_start();

if (empty($_SESSION['cart'])) {
    echo "Cart is empty";
    exit;
}

$zone = $_SESSION['cart'][0]['zone'];

echo "Cart (Zone: $zone)<br><br>";

$total = 0;

foreach ($_SESSION['cart'] as $item) {
    echo $item['product'] . " - " . $item['price'] . " TL<br>";
    $total += $item['price'];
}

echo "<br>Total: $total TL<br><br>";

echo "<a href='create_order.php'>Create Order</a>";
?>