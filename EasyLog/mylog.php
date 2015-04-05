<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
$login_name = $_SESSION["login"];

if ($login_name === "" || $login_name === NULL) {
    echo "<script>"
    . "location.href='login.php';"
    . "</script>";
} else {
    echo "Welcome: " . $login_name . " ! <a href='logout.php'>logout</a><br />";
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title id="index_title">HH's Easy Log - mylog</title>
    </head>
    <body>
        <?php
        $con = mysql_connect("localhost", "root", "aishangni520");
        if (!$con) {
            die("Could not connect" . mysql_error());
        } else {
            mysql_select_db("easylog", $con);
            $query = "select id,title,time from blog where author = '$login_name'";
            $result = mysql_query($query);
            while ($row = mysql_fetch_array($result)) {
                if (empty($row['id'])) {//seem like no use T_T
                    echo "You have no blog,Why not write now?<br />";
                } else {
                    echo "<p>-------------------------------------</p>";
                    echo "<span onclick='readBlog(" . $row['id'] . ")'>" . $row['title'] . "</span>";
                    echo "--------" . $login_name . "--------" . $row['time'];
                }
            }
            mysql_close($con);
        }
        ?>
        <p>-------------------------------------</p>
        <a href="createArticle.php">Write Blog</a>&nbsp;&nbsp;<a href="index.php">Index</a>
        <script src="js/toReadBlog.js"></script>
    </body>
</html>
