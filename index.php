<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$username = htmlspecialchars($_SESSION["user"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Arial, sans-serif;
        background: linear-gradient(135deg, #1a0800, #0d0d0f);
        color: white;
        min-height: 100vh;
    }

    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 50px;
        background: rgba(255,255,255,0.06);
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .logo {
        font-size: 18px;
        font-weight: bold;
    }

    .nav-right {
        font-size: 14px;
        color: #ddd;
    }

    .nav-right span {
        color: #ff6b35;
        font-weight: bold;
    }

    .logout {
        margin-left: 18px;
        color: #ff6b35;
        text-decoration: none;
        font-weight: bold;
    }

    .main {
        max-width: 950px;
        margin: 0 auto;
        padding: 70px 30px;
        text-align: center;
    }

    .badge {
        display: inline-block;
        background: rgba(255,107,53,0.15);
        color: #ff6b35;
        padding: 7px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        margin-bottom: 22px;
    }

    h1 {
        font-size: 38px;
        line-height: 1.25;
        margin-bottom: 15px;
    }

    h1 span {
        color: #ff6b35;
    }

    .subtitle {
        color: #b5b5b5;
        font-size: 15px;
        margin-bottom: 45px;
    }

    .cards {
        display: flex;
        gap: 20px;
        justify-content: center;
    }

    .card {
        width: 250px;
        background: white;
        color: #222;
        padding: 28px 22px;
        border-radius: 15px;
        text-decoration: none;
        box-shadow: 0 8px 25px rgba(0,0,0,0.25);
    }

    .card:hover {
        transform: translateY(-4px);
    }

    .icon {
        font-size: 34px;
        margin-bottom: 12px;
    }

    .card h3 {
        margin-bottom: 8px;
        font-size: 18px;
    }

    .card p {
        color: #777;
        font-size: 13px;
        line-height: 1.5;
    }

    .orange { border-top: 5px solid #ff6b35; }
    .green { border-top: 5px solid #0f766e; }
    .yellow { border-top: 5px solid #f59e0b; }
</style>
</head>

<body>

<nav>
    <div class="logo">🛵</div>
    <div class="nav-right">
        Welcome, <span><?php echo $username; ?></span>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</nav>

<div class="main">

    <h1>
        Smart <span>Multi-Restaurant</span><br>
        Delivery Aggregation Platform
    </h1>

    <p class="subtitle">
        Manage restaurants, couriers and rule-based courier assignments.
    </p>

    <div class="cards">

        <a href="restaurants.php" class="card orange">
            <div class="icon">🍽️</div>
            <h3>Restaurants</h3>
            <p>View, search and filter restaurants.</p>
        </a>

        <a href="couriers.php" class="card green">
            <div class="icon">🛵</div>
            <h3>Couriers</h3>
            <p>View couriers by zone and availability.</p>
        </a>

        <a href="assign_courier.php" class="card yellow">
            <div class="icon">📦</div>
            <h3>Assign Courier</h3>
            <p>Assign a courier with explanation.</p>
        </a>

    </div>

</div>

</body>
</html>