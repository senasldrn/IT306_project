<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['add'])) {

    $item = [
        "restaurant_id" => $_GET['restaurant_id'],
        "zone" => $_GET['zone'],
        "product" => $_GET['product'],
        "price" => $_GET['price']
    ];

    // zone kontrol
    if (!empty($_SESSION['cart'])) {
        $zone = $_SESSION['cart'][0]['zone'];

        if ($zone != $item['zone']) {
            echo "Cannot add item - different zone!";
            exit;
        }
    }

    $_SESSION['cart'][] = $item;

    echo "Added to cart<br>";
}

echo "<a href='view_cart.php'>Go to cart</a>";
?>