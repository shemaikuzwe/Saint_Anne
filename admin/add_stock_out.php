<?php
session_start();
include '../conn.php';
 if (!isset($_SESSION['user'])) {
    header("location:../index.php");
 }
 if (isset($_POST['submit'])) {
    $pid=$_POST['pid'];
    $quantity=$_POST['quantity'];
    $price=$conn->query("SELECT PricePerKg FROM products WHERE ProductId='$pid'");
    $row=mysqli_fetch_assoc($price);
    $unit_price=$row['PricePerKg'];
    $amount=$quantity*$unit_price;
    $update=$conn->query("UPDATE products SET Total_price=Total_price-'$amount',quantity=quantity+'$quantity' WHERE ProductId='$pid'");
    $insert=$conn->query("INSERT INTO stockout(ProductId,quantity) VALUES('$pid','$quantity')");
    if ($update AND $insert) {
        header("location:stock_out.php");
    }
    else{
        header("location:add_stock_in.php?error=product not added in stock");
    }
    
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
    <link rel="stylesheet" href="style.css">
    <title>Add stock Out</title>
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
                    <li class=" nav-item"><a href="Products.php" class="nav-link text-black"> Products</a></li>
                    <li class="nav-item"><a href="stock_in.php" class="nav-link text-black" >Stock In</a></li>
                    <li class="nav-item"><a href="stock_out.php" class="nav-link text-black"> Stock out</a></li>
                   
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
      <center > <i class="fa-solid  fa-clock-rotate-left"></i> Our Prdoucts</center> 
    </div>
    <div class="card-body">
    <form method="post" class="border rounded shadow p-4 mt-3">
          <?php
            if(isset($_GET['error'])){
                       $error=$_GET['error'];
                       echo'<div class="alert alert-danger alert-dismissible">
                       <button type="button" class="btn-close" data-bs-dismiss="alert"></button>'.
                       $error.'
                     </div>';
                    }
                    ?>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-cart-shopping"></i>&nbsp;Product name</span>
                        <select class='form-select' name="pid">
                             <?php
                                $product_name=$conn->query("SELECT ProductId,ProductName FROM products");
                                foreach ($product_name as  $product) {
                                    $id=$product['ProductId'];
                                    $name=$product['ProductName'];
                                    echo " <option value='$id'>$name</option>";
                                }
                             ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-money-bill"></i>&nbsp; Quantity</span>
                        <input type="number" placeholder="Enter Quantity in kg" name="quantity" class="form-control">
                    </div>
                    <center><button type="submit" name="submit" class="btn btn-warning"><i class="fa-solid fa-plus"></i>Add</button></center>
                </form>
    </div>
  </div>
            
        </div>
      </div>  
    </div>
</body>
</html>