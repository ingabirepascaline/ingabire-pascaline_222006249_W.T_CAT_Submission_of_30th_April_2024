<?php  
$servername="localhost";
$username="root";
$password="";
$dbname="car_reservation_system";
$connection=new mysqli($servername,$username,$password,$dbname);
if ($connection->connect_error) {
	die("connection failed.".$connection->connect_error);
}
$connection->select_db($dbname);
?>
