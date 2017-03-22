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
        <?php 
            if($_GET['id']){
                $query = mysql_query("SELECT * FROM topics WHERE topic_id = '".$_GET['id']."'");
                if(mysql_num_rows($query)){
                    while($row = mysql_fetch_assoc($query)){
                        $query1 = mysql_query("SELECT * FROM users WHERE username='".$row['topic_creator']."'");
                        while($row1 = mysql_fetch_assoc($query1)){
                            $u_id = $row1['id'];
                        }
                        echo "<h1>".$row['topic_name']."<h1>";
                        echo "<h4>Created by <a href='profile.php?id=$u_id'>".$row['topic_creator']."</a></h4>";
                        echo "<h4>".$row['created_date']."</h4>";
                        echo $row["topic_content"];
                    }
                }
                else{
                    echo "No topic with such id";
                }
            }else{
                 header("Location:index.php");
            }
         ?>
         </center>   
    </body>
</html>
<?php
    }
    else{
        echo "Login To access the whole website<br>";
        echo "<a href='Login.php'>Link</a>";
    }
?>
