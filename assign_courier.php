<?php
require_once("db.php");

$selected_zone = isset($_GET['zone']) ? $_GET['zone'] : '';
$assignedCourier = null;
$explanation = '';

if ($selected_zone != '') {

    $sql = "SELECT * FROM couriers
            WHERE zone = '$selected_zone' AND availability = 1
            ORDER BY active_order_count ASC
            LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $assignedCourier = mysqli_fetch_assoc($result);
    } else {
        $explanation = "No available courier exists in zone $selected_zone.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assign Courier</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1a0800, #0d0d0f);
            padding: 30px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }

        h1 {
            color: #222;
        }

        select {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
        }

        button, .btn {
            padding: 10px 14px;
            background: #ff6b35;
            color: white;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .result-box {
            margin-top: 20px;
            padding: 15px;
            background: #fafafa;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .explain-box {
            margin-top: 20px;
            padding: 15px;
            background: #fff4ef;
            border-left: 5px solid #ff6b35;
            border-radius: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Assign Courier</h1>

    <a class="btn" href="index.php">Home</a>
    <a class="btn" href="couriers.php">Courier Page</a>

    <br><br>

    <form method="GET">
        <label><b>Select Delivery Zone:</b></label><br><br>

        <select name="zone">
            <option value="">Choose Zone</option>
            <option value="A" <?php if ($selected_zone == "A") echo "selected"; ?>>Zone A</option>
            <option value="B" <?php if ($selected_zone == "B") echo "selected"; ?>>Zone B</option>
        </select>

        <button type="submit">Assign Courier</button>
    </form>

    <?php if ($selected_zone != ''): ?>

        <div class="result-box">
            <h3>Assignment Result</h3>

            <?php if ($assignedCourier): ?>
                <p><b>ID:</b> <?php echo $assignedCourier["courier_id"]; ?></p>
                <p><b>Name:</b> <?php echo $assignedCourier["name"]; ?></p>
                <p><b>Zone:</b> <?php echo $assignedCourier["zone"]; ?></p>
                <p><b>Availability:</b> <?php echo $assignedCourier["availability"]; ?></p>
                <p><b>Active Orders:</b> <?php echo $assignedCourier["active_order_count"]; ?></p>
            <?php else: ?>
                <p>No available courier found.</p>
            <?php endif; ?>
        </div>

        <div class="explain-box">
            <h3>Explanation</h3>

            <?php if ($assignedCourier): ?>
                <ul>
                    <li>Courier operates in zone <?php echo $selected_zone; ?></li>
                    <li>Courier is available</li>
                    <li>Courier has the lowest active order count</li>
                </ul>
            <?php else: ?>
                <p><?php echo $explanation; ?></p>
            <?php endif; ?>

        </div>

    <?php endif; ?>

</div>

</body>
</html>