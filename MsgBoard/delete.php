<?php

$q = $_GET["q"];
$con = mysql_connect("localhost", "root", "aishangni520");
if (!$con) {
    die('Could not connect: ' . mysql_error());
} else {
    mysql_select_db("h_msg_board", $con); //use database
    $query = "delete from message where id=" . $q;
    mysql_query($query, $con);
}
mysql_close($con);

?>
