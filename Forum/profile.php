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
        <?php include("header.php");
            echo "<center>";
            if(@$_GET['id']){
                $query   =mysql_query("SELECT * FROM users WHERE id='".$_GET['id']."'");
                $rows    =mysql_num_rows($query);
                if($rows!=0){
                    while($row = mysql_fetch_assoc($query)){
                        echo "<img src='".$row['profile_pic']."' width='50' height='50'><br>";
                        echo "<h2>".$row['username']."</h2><h4>Member since :".$row['date_of_reg']."</h4>";
                        echo "<h4>EMAIL ID :".$row['email']."</h4>";
                        echo "<h4>POSTS :".$row['answers']."</h4>";
                        echo "<h4>KARMA :".$row['karma']."</h4>";
                        echo "<h4>TOPICS OF INTERST CREATED:".$row['topics']."</h4>";
                    }
                }
                else{
                    echo "Could not find required ID";
                }
            }
            else{
                header("Location:index.php");
            }
            echo "</center>";
         ?>
    </body>
</html>
<?php
    if(@$_GET['action']=="logout"){
        session_destroy();
        header("Location:login.php");
    }
    }
    else{
        echo "Login To access the website<br>";
    }
?>
