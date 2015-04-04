<?php

session_start();
$login_name = $_SESSION["login"];

if ($login_name === "" || $login_name === NULL) {
    echo "<script>"
    . "location.href='login.php';"
    . "</script>";
}
//init:
$content = "";
$blog_id = $_GET["q"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = str_replace(["\r\n", "\r", "\n"], "<br />", $_POST["content"]);
    $content = str_replace("'", "\'", $content);
}
if ($content != "" && $blog_id != "") {
    $con = mysql_connect("localhost", "root", "aishangni520");
    if (!$con) {
        die("Could not connect:" . mysql_error());
    } else {
        mysql_select_db("easylog", $con);
        $time = date("Y-m-d h:i:s");
        $query = "insert into comment (visitor_name,content,time,blog_id)"
                . " values ('$login_name','$content','$time',$blog_id)";
        if (mysql_query($query, $con)) {
            mysql_close($con);
            echo "<script>"
            . "alert('OK!');location.href='readBlog.php?q=$blog_id';"
            . "</script>";
        }
    }
}
?>

