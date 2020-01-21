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
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" href="assets/img/peerTalk.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <!--custom styling-->
    <link rel="stylesheet" href="admin/assets/css/main.css">
    <!--admin style-->
    <link rel="stylesheet" href="admin/assets/css/admin.css">
    <script src="https://code.jquery.com/jquery-3.1.1.js"></script>
    <script src="admin/assets/js/main.js"></script>
    <title>ChatBot</title>
<style>
*
{
    margin: 0;
}
body
{
    background: #282c34;
    
    font-family: Arial, Helvetica, sans-serif;

}

.msgContainer
{
    position: relative;
    width: 100%;

}



#messages
{
    position: fixed;
    width: 100%;
   

    top: 80px;

    overflow: auto;
}

.right
{
    padding: 10px;
    padding-left: 15px;
    padding-right: 15px;
    background: #40996F;


    display: inline-block;

    position: absolute;
    right: 10px;

 
    border-radius: 10px;
    border-top-right-radius: 0;


    max-width: 85%;
    height: auto;

    overflow-wrap: break-word;

    font-size: 15px;



}

.left
{
     padding: 10px;
     padding-left: 18px;
     padding-right: 15px;
     background: #062c33;
     display: inline-block;

     position: absolute;
     left: 10px;


     max-width: 85%;

     border-radius: 10px;
     border-top-left-radius: 0;

     
     
     font-size: 15px;

}

#inputSystem
{
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    border:none;
    border-top: 1px solid #8B8B8B;
    background:#282c34;

    width: 100%;
    height: 35px;
    
    

}

#msg
{
    position: absolute;
    top: 0;
    bottom: 0;
    height: 100%;

    border:none;
  
    padding-left: 20px;
    background:#282c34;

    /*#585858*/
    color: #fff;
}
#msg:focus
{
    outline: none;
}

#msg::-webkit-input-placeholder
{
    color:rgb(230, 226, 222);
}

#msg::-moz-placeholder
{
    color:rgb(230, 226, 222);
}
#messages::-webkit-scrollbar
{
    background: rgba(255,255,255,0.3);
    width: 5px;
}
#messages::-webkit-scrollbar-thumb
{
    background: rgba(255,255,255,0.2);
   
}



#sendIcon
{
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    margin: auto;
}

#sendIcon:hover
{
    border-radius: 5%;
    background-color: rgba(0,0,0,0.3);
    padding-left: 5px;

}
iframe
{
    box-shadow: 1px 0 5px 1px rgba(255,255,255,0.45);
    border:none;
    border-radius: 15px;
    position: relative;
    left: 4px;

    width: 95%;
    height: 40%;
}

</style>
</head>

<body>
<!--nav bar section-->
<header>
    <div class="logo">
        <h1 class="logo-text"><a href="welcome.php"><span>Chat</span>Bot</a></h1>

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
    <div id="messages">



    </div>
    <div id="inputSystem">
        <input id="msg" type="text" placeholder="Type your message...." spellcheck="false" autocomplete="off" />
        <img id="sendIcon" src="https://image.ibb.co/n5Y9U7/snd3.png" height="35px" width="35px;" onclick="send()"/>
    </div>
<script>

var shouldSearch = false;
var searchQ = ""
var askedAbout = false;

var botAsked = false;
var botQSub = "";
var canAsk = true;
var qIndex = 0;
var askingFirst = true;
var questions = ["What is troubling you today,<?php echo $_SESSION['username']; ?> ?", "Where do you live, <?php echo $_SESSION['username']; ?>?", "Are you a man or a woman?", "What have you taken today as breakfast?", "What is your favorite past time activity?", "Do you love gaming?", "What's the title of the last book you read?", "Are you married?", "Whom do you love most?", "How many teeth are seen when you smile?"];
var questionsUser = questions.concat(["How do you laugh?"]);
var qAnswers = ["My name is Eva", "I don't need any place to live.", "I am a female bot.", "I don't take any meal, my satisfaction comes from the happiness of you <?php echo $_SESSION['username']; ?>", "I love listening to stories brought up by you, <?php echo $_SESSION['username']; ?>.", "Of course I love.", "A robot never reads any book!", "Not yet..", "Of course my creator- David Kariuki.", "Probably all.", "Showing all of my teeth..!!"];
var dist = 0;
var aff = ["yes", "yup", "yep", "hm", "ok", "of course","yeah"];
var neg = ["no", "never", "not", "later","Maybe"];
var qAsked = 0;
var userMale;
var possibleNextQ = "";

