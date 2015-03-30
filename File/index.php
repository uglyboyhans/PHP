<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>File practice</title>
    </head>
    <body>
        <?php
        $con = mysql_connect("localhost", "root", "aishangni520");
        if (!$con) {
            die('Could not connect!' . mysql_errno());
        } else {
            mysql_select_db("phpfile", $con);
            $query = "select file_link from file_link where file_name='street'";
            $result = mysql_query($query, $con);
            while ($row = mysql_fetch_array($result)) {
                $file_link = $row['file_link'];
            }
            mysql_close($con);
        }
        $myfile = fopen($file_link, "r") or die("Unable to open the file!");
        $newfile = fopen("e:/w3school/php/newfile.txt", "w");
        while (!feof($myfile)) {
            $text = fgets($myfile);
            fwrite($newfile, $text);
            echo $text . "<br />";
        }
        fclose($myfile);
        fclose($newfile);
        ?>
    </body>
</html>
