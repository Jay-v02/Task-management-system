<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<script src="sweetalert2.all.min.js"></script>
<script src="jquery-3.7.1.min.js"></script>

<body>
    <?php include "index.php"; ?>
    <div class="container">
        <!-- create task modal -->

        <div class="create-task">
            <?php
            if (isset($_GET["id"])) {
                $id = $_GET['id'];
                include './api/task/config.php';
                $query = mysqli_query($conn, "SELECT * FROM `task` WHERE id = $id");

                $row = mysqli_fetch_assoc($query)
            ?>
                <form action="./api/task/editTask.php" method="post">
                    <input type="hidden" name="id" class="form-control" value="<?php echo $row['id'] ?>" placeholder="Enter Task Title">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" name="title" class="form-control" value="<?php echo $row['title'] ?>" placeholder="Enter Task Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">description</label>
                        <textarea class="form-control" name="description" value="" placeholder="Description..." rows="3"><?php echo $row['description'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="exampleCheck1">Task priority</label>
                        <select class="custom-select" name="priority" id="inputGroupSelect01">
                            <option value="low" <?php if ($row['priority'] == "low") echo "selected"; ?>>Low</option>
                            <option value="medium" <?php if ($row['priority'] == "medium") echo "selected"; ?>>Medium</option>
                            <option value="high" <?php if ($row['priority'] == "high") echo "selected"; ?>>High</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Deadline</label>
                        <input class="from-control" type="date" name="deadline" value="<?php echo $row['deadline'] ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="exampleCheck1">Status</label>
                        <select class="custom-select" name="status" id="inputGroupSelect01" value="<?php echo $row['status'] ?>">
                            <option value="pending">Pending</option>
                            <option value="in-process">in-Process</option>
                            <option value="complated">Complated</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="exampleCheck1">Assigned to</label>
                        <select class="custom-select" name="assignedTo" id="inputGroupSelect01" value="<?php echo $row['assigend_to'] ?>">
                            <?php
                            include './api/task/config.php';

                            $query = mysqli_query($conn, "SELECT * FROM `users`");
                            while ($row = mysqli_fetch_assoc($query)) {
                                echo '
                                    <option value="' . $row['id'] . '">' . $row['name'] . '</option>
                                ';
                            }

                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php } else {
            ?>
                <form action="./api/task/addTask.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" name="title" class="form-control" value="" placeholder="Enter Task Title">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">description</label>
                        <textarea class="form-control" name="description" placeholder="Description..." rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="exampleCheck1">Task priority</label>
                        <select class="custom-select" name="priority" id="inputGroupSelect01">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Deadline</label>
                        <input class="from-control" type="date" name="deadline">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="exampleCheck1">Status</label>
                        <select class="custom-select" name="status" id="inputGroupSelect01">
                            <option value="pending">Pending</option>
                            <option value="In-progress">in-Process</option>
                            <option value="complated">Complated</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-check-label" for="exampleCheck1">Assigned to</label>
                        <select class="custom-select" name="assignedTo" id="inputGroupSelect01">
                            <?php
                            include './api/task/config.php';

                            $query = mysqli_query($conn, "SELECT * FROM `users`");
                            while ($row = mysqli_fetch_assoc($query)) {
                                echo '
                                    <option value="' . $row['id'] . '">' . $row['name'] . '</option>
                                ';
                            }

                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php } ?>
        </div>

        <!-- show the task by feaching info from database and view as a card -->
        <div class="row py-5">
            <div class="col-lg-4">
                <div class="card bg-warning text-light">
                    <h5 class="pt-2 card-title text-center">Pandding Task</h5>
                    <?php
                    include "./api/task/config.php";

                    $query = mysqli_query($conn, "SELECT * FROM `task` WHERE task_status = 1");
                    $num = mysqli_num_rows($query);

                    if ($num) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo '
                                    <div class="card-body">
                                        <h5 class="class-title"><a href="task.php?id=' . $row['id'] . '">' . $row['title'] . '</a>
                                            <button class="btn btn-danger btn-sm" onclick="deleteTask('. $row['id'].')">Delete</button>
                                        </h5> 
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

                    $query = mysqli_query($conn, "SELECT * FROM `task` WHERE task_status = 2");
                    $num = mysqli_num_rows($query);

                    if ($num) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo '
                                    <div class="card-body">
                                        <h5 class="class-title"><a href="task.php?id=' . $row['id'] . '">' . $row['title'] . '</a>
                                            <button class="btn btn-danger btn-sm" onclick="deleteTask('. $row['id'].')">Delete</button>
                                        </h5> 
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

                    $query = mysqli_query($conn, "SELECT * FROM `task` WHERE task_status = 3");
                    $num = mysqli_num_rows($query);

                    if ($num) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo '
                                    <div class="card-body">
                                        <h5 class="class-title"><a href="task.php?id=' . $row['id'] . '">' . $row['title'] . '</a>
                                            <button class="btn btn-danger btn-sm" onclick="deleteTask('. $row['id'].')">Delete</button>
                                        </h5> 
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

    <script>
        function deleteTask(id) {
            console.log(id);
            
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if(result.value) {
                        
                        window.location.href = `./api/task/deleteTask.php?id=${id}`;
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                    
                });
            }
    </script>
</body>

</html>