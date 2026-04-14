<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "it306_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

$sql = "INSERT INTO couriers (name, zone, availability, active_order_count) VALUES
('Ali', 'A', 1, 2),
('Ayse', 'A', 1, 1),
('Mehmet', 'B', 0, 3),
('Zeynep', 'B', 1, 0),
('Can', 'A', 1, 3),
('Elif', 'B', 1, 2),
('Mert', 'A', 0, 1),
('Selin', 'B', 1, 1)";

if (mysqli_query($conn, $sql)) {
    echo "Courier records inserted successfully";
} else {
    echo "Error inserting records: " . mysqli_error($conn);
}

mysqli_close($conn);
?>