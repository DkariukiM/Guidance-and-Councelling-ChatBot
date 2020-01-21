<?php
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> About || Get In Touch </title>
    <link rel="stylesheet" href="assets/css/about.css">
    <!--<link rel="stylesheet" href="assets/css/font-awesome.css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <style>
        /*responsiveness*/
        @media (max-width: 992px)
        {
            .container
            {
                padding: 20px 50px;
            }
            .container:before
            {
                display: none;
            }
            header
            {
                padding: 0;
            }
            .icons .controls li
            {
                filter: invert(0);
            }
            .content .bannerText h2
            {
                font-size: 30px;
            }
            .content
            {
                margin-top: 0;
                flex-direction: column-reverse;
            }
            .content .bannerImg
            {
                width: 100%;
                height: 40vh;
                margin: 20px 0;

            }
            .content .bannerText
            {
                width: 100%;
                padding-right: 0;
            }
            header ul
            {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                background: #fff;
                z-index: 10000;
                padding: 100px 0;
            }
            header.active ul
            {
                display: initial;
            }
            header ul li
            {
                padding: 20px;
                text-align: center;

            }
            header ul li a
            {
                color: #333 !important;
                font-size: 36px;
            }
            header ul li a:hover:before,
            header ul li a.active:before
            {
                width: 100%;
            }
            .menuIcon
            {
                display: initial;
                position: fixed;
                right: 10%;
                cursor: pointer;
                padding: 8px;
                z-index: 100000;
                font-size: 40px;
            }
            header.active .menuIcon
            {
                background: #fff url(cross.png);
                background-repeat: no-repeat;
                background-position: 6px;
            }
            .section-heading h1
            {
                font-size: 3rem;
            }
        }
        @media (max-width: 767px)
        {
            .container
            {
                padding: 20px 30px;
            }
            .section-heading h1
            {
                font-size: 2.5rem;
            }
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
        .input-field label
        {
            position: absolute;
            top: 0;
            left: 0;
            padding: 5px 0;
            pointer-events: none;
            font-size: 16px;
            color: #666;
            font-weight: 700;
            text-transform: uppercase;
            transition: 1s;
        }
        .input-field input:focus + label,
        .input-field textarea:focus + label,
        .input-field input:valid + label,
        .input-field textarea:valid + label
        {
            top: -25px;
            font-size: 16px;
            padding: 2px 5px;
            background: #1b1e21;
            color: #ff0;
            border-radius: 4px;
        }
        .btn
        {
            margin-top: 20px;
            margin-right: 50px;
            background: #1b1e21;
            color: #fff;
            padding: 15px 30px;
            border: none;
            outline: none;
            border-radius: 30px;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 16px;
            transition: 0.5s;
            float: right;

        }
        .btn:hover
        {
            background: #6f42c1;
        }
        /*reusable lib*/
        .section-heading
        {
            text-align: center;
            margin-bottom: 10rem;
        }
        .section-heading h1
        {
            font-size: 3.5rem;
            color: #6f42c1;
            text-transform: uppercase;
            position: relative;
            margin-bottom: 1rem;
        }

        .section-heading h1::before,
        .section-heading h1::after
        {
            content:'';
            position: absolute;
            bottom: -.5rem;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(255,255,255, 0.75);

        }

        .section-heading h1::before
        {
            width: 10rem;
            height: 3px;
            border-radius: .8rem;
        }

        .section-heading h1:after
        {
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 100%;
            bottom: -1rem;
        }
        .section-heading h6
        {
            font-size: 1.6rem;
            font-weight: 300;


        }

        /*end of reusable lib*/
        /*footer section*/
        /*footer*/
        @keyframes pulse
        {
            0%{box-shadow: 0 0 0 0 #6f42c1;}
            70%{box-shadow: 0 0 0 2rem rgba(253,87,191,0);}
            100%{box-shadow: 0 0 0 0 rgba(253,87,191,0)}
        }
        /*end of footer*/
        @media screen and (max-width: 600px)
        {
            form
            {
                width:100%;
            }
            .up
            {
                right: 2rem;
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
<div class="container">
    <header id="navbar">
        <a href="login.php"  class="logo"><img style="margin-top: -10px;" src="assets/img/peerTalk.png" height="100px"> About <span>Us</span></a>
        <ul>
            <li> <a href=" welcome.php" class="active"> Home </a></li>
            <li> <a href="#contact" style="color: white;"> Contact </a></li>
            <li> <a href="comingSoon.html" style="color: white;"> Blog </a></li>

        </ul>
        <span class="menuIcon" onclick="menu();"><i class="fa fa-bars"></i></span>
    </header>
    <div class="content">
            <div class="bannerText" id="slideshowText">
                <div class="active">
                    <h2>About Website <br>
                    Intro</h2>
                    <p>Have you ever been in a situation where you need some help with some issues and there is no one to offer it to you.
                        This website helps you cope with life much easier by giving you the help you need to the best of its capacity since it
                        answers the questions that are brought up by you and also acts as a listening companion when you have noone to talk to
                        and keeps it discreet. Once logged in, one asks the chat bot any question and the chat bot will respond with a
                        suitable answer. If you aren't satisfied with the response it will redirect you to a professional so that you can get the answers
                        to the question you seek.</p>
                        <a href="#" onclick="nextSlide();nextSlideText();">Read More</a>
                </div>
                    <div>
                        <h2>How To Use <br>
                            Step 1</h2>
                        <p>Click on the login button on the welcome page. It will open the login page where you can key in your credentials and gain
                        access to the application. If you haven't created your account then on the login form, Click on the register button and key in your credentials;
                        once done you'll be registered and have access to the application.</p>
                        <a href="#" onclick="nextSlide();nextSlideText();">Read More</a>
                    </div>
                    <div>
                        <h2>How To Use<br>
                            Step 2</h2>
                        <p>On a mobile device:Once logged in, Click on the menu button. A pop-up will appear. There are options
                            to chose from on the menu.Click on the Chat option.</p>
                        <p>On a Desktop / Laptop device:Once logged in on the navigation bar click on the Chat option. </p>
                        <a href="#" onclick="nextSlide();nextSlideText();">Read More</a>
                    </div>
                <div>
                    <h2>How To Use<br>
                        Step 3</h2>
                    <p>This will open the chat room where
                        you can engage in the conversation. Enjoy!</p>
                    <a href="login.php">Begin</a>
                </div>
            </div>
        <div class="bannerImg" id="slideshow">
            <img src="assets/img/snap1.jpg" class="active">
            <img src="assets/img/snap2.jpg">
            <img src="assets/img/snap3.jpg">
            <img src="assets/img/Snap4.jpg">


        </div>
    </div>
        <!--icons-->
        <div class="icons">
            <ul class="sci">
                <li><a href="#"><i class="fas fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fas fa-instagram"></i></a></li>
                <li><a href="#contact"><i class="fas fa-envelope"></i></a></li>

            </ul>
            <ul class="controls">
                <li><a><img src="assets/img/left-arrow.png" width="40px" height="40px" onclick="prevSlide();prevSlideText();"></a></li>
                <li><a><img src="assets/img/right-arrow.svg" width="40px" height="40px" onclick="nextSlide();nextSlideText();"></a></li>
            </ul>
        </div>


</div>
<script type="text/javascript">
    /*image slider*/
    var slideshow = document.getElementById('slideshow');
    var slides = slideshow.getElementsByTagName('img');
    var  index = 0;

    function  nextSlide() {
        slides[index].classList.remove('active');
        index = (index + 1) % slides.length;
        slides[index].classList.add('active');
    }
    function  prevSlide() {
        slides[index].classList.remove('active');
        index = (index - 1 + slides.length) % slides.length;
        slides[index].classList.add('active');
    }

    /*text slider*/
    var slideshowText = document.getElementById('slideshowText');
    var slidesText = slideshowText.getElementsByTagName('div');
    var  i = 0;

    function  nextSlideText() {
        slidesText[i].classList.remove('active');
        i = (i + 1) % slidesText.length;
        slidesText[index].classList.add('active');
    }
    function  prevSlideText() {
        slidesText[i].classList.remove('active');
        i = (i - 1 + slidesText.length) % slidesText.length;
        slidesText[i].classList.add('active');
    }

    /*menu script*/
    function menu() {
        var nav = document.getElementById('navbar');
        nav.classList.toggle('active');
    }
</script>


    <section class="contact" id="contact" style="height: 800px; background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.6)),url(assets/img/welcome.jpg); background-position: center; background-size: cover; background-attachment: fixed;">

        <div class="container">
            <div class="section-heading">
                <h1> Contact </h1>
                <h6 style="color: #f7f7f7"> Hello &#129488; </h6>
            </div>

            <!---contact form-------->
            <div class="wrapper"  data-aos="fade-up" data-aos-delay="300" style="position: absolute;top: 55%;left: 50%;transform: translate(-50%,-50%);width: 300px;padding:40px;box-sizing: border-box;background: #eee;box-shadow: 0 10px 30px rgba(0,0,0,.5);">
                <form action="contact.php" method="post" class="form">
                    <h2 style="color: #666;margin: 0;padding: 0;text-align: center;font-size: 30px;text-transform: uppercase;">Get in touch</h2>

                    <div class="input-field" style="position: relative;width: 100%;margin-top: 50px;">
                        <input type="text" name="" required="" style="width: 70%;padding: 5px 10px;box-sizing: border-box;background: transparent;border: none;outline: none;border-bottom: 2px solid #666;font-size: 16px;color: #666;font-weight: 700;text-transform: uppercase;resize: none;">
                        <label>Name <span style="color: red;"> * </span></label>
                    </div>
                    <div class="input-field" style="position: relative;width: 100%;margin-top: 50px;">
                        <input type="email" name="" required="" style="width: 70%;padding: 5px 0;box-sizing: border-box;background: transparent;border: none;outline: none;border-bottom: 2px solid #666;font-size: 16px;color: #666;font-weight: 700;text-transform: uppercase;resize: none;">
                        <label>Email <span style="color: red;"> * </span></label>
                    </div>
                    <div class="input-field" style="position: relative;width: 100%;margin-top: 50px;">
                        <input type="tel" name="" required="" style="width: 70%;padding: 5px 0;box-sizing: border-box;background: transparent;border: none;outline: none;border-bottom: 2px solid #666;font-size: 16px;color: #666;font-weight: 700;text-transform: uppercase;resize: none;">
                        <label>Mobile</label>
                    </div>
                    <div class="input-field" style="position: relative;width: 100%;margin-top: 50px;">
                        <textarea rows="3" required="" style="align-content: center; width: 70%;padding: 5px 0;box-sizing: border-box;background: transparent;border: none;outline: none;border-bottom: 2px solid #666;font-size: 16px;color: #666;font-weight: 700;text-transform: uppercase;resize: none;"></textarea>
                        <label>message <span style="color: red;"> * </span></label>
                    </div>
                    <div align="center">
                        <input type="submit" name="" value="Send Message" class="btn" >
                    </div>
                </form>

            </div>
    </section>
    <!--------------------FOOTER SECTION---------------------------->
    <div>
        <footer class="copyright" style="width: 100%;text-align: center;background-color: black;padding: 2rem 0;position: relative; height: auto;">
            <a href="#navbar">
                <div class="up" id="up" style="position: absolute;width: 4rem;height: 4rem;background-color: #eee;top: -2.5rem;border-radius: 100%;right: 3rem;display: flex;animation: pulse 2s infinite;cursor: pointer;">
                    <i class="fa fa-chevron-up" style="color: gold;font-size: 2rem;margin: auto;"></i>
                </div>
            </a>
            <p style="font-size: 1.4rem;color: #fff;"> &copy; 2020  Peer Talk. All Rights Reserved.</p>

        </footer>
    </div>
</main>
</body>
</html>

