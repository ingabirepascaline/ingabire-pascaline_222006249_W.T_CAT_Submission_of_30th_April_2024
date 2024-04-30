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

// Check if insurance_id is set
if(isset($_REQUEST['id'])) {
    $cid = $_REQUEST['id'];
    
    // Prepare and execute SELECT statement to retrieve insurance details
    $stmt = $connection->prepare("SELECT * FROM insurance WHERE id = ?");
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['id'];
        $z = $row['type'];
        $y = $row['coverage_limit'];
        $w = $row['price'];
    } else {
        echo "Insurance not found.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Insurance</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        form {
            background-color: #fff;
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        label {
            display: block;
            margin-bottom: 10px;
        }
        
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

    ?>

<!DOCTYPE html>
<html>
<head>
    <title>Update products</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
   <center>
    <!-- Update products form -->
    <h2><u>Update Form of insurance</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">


        <label for="id">Id:</label>
        <input type="number" name="id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="type">Type:</label>
        <input type="text" name="type" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="coverage_limit">Coverage Limit:</label>
        <input type="number" name="coverage_limit" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['id'];
    $type = $_POST['type'];
    $coverage_limit = $_POST['coverage_limit'];
    $price = $_POST['price'];

    // Update the insurance in the database
    $stmt = $connection->prepare("UPDATE insurance SET type=?, coverage_limit=?, price=? WHERE id=?");
    $stmt->bind_param("sssi", $type, $coverage_limit, $price, $id);
    
    if ($stmt->execute()) {
        // Redirect to insurance.php after successful update
        header('Location: insurance.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating insurance: " . $stmt->error;
    }
}
?>
