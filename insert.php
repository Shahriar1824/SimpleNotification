<?php
if (isset($_POST["subject"]))
{
    include ("DbConnect.php");

    $subject = mysqli_real_escape_string($dbConn, $_POST["subject"]);
    $comment = mysqli_real_escape_string($dbConn, $_POST["comment"]);
    $query = "INSERT INTO comments(comment_subject, comment_text) VALUES ('$subject', '$comment')";

    mysqli_query($dbConn,$query);
}