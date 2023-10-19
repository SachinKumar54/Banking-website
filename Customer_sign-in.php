<?php
   @include 'config.php';
   session_start();
   if(isset($_POST['csubmit'])){
       
      $username = mysqli_real_escape_string($conn, $_POST['username']);
      $pswd = md5($_POST['password']);
      $select = " SELECT * FROM users WHERE  username = '$username' && pswd = '$pswd'";
      $result = mysqli_query($conn, $select);
   
      if(mysqli_num_rows($result) > 0){
         $_POST = array(); // Clear POST data
         // Generate access token
         $accessToken = bin2hex(random_bytes(18)); // Generate a random 36-character access token
   
         
         $updateSql = "UPDATE users SET access_token = '$accessToken' WHERE username = '$username'";
         $conn->query($updateSql);
   
         $_SESSION['username'] = $username;
         header('location:transactionspage.php');
         exit();  
      }else{
         $error[] = 'Incorrect Username or password.';
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
            <h4 class="heading_h4">Sign In</h4>
            <form method="post">
               <div class="form-row"> 
                  <?php
                     if(isset($error)){
                     foreach($error as $error){
                     echo '<span class="text-primary">'.$error.'</span>';
                           }
                         }
                     ?> 
               </div>
               <div class="form-row"> <input type="text" name="username" class="form-controll" placeholder="Username"> </div>
               <div class="form-row"> <input type="password" name="password" class="form-controll" placeholder="Password"> </div>
               <div class="form-row row reg_links">
                  <div class="col-lg-6" style="text-align: left;">
                     <a href="Register.php" class="text-primary">Create Account ?</a>
                  </div>
               </div>
               <div class="form-row"> <input type="submit" value="Login" name="csubmit" class="home-btn reg_btn"> </div>
            </form>
         </div>
      </section>
      <!--- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
      <!-- Custom JS -->
      <script src="files/js/main.js"></script>
   </body>
</html>
