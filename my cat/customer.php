<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>

        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Navigation menu styles */
        header {
            background-color: #333;
            padding: 10px 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        li {
            display: inline;
            margin-right: 10px;
        }

        li a {
            padding: 10px;
            color: black;
            background-color:yellow;
            text-decoration: none;
        }

        li a:hover {
            background-color: yellow;
        }

        /* Dropdown styles */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-contents {
            display: none;
            position: absolute;
            background-color: yellow;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-contents a {
            color:blue;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-contents a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-contents {
            display: block;
        }

        /* Form styles */
        section {
            padding: 20px;
             background-color: white;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
             background-color: orange;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: yellow;
            color: green;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: yellow;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: pink;

        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            background-color: teal;
        }

        th {
            background-color: green;
        }

        /* Footer styles */
        footer {
            background-color: olive;
            color: pink;
            padding: 20px 0;
            text-align: center;
        }
.dropdown {
    position: relative;
    display: inline;
    margin-right: 10px;

  }
   .dropdown-contents {
    display: none;
    position: absolute;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    left: 0; /* Aligning dropdown contents to the left */
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


    <ul>
        <li><a href="./home.html">HOME</a></li>
        <li><a href="./about.html">ABOUT</a></li>
        <li><a href="./contact.html">CONTACT</a></li>
        <li><a href="./car.php">CAR</a></li>
        <li><a href="./rental.html">RENTAL</a></li>
        <li><a href="./customer.html">CUSTOMER</a></li>
        <li><a href="./insurance.html">INSURANCE</a></li>
        <li><a href="./payment.html">PAYMENT</a></li>
        <li><a href="./reservation.html">RESERVATION</a></li>
        <li class="dropdown">
            <a href="#">Settings</a>
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
    <h1><u>Customer Form</u></h1>

    <form method="post" onsubmit="return confirmInsert();">
        <label for="id">ID:</label>
        <input type="number" id="id" name="id"><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required><br>
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" required><br>
        <label for="driver_licence_number">Driver Licence Number:</label>
        <input type="number" id="driver_licence_number" name="driver_licence_number" required><br>
        <input type="submit" name="add" value="Insert">
    </form>

    <?php
    include('dbconnection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters for rental insertion
        $stmt = $connection->prepare("INSERT INTO customer (Id, name, address, email, phone_number, driver_licence_number) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $id, $name, $address, $email, $phone_number, $driver_licence_number);

        // Set parameters from form data
        $id = $_POST['id'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $driver_licence_number = $_POST['driver_licence_number'];
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
    $sql = "SELECT * FROM customer";
    $result = $connection->query($sql);
    ?>

    <h2>Table of customer</h2>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Driver Licence Number</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cid = $row['id']; // Corrected variable name
                echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['phone_number'] . "</td>
                    <td>" . $row['driver_licence_number'] . "</td>
                    <td><a href='delete_customer.php?id=$cid'>Delete</a></td>
                    <td><a href='update_customer.php?customer_Id=$cid'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No data found</td></tr>";
        }
        ?>
    </table>

    <center><button style="background-color: red; width: 150px;height: 40px;" ><a href="home.html" style=" font-size: 15px;color: white;text-decoration: none;margin-top: 400px;" >Back Home</a></button></center>
    center>
</body>

<div><footer style="background-color:teal;text-align: center;width:100%;height:auto; color: white;font-size: 25px; bottom: 0;position: fixed;">

</section>

<footer>
    <center><b><h2>UR CBE BIT &copy; 2024 &reg; Designed by: @ingabire pascaline</h2></b></center>
</footer>
</body>
</html>
