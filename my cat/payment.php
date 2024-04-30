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
            background-color: green;
            text-decoration: none;
            margin-right: 15px;
        }

        a:visited {
            color: orange;
        }

        a:link {
            color: pink;
        }

        a:hover {
            background-color: olive;
        }

        a:active {
            background-color: silver;
        }

        /* Styles for search button and input */
        button.btn {
            margin-left: 15px;
            margin-top: 4px;
            background-color: teal;
            border: none;
            color: white;
            padding: 8px 12px;
            cursor: pointer;
        }

        input.form-control {
            width: 200px;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Styles for table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: teal;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color:olive;
        }

        /* Styles for header and footer */
        header, footer {
            background-color: yellow;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        section {
            padding: 20px;
        }

        h1, h2 {
            margin-top: 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            display: inline;
            margin-right: 10px;
        }

        .dropdown-contents {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-contents a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown:hover .dropdown-contents {
            display: block;
        }
        dropdown {
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
  .dropdown:hover .dropdown-contents {
    display: block;
  }
  .dropdown-contents a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
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
    <ul>
        <li><a href="./home.html">HOME</a></li>
        <li><a href="./about.html">ABOUT</a></li>
        <li><a href="./contact.html">CONTACT</a></li>
        <li><a href="./car.html">CAR</a></li>
        <li><a href="./rental.html">RENTAL</a></li>
        <li><a href="./customer.html">CUSTOMER</a></li>
        <li><a href="./insurance.html">INSURANCE</a></li>
        <li><a href="./payment.html">PAYMENT</a></li>
        <li><a href="./reservation.html">RESERVATION</a></li>
        <li class="dropdown">
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
       
<h1><u> payment Form </u></h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="id">ID:</label><br>
        <input type="number" id="id" name="id" class="form-control"><br>

        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" required class="form-control"><br>

        <label for="amount">Amount:</label><br>
        <input type="text" id="amount" name="amount" required class="form-control"><br>

        <label for="payment_method">Payment Method:</label><br>
        <input type="text" id="payment_method" name="payment_method" required class="form-control"><br>

        <input type="submit" name="add" value="Insert" class="btn"><br><br>
    </form>
</center>
    <?php
    include('dbconnection.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepare and bind parameters for payment insertion
        $stmt = $connection->prepare("INSERT INTO payment (id, date, amount, payment_method) VALUES (?, ?, ?, ?)"); 
        $stmt->bind_param("isss", $id, $date, $amount, $payment_method);

        // Set parameters from form data
        $id = $_POST['id'];
        $date = $_POST['date'];
        $amount = $_POST['amount'];
        $payment_method = $_POST['payment_method'];
        
        // Execute the statement
        if ($stmt->execute() === TRUE) {
            echo "New record has been added successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }

    // Fetching data from the payment table
    $sql = "SELECT * FROM payment";
    $result = $connection->query($sql);
    ?>

    <h2>Table of Payment</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Payment Method</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // Output data from the payment table
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $pid = $row['id'];
                echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['date'] . "</td>
                    <td>" . $row['amount'] . "</td>
                    <td>" . $row['payment_method'] . "</td>
                    <td><a href='delete_payment.php?id=$pid'>Delete</a></td>
                    <td><a href='update_payment.php?payment_Id=$pid'>Update</a></td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
    <center><button style="background-color: skyblue; width: 150px;height: 40px;" ><a href="home.html" style=" font-size: 15px;color: white;text-decoration: none;margin-top: 400px;" >Back Home</a></button></center>
</body>

<div><footer style="background-color:teal;text-align: center;width:100%;height:auto; color: white;font-size: 25px; bottom: 0;position: fixed;">
</section>

<footer>
    <center> 
        <b><h2>UR CBE BIT &copy; 2024 &reg;, Designer by: @ingabire pascaline</h2></b>
    </center>
</footer>
</body>
</html>
