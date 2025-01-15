<?php
session_start();
if(!isset($_SESSION['name'])){
    header("Location: login.php");
}
?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">iTaskManage</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php if($page == 'home') echo 'active'; ?>">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item <?php if($page == 'user') echo 'active'; ?>" >
                        <a class="nav-link" href="user.php">User</a>
                    </li>
                    <li class="nav-item <?php if($page == 'task') echo 'active'; ?>">
                        <a class="nav-link" href="task.php">Task</a>
                    </li>
                    
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold ml-auto" href=""><?php echo $_SESSION['name']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="api/users/logOut.php" class="btn btn-outline-danger btn-sm mt-1">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
 