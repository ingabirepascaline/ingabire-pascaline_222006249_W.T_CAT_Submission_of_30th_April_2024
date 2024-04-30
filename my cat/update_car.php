<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Car Details</title>
    <style>
        /* Form styles */
        body {
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="number"],
        input[type="text"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Error message style */
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<?php
// Connection details
$host = "localhost";
$user = "root";
$pass = "";
$database = "car_reservation_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if car_id is set
if(isset($_REQUEST['id'])) {
    $cid = $_REQUEST['id'];
    
    // Prepare and execute SELECT statement to retrieve car details
    $stmt = $connection->prepare("SELECT * FROM car WHERE id = ?");
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['id'];
        $z = $row['make'];
        $y = $row['model'];
        $w = $row['year'];
        $v = $row['licence_plate_number'];
        $u = $row['current_location'];
    } else {
        echo "Car not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update car</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update products form -->
    <h2><u>Update Form of car</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">


    <label for="id">id:</label>
    <input type="number" name="id" value="<?php echo isset($x) ? $x : ''; ?>" readonly>
    <br>

    <label for="make">Make:</label>
    <input type="text" name="make" value="<?php echo isset($z) ? $z : ''; ?>">
    <br>
    
    <label for="model">Model:</label>
    <input type="text" name="model" value="<?php echo isset($y) ? $y : ''; ?>">
    <br>

    <label for="year">Year:</label>
    <input type="number" name="year" value="<?php echo isset($w) ? $w : ''; ?>">
    <br>

    <label for="licence_plate_number">Licence Plate Number:</label>
    <input type="text" name="licence_plate_number" value="<?php echo isset($v) ? $v : ''; ?>">
    <br>

    <label for="current_location">Current Location:</label>
    <input type="text" name="current_location" value="<?php echo isset($u) ? $u : ''; ?>">
    <br>
    
    <input type="submit" name="up" value="Update">
</form>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['id'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $licence_plate_number = $_POST['licence_plate_number'];
    $current_location = $_POST['current_location'];

    // Update the car in the database
    $stmt = $connection->prepare("UPDATE car SET make=?, model=?, year=?, licence_plate_number=?, current_location=? WHERE id=?");
    $stmt->bind_param("ssisss", $make, $model, $year, $licence_plate_number, $current_location, $id);
    
    if ($stmt->execute()) {
        // Redirect to car.php after successful update
        header('Location: car.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "<p class='error'>Error updating car: " . $stmt->error . "</p>";
    }
}
?>
</body>
</html>
