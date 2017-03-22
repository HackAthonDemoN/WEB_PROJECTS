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
            <a href="post.php"><button>Post topics</button></a>
            <br><br>
            <?php echo '<table border="1px">'; ?>
                <tr>
                    <td>
                        <span>ID</span>
                    </td>
                    <td width="400px;" style="text-align: center;">
                        Name
                    </td>
                    <td width="80px;" style="text-align: center;">
                        Views
                    </td>
                    <td width="80px;" style="text-align: center;">
                        Creator
                    </td>
                    <td width="80px;" style="text-align: center;">
                        Date
                    </td>
                </tr>
        </center>
    </body>
</html>
<?php
    $query = mysql_query("SELECT * FROM topics");
    if(!@$_GET['date']){
        if(mysql_num_rows($query)!=0){
            while($row=mysql_fetch_assoc($query)){
                $id=$row['topic_id'];
                $query1 = mysql_query("SELECT * FROM users WHERE username='".$row['topic_creator']."'");
                            while($row1 = mysql_fetch_assoc($query1)){
                                $u_id = $row1['id'];
                            }
                echo "<tr>";
                echo "<td>".$row['topic_id']."</td>";
                echo "<td><center><a href = 'topic.php?id=$id'>".$row['topic_name']."</a></center></td>";
                echo "<td>".$row['views']."</td>";
                echo "<td><a href='profile.php?id=$u_id'>".$row['topic_creator']."</a></td>";
                $GET_DATE = $row['created_date'];
                echo "<td><a href='index.php?date=$GET_DATE'>".$row['created_date']."</a></td>";
                echo "</tr>";
            }
        }
        else{
            echo "<center>No topics</center>";
        }
    }
    if(@$_GET['date']){
        $query_date = mysql_query("SELECT * FROM topics WHERE created_date='".$_GET['date']."'");
        while($row_date=mysql_fetch_assoc($query_date)){
            $query1 = mysql_query("SELECT * FROM users WHERE username='".$row_date['topic_creator']."'");
                            while($row1 = mysql_fetch_assoc($query1)){
                                $u_id = $row1['id'];
                            }
                $id=$row_date['topic_id'];
                echo "<tr>";
                echo "<td>".$row_date['topic_id']."</td>";
                echo "<td><center><a href = 'topic.php?id=$id'>".$row_date['topic_name']."</a></center></td>";
                echo "<td>".$row_date['views']."</td>";
                echo "<td><a href='profile.php?id=$u_id'>".$row_date['topic_creator']."</a></td>";
                $GET_DATE = $row_date['created_date'];
                echo "<td><a href='index.php?date=$GET_DATE'>".$row_date['created_date']."</a></td>";
                echo "</tr>";
        }
    }
    echo "</table>";
    if(@$_GET['action']=="logout"){
        session_destroy();
        header("Location:login.php");
    }
    }
    else{
        echo "Login To access the whole website<br>";
        echo "<a href='Login.php'>Link</a>";
    }
?>
