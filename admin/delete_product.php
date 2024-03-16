<?php
session_start();
include '../conn.php';
if(!isset($_SESSION['user'])){
  header("location:../index.php");
}
if(isset($_GET['p_id'])){
    $pid=$_GET['p_id'];
    $select=$conn->query("SELECT * FROM products WHERE ProductId=$pid AND quantity=0");
    if(mysqli_num_rows($select)>0){
    $delete=$conn->query("DELETE FROM products WHERE ProductId=$pid");
      if($delete){
                header("location:products.php");
        }
    }
    
    else{
        
        header("location:products.php"); 
      
    }
}
?>