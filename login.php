<?php
session_start();
$uname = $_POST['uname'];
$psw = $_POST['psw'];

$encr_psw = md5($psw);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cars";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL query to insert data into the 'login' table
$sql = "SELECT * FROM LOGIN WHERE USERNAME ='$uname' AND PASSWORD = '$encr_psw'";

// Execute the query
$result = $conn->query($sql);

// Check if the query is executed successfully
if ($result-> num_rows > 0) {
 $_SESSION['username'] = $uname;

    header('Location: index.php');

}

else {   header('Location: login.html');
}


// Close the database connection
$conn->close();

?>