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
        <?php
            include("header.php");
            $query = mysql_query("SELECT * FROM users WHERE username='".$_SESSION['username']."'");
            $rows  = mysql_num_rows($query);
            while($row=mysql_fetch_assoc($query)){
            $USERNAME    = $row['username'];
            $EMAIL       = $row['email'];
            $DATE        = $row['date_of_reg'];
            $ANSWERS     = $row['answers'];
            $TOPICS      = $row['topics'];
            $KARMA       = $row['karma'];
            $PROFILE_PIC = $row['profile_pic'];
            }
        ?>
        <center>
        <p>
        <?php echo "<img src='".$PROFILE_PIC."' width='70' height='70'>";?><br>
        Username :<?php echo $USERNAME; ?><br>
        Email :<?php echo $EMAIL;?><br>
        Member Since :<?php echo $DATE;?><br>
        Answers :<?php echo $ANSWERS;?><br>
        Karma :<?php echo $KARMA;?><br>
        Topics :<?php echo $TOPICS;?><br>
        <a href='account.php?action=cp'>Change Password</a><br>
        <a href='account.php?action=ci'>Change Image</a>
        </p>
        </center>
    </body>
</html>
<?php
    if(@$_GET['action']=="logout"){
        session_destroy();
        header("Location:login.php");
    }
    if(@$_GET['action']=="ci"){
        echo "<form action='account.php?action=ci' method='POST' enctype='multipart/form-data'>
                <center><br>FILE EXTENSION :<b>.JPG,.JPEG,.PNG</b><br><br>
                <input type='file' name='pic'/><br>
                <input type='submit' name='PIC' value='Change Image'/></center>
              ";
              if(isset($_POST['PIC'])){
                  $errors=array();
                  $allowed_e=array('png','jpg','jpeg');

                  $filename=$_FILES['pic']['name'];
                  $file_e=strtolower(pathinfo($filename,PATHINFO_EXTENSION));
                  $file_s=$_FILES['pic']['size'];
                  $file_tmp=$_FILES['pic']['tmp_name'];
                  
                  if(in_array($file_e,$allowed_e)==false){
                      $errors[] = "Extension Not Allowed";
                  }
                  if($file_s > 2097152){
                      $errors[] = "File size should be less than 2";
                  }
                  if(empty($errors)){
                      move_uploaded_file($file_tmp,'images/'.$filename);
                      $image_up = 'images/'.$filename;
                      $query= mysql_query("SELECT * FROM users WHERE username='".@$_SESSION['username']."'");
                      $rows=mysql_num_rows($query);
                      while($row=mysql_fetch_assoc($query)){
                          echo "<center>Will be changed shortly<br>";
                          echo $row['profile_pic'];
                          echo "<br>".$image_up."<br>";
                          echo "</center>";
                          $db_image = $row['profile_pic'];
                      }
                      if($query = mysql_query("UPDATE users SET profile_pic='".$image_up."' WHERE username = '".@$_SESSION['username']."'")){
                          echo "<br>Success<br>";
                      }
                  }
                  else{
                      foreach($errors as $error){
                         echo $error,'<br>';    
                      }
                  }
              }      
        echo "</form>";
    }
    if(@$_GET['action']=="cp"){
        echo "<form action='account.php?action=cp' method='POST'><center>";
        echo "Current Password : <input type='password' name='CP'/><br>
              New Password : <input type='password' name='NP'/><br>
              Re-Enter Password : <input type='password' name='RP'/><br>
              <input type='submit' name='NEWPASS' /><br>";
              $cur_pass = @$_POST['CP'];
              $new_pass = @$_POST['NP'];
              $con_pass = @$_POST['RP'];
              if(isset($_POST['NEWPASS'])){
                  echo "Processing<br>";
                  $query = mysql_query("SELECT * FROM users WHERE username='".$_SESSION['username']."'");
                  $rows  = mysql_num_rows($query);
                  while($row=mysql_fetch_assoc($query)){
                      $IP = $row['password_given'];
                    } 
                    if(strlen($new_pass)>=10){
                        if($IP==sha1($cur_pass)){
                            if($new_pass==$con_pass){
                                if($query = mysql_query("UPDATE users SET password_given='".sha1($new_pass)."' WHERE username='".$_SESSION['username']."'")){
                                    echo "Changed Password";
                                }
                            }
                            else{
                                echo "Not Changed since new password and re-entered password do not match";
                            }
                        }
                        else{
                            echo "Password do not match";
                        }
                    }
                    else{
                        echo "Length of new password should be greater than 9";
                    }
              }
        echo "</center></form>";
    }
    }
    else{
        echo "Login Please<br>";
    }
?>
