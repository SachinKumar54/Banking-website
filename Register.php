<?php
   @include 'config.php';
   
   if(isset($_POST['regsubmit'])){
       
      $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $utype = mysqli_real_escape_string($conn, $_POST['utype']);
      $npassword = md5($_POST['password']);
      $cpassword = md5($_POST['cpassword']);
      $select = " SELECT * FROM users WHERE username = '$username'";
      $result = mysqli_query($conn, $select);
   
      if(mysqli_num_rows($result) > 0){
         $error[] = 'User already exist.';
      }
      else{
         if($npassword != $cpassword){
            $error[] = 'Password not mathched.';
         }else{
            $insert = "INSERT INTO users(fullname, username, email, utype, pswd) VALUES('$fullname','$username','$email','$utype','$npassword')";
            mysqli_query($conn, $insert);
            // Clear/reset form data
            $error[] = 'Registerd Successfully';
   
            if($utype == 'Customer')
            {
             $balance = 200000.00;  // Initial balance of 2 lakh
             $insert = "INSERT INTO accounts(username, email, availbalance) VALUES('$username','$email','$balance')";
             mysqli_query($conn, $insert);
            }
            $_POST = array(); // Clear POST data     
         }
      }
   
   }
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="PHP Bannking Project">
      <meta name="keywords" content="HTML, CSS, JavaScript, Jquery, php, mysql, wamp, Bootstrap">
      <meta name="author" content="Sachin Kumar">
      <title>Binary Numbers Project</title>
      <!--- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
      <!-- Custom CSS -->
      <link rel="stylesheet" href="files/css/mystyles.css">
   </head>
   <body>
      <section class="reg_section">
         <div class="registration_card">
            <h4 class="heading_h4">Sign Up</h4>
            <form action="" method="post">
               <div class="form-row"> 
                  <?php
                     if(isset($error)){
                     foreach($error as $error){
                     echo '<span class="text-primary">'.$error.'</span>';
                     }
                     }
                     ?>
               </div>
               <div class="form-row"> <input type="text" name="fullname" class="form-controll" placeholder="Name" required> </div>
               <div class="form-row"> <input type="text" name="username" class="form-controll" placeholder="Username" required> </div>
               <div class="form-row"> <input type="email" name="email" class="form-controll" placeholder="Email" required> </div>
               <div class="form-row">
                  <Select name="utype" class="form-controll" required>
                     <option selected disabled>Select One</option>
                     <option value="Customer">Customer</option>
                     <option value="banker">Banker</option>
                  </select>
               </div>
               <div class="form-row"> <input type="password" name="password" class="form-controll" placeholder="Password" required> </div>
               <div class="form-row"> <input type="password" name="cpassword" class="form-controll" placeholder="Confirm Password" required> </div>
               <div class="form-row row reg_links">
                  <div class="col-lg-12">
                     <p style="color: black">Already Registerd ?</p>
                  </div>
                  <div class="col-lg-6">
                     <a href="Customer_sign-in.php" class="text-primary">Cutomer Login</a>
                  </div>
                  <div class="col-lg-6">
                     <a href="Banker_sign-in.php" class="text-primary">Banker Login</a>
                  </div>
               </div>
               <div class="form-row"> <input type="submit" name="regsubmit" value="submit" class="home-btn reg_btn"> </div>
            </form>
         </div>
      </section>
      <!--- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
      <!-- Custom JS -->
      <script src="files/js/main.js"></script>
   </body>
</html>
