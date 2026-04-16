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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IT306 Project Dashboard</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family: Arial, sans-serif;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background: linear-gradient(135deg,#dbeafe,#eff6ff,#f8fafc);
    padding:30px;
}

.container{
    width:100%;
    max-width:900px;
    background:rgba(255,255,255,0.96);
    padding:45px;
    border-radius:22px;
    text-align:center;
    box-shadow:0 20px 45px rgba(0,0,0,0.12);
}

.badge{
    display:inline-block;
    padding:8px 16px;
    background:#e0f2fe;
    color:#0369a1;
    font-weight:bold;
    border-radius:999px;
    margin-bottom:22px;
    font-size:13px;
}

h1{
    font-size:30px;
    line-height:1.3;
    color:#0f172a;
    margin-bottom:16px;
}

.subtitle{
    font-size:18px;
    color:#475569;
    margin-bottom:12px;
}

.welcome{
    font-size:22px;
    margin-bottom:32px;
    color:#111827;
}

.welcome span{
    color:#2563eb;
    font-weight:bold;
}

.button-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:18px;
}

.btn{
    display:block;
    padding:16px;
    text-decoration:none;
    color:white;
    font-weight:bold;
    font-size:17px;
    border-radius:14px;
    transition:0.25s;
    box-shadow:0 10px 20px rgba(0,0,0,0.10);
}

.btn:hover{
    transform:translateY(-4px);
}

.btn-primary{
    background:#2563eb;
}

.btn-primary:hover{
    background:#1d4ed8;
}

.btn-secondary{
    background:#0f766e;
}

.btn-secondary:hover{
    background:#115e59;
}

.btn-warning{
    background:#f59e0b;
}

.btn-warning:hover{
    background:#d97706;
}

.btn-danger{
    background:#dc2626;
}

.btn-danger:hover{
    background:#b91c1c;
}

.logout-area{
    margin-top:22px;
    text-align:center;
}

.logout-btn{
    width:250px;
    display:inline-block;
}

.footer{
    margin-top:35px;
    color:#64748b;
    font-size:15px;
}

@media(max-width:900px){

    h1{
        font-size:25px;
    }

    .welcome{
        font-size:18px;
    }

    .button-grid{
        grid-template-columns:1fr;
    }

    .logout-btn{
        width:100%;
    }
}
</style>
</head>

<body>

<div class="container">

    <div class="badge">IT306 Server-Side Programming</div>

    <h1>Smart Multi-Restaurant Delivery Aggregation Platform</h1>

    <p class="subtitle">Project Demo Dashboard</p>

    <p class="welcome">
        Welcome back, <span><?php echo $username; ?></span>!
    </p>

    <div class="button-grid">
        <a href="restaurants.php" class="btn btn-primary">Restaurant Page</a>
        <a href="couriers.php" class="btn btn-secondary">Courier Page</a>
        <a href="assign_courier.php" class="btn btn-warning">Assign Courier</a>
    </div>

    <div class="logout-area">
        <a href="logout.php" class="btn btn-danger logout-btn">Logout</a>
    </div>

    <p class="footer">
        Manage restaurants, couriers and assignments from one dashboard.
    </p>

</div>

</body>
</html>