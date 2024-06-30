
<?php
$conn = mysqli_connect("localhost", "root", "", "cars");

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$insertCarName = isset($_REQUEST['insertCarName']) ? $_REQUEST['insertCarName'] : '';
$insertCarModel = isset($_REQUEST['insertCarModel']) ? $_REQUEST['insertCarModel'] : '';
$insertCarYear = isset($_REQUEST['insertCarYear']) ? $_REQUEST['insertCarYear'] : '';
$insertCarMade = isset($_REQUEST['insertCarMade']) ? $_REQUEST['insertCarMade'] : '';
$insertCarCountry = isset($_REQUEST['insertCar']) ? $_REQUEST['insertCar'] : '';  // Corrected variable name

$sql = "INSERT INTO address (id, buidling, street, city, country) VALUES ('$insertCarName', '$insertCarModel', '$insertCarYear', '$insertCarMade', '$insertCarCountry')";

// Check if the primary key already exists
$checkDuplicateQuery = "SELECT * FROM address WHERE id = '$insertCarName'";
$checkDuplicateResult = mysqli_query($conn, $checkDuplicateQuery);

if (mysqli_num_rows($checkDuplicateResult) > 0) {
    // Show alert and redirect
    echo "<script>alert('ERROR: The primary key already exists. ID duplicated.'); window.location.href = 'selectAddress.php';</script>";
    exit();
} else {
    // Performing insert query execution
    if (mysqli_query($conn, $sql)) {
        // Show alert and redirect
        echo "<script>alert('Data stored in the database successfully.'); window.location.href = 'selectAddress.php';</script>";
        exit();
    } else {
        // Show alert and redirect
        echo "<script>alert('ERROR: Unable to execute $sql. " . mysqli_error($conn) . "'); window.location.href = 'selectAddress.php';</script>";
        exit();
    }
}

mysqli_close($conn);
?>
