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

// sql to insert data
$sql = "INSERT INTO Restaurants (name, category, zone) VALUES
('Burger House', 'Fast Food', 'A'),
('Burger City', 'Fast Food', 'B'),
('Big Burger', 'Fast Food', 'A'),
('Pizza Point', 'Italian', 'A'),
('Pizza Station', 'Italian', 'B'),
('Pasta Bella', 'Italian', 'A'),
('Sushi World', 'Japanese', 'B'),
('Tokyo Sushi', 'Japanese', 'A'),
('Sweet Corner', 'Dessert', 'A'),
('Donut Heaven', 'Dessert', 'B'),
('Cake Land', 'Dessert', 'A'),
('Kebapçı Yusuf', 'Turkish', 'B'),
('Osmanlı Kebap', 'Turkish', 'A'),
('Anadolu Sofrası', 'Turkish', 'B'),
('Vegan Life', 'Vegan', 'A'),
('Green Vegan', 'Vegan', 'B'),
('Salad Box', 'Vegan', 'A'),
('Chicken Hub', 'Fast Food', 'A'),
('Chicken Express', 'Fast Food', 'B'),
('Ev Yemekleri', 'Turkish', 'A');";

if (mysqli_query($conn, $sql)) {
  echo "Records inserted successfully";
} else {
  echo "Error inserting records: " . mysqli_error($conn);
}

mysqli_close($conn);
?>