<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
   exit; // Ensure to exit after header redirect to prevent further execution
}

if(isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $select_query = "SELECT * FROM students WHERE id = $student_id";
    $result = mysqli_query($conn, $select_query);
    $student = mysqli_fetch_assoc($result);

    if(!$student) {
        header('location:admin_page.php');
        exit;
    }
} else {
    header('location:admin_page.php');
    exit;
}

if(isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $year_level = mysqli_real_escape_string($conn, $_POST['year_level']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    $update_query = "UPDATE students SET 
                     name = '$name', 
                     email = '$email', 
                     age = '$age', 
                     year_level = '$year_level', 
                     course = '$course' 
                     WHERE id = $student_id";
    
    if(mysqli_query($conn, $update_query)) {
        header('location:admin_page.php?success=1');
    } else {
        $error = 'Failed to update student information!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Student</title>
   <link rel="stylesheet" href="css/style.css">
   <script type="text/javascript" src="jquery/jquery-3.7.1-jquery.min.js"></script>
</head>
<body>
   
<div class="container">
   <div class="content">
      <h3>Edit Student</h3>
      <?php
      if(isset($error)) {
         echo '<p class="error-msg">'.$error.'</p>';
      }
      ?>
      <form action="" method="post">
         <input type="text" name="name" value="<?php echo $student['name']; ?>" placeholder="Enter Student Name" required>
         <input type="email" name="email" value="<?php echo $student['email']; ?>" placeholder="Enter Email" required>
         <input type="number" name="age" value="<?php echo $student['age']; ?>" placeholder="Enter Age" required>
         <input type="number" name="year_level" value="<?php echo $student['year_level']; ?>" placeholder="Enter Year Level" required>
         <input type="text" name="course" value="<?php echo $student['course']; ?>" placeholder="Enter Course" required>
         <input type="submit" name="update" value="Update Student" class="btn">
         <a href="admin_page.php" class="btn cancel-btn">Cancel</a>
      </form>
   </div>
</div>

</body>
</html>
