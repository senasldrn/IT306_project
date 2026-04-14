<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "it306_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM restaurants";
$result = mysqli_query($conn, $sql);

echo "<h2>Restaurant List</h2>";

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row["restaurant_id"] . 
             " - Name: " . $row["name"] . 
             " - Category: " . $row["category"] . 
             " - Zone: " . $row["zone"] . "<br>";
    }
} else {
    echo "No results";
}

mysqli_close($conn);
?>