<?php
include 'conn.php';
session_start();
if(isset($_POST['submit'])){
   $fname=$_POST['fname'];
   $lname=$_POST['lname'];
   $uname=$_POST['uname'];
   $pass=$_POST['pass'];
   $cpass=$_POST['cpass'];
   $email=$_POST['email'];
   $phone=$_POST['phone'];
   $select=$conn->query("SELECT * FROM users WHERE username='$uname'");
   if(mysqli_num_rows($select) > 0){
      header("location:register.php?error=username already exits");
      exit();
   }
   if($pass!=$cpass){
    header("location:register.php?error=password mismatch");
    exit();
   }
   $insert=$conn->query("INSERT INTO users(fname,lname,username,password,email,phone) VALUES('$fname','$lname','$uname','$pass','$email','$phone')");
   if($insert){
    $_SESSION['user']=$user;
    header("location:./admin/");
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Sign up</title>
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-sm-4 mt-5 p-3 border rounded shadow">
                <form  method="post" >
                    <center><h3>Join us Now</h3></center>
                    <?php
                    if(isset($_GET['error'])){
                        $error = $_GET['error'];
                        echo"
                        <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
                        ".$error."
                      </div>
                        ";
                    }
                    ?>
                    <div class="input-group mb-3">
                        <span class="input-group-text">FirstName:</span>
                        <input type="text" placeholder="Enter username" name="fname" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">LastName:</span>
                        <input type="text" placeholder="Enter LastName" name="lname" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Username:</span>
                        <input type="text" placeholder="Enter Username" name="uname" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Password:</span>
                        <input type="password" placeholder="Enter password" name="pass" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Confirm Password:</span>
                        <input type="password" placeholder="Confirm Password" name="cpass" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Phone</span>
                        <input type="text" placeholder="Enter phone" name="phone" class="form-control" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Email:</span>
                        <input type="email" placeholder="Enter email" name="email" class="form-control" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox"  class="form-check-input" name="remember">
                        <span class="form-check-label">Agree our terms & conditions</span>
                </div>
                    <center><Button type="submit" class="btn btn-warning text-white" name="submit">Sign up</Button></center>
                    <center><span>Already have account <a href="index.php" class="alert-link">login</a></span></center>
                </form>
            </div>
        </div>
    </div>
</body>
</html>