<?php

session_start();
$login_name = $_SESSION["login"];

if ($login_name === "" || $login_name === NULL) {
    echo "<script>"
    . "location.href='login.php';"
    . "</script>";
}
//init:
$reply = "";
$id="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reply = str_replace(["\r\n", "\r", "\n"], "<br />", $_POST["reply"]);
    $reply = str_replace("'", "\'", $reply);
    $id=$_POST["id"];
}
if ($reply != "" && $id != "") {
    $con = mysql_connect("localhost", "root", "aishangni520");
    if (!$con) {
        die("Could not connect:" . mysql_error());
    } else {
        mysql_select_db("easylog", $con);
        $query = "update comment set reply='$reply' where id = '$id'";
        if (mysql_query($query, $con)) {
            mysql_close($con);
            echo "<script>"
            . "alert('OK!');history.back();"
            . "</script>";
        }
    }
}
?>