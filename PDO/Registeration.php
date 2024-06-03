<?php


include "Classes/Register.php";



include "logout.php";
$data = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    
    // Adding basic validation
    $user->name = isset($_POST['name']) ? $_POST['name'] : '';
    $user->fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $user->cnic = isset($_POST['cnic']) ? $_POST['cnic'] : '';
    $user->phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $user->email = isset($_POST['email']) ? $_POST['email'] : '';
    $user->password = isset($_POST['password']) ? $_POST['password'] : '';
    $user->gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $user->city = isset($_POST['city']) ? $_POST['city'] : '';
    $user->address = isset($_POST['address']) ? $_POST['address'] : '';

    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "image";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Check file size (e.g., 5MB maximum)
            if ($_FILES["image"]["size"] <= 5000000) {
                // Allow certain file formats
                $allowed_formats = ['jpg', 'png', 'jpeg', 'gif'];
                if (in_array($imageFileType, $allowed_formats)) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $user->image = $target_file;
                    } 
                } 
            } 
        } 
    } else {
        $user->image = '';
    };
    
 
if($user->user_Exists()) {
    $data = "Email has already registered!";
} else {
    if($user->register()) {
       
        $data = "You are Registerd You can,Login Now";
    } else {
        $data = "Registration failed!";
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign_Up Form</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style3.css">
</head>
<body>
<div class="container register">
    <div class="row">
        <div class="col-md-3 register-left">
            <!-- <img src="images/download.jpeg"  alt="no logo"/><br> -->
            <div class="row">
                <div class="col">
                <?php if($data !='') : ?>
            <p class="h4 text-white text-center</h4>"><?= $data ?></p>
            <img src="images/down.png" alt="no logo"/><br>
            <a href="login.php"><input type="submit" name="" value="Login"></a><br/>
            <?php endif; ?>
            </div>
            </div>
        </div>
        <div class="col-md-9 register-right">
            <h3 class="register-heading">Sign_Up Form</h3>
            
            <form action="Registeration.php" method="POST" class="register-form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="First Name *" value=""  required>
                        </div>
            
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="fname" placeholder="Father Name *" value="" />
                        </div>
    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="number" class="form-control" name="cnic" placeholder="CNIC *" value="" />
                        </div>
                
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="number" minlength="10" maxlength="10" name="phone" class="form-control" placeholder="Enter Phone No *" value="" />
                    </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Enter Email *" value="" />
                            </div>
        
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Enter Password *" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <div class="max1">
                            <label class="radio inline"> 
                                <input type="radio" name="gender"  value="male">
                                <span> Male </span> 
                            </label>
                            <label class="radio inline"> 
                                <input type="radio" name="gender" value="female">
                                <span>Female </span> 
                            </label>
                        </div>
                            </div>
        
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="file" name="image" id="">
                            </div>
                        </div>
                        </div>

                    <div class="form-group">
                    <select class="form-select" name="city" aria-label="City select" required>
                        <option value="" selected disabled>Select City</option>
                        <option value="Karachi">Karachi</option>
                        <option value="Hyderabad">Hyderabad</option>
                        <option value="Sukkur">Sukkur</option>
                        <option value="Larkana">Larkana</option>
                        <option value="Nawabshah">Nawabshah</option>
                    </select>
                </div>


                <div class="form-group">
                    <textarea class="form-control" name="address"  placeholder="Address*" value="" ></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary " value="Sign_Up"/>
                </div>
            </div>

        </div>

            </form>
        </div>
    </div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</body>
</html>

