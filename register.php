<?php
$uname = $_POST['uname'];
$psw = $_POST['psw'];

$encr_psw = md5($psw);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cars";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Adjust the SQL query to specify the columns and values to be inserted
$sql = "INSERT INTO login (USERNAME, PASSWORD) VALUES ('$uname', '$encr_psw')";

if ($conn->query($sql) === TRUE) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
