<?php 

$db = mysqli_connect("localhost", "root", "", "r-land");

$question = mysqli_real_escape_string($db, $_GET['question']);
$comment = mysqli_real_escape_string($db, $_GET['comment']);
$username = mysqli_real_escape_string($db, $_GET['username']);
$date = date('d/m/y');

$query = "INSERT INTO answers (question, answer, givenby, date)
          VALUES ('$question', '$comment', '$username', '$date')";
          mysqli_query($db, $query);

?>