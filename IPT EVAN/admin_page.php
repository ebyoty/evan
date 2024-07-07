<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
   header('location:login_form.php');
   exit; // Ensure to exit after header redirect to prevent further execution
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Page</title>
   <link rel="stylesheet" href="css/style.css">
   <script type="text/javascript" src="jquery/jquery-3.7.1-jquery.min.js"></script>
</head>
<body>
   
<div class="container">
   <div class="content">
      <h3>Hi, <span>Admin</span></h3>
      <h1>Welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
      <p>This is an admin page.</p>
      <a href="login_form.php" class="btn">Login</a>
      <a href="register_form.php" class="btn">Register</a>
      <a href="logout.php" class="btn">Logout</a>
   </div>

   <div class="content">
      <h3>Student List</h3>
      
      <!-- Search form -->
      <form action="" method="GET">
         <input type="text" name="search" placeholder="Search students..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
         <input type="submit" value="Search" class="btn">
         <a href="admin_page.php" class="btn">Clear Search</a> <!-- Clear search button -->
      </form>

      <table>
         <thead>
            <tr>
               <th>ID</th>
               <th>Name</th>
               <th>Email</th>
               <th>Age</th>
               <th>Year Level</th>
               <th>Course</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php
            // Check if search query is set
            $search_query = "";
            if (isset($_GET['search'])) {
               $search = mysqli_real_escape_string($conn, $_GET['search']);
               $search_query = " WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR course LIKE '%$search%'";
            }

            $select_query = "SELECT * FROM students" . $search_query;
            $result = mysqli_query($conn, $select_query);

            // Check if query was successful
            if ($result) {
               if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                     echo "<tr>
                              <td>{$row['id']}</td>
                              <td>{$row['name']}</td>
                              <td>{$row['email']}</td>
                              <td>{$row['age']}</td>
                              <td>{$row['year_level']}</td>
                              <td>{$row['course']}</td>
                              <td>
                                 <a href='edit_student.php?id={$row['id']}' class='btn'>Edit</a>
                                 <a href='delete_student.php?id={$row['id']}' class='btn' onclick='return confirm(\"Are you sure you want to delete this student?\")'>Delete</a>
                              </td>
                           </tr>";
                  }
               } else {
                  echo "<tr><td colspan='7'>No students found.</td></tr>";
               }
            } else {
               // Print the error message
               echo "Error: " . mysqli_error($conn);
            }
            ?>
         </tbody>
      </table>
   </div>
</div>

</body>
</html>