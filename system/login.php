<?php include('includes/server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Login || Register </title>
    <link rel="shortcut icon" type="image/png" href="assets/img/logo.png">
    <link rel="stylesheet" href="assets/css/font-awesome.css"><!--https://use.fontawesome.com/releases/v5.7.2/css/all.css-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <style>
        *
        {
            margin: 0;
            padding: 0;

        }
        .login
        {
            height: 100%;
            width: 100%;
            position: absolute;
        }
        .form-box
        {
            width: 380px;
            height: 480px;
            position: relative;
            margin: 6% auto;
            background: #f7f7f7;
            padding: 5px;
            overflow: hidden;
        }
        .button-box
        {
            width: 220px;
            margin: 35px auto;
            position: relative;
            box-shadow: 0 0 20px #ff61241f;
            border-radius: 30px;
        }
        .toggle-btn
        {
            padding: 10px 30px;
            cursor: pointer;
            background: transparent;
            border: 0;
            outline: none;
            position: relative;
        }
        #btn
        {
            top: 0;
            left: 0;
            position: absolute;
            width: 110px;
            height: 100%;
            background: linear-gradient(to right, #ff105f, #ffad06);
            border-radius:30px;
            transition: .5s;
        }

        .input-group
        {
            top: 180px;
            position: absolute;
            width: 280px;
            transition: .5s;

        }
        .input-field
        {
            width: 100%;
            padding: 10px 0;
            margin: 5px 0;
            border-left: 0;
            border-top: 0;
            border-right:0;
            border-bottom: 1px solid #999;
            outline: none;
            background: transparent;


        }
        .submit-btn
        {

            width: 85%;
            padding: 10px 30px;
            cursor: pointer;
            display: block;
            margin: auto;
            background: linear-gradient(to right, #ff105f, #ffad06);
            border: 0;
            outline: none;
            border-radius: 30px;

        }
        .submit-btn:hover

        {
            background:linear-gradient(to right, #ffad06, #ff105f) ;
            transform: translateY(-3px);
        }
        .submit-btn:active
        {
            transform: translateY(0px);
        }
        .signup-submit-btn
        {
            width: 85%;
            padding: 10px 30px;
            cursor: pointer;
            display: block;
            margin: auto;
            background: linear-gradient(to right, #ff105f, #ffad06);
            border: 0;
            outline: none;
            border-radius: 30px;
        }
        .signup-submit-btn:hover

        {
            background:linear-gradient(to right, #ffad06, #ff105f) ;
            transform: translateY(-3px);
        }
        .signup-submit-btn:active
        {
            transform: translateY(0px);
        }
        .check-box
        {
            margin: 30px 10px 30px 0;

        }
        span
        {
            color: #777;
            font-size: 12px;
            bottom: 68px;
            position: absolute;
        }
        #login
        {
            left: 50px;

        }
        #register
        {
            left: 450px;
        }
        p
        {
            font-family: 'Italianno', cursive;
            margin-bottom: 20px;
            margin-top: -100px;
        }

        /* LOADER CSS */
        .loader-wrapper
        {

            top: 0;
            left: 0;
            background-color: #242F3F;
            display: flex;
            justify-content: center;
            position: fixed;
            align-items: center;
            width: 100%;
            height: 100vh;
            z-index: 100000000;


        }
        #big,#medium,#small{
            position:fixed;
            border:3px solid white;
            border-radius:50%;
            animation:pop 1.5s infinite;
        }
        #medium{
            animation-delay:0.5s;
        }
        #small{
            animation-delay:1s;
        }
        @keyframes pop{
            0%{
                height:1vmin;
                width:1vmin;
                top:calc(50vh - 0.5vmin);
                left:calc(50vw - 0.5vmin);
                border-color:rgba(255,255,255,1);
            }
            100%{
                height:80vmin;
                width:80vmin;
                top:calc(50vh - 40vmin);
                left:calc(50vw - 40vmin);
                border-color:rgba(255,255,255,0);
            }
        }
    </style>


</head>

<body>
<!--PRE LOADER-->
<div class="loader-wrapper">

    <div id="big"></div>
    <div id="medium"></div>
    <div id="small"></div>
    <script src="assets/js/jquery-3.4.1.js"></script>
    <script>
            $(window).on("load",function(){
                $(".loader-wrapper").fadeOut("slow")
            });

        </script>

</div>
<main>
<section>
<!--main container-->
<div class="container" style="width: 100%;height: 100vh;background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.8)),url(assets/img/login.png) center no-repeat;background-size: cover;">

    <!--welcome message-->
    <div class="login">
        <div class="form-box">
            <div class="button-box">
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()"> Log In </button>
                <button type="button" class="toggle-btn" onclick="register()"> Register </button>

            </div>

            <!------LOGIN FORM------>
            <form action="login.php" id="login" method="post"  class="input-group">
                <?php include('includes/errors.php'); ?>
                <p>Hi, Nice to see you again !</p>
                <input type="text" name="username" class="input-field" placeholder="UserName" required>
                <input type="password" name="password" class="input-field" placeholder="Enter your Password" required>
                <button type="submit" name="login_user" class="submit-btn"> LOGIN </button><br />
                <p style="margin-top: 20px;"> Forgot your password? <a style="text-decoration: none;color: #0069d9;" href="enter_email.php">Reset here.</a></p>
                <!--sign-up link-->


            </form>

            <!------Register form----------->
            <form method="post" action="login.php"  id="register" class="input-group">
                    <?php include('includes/errors.php'); ?>
                <p>Register here!</p>
                <input type="text" name ="username" value="<?php echo $username; ?>" class="input-field" placeholder="UserName" >
                <input type="email" name="email" value="<?php echo $email; ?>"  class="input-field" placeholder="E-Mail" >
                <input type="password" name="password_1" class="input-field" placeholder="Enter your Password" >
                <input type="password" name="password_2" class="input-field" placeholder="Re-enter your Password" >
<!--
                <label> Date of Birth: </label><input type="date" name="dob" class="input-field" required><br />
-->
                <input type="checkbox" class="check-box" required><span> I agree to the terms & conditions </span>

                <button type="submit" name="reg_user" class="signup-submit-btn"> REGISTER </button>

            </form>
            <script>

                var x = document.getElementById("login");
                var y = document.getElementById("register");
                var z = document.getElementById("btn");

                function register() {
                    x.style.left = "-400px";
                    y.style.left = "50px";
                    z.style.left = "110px";

                }

                function login() {
                    x.style.left = "50px";
                    y.style.left = "450px";
                    z.style.left = "0px";

                }


            </script>
        </div>

    </div>
</div>
</section>
</main>
</body>
</html>