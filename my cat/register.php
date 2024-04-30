<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        .p1 {
            font-family: Elephant;
            font-weight: bold;
            font-size: 20px;
            align-items: center;
        }
        form {
            width: 500px;
            height: 500px;
            border: 2px solid red;

        }
        tr {
            color: teal;
            font-size: 25px;
        }
        tr td {
            font-size: 20px;
            color: teal;
            width: 300px;
            height: 40px;
        }
        tr td input {
            font-size: 20px;
            color: black;
            width: 300px;
            height: 40px;
        }
    </style>
</head>
<body>
<center>
    <form action="register.php" method="POST">
        <table>
            <tr><h3 style="font-size: 20px;color: green;"><i>CREATE ACCOUNT FORM</i></h3></tr>
            <tr><td>id</td><td><input type="text" name="id" id="id"></td></tr>
            <tr><td>firstname</td><td><input type="text" name="firstname" id="firstname"></td></tr>
            <tr><td>lastname</td><td><input type="text" name="lastname" id="lastname"></td></tr>
            <tr><td>email</td><td><input type="email" name="email" required></td></tr>
            <tr><td>password</td><td><input type="password" name="password" required></td></tr>
            <tr><td>username</td><td><input type="text" name="username" required></td></tr>
            <tr><td>telephone</td><td><input type="tel" name="telephone" required></td></tr>
            <tr><td>reservation_date</td><td><input type="date" name="reservation_date" required></td></tr>
            <tr><td></td><td><input type="submit" name="send" value="Register" style="width: 150px;background-color: orange;color: white;font-size: 30px;">
                    <input type="submit" name="send" value="Cancel" style="width: 150px;background-color:  blue;color: white;font-size: 30px;"></td></tr>
        </table>
    </form>

    <?php
    // Connection details
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "car_reservation_system";

    // Create connection
    $connection = new mysqli($host, $user, $pass, $dbname);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Prepare SQL statement using prepared statement
    $sql = "INSERT INTO user (firstname, lastname, email, password, username, telephone, reservation_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sssssss", $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_POST['username'], $_POST['telephone'], $_POST['reservation_date']);

    // Execute statement
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($stmt->execute()) {
            echo "Data inserted successfully<br>";
        } else {
            echo "Error inserting data: " . $connection->error;
        }
    }

    // Close statement and connection
    $stmt->close();
    $connection->close();
    ?>

    <div>
        <footer style="background-color:green;text-align: center;width:100%;height:auto; color: white;font-size: 25px;">
            <p>Designed by pascaline ingabire_222006249 &copy YEAR TWO BIT GROUP A &reg 2024</p>
        </footer>
    </div>
</center>
</body>
</html>