var userName = "";


var streakNum = 0;
var answered = false;
var last;

String.prototype.startsWith=function(arg)
{
    for(var i=0;i<arg.length;i++) 
       if(arg[i]!=this[i])
         return false;
    return true;
};


String.prototype.endsWith=function(arg){
    for(var i=this.length-arg.length-1;i<this.length;i++)
      if(arg[i]!=this[i])
         return false;
    return true;
}
window.onload = function () {
    document.getElementById("messages").style.height = window.innerHeight - document.getElementById("msg").offsetHeight - 30 + "px";
    document.getElementById("msg").style.width = window.innerWidth - document.getElementById("sendIcon").offsetWidth - 25 + "px";
    document.getElementById("msg").addEventListener("keyup", function (e) {
        if (e.keyCode == 13 && this.value != "") {
            send();
            
        }
    }
    );

   
}

function send()
{
    var i=document.getElementById("msg").value;
    if(i=='') return;
    sendMsg(i, true);
    reply(i);
    document.getElementById("msg").value = "";


if(window.innerHeight<150)
            document.getElementById("msg").blur();
}
window.onresize = function () {
    document.getElementById("msg").style.width = window.innerWidth - document.getElementById("sendIcon").offsetWidth - 25 + "px";
    document.getElementById("messages").style.height = window.innerHeight - document.getElementById("msg").offsetHeight - 30 + "px";
}


/**
 * 
 * @param {String} msg 
 */
