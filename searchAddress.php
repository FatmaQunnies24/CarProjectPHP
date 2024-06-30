<?php
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

$carName = isset($_POST['carName']) ? $_POST['carName'] : '';

$sql = "SELECT * FROM address";

// Check if carName is provided for filtering
if ($carName !== '') {
    $sql .= " WHERE id='" . $carName . "'";
}

$result = $conn->query($sql);

// Query to get columns from table
$query = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '" . $dbname . "' AND TABLE_NAME = 'address'");

while ($row = $query->fetch_assoc()) {
    $res_array[] = $row;
}

$columnArr = array_column($res_array, 'COLUMN_NAME');

if ($result->num_rows > 0) {
    echo "<table>";

    echo "<tr>";
    foreach ($columnArr as $header) {
        echo "<th>$header</th>";
    }
    echo "</tr>";

    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td><td>" . $row["buidling"] . "</td><td>" . $row["street"] . "</td><td>" . $row["city"] . "</td><td>" . $row["country"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>