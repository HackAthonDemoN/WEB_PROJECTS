<html>
    <head>
        <title>Registration</title>
    </head>
    </body>
            <form action="Register.php" method="POST">   
                Username:<input type="text" name="username"/><br>
                Password:<input type="password" name="password"/><br>
                Confirm Password:<input type="password" name="confirmPassword"/><br>
                Email:<input type="text" type="email" name="emailId"/><br>
                <input type="submit" name="Submit" value="register"/>
                <br>
                <br>
                <a href="Login.php">Login</a>
            </form>
    </body>
</html>
<?php  
        require('Connect.php');
        $USERNAME     = @$_POST['username'];
        $PASSWORD     = @$_POST['password'];
        $CPASSWORD    = @$_POST['confirmPassword'];
        $EMAIL        = @$_POST['emailId'];
        $DATE         = date('Y-m-d');
        $PASS_ENCODE  = sha1("$PASSWORD");
        echo "<br>$DATE<br>"; 
        echo "$USERNAME<br>";
        if(isset($_POST['Submit'])){
            if($USERNAME && $PASSWORD && $CPASSWORD && $EMAIL){
                echo "Done entering <br>";
                $l1=strlen($USERNAME);
                $l2=strlen($PASSWORD);
                if($l1>5 && $l1<25 && $l2>=10){
                    if($PASSWORD == $CPASSWORD){
                         if($query=mysql_query("INSERT INTO users(username,password_given,email,date_of_reg) VALUES ('".$USERNAME."','".$PASS_ENCODE."','".$EMAIL."','".$DATE."')")){
                            echo "Success";}
                         else{
                            echo "Failure";}
                    }
                    else
                        echo "Password does not match<br>";
                }
                else{
                    if($l1<=5 || $l1>=25)
                    echo "Please refresh the page and enter username between 5 and 25 characters <br>";
                    if($l2<10)
                    echo "Please refresh the page and enter password bigger than 9 characters <br>";      
                }
            }
            else{
                echo 'Please fill up your detail to proceed<br>';
            }
        }
?>