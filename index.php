<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Strathmore University</h1>
        </header>
        <nav class="toplink">
            <a href="about.php">About</a>
            <a href="courses.php">Courses</a>
            <a href="registration.php">Registration</a>
            <a href="contacts.php">Contacts</a>
        </nav>
        <div class="row">
            <div class="content">
                <u><i><b><h2>Student Life</h2></i></u></b>
                <p>At Strathmore, students and researchers have a wide range of services at their disposal for studying, eating, having fun, and getting involved (libraries, auditorium, language laboratory, theatre, choir, music studios, contemporary art, stadiums, swimming pool, tennis, gymnasium…). Discover all of our services.</p>
                <img src="strathmore.jpg" width="300" height="200" alt="Sir Thomas Moore building">
                <img src="SBS.jpg" width="300" height="200" alt="Strathmore business school">
            </div>
        </div>
        <div class="row">
            <div class="content">
                <?php
                // Include config file
                include 'config.php';

               // Attempt select query execution
               $sql = "SELECT * FROM user_form"; // Replace 'your_table_name' with your actual table name
               if($result = mysqli_query($conn, $sql)){
                   if(mysqli_num_rows($result) > 0){
                       while($row = mysqli_fetch_array($result)){
                           echo "<p>" . $row['fullName'] . "</p>";
                           echo "<p>" . $row['email'] . "</p>";
                           echo "<p>" . $row['password'] . "</p>";
                           echo "<p>" . $row['phoneNumber'] . "</p>";
                           echo "<p>" . $row['courseName'] . "</p>";
                           echo "<p>" . $row['country'] . "</p>";
                       }
                       // Free result set
                       mysqli_free_result($result);
                   } else{
                       echo "No records found.";
                   }
               } else{
                   echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
               }

               // Close connection
               mysqli_close($conn);
               ?>
           </div>
       </div>
        <footer class="footer">
            <p>&copy; 2024 Strathmore University. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>