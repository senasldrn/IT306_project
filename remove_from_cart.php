<?php
session_start();

$index = intval($_GET['index']);

if (isset($_SESSION['cart'][$index])) {
    array_splice($_SESSION['cart'], $index, 1);
}

header("Location: /IT306_project/view_cart.php");
exit();
?>