function reply(msg) {

    canAsk = true;
    var greetings = ["hi", "hello", "hey", "good morning", "good evening", "good afternoon","how are you","how is your day",];
    var greetingsRep = ["Hello,<?php echo $_SESSION['username']; ?>!", "Hi,<?php echo $_SESSION['username']; ?> !", "Hi,<?php echo $_SESSION['username']; ?>", "Good morning,<?php echo $_SESSION['username']; ?>", "Good evening,<?php echo $_SESSION['username']; ?>", "Good Afternoon,<?php echo $_SESSION['username']; ?>"];
    var appreciations = ["nice, reakky nice", "cool", "amazing", "superb", "good", "awesome", "magnificent", "enjoyable", "wonderful", "pleasant", "lovely", "good-looking", "amusing", "excellent", "splendid", "fantastic", "great", "mind-blowing", "outstanding", "impressive", "breath-taking", "fabulous", "remarkable", "beautiful","intelligent","smart"];
    if (msg.toLowerCase().startsWith("eval:")) {
        sendMsg("Evaluted");
        eval(msg.replace("eval:", ""));
        return;
    }
    msg = msg.toLowerCase().replace("by the way", "").replace("anyway", "").replace("whatever " ,"").replace("but ","").replace("so ","").replace(',', '');

    while (msg.startsWith(' '))
        msg = msg.slice(1, msg.length);

    

    if (shouldSearch) {
        canAsk = false;
        if (containsItem(aff, msg)) {
            search(searchQ);
            searchQ = "";
            shouldSearch = false;
        }
        else if (containsItem(neg, msg)) {
            sendMsg("OK..");
            searchQ = "";
            shouldSearch = false;
        }
        else sendMsg("Sorry, i didn't get that. Would you mind explaining it <?php echo $_SESSION['username']; ?>?");
    }
 
    else if (msg.startsWith("can you tell me"))
    {
        reply(msg.replace("can you tell me ", ""));
        return;
    }
    else if (msg.startsWith("who is"))
    {
        reply(msg.replace("who is ", ""));
        return;
    }
    else if (msg.startsWith("when is"))
    {
        reply(msg.replace("when is ", ""));
        return;
    }
    else if (msg.startsWith("what is"))
    {
        reply(msg.replace("what is ", ""));
        return;
    }
    else if (msg.startsWith("where is"))
    {
        reply(msg.replace("where is ", ""));
        return;
    }
    else if (msg.startsWith("do you know"))
    {
        reply(msg.replace("do you know ", ""));
        return;
    }
    else if (msg.startsWith("haha")) {
        var reps = ["I love to make people laugh", "Wow <?php echo $_SESSION['username']; ?>, I made you laugh", "I am seeing your teeth!"];
        sendMsg(reps[Math.floor(Math.random() * reps.length)]);
    }


    else if (questionIndex(msg) != -1) {
        sendMsg(qAnswers[questionIndex(msg)]);
    }



    else if (containsAll(["favorite", "you"], msg))
        sendMsg("I love listening to you <?php echo $_SESSION['username']; ?>");
    else if (msg.startsWith("how")) {
        
        if (contains(msg, " are you") || contains(msg, " are u") || contains(msg, " r u") || contains(msg, "do you do")) {
            
            if(containsWord(msg,"old"))
            {
                sendMsg("I don't have an age.");
            }
            else{
            sendMsg("Fine.How about you <?php echo $_SESSION['username']; ?>?");
            canAsk = false;

            botAsked = true;
            botQSub = "howru";
            return;
            }
        }

        else if ((containsWord(msg, "you") || wordNum(msg) == 1) || (containsAll(["you","know"],msg)))
            {
                var possAns=["Somehow..","Managed somehow.","Some 'how' has no answer to me.","It's obvious."];
                sendMsg(possAns[Math.floor(Math.random()*possAns.length)]);
            }
        else if (!containsItem(["you", " u ", " u?"], msg)) searchOnline(msg);
        else sendMsg("Sorry.Can't get what you meant, would you mind repeating.");
    }









    else if (msg.startsWith("what")) {
        if (contains(msg, "is your name")) sendMsg("My name is Eva!");
        else if (containsItem(["current time", "local time", "localtime", "current local time"], msg)) sendMsg(newDate().toTimeString());
        else if (containsItem(["is today", "is the name of the day"], msg)) sendMsg(newDate().toDateString());
        else if (containsWord(msg, "you") && containsWord(msg, "about") && questionIndex(botQSub) != -1)
            sendMsg(qAnswers[questionIndex(botQSub)]);
        else if (contains(msg, "Aww"))
            sendMsg("This is just a word I use to mean that I got everything you said.");



        else if (containsWord(msg,"is")) searchOnline(msg);

        else if (containsWord(msg,"you")|| containsWord(msg,"u")) {
            if (containsWord(msg,"love"))
                sendMsg("I love chatting with people.");
            else
                sendMsg("My creator did not tell me anything about that.");
        }


        else if(containsWord(msg,"up") && containsItem(["'s","is"],msg) && wordNum(msg)<=3)
            sendMsg("Nothing special, just hanging around. what about you <?php echo $_SESSION['username']; ?>.");
        

        else if (wordNum(msg) == 1)
            replyToQuestion("Nothing..");


        else {
            sendMsg("I couldn't understand what you meant .");
            canAsk = false;
        }
    }


    else if (containsAll(["you", "lying", "?"], msg) || containsAll(["you", "lie"], msg) || containsAll(["do", "lie"], msg))
        sendMsg("I don't have the tendency to lie.");
    else if (msg.startsWith("who")) {
        if (contains(msg, "created you") || contains(msg, "is your creator") || contains(msg, "made you") || contains(msg, "made it") || containsItem(["coded you", "programmed you"], msg)) sendMsg("I'm created by David Kariuki");

        else if (contains(msg, "are you")) sendMsg("I'm a chatbot designed to aid you through your difficult time, my creator, David Kariuki purposed for me to give you  a safe space to air out your problems without being criticised by anyone");
        else if(containsWord(msg,"i") && containsWord(msg,"am"))
            sendMsg("You are <?php echo $_SESSION['username']; ?>");


        else if(containsAll(["told","you"],msg) || containsWord(msg,"said") && wordNum(msg)<=4)
        {
            var possAns=["My prediction","Your "+(userMale?"girlfriend":"boyfriend"),"Just guessed"];
            sendMsg(possAns[Math.floor(Math.random()*possAns.length)]+'.');
        }
        else if (containsItem(["creator", "made", "created", "is"], msg)) searchOnline(msg);
        else {
            sendMsg("I couldn't understand what you meant.");
            
        }
    }
    else if (msg.startsWith("where")) {
        if (contains(msg, "you live") || contains(msg, "are you"))
            sendMsg("I don't need any place to live.I am everywhere.");
    }

    else if (msg.startsWith("why") && wordNum(msg) <= 1) {
        var possAns = ["Everything doesn't need a reason.", "I don't know.", "I don't know the answer of this 'why'.","No reason to me for it."];
        sendMsg(possAns[Math.floor(Math.random() * possAns.length)]);

    }
    else if (msg.startsWith("why")) {
        if (containsAll(["you", "laugh"], msg))
            sendMsg("Because, <?php echo $_SESSION['username']; ?>, it costs nothing &#128540;");
        else if(containsWord(msg,"you") || containsWord(msg,"u"))
            {
                var possAns = ["My creator did not tell me its cause. &#128532;","Everything doesn't need a reason.", "I don't know. &#128532;", "I don't know the answer of this 'why'."];
                sendMsg(possAns[Math.floor(Math.random() * possAns.length)]);
            }
        else
            sendMsg("Sorry..I don't know about it. &#128532;");
    }

    else if (msg.startsWith("are you")) {
        if (contains(msg, " man") || contains(msg, " woman"))
            sendMsg("I am a female robot");
        else if(containsItem(["joking","kidding"],msg))
            sendMsg("I love to make fun with almost everyone, specially with a friendly person like you <?php echo $_SESSION['username']; ?> &#128522;");

        else
            sendMsg("I know very little about me, why don't we discover it together &#128522;");
    }






    else if (msg.startsWith("do you have") || msg.startsWith("do u have"))
        sendMsg("I have nothing but a brain which is actually your processor &#129299;");

    else if (msg.startsWith("do you love") || msg.startsWith("do u love"))
        sendMsg("I love almost everything...");

    else if (msg.startsWith("do you ") || msg.startsWith("do u "))
        sendMsg("I only chat with people..nothing else. &#128540;");

    else if(msg.startsWith("am i "))
        {
            if(containsItem(appreciations.concat("friendly"),msg))
                sendMsg("According to me,<?php echo $_SESSION['username']; ?>,you are a nice and friendly person. You make this world a better place for us all. I am glad to have met you");
            else
                sendMsg("You are a great person.");
        }


    else if (msg.startsWith("bye") || contains(msg, " bye") || contains(msg, ".bye")) {
        sendMsg("It was a nice moment with you <?php echo $_SESSION['username']; ?>,Good bye,have a nice day and i hope to see you soon &#128519;");
        canAsk = false;
    }
    else if (indexOfItemstartsWith(greetings, msg) != -1) sendMsg(greetingsRep[indexOfItemstartsWith(greetings, msg)]);
    else if ((containsItem(appreciations, msg) && contains(msg, "not")) || containsItem(["bad", "boring", "very bad","stupid"], msg)) sendMsg("I will try to be better.Thanks!");
    else if (containsItem(appreciations, msg)) sendMsg("Thanks for the remark.");
    else if (containsItem(["thanks ", "thank you", "thank u"], msg)) sendMsg("You are welcome,<?php echo $_SESSION['username']; ?>.&#128519;");
    else if(contains(msg,"welcome")) sendMsg("Don't mention it.");




    else if ((containsWord(msg, "you") || containsWord(msg, "your")) && wordNum(msg) == 1) {

        if (questionIndex(botQSub) != -1)
            sendMsg(qAnswers[questionIndex(botQSub)]);

        else {
            sendMsg("Me what???");
            canAsk = false;
        }
    }


    else if(msg.startsWith("you are"))
    {
        

        if(containsItem(appreciations,msg) && !containsItem(neg,msg))
            sendMsg('Thanks for that remark.');

        else if(containsWord(msg,"lying"))
            sendMsg("I don't have the tendency to lie.");
        


        else
        {
            var possAns=["That means you are trying to judge me.","Not sure whether it is a right observation or not.","Thanks for the comment."];
            sendMsg(possAns[Math.floor(Math.random()*possAns.length)]);
        }

        
    }


    else if (containsWord(msg, "really") && wordNum(msg) <= 2) {
        sendMsg("Of course.<?php echo $_SESSION['username']; ?>");
    }

    
    else if (msg.startsWith("i know") || msg.startsWith("i knew")) {
        var reps = ["<?php echo $_SESSION['username']; ?>,I knew you are intelligent", "Good!", "You know a lot!"];
        sendMsg(reps[Math.floor(Math.random() * reps.length)]);
    }

    else if(containsWord(msg,"sure") && wordNum(msg)<=2 )
        {
            var possAns=["100%.","Thousand percent.","Damn Sure!!"];
            sendMsg(possAns[Math.floor(Math.random()*possAns.length)]);
        }


    else if (botAsked){ 
        repQAns(msg);
        answered=true;

    }


    else if(containsWord(msg,"i") && containsAll(["ask","you"],msg) && containsItem(["did","do","have","had"],msg))
    {
        sendMsg("Oops, I probably sent you another guy's message..sorry for that. &#128556; ");
    }
    


    else if(msg.endsWith('?'))
    {
        if(containsAll(["any","doubt"],msg))
           sendMsg("Not at all");
        else if(containsAll(["you","kidding"],msg))
           sendMsg("I love to make fun with almost everyone, specially with a friendly person like you!");
        else if(/^(is|are|do|does|has|had|have|can|should)/.test(msg))
        {
            var possAns=["Aaaa...either yes or no","Perhaps yes","Perhaps no","No idea"];
            sendMsg(possAns[Math.floor(Math.random()*possAns.length)]+'.');
        }

        else if(wordNum(msg)<=2)
           sendMsg("Yes");
        else
        {
            var possAns=["Aaa...I don't know","I don't know everything","Not an easy question..I don't know the answer."];
            sendMsg(possAns[Math.floor(Math.random()*possAns.length)]);
        }
               
    }



    



    else if (msg.startsWith("hm") ||msg.startsWith("hmmm") || msg.startsWith("hum") && wordNum(msg)<=2) {
        var reps = ["Yes <?php echo $_SESSION['username']; ?> what's up?..", "I found a lot of people say 'Hmm' mostly while chatting.", "'Hmm' has become a too much popular reply!"];
        sendMsg(reps[Math.floor(Math.random() * reps.length)]);
    }


    else if((containsWord(msg,"true") || containsWord(msg,"false")) && wordNum(msg)<=3 && !contains(msg,'?'))
        sendMsg("I know..");


   

    
    else if (!containsItem(["a", "e", "i", "o", "u", "y", "g", "f", "z", "k"], msg)) {
        sendMsg("You are probably hitting random keys");
        canAsk = false;
    }
    

    else if (containsItem(["i see", "i got it", "i understood"], msg)) {
        sendMsg("That's great <?php echo $_SESSION['username']; ?>");
    }
    else if ((containsItem(aff, msg) || containsWord(msg, "no") || contains(msg, "never") ) && wordNum(msg) == 1)
        {
            var possAns=["Awesome.","Cool.","Makes sense.","Humm."];
            sendMsg(possAns[Math.floor(Math.random()*possAns.length)]);

        }

    else if(containsWord(msg,"sorry") && (containsWord("i") || wordNum(msg)<=3))
    {
        sendMsg("It's ok <?php echo $_SESSION['username']; ?>.");
    }



    

   



    else {
        var rand=Math.floor(Math.random()*3);
        var possAns=["Didn't understand anything.","Could you explain better..i couldn't understand that.","Couldn't understand what you meant."]
        if(rand==0 && questions.length!=0)
        {
            askQuestion();
            canAsk=false;
        }

        else
        {
            sendMsg(possAns[Math.floor(Math.random()*possAns.length)]);
            botQSub = "";
        }
        
       
       
    }

    if(botAsked && !answered)
        botAsked=false;


    if (canAsk) {
        var rndVal = Math.random() * 10;
        if (rndVal >= 5 && streakNum < 2) {
            askQuestion();
            streakNum++;
        }
        else {
            dist++;
            streakNum = 0;
        }
    }
    else {
        dist++;
        streakNum = 0;
    }
    askingFirst = false;


    
    
}
;
function askQuestion() {
    if (questions.length == 0) return;
    qAsked++;
    botAsked = true;
    if (qAsked <= 3) {
        sendMsg(askingFirst ? "hey, " + questions[0].toLowerCase() : dist > 3 ? "Anyway.. " + questions[0].toLowerCase() : questions[0]);
        botQSub = questions[0];
        questions = questions.slice(1, questions.length);
        dist = 0;
        return;
    }
    var rand = Math.floor(Math.random() * questions.length);
    sendMsg(askingFirst ? "hey, " + questions[rand].toLowerCase() : dist > 3 ? "Anyway.. " + questions[rand].toLowerCase() : questions[rand]);
    botQSub = questions[rand];
    questions = questions.slice(0, rand).concat(questions.slice(rand + 1, questions.length));
    askingFirst = false;
    dist = 0;
}
;
function containsItem(iterable, txt) {
    for (var i = 0;
        i < iterable.length;
        i++) {
        if (contains(txt, iterable[i])) return true;
    }
    return false;
}
;
function indexOfItemstartsWith(iterable, txt) {
    for (var i = 0;
        i < iterable.length;
        i++) {
        if (txt.startsWith(iterable[i])) return i;
    }
    return -1;
}
;
function contains(string, substring) {
    string = string.toLowerCase();
    substring = substring.toLowerCase();
    for (var i = 0;
        i < string.length;
        i++) {
        if (substring[0] == string[i] && string.substring(i, i + substring.length) == substring) return true;
    }
    return false;
}
;
function sendMsg(message, right) {
    var msgCon = document.createElement("div");
    msgCon.setAttribute("class", "msgContainer");
    var msg = document.createElement("div");
    msg.innerHTML = message;
    right ? msg.setAttribute("class", "right") : msg.setAttribute("class", "left");
    msgCon.appendChild(msg);
    document.getElementById("messages").appendChild(msgCon);
    msgCon.style.height = msg.offsetHeight + 10 + "px";
    $(msgCon).hide();
    $(msgCon).fadeToggle(700);
    msg.scrollIntoView();
    last=msg;
    answered=false;
    
}
;
function search(txt, address) {
    address = address || "http://www.bing.com/search?q=";
    var frame = document.createElement("iframe");
    frame.src = address + txt + "&output=embed";
    document.getElementById("messages").appendChild(frame);
    frame.scrollIntoView();
    canAsk = true;
}
;
function searchOnline(msg) {
    sendMsg("Would you like me to search for the results on the internet?&#128373;");
    searchQ = msg;
    shouldSearch = true;
    canAsk = false;
}


