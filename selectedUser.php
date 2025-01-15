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
        <!-- show the task by feaching info from database and view as a card -->
        <div class="row py-5">
            <div class="col-lg-4">
                <div class="card bg-warning text-light">
                    <h5 class="pt-2 card-title text-center">Pandding Task</h5>
                    <?php
                    include "./api/task/config.php";
                    $id = $_GET["id"];
                    $query = mysqli_query($conn, "SELECT * FROM `task` WHERE task_status = 1 AND assigned_to = $id");
                    $num = mysqli_num_rows($query);
                    

                    if ($num) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo '
                                    <div class="card-body">
                                        <h5 href="" class="card-title">' . $row['title'] . '</h5>
                                        <h6 class="card-subtitle mb-2 text-dark">Created By ~ ' . $_SESSION['name'] . '</h6>
                                        <p class="card-text">' . substr($row['description'], 0, 50) . '</p>
                                        <p class="card-text font-weight-bold">Date: ' . $row['deadline'] . '</p>
                                    </div>
                                ';
                        }
                    } else {
                        echo '<p class="px-2 font-weight-bold">No Task In Pendding state...</p>';
                    }

                    ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-info text-light">
                    <h5 class="pt-2 card-title text-center">In-Process Task</h5>
                    <?php
                    include "./api/task/config.php";
                    $id = $_GET['id'];
                    $query = mysqli_query($conn, "SELECT * FROM `task` WHERE task_status = 2 AND assigned_to = $id");
                    $num = mysqli_num_rows($query);

                    if ($num) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo '
                                    <div class="card-body">
                                        <h5 href="" class="card-title">' . $row['title'] . '</h5>
                                        <h6 class="card-subtitle mb-2 text-dark">Created By ~ ' . $_SESSION['name'] . '</h6>
                                        <p class="card-text">' . $row['description'] . '</p>
                                        <p class="card-text font-weight-bold">Date: ' . $row['deadline'] . '</p>
                                    </div>
                                ';
                        }
                    } else {
                        echo '<p class="px-2 font-weight-bold">No Task In Proccess state...</p>';
                    }

                    ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card bg-success text-light">
                    <h5 class="pt-2 card-title text-center">Complated Task</h5>
                    <?php
                    include "./api/task/config.php";

                    $query = mysqli_query($conn, "SELECT * FROM `task` WHERE task_status = 3  AND assigned_to = $id");
                    $num = mysqli_num_rows($query);

                    if ($num) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo '
                                    <div class="card-body">
                                        <h5 href="" class="card-title">' . $row['title'] . '</h5>
                                        <h6 class="card-subtitle mb-2 text-dark">Created By ~ ' . $_SESSION['name'] . '</h6>
                                        <p class="card-text">' . $row['description'] . '</p>
                                        <p class="card-text font-weight-bold"> Date: ' . $row['deadline'] . '</p>
                                    </div>
                                ';
                        }
                    } else {
                        echo '<p class="px-2 font-weight-bold">No Task In Compaleted state...</p>';
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>