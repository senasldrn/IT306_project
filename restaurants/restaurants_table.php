<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "it306_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE Restaurants (
restaurant_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
category VARCHAR(30) NOT NULL,
zone VARCHAR(10) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
  echo "Table created successfully";
} else {
  echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>