<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT306 Project</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            text-align: center;
            padding: 60px;
        }
        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
        }
        h1 {
            color: #222;
        }
        p {
            color: #666;
        }
        .btn {
            display: inline-block;
            margin: 10px;
            padding: 12px 22px;
            background: #0077cc;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
        .btn:hover {
            background: #005fa3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Smart Multi-Restaurant Delivery Aggregation Platform</h1>
        <p>IT306 Server-Side Programming Project Demo</p>
        <p>Welcome, <?php echo $_SESSION["user"]; ?>!</p>

        <a class="btn" href="restaurants.php">Restaurant Page</a>
        <a class="btn" href="couriers.php">Courier Page</a>
        <a class="btn" href="assign_courier.php">Assign Courier</a>
        <a class="btn" href="logout.php">Logout</a>
    </div>
</body>
</html>