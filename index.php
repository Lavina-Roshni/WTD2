<?php
$server_name="db";
$username="root";
$password="root";
$database_name="tnpothole";

$conn = mysqli_connect($server_name,$username,$password,$database_name);
//now check the connection
if(!$conn)
{
	die("Connection Failed:" . mysqli_connect_error());

}
if($conn)
{
	die("Connection executed");

}
?>
