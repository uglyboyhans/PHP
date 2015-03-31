<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>HH's Easy Log</title>
    </head>
    <body>
        <div style="margin-left:auto;
             margin-right:auto;
             width:40%;
             background-color:#b0e0e6;
             text-align: center;">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Title:<input type="text" placeholder="your title.." id="input_title" name="title"/></label><br />
                <textarea cols="55" rows="31" name="article" id="input_article"></textarea>
                <br />
                <input type="submit" value="publish" />
            </form>
        </div>

        <?php
        $folder_path = "e:/w3school/php/"; //the article will save at there;
        $title = $article = ""; //init title;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];
        }
        if ($title != "") {
            $article = $_POST["article"]; //get article from post
            //save article into a file:
            $filepath = $folder_path . $title . ".txt";
            $newfile = fopen($filepath, "w") or die("Could not open the file!");
            fwrite($newfile, $article);
            fclose($newfile);
            //save the file path into mysql:
            $con = mysql_connect("localhost", "root", "aishangni520");
            if (!$con) {
                die("Failed to connect:" . mysql_error());
            } else {
                mysql_select_db("easylog", $con);
                $query = "insert into file_path (filename,file_link)"
                        . " values ('$title','$filepath')";
                mysql_query($query, $con);
                mysql_close($con);
            }
        }
        ?>
    </body>
</html>
