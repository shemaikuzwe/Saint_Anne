<?php
$servername="localhost";
$username= "root";
$password= "";
$dbname= "saint_anne";
$conn=new mysqli($servername, $username, $password, $dbname);
if(!$conn){
    die("Could not connect ". mysqli_error($conn));
}
?>