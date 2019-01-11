<?php
$servername = "localhost";
$username = "root";
$password = "Mane1997";
$dbname = "bottyivan_thomas";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die($conn->connect_error);
} 

$sql_db = "USE ".$dbname;
if (!$conn->query($sql_db) === TRUE) {
    echo $conn->error;
}
?>