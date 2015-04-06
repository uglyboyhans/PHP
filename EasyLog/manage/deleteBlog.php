<?php

$q = $_GET["q"];
$con = mysql_connect("localhost", "root", "aishangni520");
if (!$con) {
    die('Could not connect: ' . mysql_error());
} else {
    mysql_select_db("easylog", $con); //use database
    $query = "delete from blog where id=" . $q;
    if (mysql_query($query, $con)) {//delete blog from mysql
        $query = "delete from comment where blog_id=" . $q;
        if (mysql_query($query, $con)) {//delete comment of this blog
            mysql_close($con);
            echo "<script>"
            . "alert('OK!');location.href='../index.php';"
            . "</script>";
        } else {
            die(mysql_error());
        }
    }
}
?>