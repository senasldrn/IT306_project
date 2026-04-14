<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "it306_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "DELETE FROM couriers WHERE courier_id = 1";

if (mysqli_query($conn, $sql)) {
    echo "Courier record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>