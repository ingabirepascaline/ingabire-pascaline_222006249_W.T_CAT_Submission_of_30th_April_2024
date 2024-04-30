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

// Check if payment_id is set
if(isset($_REQUEST['id'])) {
    $pid = $_REQUEST['id'];
    
    // Prepare and execute SELECT statement to retrieve payment details
    $stmt = $connection->prepare("SELECT * FROM payment WHERE id = ?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['id'];
        $z = $row['date'];
        $y = $row['amount'];
        $w = $row['payment_method'];
    } else {
        echo "Payment not found.";
    }
}
?>

<html>
<head>
    <style>
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 8px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
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
    <h2><u>Update Form of payment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="id">id:</label>
        <input type="number" name="id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="date">date:</label>
        <input type="text" name="date" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="amount">amount:</label>
        <input type="text" name="amount" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="payment_method">payment_method:</label>
        <input type="text" name="payment_method" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['id'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    // Update the payment in the database
    $stmt = $connection->prepare("UPDATE payment SET date=?, amount=?, payment_method=? WHERE id=?");
    $stmt->bind_param("sssi", $date, $amount, $payment_method, $id);
    
    if ($stmt->execute()) {
        // Redirect to payment.php after successful update
        header('Location: payment.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating payment: " . $stmt->error;
    }
}
?>