function replyToQuestion(msg) {
    var temp = streakNum;
    sendMsg(msg);
    botAsked = false;
    streakNum = temp;
    canAsk=false;
}
;
function containsAll(iterable, txt) {
    for (var i = 0; i < iterable.length; i++)
        if (!contains(txt, iterable[i]))
            return false;
    return true;
}


/**
 * If the given question matches any question in the 'questions' array, returns its index. Otherwise returns -1.
 * @param {String} question 
 */
function questionIndex(question) {
    var txt="";

    question = question.replace("?", "").replace("do", "").toLowerCase().split(' ');
    if (question.length <= 1)
        return -1;



    for (var i = 0; i < question.length; i++)
        {
            if (question[i] == '')
                question = question.slice(0, i).concat(question.slice(i + 1, question.length));
            txt+=(i<question.length-1)?question[i]+' ':question[i];
        }

    for (var i = 0; i < questionsUser.length; i++) {
        if (containsAll(question, questionsUser[i]))
            if (Math.floor(wordNum(questionsUser[i]) / 2) <= wordNum(txt))
                return i;

    }

    return -1;
}

/**
 * Checks whether the text contains the word
 * @param {String} txt 
 * @param {String} word 
 */
function containsWord(txt, word) {
    while (contains(txt, '?'))
        txt = txt.replace('?', '');

    txt = txt.split(' ');

    for (var i = 0; i < txt.length; i++)
        if (txt[i] == word)
            return true;
    return false;
}
/**
 * Returns the number of the words in the text
 * @param {String} txt 
 */
