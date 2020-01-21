<?php include('includes/server.php');

// Initialize the session
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
// initializing variables
$username = $_SESSION['username'];
$email    = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'david', 'rootroot', 'chatbot');

//update user
if (isset($_POST['user-update'])) {
    $email = $_POST['New-email'];
    $password = $_POST['New-password'];
    $password = md5($password);//encrypt the password before saving in the database
    mysqli_query($db, "UPDATE users SET email='$email', password='$password' WHERE username = $username ");
    echo "<script type=text/javascript>";
    echo "alert('User details successfully updated');";
    echo "</script>";
    header('location: welcome.php');

}

?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title> Update || <?php echo $_SESSION['username']; ?> </title>
        <link rel="shortcut icon" type="image/png" href="assets/img/peerTalk.png">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <!--custom styling-->
        <link rel="stylesheet" href="admin/assets/css/main.css">
        <!--admin style-->
        <link rel="stylesheet" href="admin/assets/css/admin.css">
        <!--google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">
        <style>

        </style>
    </head>
    <body>

    <!--nav bar section-->
    <header>
        <div class="logo">
            <h1 class="logo-text"><a href="welcome.php"><span>Update</span>Details</a></h1>

        </div>
        <i class="fa fa-bars menu-toggle"></i>

        <ul class="nav">
            <li>
                <a href="#">
                    <i class="fa fa-user" ></i>
                    <?php echo $_SESSION['username']; ?>
                    <i class="fa fa-chevron-down" style="font-size: .8em;"></i>
                </a>
                <ul>
                    <li><a href="welcome.php">Home</a></li>
                    <li><a href="welcome.php?logout='1'" class="logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </header>

    <!--Admin Page wrapper-->
    <div class="Admin-wrapper">

        <!--left side bar-->
        <!--end of left sidebar-->

        <!-- Admin Content-->
        <div class="admin-content">
            <div class="button-group">
                <a href="welcome.php" class="btn btn-big">Back</a>
            </div>

            <div class="content">
                <h2 class="page-title"> Update Your Info </h2>
                <!--content table-->
                <form action="update.php" method="post">
                    <?php include('includes/errors.php'); ?>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                        <label> Username: <?php echo $_SESSION['username']; ?></label>
                    <br><br>
                    <label> Email: </label>
                        <input type="email" name="New-email" value="<?php echo $email; ?>" class="text-input">
                    <br><br>
                        <label>password: </label>
                        <input type="password" name="New-password" class="text-input">
                    <br><br>

                    <br><br>

                    <button type="submit" name="user-update" class="btn btn-big" style="margin-bottom: 20px;"> Update User </button>
                        <button type="reset" class="btn btn-big"> Reset </button>


                </form>

                <!--end of content table-->

            </div>

        </div>
        <!--end of admin content-->
    </div>
    <!--ent of page wrapper-->
    <!--jquery-->
    <script src="admin/assets/js/jquery-3.4.1.js"></script>
    <!--main js-->
    <script src="admin/assets/js/main.js"></script>
    </body>
    </html>
<?php
