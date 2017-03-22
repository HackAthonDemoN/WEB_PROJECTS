<html>
    <head>
        <title>
            LOGIN PAGE
        </title>
    </head>
    <body>
        <form action="Login.php" method="POST">
            USERNAME :<input type="text" name="username"><br>
            PASSWORD :<input type="password" name="password"><br>
            <input type="submit" name="Submit" value="Login"> 
        </form>
        <a href="Register.php">No Account Click to register</a>
    </body>
</html>
<?php
    session_start();
    require('Connect.php');
    $USERNAME     = @$_POST['username'];
    $PASSWORD     = @$_POST['password'];
    if(isset($_POST['Submit'])){
        if($USERNAME && $PASSWORD){
            $query = mysql_query("SELECT * FROM users WHERE username='".$USERNAME."'");
            $rows  = mysql_num_rows($query);
            if(mysql_num_rows($query)!=0){
                while($row = mysql_fetch_assoc($query)){
                    $db_username = $row['username'];
                    $db_password = $row['password_given'];
                }
                if($USERNAME == $db_username && sha1($PASSWORD) == $db_password){
                    echo "Successfully Logged In Please wait you are being redirected <br>";
                    @$_SESSION["username"]=$USERNAME;
                    header("Location: index.php");
                }
                else{
                    echo "Unsuccessful";
                }
            }
            else{
                die ("USER NOT FOUND");
            }
        }
        else{
            echo "<br> Please fill in  both the fields <br>";
        }
    }
?>