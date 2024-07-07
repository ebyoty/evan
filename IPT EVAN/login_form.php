<?php

@include 'config.php';

session_start();

$error = []; // Initialize an array to store errors

if(isset($_POST['submit'])) {
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']); // Consider using more secure password hashing methods like bcrypt
   
   $select = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";
   $result = mysqli_query($conn, $select);

   if ($result) {
      if(mysqli_num_rows($result) > 0) {
         $row = mysqli_fetch_array($result);
         
         if($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            header('location: admin_page.php');
            exit;
         } elseif($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            header('location: user_page.php');
            exit;
         }
      } else {
         $error[] = 'Incorrect email or password!';
      }
   } else {
      $error[] = 'Query failed: ' . mysqli_error($conn);
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <script type="text/javascript" src="jquery/jquery-3.7.1-jquery.min.js"></script>
</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>Login Now</h3>
      <?php
      // Display errors if there are any
      if(!empty($error)) {
         foreach($error as $error_msg) {
            echo '<span class="error-msg">'.$error_msg.'</span>';
         }
      }
      ?>
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="submit" name="submit" value="Login Now" class="form-btn">
      <p>Don't have an account? <a href="register_form.php">Register Now</a></p>
   </form>
</div>

</body>
</html>
