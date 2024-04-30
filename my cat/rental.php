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
            background-color: white;
            margin: 0;
            padding: 0;
        }

        header {
            background-color:pink;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        section {
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            background-color: #fff;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        h1 {
            text-align: center;
            background-color: pink;
        }

        form {
            margin-top: 20px;
            padding: 20px;
            border-radius: 5px;
            background-color: green;
        }

        label {
            display: block;
            margin-bottom: 5px;
            padding: 5px;
            border-radius: 3px;
            background-color: silver;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: teal;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: blue;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            background-color: green;
            color: white;
        }

        th {
            background-color: orange;
        }

        footer {
            text-align: center;
            background-color: orange;
            color: #fff;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;

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
<center>

<section>
    
<h1><u> rental Form </u></h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="id">Id:</label>
        <input type="number" id="id" name="id"><br><br>
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required><br><br>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required><br><br>
        <label for="total_price">Total Price:</label>
        <input type="number" id="total_price" name="total_price" required><br><br>
        <input type="submit" name="add" value="Insert"><br><br>
    </form>
</center>
    <?php
include('dbconnection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters for rental insertion
        $stmt = $connection->prepare("INSERT INTO rental (id, start_date, end_date, total_price) VALUES (?, ?, ?, ?)"); 
        $stmt->bind_param("isss", $id, $start_date, $end_date, $total_price);

        // Set parameters from form data
        $id = $_POST['id'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $total_price = $_POST['total_price'];
        
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
    $sql = "SELECT * FROM rental";
    $result = $connection->query($sql);
    ?>

    <h2>Table of Rental</h2>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Total Price</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rid = $row['id']; // Corrected variable name
                echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['start_date'] . "</td>
                    <td>" . $row['end_date'] . "</td>
                    <td>" . $row['total_price'] . "</td>
                    <td><a href='delete_rental.php?id=$rid'>Delete</a></td>
                    <td><a href='update_rental.php?rental_Id=$rid'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        ?>
    </table>

    <center><button style="background-color: red; width: 150px;height: 80px;" ><a href="home.html" style=" font-size: 15px;color: white;text-decoration: none;margin-top: 400px;" >Back Home</a></button></center>
</section>

<footer style="background-color:teal;text-align: center;width:100%;height:auto; color: white;font-size: 25px; bottom: 0;position: fixed;">
    <center><b><h2>UR CBE BIT &copy; 2024 &reg; Designed by: @ingabire pascaline</h2></b></center>
</footer>
</body>
</html>
