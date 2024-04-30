<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        /* Global styles for links */
        a {
            padding: 10px;
            color: white;
            background-color: teal;
            text-decoration: none;
            margin-right: 15px;
        }

        a:visited {
            color: purple;
        }

        a:link {
            color: brown;
        }

        a:hover {
            background-color: white;
        }

        a:active {
            background-color: red;
        }

        /* Styles for search button and input */
        button.btn {
            margin-left: 15px;
            margin-top: 4px;
            background-color: blue;
            border: none;
        }

        input.form-control {
            width: 200px; /* Adjust width as needed */
            padding: 8px;
        }

        /* Styles for table */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: green;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            background-color: skyblue;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

    <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body>
<header>
    <!-- Navigation Menu -->
    <ul style="list-style-type: none; padding: 0;">
        <li style="display: inline;"><a href="./home.html">HOME</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./car.php">CAR</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./rental.html">RENTAL</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./customer.html">CUSTOMER</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./insurance.html">INSURANCE</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./payment.html">PAYMENT</a></li>
        <li style="display: inline; margin-right: 10px;"><a href="./reservation.html">RESERVATION</a></li>
        <li class="dropdown" style="display: inline; margin-right: 10px;">
            <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
            <div class="dropdown-contents">
                <!-- Dropdown Links -->
                <a href="login.html">Login</a>
                <a href="register.html">Register</a>
                <a href="logout.php">Logout</a>
            </div>
        </li>
    </ul>
</header>

<section>
<center>          
<h1><u> reservation Form </u></h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="id">id:</label>
        <input type="number" id="id" name="id"><br><br>
        <label for="date">date:</label>
        <input type="text" id="date" name="date" required><br><br>
        
        <input type="submit" name="add" value="Insert"><br><br>
    </form>
</center>
<?php 
 include('dbconnection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO reservation(Id, date) VALUES (?, ?)"); 
    $stmt->bind_param("is", $id, $date);

    // Set parameters
    $id = $_POST['id'];
    $date = $_POST['date'];
    
    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>

<?php
// SQL query to fetch data from the reservation table
$sql = "SELECT * FROM reservation";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of reservation</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of reservation</h2></center>
    <table border="5">
        <tr>
            <th>id</th>
            <th>date</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Check if there are any reservations
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $rid = $row['id']; // Fetch the reservation ID
                echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['date'] . "</td>
                    <td><a style='padding:4px' href='delete_reservation.php?id=$rid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_reservation.php?reservation_Id=$rid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>



    <center><button style="background-color: yellow; width: 150px;height: 40px;" ><a href="home.html" style=" font-size: 15px;color: white;text-decoration: none;margin-top: 400px;" >Back Home</a></button></center>
</body>

<div><footer style="background-color:teal;text-align: center;width:100%;height:auto; color: white;font-size: 25px; bottom: 0;position: fixed;">
</body>
</html>

</section>
  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy; 2024 &reg;, Designed by: @ingabire pascaline</h2></b>
  </center>
</footer>
</body>
</html>
