<?php
//init:
$content = "";
$blog_id = $_GET["q"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST["content"];
}
if ($content != "" && $blog_id != "") {
    $con = mysql_connect("localhost", "root", "aishangni520");
    if (!$con) {
        die("Could not connect:" . mysql_error());
    } else {
        mysql_select_db("easylog", $con);
        $time= date("Y-m-d h:i:s");
        $query = "insert into comment (visitor_name,content,time,blog_id)"
                . " values ('visitor','$content','$time',$blog_id)";
        mysql_query($query, $con);
        mysql_close($con);
        echo "<script>"
        . "location.href='readblog.php?q=$blog_id';"
        . "</script>";
    }
}
?>

