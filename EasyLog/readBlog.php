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
        $con = mysql_connect("localhost", "root", "aishangni520");
            if (!$con) {
                die("Failed to connect:" . mysql_error());
            } else {
                mysql_select_db("easylog", $con);
                $query = "select article from blog where title='haha'";
                $result=mysql_query($query, $con);
                while($row=  mysql_fetch_array($result)){
                    echo $row['article'];
                }
                mysql_close($con);
            }
        ?>
    </body>
</html>
