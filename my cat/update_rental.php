<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Form</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="number"],
        input[type="date"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
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
    <h2><u>Update Form of rental</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="id">ID:</label>
    <input type="number" id="id" name="id" value="<?php echo isset($x) ? $x : ''; ?>">

    <label for="start_date">Start Date:</label>
    <input type="date" id="start_date" name="start_date" value="<?php echo isset($z) ? $z : ''; ?>">

    <label for="end_date">End Date:</label>
    <input type="date" id="end_date" name="end_date" value="<?php echo isset($y) ? $y : ''; ?>">

    <label for="total_price">Total Price:</label>
    <input type="text" id="total_price" name="total_price" value="<?php echo isset($w) ? $w : ''; ?>">

    <input type="submit" name="up" value="Update">
</form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $total_price = $_POST['total_price'];
   
    // Update the rental in the database
    $stmt = $connection->prepare("UPDATE rental SET start_date=?, end_date=?, total_price=? WHERE id=?");
    $stmt->bind_param("sssi", $start_date, $end_date, $total_price, $id);
    
    if ($stmt->execute()) {
        // Redirect to rental.php after successful update
        header('Location: rental.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating rental: " . $stmt->error;
    }
}
?>
