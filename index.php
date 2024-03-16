<?php
include'conn.php';
session_start();
if(isset($_POST['submit'])){
    $uname=$_POST['uname'];
    $pass=$_POST['pass'];
    $stmt=$conn->prepare("SELECT * FROM users WHERE username=? AND password=?");
    $stmt->bind_param("ss", $uname, $pass);
    $stmt->execute();
    $select=$stmt->get_result();
    if(mysqli_num_rows($select) > 0){
        $_SESSION['user']=$uname;
        header("location:./admin/");
    }
    else{
        header("location:index.php?error=invalid username or password");
    }    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
    <div class="form-container mt-5">
        <div class="row justify-content-center">
            <div class="col-sm-4 border rounded shadow p-4 mt-5">
                <form method="post">
                  <center>  <h3>Welcome Back</h3></center>
                    <?php
                    if(isset($_GET['error'])){
                        $error=$_GET['error'];
                        echo"
                        <div class='alert alert-warning alert-dismissible'>
                        <button type='button' class='btn-close' data-bs-dismiss='alert'></button>".$error."
                        </div>";
                    }
                    ?>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                        <input type="text" name="uname" class="form-control" placeholder="Enter username">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="pass" class="form-control" placeholder="Enter password">
                    </div>
                     <input type="checkbox" name="check" class="form-check-input">&nbsp;Remember Me
                    <center><button type="submit" class="btn btn-warning" name="submit">Login</button></center>
                    <center><span>Don't have account <a href="register.php" class="alert-link">Register</a></span></center>
                </form>
            </div>
        </div>
    </div>
</body>
</html>