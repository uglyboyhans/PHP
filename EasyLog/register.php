<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>HH's Easy Log - register</title>
    </head>
    <body onload="enableSubmit()">
        <form id="form_register" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label id="label_username">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                username:<input type="text" placeholder="username..." name="username" size="20" />* no more than 20
            </label><br />
            <label id="label_password">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                password:<input type="password" size="16" name="password" id="input_pass" />
                * no less than 9 but no more than 16
            </label><br />
            <label id="label_password_repeat">
                password again:<input type="password" size="16" name="password_r" id="input_pass_r" />
            </label><br />
            <input type="submit" id="register_submit" value="Register" disabled="true" />
        </form>
        <?php
        //init:
        $flag = true;
        $username = $password = "";
        //post:
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
        }
        //connect mysql:
        if ($username != "" && $password != "") {
            $con = mysql_connect("localhost", "root", "aishangni520");
            if (!$con) {
                die("Failed to connect:" . mysql_error());
            } else {
                mysql_select_db("easylog", $con);
                $query = "select username from user where username='$username'"; //check whether it exist..
                $result = mysql_query($query, $con);
                while ($row = mysql_fetch_array($result)) {
                    //if (!empty($row['username'])) {
                    mysql_close($con);
                    echo "The username has already exist!Please use another username!";
                    $flag = false; //can't regiest
                }
                if ($flag) {
                    $query = "insert into user (username,password)"
                            . " values ('$username','$password')";
                    mysql_query($query, $con);
                    mysql_close($con);
                    echo "<script>"
                    . "location.href='index.php';"
                    . "</script>";
                    //exit;
                }
            }
        }
        ?>
        <script>
            function enableSubmit() {
                var pass = document.getElementById("input_pass").value;
                var pass_r = document.getElementById("input_pass_r").value;
                if (pass === pass_r && pass.length >= 9) {
                    document.getElementById("register_submit").disabled = false;
                } else {
                    document.getElementById("register_submit").disabled = true;
                }
                var time = setTimeout('enableSubmit()', 30);
            }
        </script>
    </body>
</html>
