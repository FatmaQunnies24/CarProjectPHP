<!-- <?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "cars";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$carName = isset($_POST['insertCarName']) ? mysqli_real_escape_string($conn, $_POST['insertCarName']) : '';
$carModel = isset($_POST['insertCarModel']) ? mysqli_real_escape_string($conn, $_POST['insertCarModel']) : '';
$carYear = isset($_POST['insertCarYear']) ? mysqli_real_escape_string($conn, $_POST['insertCarYear']) : '';
$carMade = isset($_POST['insertCarMade']) ? mysqli_real_escape_string($conn, $_POST['insertCarMade']) : '';

echo "Car Name: " . $carName . "<br>";
echo "Car Model: " . $carModel . "<br>";
echo "Car Year: " . $carYear . "<br>";
echo "Made: " . $carMade . "<br>";

$sql = "INSERT INTO car (name, model, year, made)
VALUES ('$carName', '$carModel', '$carYear', '$carMade')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> -->
<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "cars";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carName = mysqli_real_escape_string($conn, $_POST['insertCarName']);
    $carModel = mysqli_real_escape_string($conn, $_POST['insertCarModel']);
    $carYear = mysqli_real_escape_string($conn, $_POST['insertCarYear']);
    $made = mysqli_real_escape_string($conn, $_POST['insertCarMade']);

    $sql = "INSERT INTO car (name, model, year, made)
            VALUES ('$carName', '$carModel', '$carYear', '$made')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Reload data after insertion
function loadAllData() {
    global $conn;
    $result = $conn->query("SELECT * FROM car");
    echo "<table>";
    echo "<tr><th>Name</th><th>Model</th><th>Year</th><th>Made</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["name"] . "</td><td>" . $row["model"] . "</td><td>" . $row["year"] . "</td><td>" . $row["made"] . "</td></tr>";
    }
    echo "</table>";
}

// Load data initially
loadAllData();

$conn->close();
?>
