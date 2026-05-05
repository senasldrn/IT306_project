<?php
require_once(__DIR__ . "/../db.php");

$message = "";
$error = "";

$id = $_GET["id"];

$sql = "SELECT * FROM restaurants WHERE restaurant_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$restaurant = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $category = $_POST["category"];
    $zone = $_POST["zone"];

    $sql = "UPDATE restaurants SET name=?, category=?, zone=? WHERE restaurant_id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $name, $category, $zone, $id);
    mysqli_stmt_execute($stmt);

    echo "Updated successfully.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Restaurant</title>

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
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
        }

        h1 {
            color: #222;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 12px;
            margin-bottom: 5px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button, .btn {
            display: inline-block;
            padding: 10px 14px;
            background: #ff6b35;
            color: white;
            border: none;
            text-decoration: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            margin-bottom: 15px;
        }

        button:hover, .btn:hover {
            background: #e85a28;
        }

        .success {
            color: green;
            margin-top: 10px;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .explain {
            margin-top: 15px;
            color: #444;
            background: #fff4ef;
            padding: 10px;
            border-left: 4px solid #ff6b35;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Edit Restaurant</h1>

    <a href="../restaurants.php" class="btn">Back to Restaurants</a>

    <form method="POST">

        <label>Restaurant Name</label>
        <input type="text" name="name" value="<?php echo $restaurant['name']; ?>">

        <label>Category</label>
        <input type="text" name="category" value="<?php echo $restaurant['category']; ?>">

        <label>Zone</label>
        <select name="zone">
            <option value="A" <?php if($restaurant["zone"] == "A") echo "selected"; ?>>A</option>
            <option value="B" <?php if($restaurant["zone"] == "B") echo "selected"; ?>>B</option>
        </select>

        <button type="submit">Update Restaurant</button>

    </form>

    <?php if ($message != "") { ?>
        <div class="success"><?php echo $message; ?></div>
    <?php } ?>

    <?php if ($error != "") { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <div class="explain">
        Validation rule: name, category and zone are required. Zone must be A or B.
    </div>

</div>

</body>
</html>