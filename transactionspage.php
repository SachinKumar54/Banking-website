d<?php
   @include 'config.php';
   session_start();
   if(!isset($_SESSION['username'])){
      header('location:Customer_sign-in.php');
   }
   
   $username = $_SESSION['username'];
   $email = "SELECT username, email, availbalance FROM users WHERE username = '$username'";
   $result = mysqli_query($conn, $email);
   
   if (mysqli_num_rows($result) > 0) {
     $row = mysqli_fetch_assoc($result);
   
     $usernamee = $row['username'];
     $email = $row['email'];
     $availbalance = $row['availbalance'];
   
     if(isset($_POST['tsubmit'])){
       
       // Retrieve user details from the database
       $amount = mysqli_real_escape_string($conn, $_POST['amount']);
       $ttype = mysqli_real_escape_string($conn, $_POST['ttype']);
       if($ttype == 'deposit')
            {
             $totalbalance = $availbalance + $amount;
             $update = mysqli_query($conn, "UPDATE users SET availbalance='$totalbalance' WHERE username='$usernamee'");
             mysqli_query($conn, $update);
             $insert = "INSERT INTO accounts(username, email, amount, ttype) VALUES('$username','$email','$amount','$ttype')";
             mysqli_query($conn, $insert);
              // Refresh the page
             $error[] = 'Balance Deposit Sucessfull';
           
             
            }
            if($ttype == 'withdrawl')
            {
             if($amount > $availbalance)
             {
               $error[] = 'Insufficient Balance!!';
             }
             else {
               $remainlbalance = $availbalance - $amount;
               $update = mysqli_query($conn, "UPDATE users SET availbalance='$remainlbalance' WHERE username='$usernamee'");
               mysqli_query($conn, $update);
               $insert = "INSERT INTO accounts(username, email, amount, ttype) VALUES('$username','$email','$amount','$ttype')";
               mysqli_query($conn, $insert);
               $error[] = 'Balance Withdraw Sucessfull';
             } 
            }     
     
      
     
      
       
     
     }
   }
   
   
  

   // Construct the SQL query
   $sqll = "SELECT * FROM accounts WHERE username = '$username'";
   
   // Execute the query
   $resulttt = $conn->query($sqll);
   
   
   
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
      <style>
         #customers {
         font-family: Arial, Helvetica, sans-serif;
         border-collapse: collapse;
         width: 100%;
         text-align: center;
         background: white;
         }
         #customers td, #customers th {
         border: 1px solid #ddd;
         padding: 8px;
         }
         #customers tr:nth-child(even){background-color: #f2f2f2;}
         #customers tr:hover {background-color: #ddd;}
         #customers th {
         padding-top: 12px;
         padding-bottom: 12px;
         text-align: center;
         background-color: #04AA6D;
         color: white;
         }
      </style>
      <!--- Bootstrap CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
      <!-- Custom CSS -->
      <link rel="stylesheet" href="files/css/mystyles.css">
   </head>
   <body>
      <section style="background: #fff; border-radius: 15px; margin: 2rem 9rem;padding: 1rem 1.2rem">
         <div class="container">
            <div class="row">
               <div class="col-lg-12" style="text-align: center">
                  <div >
                     <h2 style="font-size: 30px; font-weight: 800">Welcome</h2>
                     <p><span><?php echo $_SESSION['username']; ?></span></p>
                     <a href="logout.php" class="home-btn" style="text-decoration: none; background-color: orangered;">
                     <span class="span">LOGOUT</span>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section style="background: #fff; border-radius: 15px; margin: 2rem 9rem;padding: 1rem 1.2rem">
         <div class="container">
            <div class="row">
               <div class="col-lg-6" style="text-align: center; margin: auto">
                  <h2 style="font-size: 30px; font-weight: 800">Click Here For</h2>
                  <p>Deposit & Withdrawl Process</p>
                  <Button type="button" class="home-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                     style="text-decoration: none; background-color: orangered;border: 0px">Click</Button>
               </div>
               <div class="col-lg-12">
                  <!-- Modal -->
                  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel" Style="font-weight: 700">Your Available Balance :
                                 <span class="text-success"><?php echo $availbalance; ?></span> 
                              </h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <form action="" method="post" id="tform">
                                 <div class="form-row"> 
                                    <?php
                                       if(isset($error)){
                                       foreach($error as $error){
                                          echo "<script>alert('" . $error . "');</script>";
                                       }
                                       }
                                       ?>
                                 </div>
                                 <div class="form-row"> <input type="number" name="amount" class="form-controll" placeholder="Enter Amount" required> </div>
                                 <div class="form-row">
                                    <Select name="ttype" class="form-controll" required>
                                       <option selected disabled>Select One</option>
                                       <option value="deposit">Deposit</option>
                                       <option value="withdrawl">Withdrawl</option>
                                    </select>
                                 </div>
                                 <div class="form-row"> <input type="submit" name="tsubmit" value="submit" class="home-btn reg_btn"> </div>
                              </form>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section style="background: #fff; margin: 1rem 2rem; padding: 1rem 2rem; border-radius: 2rem">
      <h5 style="text-align: center; font-weight: 700;">Dear User Your All Transactions Details</h5>
      <table id="customers">
         <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Amount</th>
            <th>T Type</th>
         </tr>
         <?php
            // Check if any rows are returned
            if ($resulttt->num_rows > 0) {
                // Loop through each row
                while ($row = $resulttt->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["amount"] . "</td>";
                    echo "<td>" . $row["ttype"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No transactions found</td></tr>";
            }
            ?>
      </table>
         </section>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!--- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
      <!-- Custom JS -->
      <script src="files/js/main.js"></script>
   </body>
</html>
