<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 11/11/2019
 * Time: 10:50 AM
 */
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
        require "header.php";

?>
<!---->
<style>
    *,
    *::before,
    *::after
    {
        box-sizing: inherit;
        margin: 0;
        padding: 0;

    }
    body
    {
        width: 100%;
        height: 100%;
        background: #06051e;

    }
    header
    {
        width: auto;
        background-color: #222146;
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
    /*nav bar css*/
    .nav {
        height: 50px;
        width: 100%;
        background-color: #222146;
        position: relative;
    }
    .logo
    {
        height: 30px;
        cursor: pointer;
    }
    .nav > .nav-header {
        display: inline;
    }

    .nav > .nav-header > .nav-title {
        display: inline-block;
        font-size: 22px;
        color: #fff;
        padding: 10px 10px 10px 10px;
    }

    .nav > .nav-btn {
        display: none;
    }

    .nav > .nav-links {
        display: inline;
        float: right;
        font-size: 18px;
    }

    .nav > .nav-links > a {
        display: inline-block;
        padding: 13px 10px 13px 10px;
        text-decoration: none;
        color: #efefef;
    }

    .nav > .nav-links > a:hover {
        background-color: rgba(0, 0, 0, 0.3);
    }

    .nav > #nav-check {
        display: none;
    }

    @media (max-width:600px) {
        .nav > .nav-btn {
            display: inline-block;
            position: absolute;
            right: 0px;
            top: 0px;
        }

        .nav > .nav-btn > label {
            display: inline-block;
            width: 50px;
            height: 50px;
            padding: 13px;
        }

        .nav > .nav-btn > label:hover, .nav #nav-check:checked ~ .nav-btn > label {
            background-color: rgba(0, 0, 0, 0.3);
            opacity: 1;
        }

        .nav > .nav-btn > label > span {
            display: block;
            width: 25px;
            height: 10px;
            border-top: 2px solid #eee;
        }

        .nav > .nav-links {
            position: absolute;
            display: block;
            width: 100%;
            background-color: #333;
            height: 0px;
            transition: all 0.3s ease-in;
            overflow-y: hidden;
            top: 50px;
            left: 0px;
            color: #1b1e21;
        }

        .nav > .nav-links > a {
            display: block;
            width: 100%;
        }

        .nav > #nav-check:not(:checked) ~ .nav-links {
            height: 0px;
        }

        .nav > #nav-check:checked ~ .nav-links {
            height: calc(100vh - 50px);
            overflow-y: auto;
            background-color: #06051e;
        }
    }
    /*welcome css*/
        .fly-in-text {
            list-style: none;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translateX(-50%) translateY(-50%);
            color: #fff3cd;
        }

        .fly-in-text li {
            display: inline-block;
            font-family: 'Italianno', sans-serif;
            font-weight: 300;
            font-size: 4em;
            opacity: 1;
            transition: all 2.5s ease;
        }

        @media screen and (max-width: 1275px) {
            .fly-in-text li {
                font-weight: 400;
                font-size: 1.5em;
            }

        }

        @media screen and (max-width: 900px) {
            .fly-in-text li {
                display: inline-block;
                font-weight: 300;
                font-size: 1.5em;
            }

        }

        @media screen and (max-width: 768px) {
            .fly-in-text li {
                display: inline-block;
                font-weight: 500;
                font-size: 1.05em;
                text-align: center;
            }
        }
    @media screen and (max-width: 400px) {
        .fly-in-text li {
            display: inline-block;
            font-weight: 500;
            font-size: .8em;
            text-align: center;
        }

    }
    @media screen and (max-width: 350px) {
        .fly-in-text li {
            display: inline-block;
            font-weight: 500;
            font-size: .7em;
            text-align: center;
        }

    }
    }

    .fly-in-text li:last-child {
        margin-right: 0;
    }

    .fly-in-text.hidden li {
        opacity: 0;
    }

    .fly-in-text.hidden li:nth-child(1) {
        transform: translateX(-200px) translateY(-200px);
    }
    .fly-in-text.hidden li:nth-child(2) {
        transform: translateX(20px) translateY(100px);
    }
    .fly-in-text.hidden li:nth-child(3) {
        transform: translateX(-150px) translateY(-80px);
    }
    .fly-in-text.hidden li:nth-child(4) {
        transform: translateX(10px) translateY(-200px);
    }
    .fly-in-text.hidden li:nth-child(5) {
        transform: translateX(-300px) translateY(200px);
    }
    .fly-in-text.hidden li:nth-child(6) {
        transform: translateX(80px) translateY(-20px);
    }
    .fly-in-text.hidden li:nth-child(4) {
        transform: translateX(30px) translateY(200px);
    }
    .User-Message
    {
        display: block;
        text-align: center;
        font-size: 1.3em;
        text-decoration: none;
        opacity: 1;
        margin-top: 20px;
        text-transform: uppercase;
        color: white;
        font-weight: 700;
        letter-spacing: 10px;
        margin-bottom: 10px;
        background: #06051e;
        position: relative;
        animation: text 4s 1;

    }
    .User-Message2
    {
        display: block;
        text-align: center;
        font-size: 0.7em;
        text-decoration: none;
        opacity: 1;
        margin-top: 5px;
        color: white;
        font-weight: 200;
        letter-spacing: 2px;
        margin-bottom: 20px;
        position: relative;
    }
    /*update Button*/
    .submit-btn
    {

        width: 100px;
        padding: 10px 30px;
        cursor: pointer;
        display: block;
        margin-left: 10px;
        background: linear-gradient(to right, #ff105f, #ffad06);
        border: 0;
        outline: none;

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
    .submit-btn a
    {
        text-decoration: none;
        color: white;
        font-weight: 400;
    }
    /*tools model*/
    /*TOOLS MODAL*/
    .user-modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .user-modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 90%;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
        -webkit-animation-name: animatetop;
        -webkit-animation-duration: 0.4s;
        animation-name: animatetop;
        animation-duration: 0.4s
    }

    /* Add Animation */
    @-webkit-keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
    }

    @keyframes animatetop {
        from {top:-300px; opacity:0}
        to {top:0; opacity:1}
    }

    /* The Close Button */
    .user-close {
        color: white;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .user-close:hover,
    .user-close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .user-modal-header {
        padding: 2px 16px;
        background-color: #222146;
        color: white;
    }

    .user-modal-body {padding: 2px 16px;}

    .user-modal-footer {
        padding: 2px 16px;
        background-color: #222146;
        color: white;
    }

    .row {
        display: flex;
    }

    .column {
        flex: 33.33%;
        padding: 5px;
        cursor: pointer;
    }
    .column img
    {
        height: 100px;
        width: 70px;
    }
    .column p
    {
        color: black;
        text-align: center;
    }
    .column a
    {
        text-decoration: none;
    }
    .column p:hover
    {
        background: linear-gradient(to right, #ffad06, #ff105f);
    }
    /* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 500px) {
        .column {
            width: 100%;
        }
    }



</style>
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
<!--nav bar-->
    <nav class="nav">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
            <div class="nav-title" id="myBtn">
                <img src="assets/img/roundU.png" class="logo"> &nbsp; <strong style="cursor: pointer;"><?php echo $_SESSION['username']; ?></strong>

                    </div>



            </div>
        </div>
        <div class="nav-btn">
            <label for="nav-check">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>

        <div class="nav-links">
            <a href="chatbot.php" >Chat</a>
            <a href="about.php" target="_blank">About</a>
            <a href="mailto:peertalk01@gmail.com">Contact</a> <!--https://mail.google.com/mail/?view=cm&fs=1&tf=1&to=peertalk@gmail.com-->
            <a href="#" id="user-tools">Tools</a>
            <a href="welcome.php?logout='1'" >logout</a>

        </div>
        <!--Tools Modal-->
        <div id="UserModal" class="user-modal">

            <!-- Modal content -->
            <div class="user-modal-content">
                <div class="user-modal-header">
                    <span class="user-close">&times;</span>
                    <h2> <strong style="cursor: pointer;"><?php echo $_SESSION['username']; ?></strong> Tools </h2>
                </div>
                <div class="user-modal-body">
                    <div class="row">
                        <div class="column">
                            <a href="chatbot.php">
                            <img src="assets/img/bot.png" alt="Snow" style="width:100%">
                            <p>ChatBot</p>
                            </a>
                        </div>
                        <div class="column">
                            <a href="snake.php">
                            <img src="assets/img/snake.png" alt="Forest" style="width:100%">
                            <p>Snake Game</p>
                            </a>
                        </div>
                        <div class="column">
                            <a href="pong.html">
                            <img src="assets/img/pong_game.jpeg" alt="Mountains" style="width:100%">
                            <p>Pong Game</p>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="user-modal-footer">
                    <button type="button" class="submit-btn"><a href="update.php">
                            Update Your Details
                        </a></button> &nbsp;<p style="font-size: 1.0rem;color: #fff; margin-top: -25px;margin-bottom: -5px;"> &copy; 2020  Peer Talk. All Rights Reserved.</p>
                </div>
            </div>

        </div>

        <script>
            // Get the modal
            var usermodal = document.getElementById("UserModal");

            // Get the button that opens the modal
            var userbtn = document.getElementById("user-tools");

            // Get the <span> element that closes the modal
            var close = document.getElementsByClassName("user-close")[0];

            // When the user clicks the button, open the modal
            userbtn.onclick = function() {
                usermodal.style.display = "block";
            };

            // When the user clicks on <span> (x), close the modal
            close.onclick = function() {
                usermodal.style.display = "none";
            };

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == usermodal) {
                    usermodal.style.display = "none";
                }
            };
        </script>
    </nav>
    <section>
<div>
    <!--welcome message-->
    <ul class="fly-in-text hidden">
        <li> W</li>
        <li> E </li>
        <li> L </li>
        <li> C </li>
        <li> O </li>
        <li> M </li>
        <li> E. </li>
        <script>
            $(function() {
                setTimeout(function() {
                    $('.fly-in-text').removeClass('hidden');
                },500);
            })();
        </script>

        <!--greeting script-->
        <script>
            var today = new Date();
            var hourNow = today.getHours();
            var greeting;

            if (hourNow >=17 && hourNow <=24 ){ //6:00pm
                greeting = "Good Evening &#128526";
            }else if(hourNow >= 12 && hourNow <= 17 ){//12:00pm
                greeting = "Good Afternoon &#129312";
            }else if(hourNow < 12 ){ //12:00 midnight
                greeting = "Good Morning &#128519";
            }else{
                greeting = "Hi, How are you?";
            }

            document.write('<p style="font-size:25px ;text-align: center;margin-bottom: -10px;font-weight: 400;">' + greeting + '</p>') ;
        </script>

        <span>
            <!--logged in user information -->
        <?php  if (isset($_SESSION['username'])) : ?>
            <p class="User-Message" ><strong><?php echo $_SESSION['username']; ?></strong></p>
        <?php endif ?>
            </span>
        <br />
        <!--notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="User-Message2">
                <h3 >
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </h3>
            </div>

        <?php endif ?>
    </ul>
</div>
    </section>

</main>
</body>


<?php
require "footer.php";
?>

