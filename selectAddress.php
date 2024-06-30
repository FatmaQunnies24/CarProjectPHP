
<html>
<head>
<header>  <link rel="stylesheet" href="style.css"></header>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
#res {
    text-align: left;
position: absolute;
    top: 20%;
    left: 160%;
    z-index: -522;
}
/* #res {
    text-align: left;
    position: fixed;
    top: 15%;
    left: 60%;
    z-index: -522;
} */
</style>
</head>

<body>
    
<?php
session_start();
if (!isset($_SESSION['username'])){
    header('Location: login.php');
    exit();
}
?>




<section>
    <a href="index.php" style="font-size: 18px; margin-left: 10px; margin-top: 7px; color: white; padding-top: 19px;">Back</a>
   <p> <br><br><br></p>

        <div class="form-box">
            <h2>Update , Insert ,search Address</h2>
            <form id="updateForm">
            <div id="demo"></div>

                <div class="input-container">
                    <div class="input-box">
                        <input type="text" required name="updateCarName" id="updateCarName" placeholder=" " style="z-index: 100;">
                        <label>id</label>
                        <span class="icon"><ion-icon name="car"></ion-icon></span>
                    </div>
                    <div class="input-box">
                        <input type="text" required name="updateCarModel" id="updateCarModel" placeholder=" ">
                        <label>buidling</label>
                        <span class="icon"><ion-icon name="construct"></ion-icon></span>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input-box">
                        <input type="text" required name="updateCarYear" id="updateCarYear" placeholder=" " >
                        <label>street</label>
                        <span class="icon"><ion-icon name="calendar"></ion-icon></span>
                    </div>
                    <div class="input-box">
                        <input type="text" required name="updateCarMade" id="updateCarMade" placeholder=" ">
                        <label>city</label>
                        <span class="icon"><ion-icon name="cog"></ion-icon></span>
                    </div>
                    <div class="input-container">
                    <div class="input-box" style="margin-top=-50px ">
                        <input type="text" required name="updateCar" id="updateCar" placeholder=" ">
                        <label>country</label>
                        <span class="icon"><ion-icon name="calendar"></ion-icon></span>
                    </div>
                </div>
                <button id="btnn" type="submit">Update Car</button>

            </form>

            <form id="insertForm" action="insert.php"  method="post">
                <div class="input-container">
                    <div class="input-box">
                        <input type="text" required name="insertCarName" id="insertCarName" placeholder=" ">
                        <label>id</label>
                        <span class="icon"><ion-icon name="car"></ion-icon></span>
                    </div>
                    <div class="input-box">
                        <input type="text" required name="insertCarModel" id="insertCarModel" placeholder=" ">
                        <label>buidling</label>
                        <span class="icon"><ion-icon name="construct"></ion-icon></span>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input-box">
                        <input type="text" required name="insertCarYear" id="insertCarYear" placeholder=" ">
                        <label>street</label>
                        <span class="icon"><ion-icon name="calendar"></ion-icon></span>
                    </div>
                    <div class="input-box">
                        <input type="text" required name="insertCarMade" id="insertCarMade" placeholder=" ">
                        <label>city</label>
                        <span class="icon"><ion-icon name="cog"></ion-icon></span>
                    </div>
                    <div class="input-container">
                    <div class="input-box">
                        <input type="text" required name="insertCar" id="insertCar" placeholder=" ">
                        <label>country</label>
                        <span class="icon"><ion-icon name="calendar"></ion-icon></span>
                    </div>
                    </div>     
   
    <button type="submit" id="btn">Insert Car</button>
</form>
           
            

            <div class="search-container">
                <input type="text" id="carName" placeholder="id">
                <button  id="myButton" type="submit">Search</button>
            </div>
        </div>
  

    <div id="res" ></div>

</section>


<script>
        $(document).ready(function () {
            // Function to load all data initially
            function loadAllData() {
                $.post("searchAddress.php", {},
                    function (data, status) {
                        $("#res").html(data);
                        $("#res table").addClass("result-table");
                    });
            }

            // Load all data initially
            loadAllData();

            // Handle search button click
            $("#myButton").click(function () {
                $.post("searchAddress.php", {
                    carName: $("#carName").val()
                },
                    function (data, status) {
                        $("#res").html(data);
                        $("#res table").addClass("result-table");
                    });
                }); });
    </script>
  <?php
