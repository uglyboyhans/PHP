<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>HH's Message Board - send</title>
    </head>
    <body>
        <div align="center">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label>name:  <input type="text" name="name" placeholder="your name.." /></label>
            <br />message:<br /><textarea cols="11" rows="11" name="content"></textarea>
            <input type="submit" value="submit" />
        </form>
        
        <?php
        //init:
        $name="";
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $name=$_POST["name"];
            $msg_time=  date("Y-m-d h:i:s");
            $content=$_POST["content"];
        }
        $con = mysql_connect("localhost","root","aishangni520");
        if (!$con){
            die('Could not connect: ' . mysql_error());
            }
            else{
                if($name!=""){
                    mysql_select_db("h_msg_board",$con);//use database
                    $query="insert into message (name,msg_time,content)"
                            . " values"
                            . "('$name','$msg_time','$content')";
                    mysql_query($query,$con); 
                    mysql_close($con); 
                    echo "<script>"
                    . "location.href='index.php';"
                            . "</script>";
                    //exit;
                }
            }      
        ?>
        <a href="index.php">Back to Index</a>
        </div>
    </body>
</html>
