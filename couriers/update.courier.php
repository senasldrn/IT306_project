<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "it306_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE couriers
        SET name='Ahmet', zone='A', availability=1, active_order_count=0
        WHERE courier_id = 2";

if (mysqli_query($conn, $sql)) {
    echo "Courier record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>