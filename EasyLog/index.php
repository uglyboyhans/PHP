<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title id="index_title">HH's Easy Log - index</title>
    </head>
    <body>
        <a href="login.php">login</a><br /><br />
        <?php
        $con=  mysql_connect("localhost", "root", "aishangni520");
        if(!$con){
            die("Could not connect".mysql_error());
        }else{
            mysql_select_db("easylog",$con);
            $query="select id,title from blog";
            $result=  mysql_query($query);
            while($row=  mysql_fetch_array($result)){
                echo "<p>-------------------------------------</p>";
                echo "<span onclick='readBlog(".$row['id'].")'>".$row['title']."</span>";
            }
        }
        ?>
        <p>-------------------------------------</p>
        <a href="createArticle.php">Write Blog</a>
        <script src="js/toReadBlog.js"></script>
    </body>
</html>
