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
            color: pink;
            background-color:teal ;
            text-decoration: none;
            margin-right: 15px;
        }

        a:visited {
            color: white;
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
        .btn {
            margin-left: 15px;
            margin-top: 4px;
            background-color: blue;
            border: none;
            color: pink;
            padding: 8px 12px;
            cursor: pointer;
        }

        .form-control {
            width: 200px; /* Adjust width as needed */
            padding: 8px;
            margin-bottom: 10px;
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
            background-color: yellow;
        }

        th {
            background-color: teal;
        }

        /* Styles for footer */
        footer {
            text-align: center;
            background-color: green;
            color: white;
            padding: 20px 0;
        }
    </style>
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
<center>
<section>
    <h1><u>Insurance Form</u></h1>
    <form method="post">
        <label for="id">Id:</label>
        <input type="number" id="id" name="id" class="form-control"><br>

        <label for="type">Type:</label>
        <input type="text" id="type" name="type" required class="form-control"><br>

        <label for="coverage_limit">Coverage Limit:</label>
        <input type="number" id="coverage_limit" name="coverage_limit" required class="form-control"><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required class="form-control"><br>

        <input type="submit" name="add" value="Insert" class="btn"><br><br>
    </form>
</center>
    <?php
   include('dbconnection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters for insurance insertion
        $stmt = $connection->prepare("INSERT INTO insurance (Id, type, coverage_limit, price) VALUES (?, ?, ?, ?)"); 
        $stmt->bind_param("isii", $id, $type, $coverage_limit, $price);

        // Set parameters from form data
        $id = $_POST['id'];
        $type = $_POST['type'];
        $coverage_limit = $_POST['coverage_limit'];
        $price = $_POST['price'];
        
        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Fetching data from the insurance table
    $sql = "SELECT * FROM insurance";
    $result = $connection->query($sql);
    ?>

    <h2>Table of Insurance</h2>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Type</th>
            <th>Coverage Limit</th>
            <th>Price</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $iid = $row['id']; // Corrected variable name
                echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['type'] . "</td>
                    <td>" . $row['coverage_limit'] . "</td>
                    <td>" . $row['price'] . "</td>
                    <td><a href='delete_insurance.php?id=$iid'>Delete</a></td>
                    <td><a href='update_insurance.php?insurance_Id=$iid'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        ?>
    </table>
    <center><button style="background-color: indigo; width: 150px;height: 40px;" ><a href="home.html" style=" font-size: 15px;color: white;text-decoration: none;margin-top: 400px;" >Back Home</a></button></center>
</body>

<div><footer style="background-color:teal;text-align: center;width:100%;height:auto; color: white;font-size: 25px; bottom: 0;position: fixed;">
</section>

<footer>
    <center><b><h2>UR CBE BIT &copy; 2024 &reg; Designed by: @ingabire pascaline</h2></b></center>
</footer>
</body>
</html>
