<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "IT306_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE TABLE couriers (
    courier_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    zone VARCHAR(10) NOT NULL,
    availability TINYINT(1) NOT NULL,
    active_order_count INT NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Couriers table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>