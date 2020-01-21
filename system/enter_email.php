<?php include('includes/server.php')

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Password Reset </title>
    <link rel="shortcut icon" type="image/png" href="assets/img/logo.png">
    <link rel="stylesheet" href="assets/css/font-awesome.css"><!--https://use.fontawesome.com/releases/v5.7.2/css/all.css-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <style>
        *
        {
            margin: 0;
            padding: 0;

        }
        .Reset
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
        p
        {
            font-family: 'Italianno', sans-serif;
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
<div class="container" style="width: 100%;height: 100vh;background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.8)),url(assets/img/login.png) center no-repeat;background-size: cover;">
    <div class="Reset">
        <div class="form-box">
    <!------RESET FORM------>
<form action="enter_email.php" id="login" method="post" class="input-group">
    <?php include('includes/messages.php'); ?>
    <p>Reset Password</p>
    <input type="email" name="email" class="input-field" placeholder="Key in Your Email Address" required>
    <button type="submit" name="reset-password" class="submit-btn" style="margin-top: 20px;"> SUBMIT </button><br />
</form>
</div>
    </div>
</div>
</body>
</html>
