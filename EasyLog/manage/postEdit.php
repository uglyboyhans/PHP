<?php
$blog_id=$new_title =$new_article= ""; //init
//get article from post:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_title = $_POST["title"];
}
if ($new_title != "") {
    $blog_id=$_POST["blog_id"];
    $new_article = str_replace(["\r\n", "\r", "\n"], "<br />", $_POST["article"]);
    $new_article = str_replace("'", "\'", $new_article);
    $time = date("Y-m-d h:i:s"); //recent update time
    $new_article = "(Recent update time:$time)<br />" . $new_article;

    //update the blog to mysql:
    $con = mysql_connect("localhost", "root", "aishangni520");
    if (!$con) {
        die("Failed to connect:" . mysql_error());
    } else {
        mysql_select_db("easylog", $con);
        $query = "update blog set title='$new_title',article='$new_article' where id=$blog_id";
        if (mysql_query($query, $con)) {
            mysql_close($con);
            echo "<script>"
            . "alert('OK!');history.back();"
            . "</script>";
        } else {
            die(mysql_error($con));
        }
    }
}
?>


