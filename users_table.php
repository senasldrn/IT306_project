<?php
require_once("db.php");

$sql = "CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Users table created successfully";
} else {
    echo "Error creating users table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>