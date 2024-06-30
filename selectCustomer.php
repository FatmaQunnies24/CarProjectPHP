
<html>
<head>
<header>  <link rel="stylesheet" href="style.css"></header>

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  
</head>
<style>
#res {
    text-align: left;
    position: fixed;
    top: 15%;
    left: 60%;
    z-index: -522;
}
</style>
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
            <h2>Update , Insert ,search customer</h2>
            <form id="updateForm">
                <div class="input-container">
                    <div class="input-box">
                        <input type="text" required name="updateCarName" id="updateCarName" placeholder=" ">
                        <label>id</label>
                        <span class="icon"><ion-icon name="car"></ion-icon></span>
                    </div>
                    <div class="input-box">
                        <input type="text" required name="updateCarModel" id="updateCarModel" placeholder=" ">
                        <label>f_name</label>
                        <span class="icon"><ion-icon name="construct"></ion-icon></span>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input-box">
                        <input type="text" required name="updateCarYear" id="updateCarYear" placeholder=" ">
                        <label>l_name</label>
                        <span class="icon"><ion-icon name="calendar"></ion-icon></span>
                    </div>
                    <div class="input-box">
                        <!-- <input type="text" required name="updateCarMade" id="updateCarMade" placeholder=" ">
                        <label>Car Made</label>
                        <span class="icon"><ion-icon name="cog"></ion-icon></span> -->
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

// Fetch car names from car table
$carNamesQuery = $conn->query("SELECT id FROM address");
?>


<select id="carNames" name="updateCarMade">
    <option value="" >address</option>
    <?php
    while ($rowCar = $carNamesQuery->fetch_assoc()) {
        echo "<option value='" . $rowCar["id"] . "'>" . $rowCar["id"] . "</option>";
    }
    ?>
</select>

                    </div>
                    <div class="input-box">
                        <input type="text" required name="updateCar" id="updateCar" placeholder=" ">
                        <label>job</label>
                        <span class="icon"><ion-icon name="construct"></ion-icon></span>
                    </div>
                </div>
                <button id="btnn" type="submit">Update Car</button>

            </form>

            <form id="insertForm" method="post">
                <div class="input-container">
                    <div class="input-box">
                        <input type="text" required name="insertCarName" id="insertCarName" placeholder=" ">
                        <label>id</label>
                        <span class="icon"><ion-icon name="car"></ion-icon></span>
                    </div>
                    <div class="input-box">
                        <input type="text" required name="insertCarModel" id="insertCarModel" placeholder=" ">
                        <label>f_name</label>
                        <span class="icon"><ion-icon name="construct"></ion-icon></span>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input-box">
                        <input type="text" required name="insertCarYear" id="insertCarYear" placeholder=" ">
                        <label>l_name</label>
                        <span class="icon"><ion-icon name="calendar"></ion-icon></span>
                    </div>
                    <div class="input-box">
                        <!-- <input type="text" required name="insertCarMade" id="insertCarMade" placeholder=" ">
                        <label>Car Made</label>
                        <span class="icon"><ion-icon name="cog"></ion-icon></span> -->
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

// Fetch car names from car table
$carNamesQuery = $conn->query("SELECT id FROM address");
?>


<select id="carNames" name="insertCarMade">
    <option value="" > address</option>
    <?php
    while ($rowCar = $carNamesQuery->fetch_assoc()) {
        echo "<option value='" . $rowCar["id"] . "'>" . $rowCar["id"] . "</option>";
    }
    ?>
</select>
                    </div>
                    <div class="input-box">
                        <input type="text" required name="insertCar" id="insertCar" placeholder=" ">
                        <label>job</label>
                        <span class="icon"><ion-icon name="construct"></ion-icon></span>
                    </div>
                </div>
                <form id="formins" method="post" action="insertCar.php">
   
    <button type="submit" id="btn">Insert Car</button>
