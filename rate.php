<?php
$db = mysqli_connect('localhost', 'root', '', 'r-land');

$qup = mysqli_real_escape_string($db, $_GET['qup']);
$qud = mysqli_real_escape_string($db, $_GET['qud']);
$rating = 0;

if (!$db) {
    die('Could not connect: ' . mysqli_error($con));
}


if($qup != ""){
    $query = "SELECT rating FROM questions WHERE question = '$qup'";
    $result = mysqli_query($db, $query);
    $allquestions = mysqli_fetch_assoc($result);
    $rating = $allquestions['rating'];
    ++$rating;
    $query = "UPDATE questions SET rating = '$rating' WHERE question = '$qup'";
    mysqli_query($db, $query);
}
if($qud != ""){
    $query = "SELECT rating FROM questions WHERE question = '$qud'";
    $result = mysqli_query($db, $query);
    $allquestions = mysqli_fetch_assoc($result);
    $rating = $allquestions['rating'];
    --$rating;
    $query = "UPDATE questions SET rating = '$rating' WHERE question = '$qud'";
    mysqli_query($db, $query);
}
echo $rating;
?>