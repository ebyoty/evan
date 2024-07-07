<?php
@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
   exit; // Ensure to exit after header redirect to prevent further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manage Inventory</title>
   <link rel="stylesheet" href="css/style.css">
   <script>
      $(document).ready(function() {
         $('table tbody tr').on('click', function() {
            $(this).toggleClass('highlight');
         });
      });
   </script>
   <style>
      .highlight {
         background-color: #f0f0f0;
      }
   </style>
</head>
<body>
   
<div class="container">
   <div class="content">
      <h3>Hi, <span>Student</span></h3>
      <h1>Welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
      <p>This is your inventory management page.</p>
      <a href="add_student.php" class="btn">Add Student</a>
      
      <h4>Student List</h4>
      <table>
         <thead>
            <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Email</th>
               <th>Age</th>
               <th>Year Level</th>
               <th>Course</th>
            </tr>
         </thead>
         <tbody>
            <?php
            $select_query = "SELECT * FROM students";
            $result = mysqli_query($conn, $select_query);
            
            if(mysqli_num_rows($result) > 0) {
               while($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>
                           <td>{$row['id']}</td>
                           <td>{$row['name']}</td>
                           <td>{$row['email']}</td>
                           <td>{$row['age']}</td>
                           <td>{$row['year_level']}</td>
                           <td>{$row['course']}</td>
                        </tr>";
               }
            } else {
               echo "<tr><td colspan='6'>No students found.</td></tr>";
            }
            ?>
         </tbody>
      </table>
      
      <a href="logout.php" class="btn">Logout</a>
   </div>
</div>

</body>
</html>
