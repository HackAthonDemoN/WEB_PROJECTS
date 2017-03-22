<?php
    if($_SESSION['username']){
?>
<center><a href="index.php">HOME PAGE</a> | <a href="account.php">MY PROFILE</a> | <a href="members.php">MEMBERS</a> | <?php
$query = mysql_query("SELECT * FROM users WHERE username='".$_SESSION['username']."'");
$rows  = mysql_num_rows($query);
while($row=mysql_fetch_assoc($query)){
$ID    = $row['id'];
}
echo "LOGGED IN AS <a href='profile.php?id=$ID'>";
echo  @$_SESSION["username"]."</a> |" ?>
<a href="index.php?action=logout">LOGOUT</a></center>
<?php
    }
    else{
        header("Location:Login.php");
    }
?>