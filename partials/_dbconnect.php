<?php

//Connecting to a database 
$server = "localhost";
$username = "root";
$password = "";
$database = "onlinetuitionmanagementsystem";

// create a connection
$conn = mysqli_connect($server, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect " . mysqli_connect_error());
}
else{
   // echo "connected";
}
?>

