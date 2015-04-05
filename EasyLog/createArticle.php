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
        <title>HH's Easy Log - create</title>
    </head>
    <body>
        <div style="margin-left:auto;
             margin-right:auto;
             width:40%;
             background-color:#b0e0e6;
             text-align: center;">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Title:<input type="text" placeholder="your title.." id="input_title" name="title"/></label><br />
                <textarea cols="55" rows="31" name="article" id="input_article"></textarea>
                <br />
                <input type="submit" value="publish" />
            </form>
        </div>

        <a href="index.php">Index</a>

        <?php
        $title = $article = ""; //init;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];
        }
        if ($title != "") {
            //get article from post:
            $article = str_replace(["\r\n", "\r", "\n"], "<br />", $_POST["article"]);
            $article = str_replace("'", "\'", $article);
            //save the blog into mysql:
            $con = mysql_connect("localhost", "root", "aishangni520");
            if (!$con) {
                die("Failed to connect:" . mysql_error());
            } else {
                $time = date("Y-m-d h:i:s");
                mysql_select_db("easylog", $con);
                $query = "insert into blog (title,article,time,author)"
                        . " values ('$title','$article','$time','$login_name')";
                if (mysql_query($query, $con)) {
                    mysql_close($con);
                    echo "<script>"
                    . "alert('OK!');location.href='index.php';"
                    . "</script>";
                } else {
                    die(mysql_error($con));
                }
            }
        }
        ?>
    </body>
</html>
