<?php
require_once("db.php");

$zone = isset($_GET['zone']) ? $_GET['zone'] : '';
$availability = isset($_GET['availability']) ? $_GET['availability'] : '';

$sql = "SELECT * FROM couriers WHERE 1=1";

if ($zone != '') {
    $sql .= " AND zone = '$zone'";
}
if ($availability != '') {
    $sql .= " AND availability = '$availability'";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Couriers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 30px;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.08);
        }
        input, select, button, .btn {
            padding: 8px 14px;
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background: #f0f0f0;
        }
        .explain {
            margin-top: 10px;
            margin-bottom: 15px;
            color: #444;
            background: #f9f9f9;
            padding: 10px;
            border-left: 4px solid #0077cc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Courier Page</h1>

        <a class="btn" href="index.php">Home</a>

        <form method="GET">
            <select name="zone">
                <option value="">All Zones</option>
                <option value="A" <?php if($zone=="A") echo "selected"; ?>>A</option>
                <option value="B" <?php if($zone=="B") echo "selected"; ?>>B</option>
            </select>

            <select name="availability">
                <option value="">All</option>
                <option value="1" <?php if($availability==="1") echo "selected"; ?>>Available</option>
                <option value="0" <?php if($availability==="0") echo "selected"; ?>>Unavailable</option>
            </select>

            <button type="submit">Apply</button>
        </form>

        <div class="explain">
            <?php
            if ($zone != '') echo "Filtering couriers in zone: <b>$zone</b>. ";
            if ($availability !== '') {
                if ($availability == "1") {
                    echo "Showing only <b>available</b> couriers. ";
                } else {
                    echo "Showing only <b>unavailable</b> couriers. ";
                }
            }
            if ($zone == '' && $availability === '') echo "Showing all couriers.";
            ?>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Zone</th>
                <th>Availability</th>
                <th>Active Order Count</th>
            </tr>

            <?php
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["courier_id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["zone"] . "</td>";
                    echo "<td>" . $row["availability"] . "</td>";
                    echo "<td>" . $row["active_order_count"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No couriers found.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>