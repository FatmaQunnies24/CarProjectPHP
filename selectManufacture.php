
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
            <h2>Update , Insert ,search manufacture</h2>
            <form id="updateForm">
                <div class="input-container">
                    <div class="input-box">
                        <input type="text" required name="updateCarName" id="updateCarName" placeholder=" ">
                        <label>name</label>
                        <span class="icon"><ion-icon name="car"></ion-icon></span>
                    </div>
                    <div class="input-box">
                        <input type="text" required name="updateCarModel" id="updateCarModel" placeholder=" ">
                        <label>type</label>
                        <span class="icon"><ion-icon name="construct"></ion-icon></span>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input-box">
                        <input type="text" required name="updateCarYear" id="updateCarYear" placeholder=" ">
                        <label>city</label>
                        <span class="icon"><ion-icon name="calendar"></ion-icon></span>
                    </div>
                    <div class="input-box">
                        <input type="text" required name="updateCarMade" id="updateCarMade" placeholder=" ">
                        <label>country</label>
                        <span class="icon"><ion-icon name="cog"></ion-icon></span>
                    </div>
                </div>
                <button id="btnn" type="submit">Update Car</button>

            </form>

            <form id="insertForm" method="post">
                <div class="input-container">
                    <div class="input-box">
                        <input type="text" required name="insertCarName" id="insertCarName" placeholder=" ">
                        <label>name</label>
                        <span class="icon"><ion-icon name="car"></ion-icon></span>
                    </div>
                    <div class="input-box">
                        <input type="text" required name="insertCarModel" id="insertCarModel" placeholder=" ">
                        <label>type</label>
                        <span class="icon"><ion-icon name="construct"></ion-icon></span>
                    </div>
                </div>
                <div class="input-container">
                    <div class="input-box">
                        <input type="text" required name="insertCarYear" id="insertCarYear" placeholder=" ">
                        <label>city</label>
                        <span class="icon"><ion-icon name="calendar"></ion-icon></span>
                    </div>
                    <div class="input-box">
                        <input type="text" required name="insertCarMade" id="insertCarMade" placeholder=" ">
                        <label>country</label>
                        <span class="icon"><ion-icon name="cog"></ion-icon></span>
                    </div>
                </div>
                <form id="formins" method="post" action="insertCar.php">
   
    <button type="submit" id="btn">Insert Car</button>
</form>
            </form>
            

            <div class="search-container">
                <input type="text" id="carName" placeholder="name">
                <button  id="myButton" type="submit">Search</button>
            </div>
        </div>
  

    <div id="res"></div>

</section>

    <script>
        $(document).ready(function () {
            // Function to load all data initially
            function loadAllData() {
                $.post("searchManufacture.php", {},
                    function (data, status) {
                        $("#res").html(data);
                        $("#res table").addClass("result-table");
                    });
            }

            // Load all data initially
            loadAllData();

            // Handle search button click
            $("#myButton").click(function () {
                $.post("searchManufacture.php", {
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

// Check if all required fields are not empty
if (!empty($insertCarName) && !empty($insertCarModel) && !empty($insertCarYear) && !empty($insertCarMade)) {
    // Check if the primary key already exists
    $checkDuplicateQuery = "SELECT * FROM Manufacture WHERE name = '$insertCarName'";
    $checkDuplicateResult = mysqli_query($conn, $checkDuplicateQuery);

    if (mysqli_num_rows($checkDuplicateResult) > 0) {
        echo "ERROR: The primary key already exists. id duplicated.";
    } else {
        // Performing insert query execution

        $sql = "INSERT INTO Manufacture (name, type, city, country) VALUES ('$insertCarName', '$insertCarModel', '$insertCarYear', '$insertCarMade')";

        if (mysqli_query($conn, $sql)) {
            echo "<h3>Data stored in the database successfully.</h3>";
        } else {
            echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
        }
    }
} else {
   
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

// Check if all required fields are not empty
if (!empty($updateCarName) && !empty($updateCarModel) && !empty($updateCarYear) && !empty($updateCarMade)) {
    // Check if the primary key already exists
    $checkDuplicateQuery = "SELECT * FROM Manufacture WHERE name = '$updateCarName'";
    $checkDuplicateResult = mysqli_query($conn, $checkDuplicateQuery);

    if (mysqli_num_rows($checkDuplicateResult) > 0) {
        // Performing update query execution
        $sql = "UPDATE Manufacture SET type = '$updateCarModel', city = '$updateCarYear', country = '$updateCarMade' WHERE name = '$updateCarName'";

        if (mysqli_query($conn, $sql)) {
            echo "<h3>Data updated in the database successfully.</h3>";
        } else {
            echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
        }
    } else {
        echo "ERROR: The primary key does not exist. Cannot update non-existent record.";
    }
} else {
    echo "be careful All required fields must be filled.";
}

mysqli_close($conn);
?>






</body>

</html>
