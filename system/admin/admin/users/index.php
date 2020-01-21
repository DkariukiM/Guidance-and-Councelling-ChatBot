<?php include('connection.php');
?>
<?php include('../../../includes/server.php');
if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Admin Section || Manage Users </title>
    <link rel="shortcut icon" type="image/png" href="../../assets/img/peerTalk.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <!--custom styling-->
    <link rel="stylesheet" href="../../assets/css/main.css">
    <!--admin style-->
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <!--google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">
</head>
<body>


<!--nav bar section-->
<header>
    <div class="logo">
        <h1 class="logo-text"><a href="index.php"><span>Dash</span>Board</a></h1>

    </div>
    <i class="fa fa-bars menu-toggle"></i>

    <ul class="nav">
        <li>
            <a href="#">
                <i class="fa fa-user" ></i>
                <!--David Kariuki-->
                <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
            </a>
            <ul>
                <li><a href="../../../welcome.php"> Home </a></li>
                <li><a href="../../../login.php" class="logout">Logout</a></li>
            </ul>
        </li>
    </ul>
</header>

<!--Admin Page wrapper-->
<div class="Admin-wrapper">

    <!--left side bar-->
    <div class="left-sidebar">
        <ul>
            <li><a href="index.php">Manage Users</a></li>
        </ul>

    </div>
    <!--end of left sidebar-->

    <!-- Admin Content-->
    <div class="admin-content">
        <div class="button-group">
            <a href="create.php" class="btn btn-big">Add User</a>
            <a href="index.php" class="btn btn-big">Manage User</a>
        </div>





        <div class="content">
            <h2 class="page-title"> Manage Users </h2>

            <!--content table-->
            <?php $results = mysqli_query($db,"SELECT id, username, email,user_type FROM users"); ?>
            <table>
                <thead>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th colspan="3">Action</th>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['user_type']; ?></td>
                    <td><a href="update.php?edit=<?php echo $row['id']; ?>" class="edit" > <i class="fa fa-pencil"></i>Edit</a></td>
                    <td><a href="connection.php?del=<?php echo $row['id'];?>" class="delete" onclick="del();" >Delete</a></td>
                    <script type="text/javascript">
                        function del() {
                            confirm("Are you sure you want to delete the user?");
                        }
                    </script>
                </tr>
                <?php } ?>
                </tbody>
            </table>

            <!--end of content table-->

        </div>

    </div>
    <!--end of admin content-->
</div>
<!--ent of page wrapper-->
<!--jquery-->
<script src="../../assets/js/jquery-3.4.1.js"></script>
<!--main javascript-->
<script src="../../assets/js/main.js"></script>
<?php /*require 'footer.php' */?>
</body>
</html>