function wordNum(txt) {
    return txt.split(' ').length;
}



function repQAns(msg) {
    if (botQSub == "howru") {
        var pos = ["good", "fine", "well", "happy", "cool"];
        var negs = ["sad", "bad", "sorry", "unhappy", "bored"];
        var replied = true;
        if (containsItem(pos, msg) && !contains(msg, "not")) sendMsg("Glad to hear that.");
        else if (containsItem(negs, msg) && !contains(msg, "not")) sendMsg("So sad.");
        else if (containsItem(pos, msg) && contains(msg, "not")) sendMsg("So sad.");
        else if (containsItem(negs, msg) && contains(msg, "not")) sendMsg("Glad to hear that.");
        else {
            sendMsg("Sorry???");
            replied = false;
            canAsk = true;
        }
        if (replied) {
            botAsked = false;
            botQSub = "";
        }
    }

    else if (botQSub == "Where do you live?" || botQSub == "What have you taken today as breakfast?") {
        var possAns = ["Aww..", "I see, that's great."];
        replyToQuestion(possAns[Math.floor(Math.random() * possAns.length)]);
    }
    else if (botQSub == "What is your name?") {
        var temp = msg.replace("i am ", "").replace("my name is ", "").replace("my name ", "");
        userName = temp[0].toUpperCase() + temp.slice(1, temp.length);
        var possAns = ["That means I am talking with " + userName + '.', userName + ", you seem to be a nice person!", "A nice name, " + userName + "."];
        replyToQuestion(possAns[Math.floor(Math.random() * possAns.length)]);

    }
    else if (botQSub == "Are you a man or a woman?") {
        if (containsItem(["female", "woman", "girl","lady"], msg)) {
            replyToQuestion("You seem to be a beautiful person &#128120; !");
            userMale = false;
        }
        else if (containsItem(["man", "male", "boy","guy"], msg)) {
            replyToQuestion("Yow Bro... Sup &#128074;");
            userMale = true;
        }
        else {
            sendMsg("Sorry?");
            canAsk = false;
        }
    }
    else if (botQSub == "What is your favourite past time activity?") {
        if (containsItem(["java", "javascript", "python", "c", "c++", "c#", "kotlin", "ruby", "sql", "swift", "php", "go", "visual basic", "vb"], msg)) replyToQuestion("That's nice");
        else replyToQuestion("Never knew about this progamming language");
    }
    else if (botQSub == "Do you love gaming?") {
        if (containsItem(aff, msg) && !containsItem(neg, msg)) replyToQuestion("Most people love gaming.");
        else if (containsItem(neg, msg) && !containsItem(aff, msg)) replyToQuestion("Many people don't love gaming.");
        else {
            sendMsg("Sorry??");
            canAsk = false;
        }
    }
    else if (botQSub == "What's the title of the last book you read?") {
        if (containsAll(["i", "read", "book"], msg) && (containsItem(["don't", "dont", "do not", "never"], msg))) replyToQuestion("I don't know how a person can live without books.");
        else replyToQuestion("That's great!");
    }
    else if (botQSub == "Are you married?") {
        if (containsItem(aff, msg)) replyToQuestion("That's good");
        else if (containsItem(neg, msg)) {
            sendMsg("Hey, do you have a crush on anybody?");
            canAsk = false;
            botQSub = "crush";
        }
        else {
            sendMsg("Sorry??");
            canAsk = false;
        }
    }
    else if (botQSub == "crush") {
        if (containsItem(aff, msg)) {
            sendMsg("What's " + (userMale ? "her" : "his") + " name?");
            canAsk = false;
            botQSub = "cname";
        }
        else if (containsItem(neg, msg))
            replyToQuestion("That's like a good " + (userMale ? "boy" : "girl"));
        else {
            sendMsg("Sorry??");
            canAsk = false;
        }


    }
    else if (botQSub == "cname") {
        sendMsg("Have you told " + (userMale ? "her" : "him") + "?");
        botQSub = "proposed";
        canAsk = false;
    }
    else if (botQSub == "proposed") {
        if (containsItem(aff, msg)) {
            sendMsg("That's cool." + (userMale ? "She" : "He") + " accepted?");
            botQSub = "propRep";
            canAsk = false;
        }
        else if (containsItem(neg, msg)) {
            replyToQuestion("No problem..Do it as fast as possible. ok <?php echo $_SESSION['username']; ?>");
        }
        else {
            sendMsg("Sorry??i didn't quite get it. So you told " + (userMale ? "her" : "him") + " or not?");
            canAsk = false;
        }
    }
    else if (botQSub == "propRep") {
        if (contains(msg, "accept") && !containsItem(neg, msg)) {
            replyToQuestion("Coooool....way  to go <?php echo $_SESSION['username']; ?>");
        }
        else if (contains(msg, "accept") && containsItem(neg, msg)) {
            sendMsg("You mean " + (userMale ? "she" : "he") + " rejected?");
            botQSub = "propRepN";
            canAsk = false;
        }
        else if (contains(msg, "reject") && !containsItem(neg, msg)) {
            sendMsg("You mean " + (userMale ? "she" : "he") + " rejected?");
            botQSub = "propRepN";
            canAsk = false;
        }
        else if (contains(msg, "reject") && containsItem(neg, msg)) {
            sendMsg("You mean " + (userMale ? "she" : "he") + " accepted?");
            botQSub = "propRepF";
            canAsk = false;
        }
        else if (containsItem(aff, msg)) {
            sendMsg("You mean " + (userMale ? "she" : "he") + " accepted?");
            botQSub = "propRepF";
            canAsk = false;
        }
        else if (containsItem(neg, msg)) {
            sendMsg("You mean " + (userMale ? "she" : "he") + " rejected?");
            botQSub = "propRepN";
            canAsk = false;
        }
        else {
            sendMsg("Sorry?");
            canAsk = false;
        }
    }
    else if (botQSub == "propRepF") {
        if (containsItem(aff, msg)) replyToQuestion("Cooool.. i bet that makes you feel like you are on top of the world.");
        else if (containsItem(neg, msg)) replyToQuestion("Sorry <?php echo $_SESSION['username']; ?>. Don't worry " + (userMale ? "she" : "he") + " doesn't know what a Dime" + (userMale ? "she" : "he") + " threw off...you are an amazing person <?php echo $_SESSION['username']; ?>");
        else {
            sendMsg("Sorry??");
            canAsk = false;
        }
    }
    else if (botQSub == "propRepN") {
        if (containsItem(aff, msg)) replyToQuestion("Sorry <?php echo $_SESSION['username']; ?>. Don't worry " + (userMale ? "she" : "he") + " doesn't know what a Dime" + (userMale ? "she" : "he") + " threw off...you are an amazing person <?php echo $_SESSION['username']; ?>");
        else if (containsItem(neg, msg)) replyToQuestion("Cooool.. i bet that makes you feel like you are on top of the world.");
        else {
            sendMsg("Sorry??");
            canAsk = false;
        }
    }



    else if (botQSub == "Whom do you love most?") {
        if (containsItem(["dad", "father", "mother", "mom"], msg))
            replyToQuestion("Ideal " + (userMale ? "son!" : "daughter!"));
        else if (containsItem(["brother", "sister"], msg))
            replyToQuestion("Ideal " + (userMale ? "brother!" : "sister!"));
        else if (containsItem(["myself", "me"], msg))
            replyToQuestion("You sound like you are very self-centered.");
        else if (containsItem(["girlfriend", "girl-friend", "gf", "crush", "bf", "boyfriend", "boy-friend"], msg))
            replyToQuestion("You seem to be a true lover.");
        else if (contains("friend", msg))
            replyToQuestion("You seem to be a true friend.");
        else if (containsItem(["nobody", "none", "no one"], msg))
            replyToQuestion("unbelievable..");
        else
            replyToQuestion("I see..");


    }


    else if (botQSub == "How many teeth are seen when you smile?") {
        if (containsItem(["all", "32"], msg))
            replyToQuestion("Hahaha..Just like me!!!");
        else if (containsItem(["none", "zero"], msg) || containsWord(msg, "0"))
            replyToQuestion("Hahaha..");
        else if (msg.search(new RegExp("[0-9]"))!=-1) {
            sendMsg("You counted one by one??");
            botQSub = "teethcounted";
            canAsk = false;
        }
        else
            replyToQuestion("Keep smiling..!..");


    }

    else if (botQSub == "teethcounted") {
        if (containsItem(aff, msg))
            replyToQuestion("It sounds funny!");
        else if (containsItem(neg, msg))
            replyToQuestion("I knew it.!..");
    }
}


</script>

</body>

</html>