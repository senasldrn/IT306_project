<?php
require_once("db.php");

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if ($username == "" || $email == "" || $password == "") {
        $error = "All fields are required.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $checkSql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $checkResult = mysqli_query($conn, $checkSql);

        if (mysqli_num_rows($checkResult) > 0) {
            $error = "Username or email already exists.";
        } else {
            $sql = "INSERT INTO users (username, email, password)
                    VALUES ('$username', '$email', '$hashedPassword')";

            if (mysqli_query($conn, $sql)) {
                $message = "Registration successful. You can now login.";
            } else {
                $error = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .box {
            width: 400px;
            background: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 0 15px rgba(0,0,0,0.08);
        }
        h1 {
            text-align: center;
            margin-bottom: 10px;
        }
        p {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: #0077cc;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
        }
        .btn:hover {
            background: #005fa3;
        }
        .success {
            margin-top: 15px;
            color: #1b5e20;
            background: #e8f5e9;
            padding: 10px;
            border-radius: 8px;
        }
        .error {
            margin-top: 15px;
            color: #c62828;
            background: #fdeaea;
            padding: 10px;
            border-radius: 8px;
        }
        .link {
            margin-top: 18px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Register</h1>
        <p>Create a new user account</p>

        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn">Register</button>
        </form>

        <?php if ($message != ""): ?>
            <div class="success"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if ($error != ""): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="link">
            <a href="login.php">Go to Login</a>
        </div>
    </div>
</body>
</html>