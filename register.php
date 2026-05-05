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
    <title>Register</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            background: linear-gradient(135deg, #1a0800, #0d0d0f);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-box {
            width: 360px;
            background-color: white;
            padding: 35px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }

        h1 {
            margin-bottom: 6px;
            color: #222;
        }

        .subtitle {
            color: #777;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: bold;
            color: #444;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 14px;
        }

        input:focus {
            border-color: #ff6b35;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #ff6b35;
            border: none;
            color: white;
            border-radius: 7px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #e85a28;
        }

        .success {
            margin-top: 15px;
            color: green;
            font-size: 14px;
        }

        .error {
            margin-top: 15px;
            color: red;
            font-size: 14px;
        }

        .login-link {
            margin-top: 22px;
            font-size: 14px;
            color: #777;
        }

        .login-link a {
            color: #ff6b35;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="register-box">
        <h1>Create Account</h1>
        <p class="subtitle">Register to use the delivery platform</p>

        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Choose username" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Create password" required>
            </div>

            <button type="submit" class="btn">Register</button>
        </form>

        <?php if ($message != "") { ?>
            <div class="success"><?php echo $message; ?></div>
        <?php } ?>

        <?php if ($error != "") { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>

        <div class="login-link">
            Already have an account? <a href="login.php">Login</a>
        </div>
    </div>

</body>
</html>