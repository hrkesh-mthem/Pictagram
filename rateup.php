<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "insta";
$tablename = "gallary";
session_start();
// Connection to database
$connection=mysqli_connect("$servername","$username","$password","$dbname");
// Check connection
if (mysqli_connect_errno()) {
    echo 'NOT_OK';
    //echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Increasing the current value with 1
mysqli_query($connection,"UPDATE $tablename SET download = (download + 1) WHERE id = ' ".$id." ' ");

mysqli_close($connection);

echo 'OK';     ?>