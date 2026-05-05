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
    <title>Couriers</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1a0800, #0d0d0f);
            padding: 35px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
        }

        h1 {
            color: #222;
            margin-bottom: 15px;
        }

        .home-btn {
            display: inline-block;
            background: #ff6b35;
            color: white;
            padding: 9px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .home-btn:hover {
            background: #e85a28;
        }

        form {
            margin-bottom: 10px;
        }

        select {
            padding: 9px;
            margin-right: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            padding: 9px 16px;
            background: #ff6b35;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #e85a28;
        }

        .explain {
            margin-top: 10px;
            margin-bottom: 18px;
            color: #444;
            background: #fff4ef;
            padding: 12px;
            border-left: 4px solid #ff6b35;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 11px;
            text-align: left;
        }

        th {
            background: #f3f3f3;
            color: #222;
        }

        tr:nth-child(even) {
            background: #fafafa;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Courier Page</h1>

    <a class="home-btn" href="index.php">Home</a>
    <a href="couriers/add_courier.php" class="home-btn">Add Courier</a>

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
                echo "Showing only <b>available</b> couriers.";
            } else {
                echo "Showing only <b>unavailable</b> couriers.";
            }
        }

        if ($zone == '' && $availability === '') {
            echo "Showing all couriers.";
        }
        ?>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Zone</th>
            <th>Availability</th>
            <th>Active Order Count</th>
            <th>Actions</th>
            <tr>

</tr>
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
                echo "<td>
                    <a href='couriers/edit_courier.php?id=" . $row["courier_id"] . "' class='home-btn'>Edit</a>
                    <a href='couriers/delete_courier.php?id=" . $row["courier_id"] . "' class='home-btn'>Delete</a>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No couriers found.</td></tr>";
        }
        ?>
    </table>

</div>

</body>
</html>