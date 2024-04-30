<!DOCTYPE html>
<html lang="en">
<head>
<!-- official website designed by G8 on 24th march 2024-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>all in one</title>
    <style>
         .p1{
            font-family: Elephant;
            font-weight: bold;
            font-size: 20px;
            align-items: center;
        }
        form{
            width: 450px;
            height:300px;
        border: 2px  solid red;
        }
        tr{
            color: teal;
            font-size: 25px;
        }
        tr td{
            font-size: 20px;
            color:  teal;
            width: 100px;
            height: 40px;
        }
          tr td input{
            font-size: 20px;
            color:  yellow;
            width: 200px;
            height: 30px;
        }
    </style>
     <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmlogin() {
                return confirm('Are you sure you want to login?');
            }
        </script>
</head>
<body>

<center>
<form action="login.php" method="POST">
    <table><tr><h3  style="font-size: 20px;color: orange;"><i>LOGIN FORM</i></h3>
    </tr>
    <tr>
    <td>email</td>
    <td><input type="text" name="email"  required=""></td></tr>
    <tr><td>Password</td>
    <td><input type="password" name="password"  required=""></td></tr>
      <tr><td>    </td><td><input type="submit" name="send"  value="Login" style="background-color: black;color: white; width: 100px;">
    <input type="submit" name="send"  value="cancel" style="background-color: black;color: skyblue;width: 100px;"></td></tr>
    <tr><td><p>Do you have any account <td>click here for<a href="registration.php">SIGNUP</a></td></p></td></tr></table>
</form></center>
<div><footer style="background-color:green;text-align: center;width:100%;height:auto; color: white;font-size: 25px;"><p>&copy Designed by pacc nyampinga YEAR TWO BIT GROUP A &reg 2024</p></footer></div>
</body>
</html>