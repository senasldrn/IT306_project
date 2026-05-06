<?php
require_once(__DIR__ . "/../db.php");

$id = $_GET["id"] ?? "";

$sql = "SELECT * FROM couriers WHERE courier_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$courier = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $zone = $_POST["zone"];
    $availability = $_POST["availability"];
    $active_order_count = $_POST["active_order_count"];

    $sql = "UPDATE couriers 
            SET name = ?, zone = ?, availability = ?, active_order_count = ?
            WHERE courier_id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssiii", $name, $zone, $availability, $active_order_count, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../couriers.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Courier</title>

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

        h1 {
            color: #222;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 12px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button, .btn {
            padding: 10px 14px;
            background: #ff6b35;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        button:hover, .btn:hover {
            background: #e85a28;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Courier</h1>

    <form method="POST">

        <label>Name</label>
        <input type="text" name="name" value="<?php echo $courier['name']; ?>">

        <label>Zone</label>
        <select name="zone">
            <option value="A" <?php if($courier["zone"]=="A") echo "selected"; ?>>A</option>
            <option value="B" <?php if($courier["zone"]=="B") echo "selected"; ?>>B</option>
        </select>

        <label>Availability</label>
        <select name="availability">
            <option value="1" <?php if($courier["availability"]=="1") echo "selected"; ?>>Available</option>
            <option value="0" <?php if($courier["availability"]=="0") echo "selected"; ?>>Unavailable</option>
        </select>

        <label>Active Order Count</label>
        <input type="number" name="active_order_count" value="<?php echo $courier['active_order_count']; ?>">

        <button type="submit">Update Courier</button>

    </form>


</div>

</body>
</html>