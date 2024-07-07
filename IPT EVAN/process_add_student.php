<?php
@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
   exit;
}

if(isset($_POST['submit'])) {
   $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $age = mysqli_real_escape_string($conn, $_POST['age']);
   $year_level = mysqli_real_escape_string($conn, $_POST['year_level']);
   $course = mysqli_real_escape_string($conn, $_POST['course']);
   
   // Insert student into database
   $insert_query = "INSERT INTO students (name, email, age, year_level, course) 
                    VALUES ('$student_name', '$email', $age, $year_level, '$course')";
   
   if(mysqli_query($conn, $insert_query)) {
      // Redirect with success message or simply redirect back to add_student.php
      header('Location: add_student.php?success=1');
      exit;
   } else {
      echo "Error: " . mysqli_error($conn);
   }
}
?>