<?php include('connection.php');
// REGISTER USER
if (isset($_POST['reg_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $user_type = $_POST['user-type'];

    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if (empty($user_type)) { array_push($errors, "User-type is required"); }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database

        $query = "INSERT INTO users (username, email, user_type,password) 
  			  VALUES('$username', '$email', '$user_type', '$password ')";
        mysqli_query($db, $query);
        echo '<script lanugage = "javascript">';
         echo 'alert("User created successfully")';
         echo '</script>';
         header('location: index.php');
    }
}

// ...
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
            <h2 class="page-title"> Add User </h2>
            <!--content table-->
                <form action="create.php" method="post">
                    <?php include('../../../includes/errors.php'); ?>
                    <div style="margin-bottom: 20px;">
                        <label> Username: </label>
                        <input type="text" name="username" value="<?php echo $username; ?>"  class="text-input">
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label> Email: </label>
                        <input type="email" name="email" value="<?php echo $email; ?>" class="text-input">
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label>password: </label>
                        <input type="password" name="password_1" class="text-input">
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label> Retype password: </label>
                        <input type="password" name="password_2" class="text-input">
                    </div>
                    <div style="margin-bottom: 20px;">
                        <label> Role: </label>
                        <select name="user-type" id="user-type" class="text-input">
                            <option value="">-----Select User Type------</option>
                            <option value="admin"> Admin </option>
                            <option value="user">  User </option>
                        </select>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <button type="submit" name="reg_user" class="btn btn-big"> Add User </button>
                        <button type="reset" class="btn btn-big"> Reset </button>

                    </div>

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
