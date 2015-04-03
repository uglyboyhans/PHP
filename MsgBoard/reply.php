<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>HH's Message Board - reply</title>
    </head>
    <body>
        <div align="center">
        <?php
        $q = $_GET["q"];
        $reply = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {//post from input
            $reply = $_POST["reply"];
        }
        $con = mysql_connect("localhost", "root", "aishangni520");
        if (!$con) {
            die('Could not connect: ' . mysql_error());
        } else {
            mysql_select_db("h_msg_board",$con);//use database
                $query="select * from message where id=".$q;
                $result=mysql_query($query, $con);
                while($row = mysql_fetch_array($result)){
                    echo $row['name']." says:<br />";
                    echo $row['content']."<br />";
                    echo "at ".$row['msg_time']."<br />";
                    echo "admin reply:".$row['reply']."<br />";
                    echo "<br /><br />";
                }
            if ($reply != "") {
                echo "q:".$q;
                mysql_select_db("h_msg_board", $con); //use database
                $query = "update message set reply ='$reply' where id=" . $q;
                mysql_query($query, $con);
                mysql_close($con);
                echo "<script>location.href='manage.php';</script>";
            }
        }
        //echo "<script>location.href='manage.php'</script>";
        ?>
        <form action="reply.php?q=<?php echo $q; ?>" method="post">
            <input type="text" name="reply" placeholder="input your reply" />
            <input type="submit" value="reply" />
        </form>
            <a href="manage.php">Back to Manage</a>
        </div>
    </body>
</html>
