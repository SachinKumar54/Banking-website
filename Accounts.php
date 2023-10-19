<?php
   @include 'config.php';
   // Fetch user names from the accounts table
   $sql = "SELECT DISTINCT username FROM accounts";
   $result = $conn->query($sql);
   
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
         .container {
         margin: 0 7rem;
         }
         .container div{
         background: #fff; 
         margin: 1rem; 
         padding: 1rem 0; 
         display: flex; 
         justify-content: center; 
         align-items: center; 
         gap: 9rem;
         border-radius: 10px;
         }
         .container div p, .container div a {
         text-decoration: none;
         font-size: 15px;
         font-family: sans-serif;
         }
         .container h2{
         padding : 2rem;
         color: black;
         background: #fff;
         text-align: center:
         border-radius: 12px;
         font-family: sans-serif;
         display: flex;
         align-items: center;
         justify-content: center;
         }
      </style>
      <!-- Custom CSS -->
      <link rel="stylesheet" href="files/css/mystyles.css">
   </head>
   <body>
      <section class="">
         <div class="container">
            <?php
               if ($result->num_rows > 0) {
                   // Output data of each row
                   $view = 'view more';
                   while($row = $result->fetch_assoc()) {
                       //echo "<a href='single_user-tdetails.php?user=" . $row['username'] . "'>" . $row['username'] . "</a><br>";
                       echo "<div>";
                       echo "<p>" . $row["username"] . "</p>";
                       echo "<a href='single_user-tdetails.php?user=" . $row['username'] . "'>" . $view . "</a>";
                       echo "</div>";
                   }
               } else {
                  echo "<h2>No User Found!</h2>";
                 
               }
               ?>
         </div>
      </section>
      <!--- Bootstrap JS -->
      <!-- Custom JS -->
      <script src="files/js/main.js"></script>
   </body>
</html>
