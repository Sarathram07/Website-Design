<?php

$username = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['mail'];
$password = $_POST['passwd'];

if (!empty($username) || !empty($password) || !empty($email) || !empty($phone)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "dmlogin";
	
    //create connection
    $conne = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email FROM signin WHERE email = ? Limit 1";
     $INSERT = "INSERT INTO signup (name, phone, email, password) values(?, ?, ?, ?)";
	 
     //Prepare statement
     $stmt = $conne->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
	  
      $stmt = $conne->prepare($INSERT);
      $stmt->bind_param("siss", $username, $phone, $email, $password);
      $stmt->execute();
      #echo "New record inserted sucessfully";
	  header("location:nike.html");
	  exit;
     } else {
      echo "Someone already Registered using this email";
     }
     $stmt->close();
     $conne->close();
    }
} else {
 echo "All field are required";
 die();
}

?>