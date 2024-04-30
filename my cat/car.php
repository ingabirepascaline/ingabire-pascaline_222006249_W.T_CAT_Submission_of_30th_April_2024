<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>




        /* Global styles for links */
        a {
            padding: 10px;
            color: white;
            background-color: green;
            text-decoration: none;
            margin-right: 15px;
        }

        a:visited {
            color: orange;
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

        /* Styles for form */
        form {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: yellow;
            max-width: 400px;
            margin: 0 auto;
        }

        form label {
            display: inline-block;
            width: 150px;
            margin-bottom: 10px;
        }

        form input[type="text"],
        form input[type="number"] {
            width: calc(100% - 170px);
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Styles for table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
             background-color: olive;
        }

        th {
            background-color: blue;
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
            <a href="#" class="dropdown-btn">Settings</a>
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
    <h1><u>Car Form</u></h1>
     <form method="post" onsubmit="return confirmInsert();">
            
        <label for="id">id:</label>
        <input type="number" id="id" name="id"><br><br>
        <label for="make">Make:</label>
        <input type="text" id="make" name="make" required><br><br>
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required><br><br>
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required><br><br>
        <label for="licence_plate_number">Licence Plate Number:</label>
        <input type="text" id="licence_plate_number" name="licence_plate_number" required><br><br>
        <label for="current_location">Current Location:</label>
        <input type="text" id="current_location" name="current_location" required><br><br>
        <input type="submit" name="add" value="Insert"><br><br>
    </form>
    
    <?php
    include('dbconnection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters for rental insertion
        $stmt = $connection->prepare("INSERT INTO car (Id, make, model, year, licence_plate_number, current_location) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $id, $make, $model, $year, $licence_plate_number, $current_location);

        // Set parameters from form data
        $id = $_POST['id'];
        $make = $_POST['make'];
        $model = $_POST['model'];
        $year = $_POST['year'];
        $licence_plate_number = $_POST['licence_plate_number'];
        $current_location= $_POST['current_location'];
        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Fetching data from the rental table
    $sql = "SELECT * FROM car";
    $result = $connection->query($sql);
    ?>

    <h2>Table of car</h2>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>make</th>
            <th>model</th>
            <th>year</th>
            <th>licence_plate_number</th>
            <th>current_location</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cid = $row['id']; // Corrected variable name
                echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['make'] . "</td>
                    <td>" . $row['model'] . "</td>
                    <td>" . $row['year'] . "</td>
                    <td>" . $row['licence_plate_number'] . "</td>
                    <td>" . $row['current_location'] . "</td>
                    <td><a href='delete_car.php?id=$cid'>Delete</a></td>
                    <td><a href='update_car.php?car_Id=$cid'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No data found</td></tr>";
        }
        ?>
    </table>
    <center><button style="background-color: ; width: 150px;height: 40px;" ><a href="home.html" style=" font-size: 15px;color: pink;text-decoration: none;margin-top: 400px;" >Back Home</a></button></center>
</body>

<div><footer style="background-color:teal;text-align: center;width:100%;height:auto; color: white;font-size: 25px; bottom: 0;position: fixed;">
</section>

<footer>
    <center><b><h2>UR CBE BIT &copy; 2024 &reg; Designed by: @ingabire pascaline</h2></b></center>
</footer>
</body>
</html>
