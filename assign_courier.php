<?php
require_once("db.php");

$selected_zone = isset($_GET['zone']) ? $_GET['zone'] : '';
$result = null;
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
        $explanation = "Courier assigned because they are available, operate in zone $selected_zone, and have the lowest active order count.";
    } else {
        $explanation = "Courier assignment failed because no available courier exists in zone $selected_zone.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Courier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 30px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
        }
        h1 {
            margin-bottom: 20px;
        }
        select, button, .btn {
            padding: 10px 14px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        button, .btn {
            background: #0077cc;
            color: white;
            border: none;
            text-decoration: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover, .btn:hover {
            background: #005fa3;
        }
        .result-box, .explain-box {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
        }
        .result-box {
            background: #f9f9f9;
            border: 1px solid #ddd;
        }
        .explain-box {
            background: #eef6ff;
            border-left: 5px solid #0077cc;
        }
        .top-links {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Assign Courier</h1>

        <div class="top-links">
            <a class="btn" href="index.php">Home</a>
            <a class="btn" href="couriers.php">Courier Page</a>
        </div>

        <form method="GET">
            <label for="zone"><b>Select Delivery Zone:</b></label><br><br>
            <select name="zone" id="zone">
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
                    <p><b>Assigned Courier ID:</b> <?php echo $assignedCourier["courier_id"]; ?></p>
                    <p><b>Name:</b> <?php echo $assignedCourier["name"]; ?></p>
                    <p><b>Zone:</b> <?php echo $assignedCourier["zone"]; ?></p>
                    <p><b>Availability:</b> <?php echo $assignedCourier["availability"]; ?></p>
                    <p><b>Active Order Count:</b> <?php echo $assignedCourier["active_order_count"]; ?></p>
                <?php else: ?>
                    <p>No available courier found.</p>
                <?php endif; ?>
            </div>

            <div class="explain-box">
                <h3>Explanation</h3>
                <p><?php echo $explanation; ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>