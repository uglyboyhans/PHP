<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div align="center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>username<input type="text" name="username" placeholder="username" /></label><br />
                <label>password<input type="password" name="password" /></label>
                <input type="submit" value="login" />
            </form>
            <?php
            //init:
            $input_name = $input_pass = "";
            //post:
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $input_name = $_POST["username"];
                $input_pass = $_POST["password"];
            }
            //get right name & password from db:
            if ($input_name != "") {
                $con = mysql_connect("localhost", "root", "aishangni520");
                if (!$con) {
                    die("Could not connect" . mysql_error());
                } else {
                    mysql_select_db("h_msg_board");
                    $query = "select * from admin";
                    $result = mysql_query($query, $con);
                    while ($row = mysql_fetch_array($result)) {
                        $username = $row['username'];
                        $userpass = $row['password'];
                    }

                    if ($input_name != $username) {
                        echo "<script>alert('username does not exist!');</script>";
                    } else {
                        if ($input_pass != $userpass) {
                            echo "<script>alert('Wrong password!');</script>";
                        } else {
                            session_start();
                            $_SESSION["login"] = "YES";
                            echo "<script>"
                            . "location.href='manage.php'"
                            . "</script>";
                            mysql_close($con);
                            exit;
                        }
                    }
                }
            }
            ?>

        </div>
    </body>
</html>
