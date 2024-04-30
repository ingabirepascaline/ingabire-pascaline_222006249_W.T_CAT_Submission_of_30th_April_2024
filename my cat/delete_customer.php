<?php
// Connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "car_reservation_system";

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if id is set and is a positive integer
if(isset($_REQUEST['id']) && is_numeric($_REQUEST['id']) && $_REQUEST['id'] > 0) {
    $id = $_REQUEST['id']; // No need to escape, prepared statements handle it

    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM customer WHERE id=?");
    if($stmt) {
        $stmt->bind_param("i", $id);


         ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        if ($stmt->execute()) {
            // Redirect to customer.php after successful deletion
            header('Location: customer.php?msg=Data deleted successfully');
            exit(); // Ensure no other content is sent after redirection
        } else {
            echo "Error executing deletion: " . $stmt->error;


        }
         }

     ?>
</body>
</html>
<?php
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();
?>
</body>
</html> 