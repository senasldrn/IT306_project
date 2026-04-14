<?php
require_once("db.php");

$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';
$zone = isset($_GET['zone']) ? $_GET['zone'] : '';

$sql = "SELECT * FROM restaurants WHERE 1=1";

if ($search != '') {
    $sql .= " AND name LIKE '%$search%'";
}
if ($category != '') {
    $sql .= " AND category = '$category'";
}
if ($zone != '') {
    $sql .= " AND zone = '$zone'";
}

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants</title>
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
        h1 {
            margin-bottom: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        input, select {
            padding: 8px;
            margin-right: 10px;
            margin-bottom: 10px;
        }
        button, .btn {
            padding: 8px 14px;
            background: #0077cc;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        button:hover, .btn:hover {
            background: #005fa3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
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
        .top-links {
            margin-bottom: 15px;
        }
        .explain {
            margin-top: 10px;
            color: #444;
            background: #f9f9f9;
            padding: 10px;
            border-left: 4px solid #0077cc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Restaurant Page</h1>

        <div class="top-links">
            <a class="btn" href="index.php">Home</a>
        </div>

        <form method="GET">
            <input type="text" name="search" placeholder="Search by name" value="<?php echo $search; ?>">

            <select name="category">
                <option value="">All Categories</option>
                <option value="Fast Food" <?php if($category=="Fast Food") echo "selected"; ?>>Fast Food</option>
                <option value="Italian" <?php if($category=="Italian") echo "selected"; ?>>Italian</option>
                <option value="Japanese" <?php if($category=="Japanese") echo "selected"; ?>>Japanese</option>
                <option value="Dessert" <?php if($category=="Dessert") echo "selected"; ?>>Dessert</option>
                <option value="Turkish" <?php if($category=="Turkish") echo "selected"; ?>>Turkish</option>
                <option value="Vegan" <?php if($category=="Vegan") echo "selected"; ?>>Vegan</option>
            </select>

            <select name="zone">
                <option value="">All Zones</option>
                <option value="A" <?php if($zone=="A") echo "selected"; ?>>A</option>
                <option value="B" <?php if($zone=="B") echo "selected"; ?>>B</option>
            </select>

            <button type="submit">Apply</button>
        </form>

        <div class="explain">
            <?php
            if ($search != '') echo "Search results for: <b>$search</b>. ";
            if ($category != '') echo "Filtering by category: <b>$category</b>. ";
            if ($zone != '') echo "Showing restaurants in zone: <b>$zone</b>. ";
            if ($search == '' && $category == '' && $zone == '') echo "Showing all restaurants.";
            ?>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Zone</th>
            </tr>

            <?php
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["restaurant_id"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["category"] . "</td>";
                    echo "<td>" . $row["zone"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No restaurants found.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>