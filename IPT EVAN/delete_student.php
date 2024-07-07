<?php
@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
   exit; // Ensure to exit after header redirect to prevent further execution
}

if(isset($_GET['id'])){
   $id = $_GET['id'];

   $delete_query = "DELETE FROM students WHERE id = $id";
   if(mysqli_query($conn, $delete_query)){
      header('location:admin_page.php');
   } else {
      echo 'Error: '.mysqli_error($conn);
   }
} else {
   header('location:admin_page.php');
}
?>