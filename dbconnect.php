<?php 
$host="localhost";
$username="ryt";
$pass='ryt';
$db="ryt";

$conn=mysqli_connect($host,$username,$pass,$db);

if(!$conn){"failed".mysqli_connect_error($conn);};
?>