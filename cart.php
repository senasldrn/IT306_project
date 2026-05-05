<?php
/*session_start();

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
?>*/

session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$id = $_GET['restaurant_id'];
$zone = $_GET['zone'];
$name = $_GET['name'];

// zone kontrol
if (!empty($_SESSION['cart'])) {
    $first_zone = $_SESSION['cart'][0]['zone'];

    if ($first_zone != $zone) {
        echo "Cannot add - different zone!";
        exit;
    }
}

$item = [
    "restaurant_id" => $id,
    "zone" => $zone,
    "name" => $name
];

$_SESSION['cart'][] = $item;

header("Location: view_cart.php");
exit();
?>