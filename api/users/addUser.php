<?php


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'config.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO `users`( `name`, `email`, `password`, `created_at`) VALUES ('$name','$email','$password',current_timestamp())";
    $result = mysqli_query($conn, $query);

    if($result) {
        header("Location: ../../user.php");
    }
    else {
        echo ' error';
    }

}

?>