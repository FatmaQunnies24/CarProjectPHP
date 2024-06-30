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

$sql = "SELECT * FROM device";

// Check if carName is provided for filtering
if ($carName !== '') {
    $sql .= " WHERE no='" . $carName . "'";
}

$result = $conn->query($sql);

// Query to get columns from table
$query = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '" . $dbname . "' AND TABLE_NAME = 'device'");

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
        echo "<td>" . $row["no"] . "</td><td>" . $row["name"] . "</td><td>" . $row["price"] . "</td><td>" . $row["weight"] . "</td><td>" . $row["made"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>