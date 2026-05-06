<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$queries = [
    "CREATE DATABASE IF NOT EXISTS IT306_db",
    "USE IT306_db",
    "CREATE TABLE IF NOT EXISTS users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS Restaurants (
        restaurant_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        category VARCHAR(30) NOT NULL,
        zone VARCHAR(10) NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS couriers (
        courier_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        zone VARCHAR(10) NOT NULL,
        availability TINYINT(1) NOT NULL,
        active_order_count INT NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        status VARCHAR(20) NOT NULL,
        zone VARCHAR(10) NOT NULL,
        courier_id INT DEFAULT NULL
    )",
    "CREATE TABLE IF NOT EXISTS order_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT NOT NULL,
        restaurant_id INT NOT NULL,
        product_name VARCHAR(100) NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        quantity INT NOT NULL
    )",
    "CREATE TABLE IF NOT EXISTS products (
        product_id INT AUTO_INCREMENT PRIMARY KEY,
        restaurant_id INT NOT NULL,
        name VARCHAR(100) NOT NULL,
        price DECIMAL(10,2) NOT NULL
    )",
    "INSERT IGNORE INTO Restaurants (name, category, zone) VALUES
        ('Burger House', 'Fast Food', 'A'),
        ('Pizza Roma', 'Italian', 'A'),
        ('Sushi Tokyo', 'Japanese', 'B'),
        ('Sweet Cakes', 'Dessert', 'B'),
        ('Istanbul Kebab', 'Turkish', 'A'),
        ('Green Garden', 'Vegan', 'B')",
    "INSERT IGNORE INTO products (restaurant_id, name, price) VALUES
        (1, 'Cheeseburger', 85.00),
        (1, 'Crispy Chicken', 75.00),
        (2, 'Margherita Pizza', 120.00),
        (2, 'Pasta Carbonara', 95.00),
        (3, 'Salmon Sushi Set', 180.00),
        (3, 'Ramen Bowl', 110.00),
        (4, 'Cheesecake', 65.00),
        (4, 'Brownie', 45.00),
        (5, 'Adana Kebab', 130.00),
        (5, 'Lahmacun', 55.00),
        (6, 'Vegan Bowl', 90.00),
        (6, 'Avocado Toast', 70.00)",
    "INSERT IGNORE INTO couriers (name, zone, availability, active_order_count) VALUES
        ('Ahmet Yılmaz', 'A', 1, 0),
        ('Mehmet Kaya', 'A', 1, 2),
        ('Ayşe Demir', 'B', 1, 1),
        ('Fatma Çelik', 'B', 1, 0),
        ('Ali Şahin', 'A', 0, 0)"
];

echo "<h2>Setup Running...</h2>";
foreach ($queries as $sql) {
    if (mysqli_query($conn, $sql)) {
        echo "✓ OK<br>";
    } else {
        echo "✗ Error: " . mysqli_error($conn) . "<br>";
    }
}
echo "<h2>Setup Complete! <a href='login.php'>Go to Login</a></h2>";

mysqli_close($conn);
?>
