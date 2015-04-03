<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>HH's Easy Log - read</title>
    </head>
    <body>
        <?php
        $q=$_GET["q"];
        $con = mysql_connect("localhost", "root", "aishangni520");
            if (!$con) {
                die("Failed to connect:" . mysql_error());
            } else {
                mysql_select_db("easylog", $con);
                $query = "select title,article from blog where id=".$q;
                $result=mysql_query($query, $con);
                while($row=  mysql_fetch_array($result)){
                    echo "<h2>".$row['title']."</h2>";
                    //echo $row['author']."<br />";
                    echo $row['article'];
                }
                mysql_close($con);
            }
        ?>
        <br /><a href="index.php">Index</a>
    </body>
</html>
