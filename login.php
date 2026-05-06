<?php
session_start();
require_once("db.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user["username"];
            $_SESSION["user_id"] = $user["user_id"];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; height: 100vh; display: flex; }
        .left-panel { width: 60%; background: linear-gradient(135deg, #1a0800, #0d0d0f); color: white; padding: 60px; display: flex; flex-direction: column; justify-content: center; }
        .left-panel h1 { font-size: 42px; margin-bottom: 20px; }
        .left-panel span { color: #ff6b35; }
        .left-panel p { font-size: 16px; line-height: 1.6; color: #ddd; max-width: 450px; }
        .stats { display: flex; gap: 30px; margin-top: 35px; }
        .stat-number { color: #ffc107; font-size: 26px; font-weight: bold; }
        .stat-text { color: #aaa; font-size: 12px; }
        .right-panel { width: 40%; background-color: white; padding: 60px 50px; display: flex; flex-direction: column; justify-content: center; }
        .right-panel h2 { margin-bottom: 8px; color: #222; }
        .form-subtitle { color: #777; margin-bottom: 30px; font-size: 14px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; margin-bottom: 6px; font-weight: bold; font-size: 13px; color: #444; }
        input { width: 100%; padding: 11px; border: 1px solid #ccc; border-radius: 7px; font-size: 14px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background-color: #ff6b35; border: none; color: white; border-radius: 7px; font-size: 15px; font-weight: bold; cursor: pointer; }
        button:hover { background-color: #e85a28; }
        .error { margin-top: 15px; color: red; font-size: 14px; }
        .register-link { margin-top: 22px; font-size: 14px; color: #777; text-align: center; }
        .register-link a { color: #ff6b35; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="left-panel">
        <h1>Order from <br><span>multiple restaurants</span><br>at once</h1>
        <p>A smart, zone-based delivery aggregation platform. Users can create one order from multiple restaurants in the same delivery zone.</p>
        <div class="stats">
            <div><div class="stat-number">2</div><div class="stat-text">Zones</div></div>
            <div><div class="stat-number">1</div><div class="stat-text">Cart</div></div>
            <div><div class="stat-number">1</div><div class="stat-text">Courier</div></div>
        </div>
    </div>
    <div class="right-panel">
        <h2>Login</h2>
        <p class="form-subtitle">Sign in to continue</p>
        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <?php if ($error != ""): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <div class="register-link">
            Don't have an account? <a href="register.php">Register</a>
        </div>
    </div>
</body>
</html>
