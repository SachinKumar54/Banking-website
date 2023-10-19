<?php
   @include 'config.php';
   // Get the selected user from the URL parameter
   $selectedUser = $_GET['user'];
   
   // Fetch transaction details for the selected user
   $sql = "SELECT * FROM accounts WHERE username = '$selectedUser'";
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
      <link rel="stylesheet" href="files/css/mystyles.css">
   </head>
   <body>
      <section style="background: #fff; margin: 1rem 2rem; padding: 1rem 2rem; border-radius: 2rem">
      <h5 style="text-align: center; font-weight: 700;font-family: sans-serif">All Transactions Details of user <span style="color: green;"><?php echo $selectedUser; ?></span></h5>
      <table id="customers">
         <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Amount</th>
            <th>T Type</th>
         </tr>
         <?php
            // Check if any rows are returned
            if ($result->num_rows > 0) {
                // Loop through each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["amount"] . "</td>";
                    echo "<td>" . $row["ttype"] . "</td>";
                    echo "</tr>";
                }
            } else {
                $m = 'No transactions found for user: ';
                echo "<tr><td colspan='4'>$m. $selectedUser</td></tr>";
            }
            ?>
      </table>
      <section>
      </script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!--- Bootstrap JS -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
      <!-- Custom JS -->
      <script src="files/js/main.js"></script>
   </body>
</html>
