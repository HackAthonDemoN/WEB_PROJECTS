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
            echo "<center><h2>Members</h2>";
                $query = mysql_query("SELECT * FROM users");
                $rows  = mysql_num_rows($query);
            while($row=mysql_fetch_assoc($query)){
                $ID    = $row['id'];
                echo "<a href='profile.php?id=$ID'>".$row['username']."</a><br>";
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
        echo "Login Bitch Ass Fucking Emu<br>";
    }
?>
