<?php
require_once(__DIR__ . "/../db.php");

$id = isset($_GET["id"]) ? $_GET["id"] : "";

if ($id == "") {
    die("Courier ID missing.");
}

$sql = "DELETE FROM couriers WHERE courier_id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

header("Location: ../couriers.php");
exit();
?>