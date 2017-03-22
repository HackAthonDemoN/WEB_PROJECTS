<?php
    session_start();
    require('Connect.php');
    if(@$_SESSION["username"]){
?>
<html>
    <head>
        <title>HOME PAGE</title>
    </head>
    <body>
        <?php include("header.php"); ?>
        <center>
            <br>
            <form action='post.php' method="POST">
                Topic Name :<br><input type="text" name="topic_name" style="width:450px"/><br>
                Content :<br><textarea name="content" style="resize:none; width:450px; height:450px;"></textarea>
                <br>
                <input type="submit" value="post" name="submit"/>
                <br>
            </form>
        </center>
    </body>
</html>
<?php
    if(@$_GET['action']=="logout"){
        session_destroy();
        header("Location:login.php");
    }
    $topic_name = $_POST['topic_name'];
    $content = $_POST['content'];
    $date = date('y-m-d');
    if(isset($_POST['submit'])){
        if($topic_name && $content){
            if(strlen($topic_name)>=10 && strlen($topic_name)<=100){
                if($query=mysql_query("INSERT INTO topics (topic_name,topic_content,topic_creator,created_date) VALUES ('".$topic_name."','".$content."','".$_SESSION['username']."','".$date."')")){
                    echo "<center>Posting new topic</center>";
                }
            }
            else{
                echo "<center>write the topic name within 10 and 100 characters</center>";
            }
        }
        else{
                echo "<center>Please fill both</center>";
        }
    }
    }
    else{
        echo "Login To access the whole website<br>";
        echo "<a href='Login.php'>Link</a>";
    }
?>
