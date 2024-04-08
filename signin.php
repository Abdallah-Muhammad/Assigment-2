<?php
    require_once "../Assigment-2/config.php";

    if(isset($_POST["submit"])){
        $email = mysqli_real_escape_string($conn, strtolower($_POST["email"]));
        $password = mysqli_real_escape_string($conn, $_POST["password"]);

        $check_user = "SELECT * FROM user_form WHERE email = '$email' LIMIT 1";
        $user_result = $conn->query($check_user);

        if($user_result->num_rows > 0){
            $user_row = $user_result->fetch_assoc();

            if(password_verify($password, $user_row['password'])){
                // Password is correct, create a session for the user
                session_start();
                $_SESSION['user_id'] = $user_row['id'];
                header("Location: index.php"); // Redirect to the user's dashboard
                exit();
            }else{
                echo "Incorrect password";
            }
        }else{
            echo "User not found";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><u><b><i>Sign In</i></b></u></h1>
    </header>
    <div class="toplink">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="courses.php">Courses</a>
        <a href="contacts.php">Contacts</a>
        <a href="registration.php">Registration</a>
    </div>
    <div class="content">
        <form action="" method="POST" autocomplete="off">
            <label for="email">Email Address:</label>
            <input type="text" id="email" placeholder="Enter Email" name="email" required>
            
            <br><label for="password">Password:</label>
            <input type="password" id="password" placeholder="Enter password" name="password" required>

            <input type="submit" name="submit" value="Sign In"/>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Strathmore University. All rights reserved.</p>
    </footer>
</body>
</html>
