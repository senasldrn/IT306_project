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
    <title>Restaurants</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1a0800, #0d0d0f);
            padding: 30px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.25);
        }

        h1 {
            margin-bottom: 20px;
            color: #222;
        }

        form {
            margin-bottom: 20px;
        }

        input, select {
            padding: 8px;
            margin-right: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button, .btn {
            padding: 8px 14px;
            background: #ff6b35;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            display: inline-block;
            margin: 3px;
        }

        button:hover, .btn:hover {
            background: #e85a28;
        }

        .delete-btn {
            background: #c0392b;
        }

        .delete-btn:hover {
            background: #a93226;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #f3f3f3;
            color: #222;
        }

        tr:nth-child(even) {
            background: #fafafa;
        }

        .top-links {
            margin-bottom: 15px;
        }

        .explain {
            margin-top: 10px;
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

    <h1>Restaurant Page</h1>

    <div class="top-links">
        <a class="btn" href="index.php">Home</a>
        <a href="restaurants/add_restaurant.php" class="btn">Add Restaurant</a>
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
            <th>Actions</th>
        </tr>

        <?php
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["restaurant_id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>" . $row["zone"] . "</td>";
                echo "<td>
                <a href='cart.php?restaurant_id=" . $row["restaurant_id"] . "&zone=" . $row["zone"] . "&name=" . $row["name"] . "' class='btn'>Add to Cart</a>

                <a href='restaurants/edit_restaurant.php?id=" . $row["restaurant_id"] . "' class='btn'>Edit</a>

                <a href='restaurants/delete_restaurant.php?id=" . $row["restaurant_id"] . "' class='btn'>Delete</a>
                        
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No restaurants found.</td></tr>";
        }
        ?>
    </table>

</div>

</body>
</html>