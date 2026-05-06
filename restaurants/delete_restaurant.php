<?php
require_once(__DIR__ . "/../db.php");

$id = isset($_GET["id"]) ? $_GET["id"] : "";

if ($id == "") {
    die("Restaurant ID missing.");
}

$sql = "DELETE FROM restaurants WHERE restaurant_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../restaurants.php");
    exit();
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>