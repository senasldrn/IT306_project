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
        echo "Cannot add - different zone!";
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