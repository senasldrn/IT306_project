<?php
include 'db.php';

$order_id = $_GET['order_id'];

// order zone
$result = mysqli_query($conn, "SELECT zone FROM orders WHERE id=$order_id");
$row = mysqli_fetch_assoc($result);

$zone = $row['zone'];

// courier bul
$sql = "SELECT * FROM couriers 
        WHERE zone='$zone' AND availability=1
        ORDER BY active_order_count ASC
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "No courier available";
    exit;
}

$courier = mysqli_fetch_assoc($result);
$cid = $courier['id'];

// order update
mysqli_query($conn, "UPDATE orders SET courier_id=$cid, status='assigned' WHERE id=$order_id");

// courier update
mysqli_query($conn, "UPDATE couriers SET active_order_count = active_order_count + 1 WHERE id=$cid");

echo "Courier assigned: " . $courier['name'] . "<br><br>";

echo "Explanation:<br>";
echo "Same zone<br>";
echo "Courier available<br>";
echo "Lowest active orders<br>";
?>