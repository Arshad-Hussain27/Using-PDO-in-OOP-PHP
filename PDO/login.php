<?php
session_start();


include "Classes/Register.php"; 


$failed = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    
    // Adding basic validation
    $user->email = isset($_POST['email']) ? $_POST['email'] : '';
    $user->password = isset($_POST['password']) ? $_POST['password'] : '';
    if ($user->Login()) {
        $_SESSION['user_id'] = $user->id;
        header("location:index.php");
    }else {
        $failed = "Email and Password is Incorrect";
    }
    
}
?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title> Sign_In Form</title>
</head>
<body>

    <!----------------------- Main Container -------------------------->

     <div class="container d-flex justify-content-center align-items-center min-vh-100">

    <!----------------------- Login Container -------------------------->

       <div class="row border rounded-5 p-3 bg-white shadow box-area">

    <!--------------------------- Left Box ----------------------------->

       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #1030be;">
           <div class="featured-image mb-2">
            <img src="images/businessman-holding-virtual-text-information-technology-against-dark-background-2BFP18C.jpg" class="img-fluid" style="width: 400px;">
           </div>
           <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;"></p>
           <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;"></small>
       </div> 

    <!-------------------- ------ Right Box ---------------------------->
        
       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4">
                     <h2 class="text-center">Hello,Again</h2>
                     <?php if($failed !='') : ?>
            <p class="h6 text-danger text-center"><?= $failed ?></p>
            <?php endif; ?>
                </div>
                <form action="" method="POST">
                <div class="input-group mb-3">
                    <input type="text" name="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address">
                </div>
                <div class="input-group mb-1">
                    <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                </div>
                <div class="input-group mb-5 d-flex justify-content-between">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="formCheck">
                        <label for="formCheck" class="form-check-label text-secondary"><small>Remember Me</small></label>
                    </div>
                    <div class="forgot">
                        <small><a href="#">Forgot Password?</a></small>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-light w-100 fs-6"><img src="images/google.png" style="width:20px" class="me-2"><small>Sign In with Google</small></button>
                </div>
                <div class="row">
                    <small>Don't have account? <a href="Registeration.php">Sign Up</a></small>
                </div>
          </div>
       </div> 

      </div>
    </div>
    </form>
</body>
</html>