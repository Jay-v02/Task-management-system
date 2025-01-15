<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php

include 'config.php';


$query = mysqli_query($conn, "DELETE FROM `task` WHERE id = '$_GET[id]' ");

if ($query) {
    header("Location: ../../task.php");
} else {
    echo 'task are not deleted';
}
?>