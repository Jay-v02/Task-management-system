<?php 

include 'config.php';

$search = $_GET["search"];


$query = mysqli_query($conn, "SELECT * FROM `task` WHERE title LIKE '%$search%'");
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
echo json_encode([
    'success' => true,
    'data' => $result
])
?>