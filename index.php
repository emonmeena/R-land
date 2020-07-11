<?php 
session_start();

$temp = "initial";
$question = "";
$points = "";
$db = mysqli_connect('localhost', 'root', '', 'r-land');

if(!isset($_SESSION['username'])){
    header("location: login.php");
}
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
if(isset($_POST['post_question'])){
    $temp = "final";
    $question = mysqli_real_escape_string($db, $_POST['question']);

    $query = "INSERT INTO questions (question)
    VALUES('$question')";

    mysqli_query($db, $query);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the R-land</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="index-body">
    <div class="c1">
    <div class="leaderboard-header">
        <h1>
            Leader Board
        </h1>
        <?php echo $question; ?> 
    </div>
    <div class="leaders-container"></div>
    </div>
    <div class="c2" id="c2">
        <div class="top" id="top">
        <!-- <div class="main-heading" id="main-w">R-land Quest</div> -->
        <div class="personal" id="personal">
            <div class="text-field">
                <form action="index.php" method="post">
                <textarea name="question" id="" cols="60" rows="5" placeholder="Start a question, or just speak out your mind.. 😋" onfocus="this.placeholder=''" onblur="this.placeholder='Start a question, or just speak out your mind.. 😋'"></textarea>
                <input  class="post-btn" type="submit" name="post_question" value="POST">
                </form>
            </div>
            <div class="profile">
                <img src="default.png" alt="" srcset=""><br>
                 <?php echo $_SESSION['username'] ?><br>
                Points: 1400
            </div>
        </div>
        </div>
        <div class="all-questions" id="all-q">
                
        </div>
    </div>
    <div class="c3">
        <div class="shout-out-header">
            <input type="text" name="message" id="message" placeholder="Shout Out 😁" onfocus="this.placeholder=''" onblur="this.placeholder='Shout out 😁'">
            <a href="index.php?logout='1'">Logout</a>
        </div>
        <div class="shout-out-container"></div>
    </div>
    <!-- <button onclick="myf()">btnn</button> -->
<script src="./script.js"></script>  
</body>
</html>