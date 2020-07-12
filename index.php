<?php 
session_start();

$username = $_SESSION['username'];
$question = "";
$points = "";
$message = "";
$date = "".date("d/m/Y");

$servername = "localhost";
$name = "root";
$pass = "";
$dbname = "r-land";

$db = mysqli_connect($servername, $name, $pass, $dbname);

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }

if(!isset($_SESSION['username'])){
    header("location: login.php");
}
if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['message']);
    unset($_SESSION['question']);
    unset($_SESSION['username']);
    header("location: login.php");
}
if(isset($_POST['post_question'])){
    $question = mysqli_real_escape_string($db, $_POST['question']);
    if($question != ""){
        $query = "INSERT INTO questions (question, askedby, date)
        VALUES('$question', '$username', '$date')";
        mysqli_query($db, $query);
        $_SESSION['question'] = $question;
    }
}

if(isset($_POST['message'])){
    $message = mysqli_real_escape_string($db, $_POST['message']);
    if($message != ""){
        $query = "INSERT INTO shoutout (message, username, date)
        VALUES ('$message', '$username', '$date')";
        mysqli_query($db, $query);
        $_SESSION['message'] = $message;
    }
}

$query = "SELECT points FROM users WHERE username = '$username'";
$result = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($result);
$points = $user['points'];

$query = "SELECT * FROM questions ORDER BY rating DESC";
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
                <div class="leader"> 
                <img style="height: 4vh" src="default.png" alt="" srcset=""><br>
                     <?php echo $leaders['username'] . ":  " . $leaders['points']?>  </div>
                <?php endwhile ?>
    </div>
    </div>
    <div class="c2" id="c2">
        <div class="top" id="top">
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
        <div  class="top-asked-heading"><h2 style="color: white">Trending Posts</h2></div>
        <div class="all-questions" id="all-q">
            
            <?php while($allquestions = mysqli_fetch_assoc($result_allquestions)): ?>
                <div class="question"> <b><?php echo $allquestions['askedby'] ?></b> - <span><?php echo $allquestions['date'] ?></span> 
                <p class="q">
                <?php echo $allquestions['question'] ?>
                </p>
                <br>
                <div class="respond">
                   <button onclick="rate('<?php echo $allquestions['question'] ?>', true)">👍</button>
                    <div class="rating" id="<?php echo $allquestions['question'] ?>">
                    <?php echo $allquestions['rating'] ?>
                    </div>
                    <button onclick="rate('<?php echo $allquestions['question'] ?>', false)">👎</button>
                    <br>
                    <input id="comment" type="text" name="answer" class="answer" placeholder="Comment.." onfocus="this.placeholder=''" onblur="this.placeholder='Comment..'">
                    <button onclick="comment('<?php echo $username ?>','<?php echo $allquestions['question'] ?>')">POST</button>
                    <button id="view-all-btn" onclick="viewall()" style="">View all</button>
                </div>
            </div>
            <div class="comment" id="comment<?php echo$allquestions['question'];?>">
                        <b> <?php echo $username ?> - </b> Just now
                        <p id="place">answer</p> 
                    </div>
                <?php endwhile ?>
        </div>
    </div>
    <div class="c3">
        <div class="shout-out-header">
            <form action="index.php" method="post">
            <input type="text" name="message" id="message" placeholder="Shout out messages.." onfocus="this.placeholder='Press Enter to POST'" onblur="this.placeholder='Shout out 😁'">
                
        </form>
            <a style="color: white" href="index.php?logout='1'"> <button>LOGOUT</button> </a>
        </div>
        <div class="shout-out-container">
        <?php while($allmessages = mysqli_fetch_assoc($result_shoutout)): ?>
                <div class="message"> <b><?php echo $allmessages['username'] ?></b> - <?php echo $allmessages['date'] ?>
                <p class="mssg"> <?php echo $allmessages['message'] ?> </p>
            </div>
                <?php endwhile ?>
        </div>
    </div>
<script src="script.js"></script>  
</body>
</html>