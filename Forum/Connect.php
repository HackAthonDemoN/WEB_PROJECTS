<?php
    $connect = mysql_connect("localhost" , "root" , "")or die("cannot connect to server");
    mysql_select_db("php_forum")or die("cannot connect to database");
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = new mysqli($servername, $username, $password);
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } 
    echo "<br>Connected successfully<br>";
?>