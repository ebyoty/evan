<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Student</title>
   <link rel="stylesheet" href="css/style.css">
   <script type="text/javascript" src="jquery/jquery-3.7.1-jquery.min.js"></script>
</head>
<body>
   
<div class="container">
   <div class="content">
      <h3>Add New Student</h3>
      <?php
      // Check for success message
      if(isset($_GET['success']) && $_GET['success'] == 1) {
         echo '<p class="success-msg">Student added successfully!</p>';
      }
      ?>
      
      <form action="process_add_student.php" method="post">
         <input type="text" name="student_name" placeholder="Enter Student Name" required>
         <input type="email" name="email" placeholder="Enter Email" required>
         <input type="number" name="age" placeholder="Enter Age" required>
         <input type="number" name="year_level" placeholder="Enter Year Level" required>
         <input type="text" name="course" placeholder="Enter Course" required>
         <input type="submit" name="submit" value="Add Student" class="btn">
         <a href="user_page.php" class="btn cancel-btn">Cancel</a>
      </form>
   </div>
</div>

</body>
</html>