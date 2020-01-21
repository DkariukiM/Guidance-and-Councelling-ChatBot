<?php include('connection.php');

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");

    if (count($record) == 1) {
        $n = mysqli_fetch_array($record);
        $username = $n['username'];
        $email = $n['email'];
    }
}

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> Admin Section || Add Users </title>
        <link rel="shortcut icon" type="image/png" href="../../assets/img/peerTalk.png">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <!--custom styling-->
        <link rel="stylesheet" href="../../assets/css/main.css">
        <!--admin style-->
        <link rel="stylesheet" href="../../assets/css/admin.css">
        <!--google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">
        <style>

        </style>
    </head>
    <body>

    <!--nav bar section-->
    <header>
        <div class="logo">
            <h1 class="logo-text"><a href="../../../welcome.php"><span>Dash</span>Board</a></h1>

        </div>
        <i class="fa fa-bars menu-toggle"></i>

        <ul class="nav">
            <li>
                <a href="#">
                    <i class="fa fa-user" ></i>
                    David Kariuki
                    <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
                </a>
                <ul>
                    <li><a href="#" class="logout">Logout</a></li>
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
                <h2 class="page-title"> Update User </h2>
                <!--content table-->
                <form action="update.php" method="post">
                    <?php include('../../../includes/errors.php'); ?>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                        <label> Username: </label>
                        <input type="text" name="Username" value="<?php echo $username; ?>"  class="text-input">
                    <br><br>
                    <label> Email: </label>
                        <input type="email" name="Email" value="<?php echo $email; ?>" class="text-input">
                    <br><br>
                        <label>password: </label>
                        <input type="password" name="password" class="text-input">
                    <br><br>

                        <label> Role: </label>
                        <select name="User-type" id="User-type" class="text-input">
                            <option value="">-----Select User Type------</option>
                            <option value="admin"> Admin </option>
                            <option value="user">  User </option>
                        </select>
                    <br><br>

                    <button type="submit" name="update" class="btn btn-big"> Update User </button>
                        <button type="reset" class="btn btn-big"> Reset </button>


                </form>

                <!--end of content table-->

            </div>

        </div>
        <!--end of admin content-->
    </div>
    <!--ent of page wrapper-->
    <!--jquery-->
    <script src="../../assets/js/jquery-3.4.1.js"></script>
    <!--main js-->
    <script src="../../assets/js/main.js"></script>
    <?php /*require 'footer.php' */?>
    </body>
    </html>
<?php
