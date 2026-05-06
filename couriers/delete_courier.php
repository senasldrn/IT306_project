<?php
require_once(__DIR__ . "/../db.php");

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

if ($id == 0) {
    die("Courier ID missing.");
}

$stmt = mysqli_prepare($conn, "DELETE FROM couriers WHERE courier_id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: ../couriers.php");
exit();
?>
