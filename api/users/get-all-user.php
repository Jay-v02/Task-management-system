<?php 

include 'config.php';

$search = $_GET["search"];


$query = mysqli_query($conn, "SELECT * FROM `users` WHERE name LIKE '%$search%'");
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
echo json_encode([
    'success' => true,
    'data' => $result
])
?>