<?php

$q = $_GET["q"];
$con = mysql_connect("localhost", "root", "aishangni520");
if (!$con) {
    die('Could not connect: ' . mysql_error());
} else {
    mysql_select_db("easylog", $con); //use database
    $query = "delete from comment where id=" . $q;
    if (mysql_query($query, $con)) {
        mysql_close($con);
        echo "<script>"
        . "alert('OK!');history.back();"
        . "</script>";
        
    }else{
        die(mysql_error());
    }
}
?>