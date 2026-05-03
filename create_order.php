<?php
session_start();
include 'db.php';

if (empty($_SESSION['cart'])) {
    echo "Cart is empty";
    exit;
}

$user_id = 1;
$zone = $_SESSION['cart'][0]['zone'];

// order ekle
$sql = "INSERT INTO orders (user_id, status, zone) 
        VALUES ($user_id, 'pending', '$zone')";

mysqli_query($conn, $sql);

$order_id = mysqli_insert_id($conn);

// order items
foreach ($_SESSION['cart'] as $item) {

    $rid = $item['restaurant_id'];
    $name = $item['product'];
    $price = $item['price'];

    $sql = "INSERT INTO order_items 
            (order_id, restaurant_id, product_name, price, quantity)
            VALUES ($order_id, $rid, '$name', $price, 1)";

    mysqli_query($conn, $sql);
}

echo "Order created<br>";
echo "All items were in same zone ($zone)<br><br>";

unset($_SESSION['cart']);

echo "<a href='assign_courier.php?order_id=$order_id'>Assign Courier</a>";
?>