<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'config.php';

    $id = $_POST["id"];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "UPDATE `users` SET `name`='$name',`email`='$email',`password`='$password' WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: ../../user.php");
    } else {
        echo ' error';
    }
}
