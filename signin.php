<?php

$email = $_POST['mail'];
$password = $_POST['passwd'];
if (!empty($email)){
if (!empty($password)){
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "dmlogin";
    
// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
if (mysqli_connect_error()){
die('Connect Error ('. mysqli_connect_errno() .') '
. mysqli_connect_error());
}
else{
$sql = "INSERT INTO signin (email, password) values ('$email','$password')";
    
if ($conn->query($sql)){
#echo "New record is inserted sucessfully";
 header("location:nike.html");
 exit;
}
    
else{
echo "Error: ". $sql ."
". $conn->error;
}
$conn->close();
}
}
else{
echo "Password should not be empty";
die();
}
}
else{
echo "Username should not be empty";
die();
}

?>
