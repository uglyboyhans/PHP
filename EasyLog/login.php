<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>HH's Easy Log - login</title>
    </head>
    <body>
        <div align="center">

            <?php
            //init:
            $input_name = $input_pass = "";
            $user_exist = false;
            //post:
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $input_name = $_POST["login_username"];
                $input_pass = $_POST["login_password"];
            }
            //get right name & password from db:
            if ($input_name != "") {
                $con = mysql_connect("localhost", "root", "aishangni520");
                if (!$con) {
                    die("Could not connect" . mysql_error());
                } else {
                    mysql_select_db("easylog");
                    //judge whether the name exist:
                    $query = "select username from user where username='$input_name'";
                    $result = mysql_query($query, $con);
                    while ($row = mysql_fetch_array($result)) {
                        $user_exist = true;
                        //get password from mysql:
                        $query = "select password from user where username='$input_name'";
                        $result = mysql_query($query, $con);
                        while ($row = mysql_fetch_array($result)) {
                            $password = $row['password'];
                            mysql_close($con);
                        }
                        if ($input_pass != $password) {
                            echo "<script>alert('Wrong password!');</script>";
                        } else {
                            session_start();
                            $_SESSION["login"] = $input_name;
                            echo "<script>"
                            . "location.href='index.php'"
                            . "</script>";

                            exit;
                        }
                    }
                    if ($user_exist === false) {
                        echo "<script>alert('username does not exist!');</script>";
                    }
                }
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>username<input type="text" name="login_username" placeholder="username" value="<?php echo $input_name; ?>" /></label><br />
                <label>password<input type="password" name="login_password" /></label>
                <input type="submit" value="login" />
            </form>
            <p>Have no account?&nbsp;<a href="register.php">register</a><br /><br /></p>
        </div>
    </body>
</html>
