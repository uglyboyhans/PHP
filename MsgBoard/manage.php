<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if ($_SESSION["login"] != "YES") {
    echo "No login!";
    exit;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>HH's Message Board - manage</title>
    </head>
    <body>
        <div align="center">
            <?php
            $con = mysql_connect("localhost", "root", "aishangni520");
            if (!$con) {
                die('Could not connect: ' . mysql_error());
            } else {
                mysql_select_db("h_msg_board", $con); //use database
                $query = "select * from message";
                $result = mysql_query($query, $con);
                while ($row = mysql_fetch_array($result)) {
                    echo $row['name'] . " says:<br />";
                    echo $row['content'] . "<br />";
                    echo "at " . $row['msg_time'] . "<br />";
                    echo "admin reply:" . $row['reply'] . "<br />";
                    echo "<button onclick='reply(" . $row['ID'] . ")'>reply</button>";
                    echo "<button onclick='delet(" . $row['ID'] . ")'>delete</button>";
                    echo "<br /><br />";
                }
            }
            mysql_close($con);
            ?>
            <a href="logout.php">Log out</a>
            <script src="js/Manage.js"></script>
        </div>
    </body>
</html>
