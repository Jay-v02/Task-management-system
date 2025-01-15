<?php


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'config.php';

    $id = $_POST["id"];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $priority = $_POST['priority'];
    $date = $_POST['deadline'];
    $status = $_POST['status'];
    $assignedto = $_POST['assignedTo'];

    $query = "UPDATE `task` SET `title`='$title',`description`='$desc',`priority`='$priority',`deadline`='$date',`task_status`='$status',`created_at`= current_timestamp() WHERE  `id`='$id' ";
    $result = mysqli_query($conn, $query);

    if($result) {
        header("Location: ../../task.php");
    }
    else {
        echo ' error';
    }

}

?>