$conn = mysqli_connect("localhost", "root", "", "cars");

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$insertCarName = isset($_REQUEST['insertCarName']) ? $_REQUEST['insertCarName'] : '';
$insertCarModel = isset($_REQUEST['insertCarModel']) ? $_REQUEST['insertCarModel'] : '';
$insertCarYear = isset($_REQUEST['insertCarYear']) ? $_REQUEST['insertCarYear'] : '';
$insertCarMade = isset($_REQUEST['insertCarMade']) ? $_REQUEST['insertCarMade'] : '';
$insertCar = isset($_REQUEST['insertCar']) ? $_REQUEST['insertCar'] : '';
$sql = "INSERT INTO address (id, buidling, street, city, country) VALUES ('$insertCarName', '$insertCarModel', '$insertCarYear', '$insertCarMade', '$insertCar')";
// Check if all required fields are not empty
if (!empty($insertCarName) && !empty($insertCarModel) && !empty($insertCarYear) && !empty($insertCarMade) && !empty($insertCar)) {
    // Check if the primary key already exists
    $checkDuplicateQuery = "SELECT * FROM address WHERE id = '$insertCarName'";
    $checkDuplicateResult = mysqli_query($conn, $checkDuplicateQuery);

    if (mysqli_num_rows($checkDuplicateResult) > 0) {
        echo "ERROR: The primary key already exists. id duplicated.";
    } else {
        // Performing insert query execution
        $sql = "INSERT INTO address (id, buidling, street, city, country) VALUES ('$insertCarName', '$insertCarModel', '$insertCarYear', '$insertCarMade', '$insertCar')";

        if (mysqli_query($conn, $sql)) {
            echo "<h3>Data stored in the database successfully.</h3>";
        } else {
            echo "ERROR: Unable to execute $sql. " . mysqli_error($conn);
        }
    }
} 
else {
    echo "ERROR: All required fields must be filled.";
}
    
mysqli_close($conn);
?>  

<!-- <?php
$conn = mysqli_connect("localhost", "root", "", "cars");

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['updateCarName'])) {
        // Handle update logic
        $updateCarName = mysqli_real_escape_string($conn, $_POST['updateCarName']);
        $updateCarModel = mysqli_real_escape_string($conn, $_POST['updateCarModel']);
        $updateCarYear = mysqli_real_escape_string($conn, $_POST['updateCarYear']);
        $updateCarMade = mysqli_real_escape_string($conn, $_POST['updateCarMade']);
        $updateCar = mysqli_real_escape_string($conn, $_POST['updateCar']);

        // Perform the update
        $sql = "INSERT INTO address (id, buidling, street, city, country) VALUES ('$insertCarName', '$insertCarModel', '$insertCarYear', '$insertCarMade', '$insertCar')";

        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['insertCarName'])) {
        // Handle insert logic
        $insertCarName = mysqli_real_escape_string($conn, $_POST['insertCarName']);
        $insertCarModel = mysqli_real_escape_string($conn, $_POST['insertCarModel']);
        $insertCarYear = mysqli_real_escape_string($conn, $_POST['insertCarYear']);
        $insertCarMade = mysqli_real_escape_string($conn, $_POST['insertCarMade']);
        $insertCarCountry = mysqli_real_escape_string($conn, $_POST['insertCar']);

        // Perform the insertion
        $sql = "INSERT INTO your_table_name (column1, column2, column3, column4, column5) VALUES ('$insertCarName', '$insertCarModel', '$insertCarYear', '$insertCarMade', '$insertCarCountry')";

        if (mysqli_query($conn, $sql)) {
            echo "Record inserted successfully";
        } else {
            echo "Error inserting record: " . mysqli_error($conn);
        }
    }
}

// Close the connection
mysqli_close($conn);
?> -->

<?php
$conn = mysqli_connect("localhost", "root", "", "cars");

if ($conn === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$updateCarName = isset($_REQUEST['updateCarName']) ? $_REQUEST['updateCarName'] : '';
$updateCarModel = isset($_REQUEST['updateCarModel']) ? $_REQUEST['updateCarModel'] : '';
$updateCarYear = isset($_REQUEST['updateCarYear']) ? $_REQUEST['updateCarYear'] : '';
$updateCarMade = isset($_REQUEST['updateCarMade']) ? $_REQUEST['updateCarMade'] : '';
$updateCar = isset($_REQUEST['updateCar']) ? $_REQUEST['updateCar'] : '';

// Check if all required fields are not empty
if (!empty($updateCarName) && !empty($updateCarModel) && !empty($updateCarYear) && !empty($updateCarMade) && !empty($updateCar)) {
    // Check if the primary key already exists
    $checkDuplicateQuery = "SELECT * FROM address WHERE id = '$updateCarName'";
    $checkDuplicateResult = mysqli_query($conn, $checkDuplicateQuery);

    // Check if the query was successful
    if ($checkDuplicateResult) {
        if (mysqli_num_rows($checkDuplicateResult) > 0) {
            // Performing update query execution
            $sql = "UPDATE address SET buidling = '$updateCarModel', street = '$updateCarYear', city = '$updateCarMade', country = '$updateCar' WHERE id = '$updateCarName'";

            if (mysqli_query($conn, $sql)) {
                echo "<h3>Data updated in the database successfully.</h3>";
            } else {
                echo "ERROR: Hush! Sorry " . mysqli_error($conn);
            }
        } else {
            echo "ERROR: The primary key does not exist. Cannot update a non-existent record.";
        }
    } else {
        echo "ERROR: Query failed. " . mysqli_error($conn);
    }
} else {
    echo "ERROR: All required fields must be filled.";
}

mysqli_close($conn);
?>
</body>
</html>
