<?php


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'config.php';
    
    session_start();

    $title = $_POST['title'];
    $desc = $_POST['description'];
    $priority = $_POST['priority'];
    $date = $_POST['deadline'];
    $status = $_POST['status'];
    $assignedto = $_POST['assignedTo'];
    $createdby = $_SESSION["id"];

    $query = "INSERT INTO `task`(`title`, `description`, `priority`, `deadline`, `task_status`, `assigned_to`, `created_by`, `created_at`) VALUES ('$title','$desc','$priority','$date','$status','$assignedto','$createdby',current_timestamp())";
    $result = mysqli_query($conn, $query);

    if($result) {
        header("Location: ../../task.php");
    }
    else {
        echo ' error';
    }

}

?>