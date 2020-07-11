<?php 
session_start();

$username = $_SESSION['username'];
$question = "";
$points = "";
$message = "";
$date = "".date("d/m/Y");

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
    $question = mysqli_real_escape_string($db, $_POST['question']);
    if($question != ""){
        $query = "INSERT INTO questions (question, askedby, date)
        VALUES('$question', '$username', '$date')";
        mysqli_query($db, $query);
    }
}

if(isset($_POST['message'])){
    $message = mysqli_real_escape_string($db, $_POST['message']);
    if($message != ""){
        $query = "INSERT INTO shoutout (message, username, date)
        VALUES ('$message', '$username', '$date')";
        mysqli_query($db, $query);
    }
}

$query = "SELECT points FROM users WHERE username = '$username'";
$result = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($result);
$points = $user['points'];

$query = "SELECT * FROM questions ORDER BY id DESC";
$result_allquestions = mysqli_query($db, $query);

$query = "SELECT username, points FROM users ORDER BY points DESC";
$result_leaderboard = mysqli_query($db, $query);

$query = "SELECT * FROM shoutout ORDER BY id DESC";
$result_shoutout = mysqli_query($db, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the virtual R-land</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="index-body">
    <div class="c1">
    <div class="leaderboard-header">
        <h1>
            Leader Board
        </h1>
    </div>
    <div class="leaders-container">
    <?php while($leaders = mysqli_fetch_assoc($result_leaderboard)): ?>
                <div class="question"><?php echo $leaders['username'] . " " . $leaders['points']?>  </div>
                <?php endwhile ?>
    </div>
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
                 <?php echo $username ?><br>
               Points: <?php echo $points ?> 
            </div>
        </div>
        </div>
        <div class="top-asked-heading"><h2 style="color: white">Trending Posts</h2></div>
        <div class="all-questions" id="all-q">
            
            <?php while($allquestions = mysqli_fetch_assoc($result_allquestions)): ?>
                <div class="question"> <?php echo $allquestions['askedby'] ?><?php echo $allquestions['date'] ?> <?php echo $allquestions['question'] ?> </div>
                <?php endwhile ?>
        </div>
    </div>
    <div class="c3">
        <div class="shout-out-header">
            <form action="index.php" method="post">
            <input type="text" name="message" id="message" placeholder="Shout Out messages.." onfocus="this.placeholder=''" onblur="this.placeholder='Shout out 😁'">
                
        </form>
            <!-- <a  style="color: white" href="index.php?logout='1'"> <button>LOGOUT</button> </a> -->

        </div>
        <div class="shout-out-container">
        <?php while($allmessages = mysqli_fetch_assoc($result_shoutout)): ?>
                <div class="question"> <?php echo $allmessages['username'] ?> <?php echo $allmessages['date'] ?> <?php echo $allmessages['message'] ?> </div>
                <?php endwhile ?>
        </div>
    </div>
    <!-- <button onclick="myf()">btnn</button> -->
<script src="./script.js"></script>  
</body>
</html>