</form>
            </form>
            

            <div class="search-container">
                <input type="text" id="carName" placeholder="id">
                <button  id="myButton" type="submit">Search</button>
            </div>
        </div>
  

    <div id="res"></div>

</section>

    <script>
        $(document).ready(function () {
            // Function to load all data initially
            function loadAllData() {
                $.post("searchCustomer.php", {},
                    function (data, status) {
                        $("#res").html(data);
                        $("#res table").addClass("result-table");
                    });
            }

            // Load all data initially
            loadAllData();

            // Handle search button click
            $("#myButton").click(function () {
                $.post("searchCustomer.php", {
                    carName: $("#carName").val()
                },
                    function (data, status) {
                        $("#res").html(data);
                        $("#res table").addClass("result-table");
                    });
            });
          
            // Handle insert form submission
            // $("#btn").submit(function (event) {
            //     event.preventDefault();

            //     $.post("insertCar.php", formin,
            //         function (data, status) {
            //             // Reload data after insertion
            //             loadAllData();
            //             // Clear insert form fields
            //             $("#insertForm")[0].reset();
            //         });
            // });

            // Handle update made form submission
            // $("#updateMadeForm").submit(function (event) {
            //     event.preventDefault();

            //     $.post("updateCar.php", {
            //         updatedName: $("input[name='updateCarName']").val(),
            //         updatedMade: $("input[name='updateCarMade']").val(),
            //     },
            //         function (data, status) {
            //             // Reload data after update
            //             loadAllData();
            //             // Clear update made form fields
            //             $("#updateMadeForm")[0].reset();
            //         });
            // });
        });
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

// Check if all required fields are not empty
if (!empty($insertCarName) && !empty($insertCarModel) && !empty($insertCarYear) && !empty($insertCarMade) && !empty($insertCar)) {
    // Check if the primary key already exists
    $checkDuplicateQuery = "SELECT * FROM customer WHERE id = '$insertCarName'";
    $checkDuplicateResult = mysqli_query($conn, $checkDuplicateQuery);

    if ($checkDuplicateResult !== false) {
        // Check if any rows were returned
        if (mysqli_num_rows($checkDuplicateResult) > 0) {
            echo "ERROR: The primary key already exists. ID duplicated.";
        } else {
            // Performing insert query execution
            $sql = "INSERT INTO customer (id, f_name, l_name, address, job) VALUES ('$insertCarName', '$insertCarModel', '$insertCarYear', '$insertCarMade', '$insertCar')";

            if (mysqli_query($conn, $sql)) {
                echo "<h3>Data stored in the database successfully.</h3>";
            } else {
                echo "ERROR: Unable to execute $sql. " . mysqli_error($conn);
            }
        }
    } else {
        echo "ERROR: Unable to execute SELECT query. " . mysqli_error($conn);
    }
} else {
    echo "ERROR: All required fields must be filled.";
}

mysqli_close($conn);
?>


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
    $checkDuplicateQuery = "SELECT * FROM customer WHERE id = '$updateCarName'";
    $checkDuplicateResult = mysqli_query($conn, $checkDuplicateQuery);

    if ($checkDuplicateResult) {
        // Check if any rows were returned
        if (mysqli_num_rows($checkDuplicateResult) > 0) {
            // Performing update query execution
            $sql = "UPDATE customer SET f_name = '$updateCarModel', l_name = '$updateCarYear', address = '$updateCarMade', job = '$updateCar' WHERE id = '$updateCarName'";

            if (mysqli_query($conn, $sql)) {
                echo "<h3>Data updated in the database successfully.</h3>";
            } else {
                echo "ERROR: Unable to execute update query. " . mysqli_error($conn);
            }
        } else {
            echo "ERROR: The primary key does not exist. Cannot update non-existent record.";
        }
    } else {
        echo "ERROR: Unable to execute SELECT query. " . mysqli_error($conn);
    }
} else {
    echo "ERROR: All required fields must be filled.";
}

mysqli_close($conn);
?>





</body>

</html>
