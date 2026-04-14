<?php
session_start();
require_once("db.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            width: 380px;
            background: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
            text-align: center;
        }
        h1 {
            margin-bottom: 10px;
            color: #222;
        }
        p {
            color: #666;
            margin-bottom: 25px;
        }
        .form-group {
            text-align: left;
            margin-bottom: 18px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #0077cc;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            margin-top: 5px;
        }
        .btn:hover {
            background: #005fa3;
        }
        .error {
            margin-top: 15px;
            color: #c62828;
            background: #fdeaea;
            padding: 10px;
            border-radius: 8px;
            font-size: 14px;
        }
        .link {
            margin-top: 18px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Login</h1>
        <p>Smart Multi-Restaurant Delivery Aggregation Platform</p>

        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>

        <?php if ($error != ""): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="link">
            <a href="register.php">Create an account</a>
        </div>
    </div>
</body>
</html>