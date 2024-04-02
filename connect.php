<?php
	$fullName = $_POST['fullName'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$phoneNumber = $_POST['phoneNumber'];
    $courseName = $_POST['courseNumber'];
    $country = $_POST['country'];
	// Database connection
	$conn = new mysqli('localhost','root','','user_database');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} 
    else {
		$stmt = $conn->prepare("insert into registration(fullName, phoneNumber, email, password, courseName, country) values(?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssi", $fullName, $phoneNumber, $email, $password, $courseName, $country );
		$execval = $stmt->execute();
		echo $execval;
		echo "Registration successfully...";
		$stmt->close();
		$conn->close();
	}

?>