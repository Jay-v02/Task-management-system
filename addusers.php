<?php 
$page  = "user";
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include 'index.php'; ?>

    <div class="container py-5">
        <div class="create-task">
            <?php
            if (isset($_GET["id"])) {
                $id = $_GET['id'];
                include './api/users/config.php';
                $query = mysqli_query($conn, "SELECT * FROM `users` WHERE id = $id");

                $row = mysqli_fetch_assoc($query)
            ?>
                <form action="./api/users/editUser.php" method="post">
                <input type="hidden" name="id" class="form-control" value="<?php echo $row['id'] ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $row['name'] ?>" placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            <?php
            } else {
            ?>
                <form action="./api/users/addUser.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="name" class="form-control" value="" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" name="email" class="form-control" value="" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" value="" placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php
            }
            ?>

        </div>
    </div>
</body>

</html>