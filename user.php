<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include "index.php"; ?>
    <div class="container">
        <!-- user list section start here -->
        <div class="pt-5 ">
            <?php
            include './api/task/config.php';
            $query = mysqli_query($conn, "SELECT * FROM `users`");
            while ($row = mysqli_fetch_assoc($query)) {
                echo '
                <table class="table">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="col">
                                <a href="selectedUser.php?id=' . $row['id'] . '">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7915/7915522.png" style="width: 25px; height: 25px;" alt="">
                                </a>
                                '. $row['id'] .'
                            </td>
                            <td scope="col">'. $row['name'] .'</td>
                            <td scope="col">'. $row['email'] .'</td>
                            <td scope="col">
                                <a class="btn btn-outline-info btn-sm" href="addusers.php?id='. $row['id'] .'">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                ';
            }
            ?>
            <a href="addusers.php" class="btn btn-info btn-sm">Add User</a>
        </div>
    </div>
</body>

</html>