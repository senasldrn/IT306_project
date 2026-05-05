<?php
require_once(__DIR__ . "/../db.php");

$id = isset($_GET["id"]) ? $_GET["id"] : "";


if ($id == "") {
    die("Restaurant ID missing.");
}

$sql = "DELETE FROM restaurants WHERE restaurant_id = $id";

if (mysqli_query($conn, $sql)) {
    header("Location: ../restaurants.php");
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>