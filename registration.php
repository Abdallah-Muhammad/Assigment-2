<?php
   require_once "../Assigment-2/config.php";
if(isset($_POST["submit"])){
    $fullname = mysqli_real_escape_string($conn, ucwords(strtolower($_POST["fullName"])));
    $email = mysqli_real_escape_string($conn, strtolower($_POST["email"]));
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST["phoneNumber"]);
    $courseName = mysqli_real_escape_string($conn, $_POST["courseName"]);
    $country = mysqli_real_escape_string($conn, $_POST["country"]);
    $secretcode = mysqli_real_escape_string($conn, $_POST["SecretCode"]);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        die('Invalid email');
    }

    $email_exist = "SELECT email FROM user_form WHERE email='$email' LIMIT 1";
    $email_exist_res = $conn->query($email_exist);
    if($email_exist_res->num_rows > 0){
        die('Email aleady exist'); 
    }

    $hash_pass = PASSWORD_HASH($password, PASSWORD_DEFAULT);
    $insert_qry = "INSERT INTO user_form(fullName, email, password,phoneNumber,courseName,country )VALUES('$fullname', '$email',  '$password', '$phoneNumber' ,'$courseName' ,'$country')";

    if($conn->query($insert_qry) === TRUE){
        header("Location:index.php");
    }else{
        print "Process Failed" . $insert_qry . "<br>" . $conn->error;
    }
}
?>
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'cmciris.org';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'redbt@cmciris.org';                     //SMTP username
    $mail->Password   = '1W*KUjaO?7c*';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('abdallah.muhammad@strathmore.edu', 'Abdallah');
    $mail->addAddress('abdallahmuhammad199@gmail.com', 'Abdallah');     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><u><b><i>Registration</i></b></u></h1>
    </header>

    <div class="toplink">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="courses.php">Courses</a>
        <a href="contacts.php">Contacts</a>
        <a href="signin.php">Sign In</a>
    </div>

    <div class="content">
        <form action= "" method="POST" autocomplete="off">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" placeholder="Enter Full Name" name="fullName" required>
            
            <br><label for="phoneNumber">Phone Number:</label>
            <input type="text" id="phoneNumber" placeholder="Enter Phone Number" name="phoneNumber" required>
            
            <br><label for="email">Email Address:</label>
            <input type="text" id="email" placeholder="Enter Email" name="email" required>
            
            <label for="password">Insert Password:</label>
            <input type="text" id="password" placeholder="Enter password" name="password" required>
            
            <br><label for="Coursename">Choose a Course:</label>
            <input type="text" id="courseName" placeholder="Enter Course Name" name="courseName" required>
            
            <br><label for="Country">Country:</label>
            <input type="text" id="country" placeholder="Enter Country Name" name="country" required>

            <input type="submit" name="submit" value="submit"/>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Strathmore University. All rights reserved.</p>
    </footer>
</body>
</html>
