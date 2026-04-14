<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "it306_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "UPDATE restaurants 
        SET name='Burger Palace', category='Fast Food', zone='B'
        WHERE restaurant_id = 2";

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>