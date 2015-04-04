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
    echo "Welcome: " . $login_name . "! <a href='logout.php'>logout</a><br />";
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>HH's Easy Log - read</title>
    </head>
    <body>
        <?php
        $q = $_GET["q"];
        $con = mysql_connect("localhost", "root", "aishangni520");
        if (!$con) {
            die("Failed to connect:" . mysql_error());
        } else {
            mysql_select_db("easylog", $con);
            $query = "select title,article,time,author from blog where id=" . $q;
            $result = mysql_query($query, $con);
            while ($row = mysql_fetch_array($result)) {
                echo "<h2>" . $row['title'] . "</h2>";
                echo "<b>" . $row['author'] . "</b><br />";
                echo "----------------" . $row['time'] . "<br />";
                echo $row['article'];
            }
            echo "<p>**********************************************************</p>";
            echo "Comments:<br />-------------------------------------<br />";
            $query = "select visitor_name,content,time from comment where blog_id=$q";
            $result_comment = mysql_query($query, $con);
            if (!empty($result_comment)) {
                while ($row = mysql_fetch_array($result_comment)) {
                    echo $row['visitor_name'] . " says:<br />";
                    echo $row['content'] . "<br />";
                    echo "at " . $row['time'] . "<br />";
                    if (!empty($row['reply'])) {              //in case it's NULL
                        echo "admin reply:" . $row['reply'] . "<br />";
                    }
                    echo "------------------------------<br />";
                }
            }
            mysql_close($con);
        }
        ?>
        <p>----------------------------------------------------</p>
        <form action="comment.php?q=<?php echo $q; ?>" id="form_comment" method="post">
            <textarea cols="55" rows="11" name="content"></textarea>
            <input type="submit" id="submit_comment" value="Comment" />
        </form>
        <br /><a href="index.php">Index</a>
    </body>
</html>
