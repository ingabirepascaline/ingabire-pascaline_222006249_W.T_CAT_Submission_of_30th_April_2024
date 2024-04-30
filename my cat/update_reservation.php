<?php
// Connection details
$host = "localhost";
$user = "root";
$pass = "";
$database = "car_reservation_system"; // Removed spaces from database name

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Function to sanitize user input
function sanitize_input($data) {
    return htmlspecialchars(strip_tags($data));
}

// Check if id is set and sanitize input
if(isset($_REQUEST['id'])) {
    $cid = sanitize_input($_REQUEST['id']);
    
    // Prepare and execute SELECT statement to retrieve reservation details
    $stmt = $connection->prepare("SELECT * FROM reservation WHERE id = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $connection->error);
    }
    
    $stmt->bind_param("i", $cid); // Corrected variable name from $pid to $cid
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['id'];
        $z = $row['date'];
    } else {
        echo "Reservation not found."; // Corrected spelling of reservation
    }
}

?>

<html>
<head>
  <style>
    /* Form container */
    form {
      width: 50%;
      margin: 50px auto;
      padding: 20px;
      background-color: #f2f2f2;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    /* Form labels */
    label {
      display: block;
      margin-bottom: 10px;
      color: #333;
    }

    /* Form input fields */
    input[type="number"],
    input[type="date"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-bottom: 20px;
    }

    /* Submit button */
    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    /* Submit button on hover */
    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>


?>

<!DOCTYPE html>
<html>
<head>
    <title>Update rental</title>
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
    <h2><u>Update Form of reservation</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="id">ID:</label>
    <input type="number" name="id" value="<?php echo isset($x) ? $x : ''; ?>">
    <br><br>

    <label for="date">Date:</label>
    <input type="date" name="date" value="<?php echo isset($z) ? $z : ''; ?>">
    <br><br>
    
    <input type="submit" name="up" value="Update">
  </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form and sanitize input
    $id = sanitize_input($_POST['id']);
    $date= sanitize_input($_POST['date']);
    
    // Update the reservation in the database
    $stmt = $connection->prepare("UPDATE reservation SET date = ? WHERE id = ?");
    if (!$stmt) {
        die("Error preparing statement: " . $connection->error);
    }
    
    $stmt->bind_param("si", $date, $id); // Corrected binding parameters
    if ($stmt->execute()) {
        // Redirect to reservation.php after successful update
        header('Location: reservation.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating reservation: " . $stmt->error;
    }
}
?>
