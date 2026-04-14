<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "it306_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM couriers");

echo "<h2>Courier List</h2>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["courier_id"] .
             " - Name: " . $row["name"] .
             " - Zone: " . $row["zone"] .
             " - Availability: " . $row["availability"] .
             " - Active Orders: " . $row["active_order_count"] . "<br>";
    }
} else {
    echo "No results";
}

mysqli_close($conn);
?>