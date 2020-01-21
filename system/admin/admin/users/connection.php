<?php
// initializing variables
$username = "";
$email    = "";
$id = 0;
$update = false;
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'david', 'rootroot', 'chatbot');

$_SESSION['message'] = "User saved!!!!";

//update user
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['Username'];
    $email = $_POST['Email'];
    $password = $_POST['password'];
    $user_type = $_POST['User-type'];
    $password = md5($password);//encrypt the password before saving in the database
     mysqli_query($db, "UPDATE users SET username='$username', email='$email', user_type='$user_type', password='$password' WHERE id=$id ");
     header('location: index.php');

}

//delete user
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM users WHERE id=$id");
    header('location: index.php');
}

?>

