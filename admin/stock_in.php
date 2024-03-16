<?php
session_start();
include '../conn.php';
 if (!isset($_SESSION['user'])) {
    header("location:../index.php");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dashboard</title>
</head>
<body>
    <div class="container-fluid content  d-flex  mt-2">
        <div class="col sm-9 border bg-warning  rounded  "> 
            <nav class="nav mt-2">
            <ul class=" text-black p-5 ">
                    <div class="nav-brand">
                        <img src="../images/logo.jpg" class="rounded-pill" style="width: 120px;" alt="logo" srcset="">
                        <h5><b>Saint Anne Management System</b></h5>
                    </div>
                    <li class="nav-item"><a href="index.php" class="nav-link text-black"> Dashboard</a></li>
                    <li class=" nav-item"><a href="furniture.php" class="nav-link text-black"> Products</a></li>
                    <li class="nav-item"><a href="import.php" class="nav-link text-black" >Stock In</a></li>
                    <li class="nav-item"><a href="export.php" class="nav-link text-black"> Stock out</a></li>
                    <li class="nav-item"><a href="export.php" class="nav-link text-black"> Report</a></li>
                    <div class="nav-brand">
                        <img src="../images/user.png" alt="avatar"  class="rounded-pill" style="width: 100px;" >
                    </div>
                    <li class="nav-link text-black " >Admin</li>
                    <li class="nav-item " > <a class=" nav-link text-black" href="logout.php">Logout</a></li>
                </ul>
            </nav>
               
        </div>
       
      <div class="col-sm-9 ms-3">
    <button class="btn m-1"><i class="fa-solid fa-bars " style="font-size:30px"></i></button> 
     <div class="card ">
    <div class="card-header">
      <center > <i class="fa-solid  fa-clock-rotate-left"></i> Stock In</center> 
    </div>
    <div class="card-body">
      <div class="table table-resplonsive table-sm w-80">
                <table class="table border table-stripped table-hover">
                   <thead class="table-dark text-white">
                    <th>Stock in Id </th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price per Kg</th>
                    <th>Total price</th>
                    <th>Date</th>
                   </thead> 
                   <tbody>
                <?php 
                $select=$conn->query("SELECT * FROM stockin");
                 if (mysqli_num_rows($select)>0){
                    while ($row=mysqli_fetch_assoc($select)) {
                        $s_id=$row['StockInId'];
                        $p_id=$row['ProductId'];
                        $quantity=$row['quantity'];
                        $date=$row['date'];
                        $select_product=$conn->query("SELECT * FROM product WHERE ProductId=$p_id");
                        foreach($select_product as $row_product){
                          $Pname=$row_product["ProductName"];
                          $Pprice=$row_product["PricePerKg"];
                        }
                        $total=$quantity*$Pprice;
                        echo " <tr>
                        <td>$p_id</td>
                        <td>$Pname</td>
                        <td>$quantity Kg</td>
                        <td>$Pprice Rwf</td>
                        <td>$total</td>
                    </tr>";
                    } 
                 }
                 else {
                    echo "<td colspan='3'><center> No stock in found</center></td>";
                 }

                ?>
                   
                   </tbody> 
                </table>
            </div>
        <center><a href="add_stock_in.php" class="btn btn-warning btn-sm"><i class="fa-solid fa-plus"></i>New</a></center>
    </div>
  </div>
            
        </div>
      </div>  
    </div>
</body>
</html>