<?php
require_once(__DIR__ . "/../db.php");

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $zone = $_POST["zone"];
    $availability = $_POST["availability"];
    $active_order_count = $_POST["active_order_count"];

    $sql = "INSERT INTO couriers (name, zone, availability, active_order_count)
            VALUES ('$name', '$zone', '$availability', '$active_order_count')";

    mysqli_query($conn, $sql);

    echo "Courier added.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Courier</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1a0800, #0d0d0f);
            padding: 30px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 12px;
        }

        input, select, button, .btn {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button, .btn {
            background: #ff6b35;
            color: white;
            border: none;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }

        .explain {
            background: #fff4ef;
            border-left: 4px solid #ff6b35;
            padding: 10px;
            margin-top: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Add Courier</h1>

    <a href="../couriers.php" class="btn">Back to Couriers</a>

    <form method="POST">

        <label>Courier Name</label>
        <input type="text" name="name" placeholder="Enter courier name">

        <label>Zone</label>
        <select name="zone">
            <option value="">Select zone</option>
            <option value="A">A</option>
            <option value="B">B</option>
        </select>

        <label>Availability</label>
        <select name="availability">
            <option value="">Select availability</option>
            <option value="1">Available</option>
            <option value="0">Unavailable</option>
        </select>

        <label>Active Order Count</label>
        <input type="number" name="active_order_count" placeholder="Enter active order count">

        <button type="submit">Add Courier</button>

    </form>

    <?php if ($message != "") { ?>
        <div class="success"><?php echo $message; ?></div>
    <?php } ?>

    <?php if ($error != "") { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <div class="explain">
        Validation rule: all fields are required. Zone must be A or B. Availability must be 0 or 1. Active order count cannot be negative.
    </div>

</div>

</body>
</html>