<?php
include('dbconnection.php');

// Check if customer_id is set
if(isset($_REQUEST['id'])) {
    $cid = $_REQUEST['id'];
    
    // Prepare and execute SELECT statement to retrieve customer details
    $stmt = $connection->prepare("SELECT * FROM customer WHERE id = ?");
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['id'];
        $z = $row['name'];
        $y = $row['address'];
        $w = $row['email'];
        $v = $row['phone_number'];
        $w = $row['driver_licence_number'];
    } else {
        echo "Customer not found.";
    }
}

?>

<html>
<head>
    <title>Update Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        form {
            background-color: #fff;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
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
    <h2><u>Update Form of customer</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="id">ID:</label>
        <input type="number" name="id" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        
        <label for="driver_licence_number">Driver Licence Number:</label>
        <input type="number" name="driver_licence_number" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $driver_licence_number = $_POST['driver_licence_number'];

    // Update the customer in the database
    $stmt = $connection->prepare("UPDATE customer SET name=?, address=?, email=?, phone_number=?, driver_licence_number=? WHERE id=?");
    $stmt->bind_param("ssssii", $name, $address, $email, $phone_number, $driver_licence_number, $id);
    
    if ($stmt->execute()) {
          echo "<script>alert('customerupdated successfully.'); window.location.href = 'customer.php?id=$customer_id';</script>";

        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating customer: " . $stmt->error;
    }
}
?>
