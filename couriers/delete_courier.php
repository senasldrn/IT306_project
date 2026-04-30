<?php
require_once(__DIR__ . "/../db.php");

$id = $_GET["id"];

if ($id == "") {
    die("Courier ID missing.");
}

$sql = "DELETE FROM couriers WHERE courier_id = $id";

mysqli_query($conn, $sql);

header("Location: ../couriers.php");
exit();
?>