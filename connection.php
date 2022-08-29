<?php
/* initialise the connection variable*/
$servername = "localhost";
$username = "root";
$password = "";
$database="ajax";

/* Create connection */
$conn =mysqli_connect($servername, $username, $password,$database);
/* Check connection */
if (!$conn) {
    die (mysqli_connect($conn));
} 



?>
