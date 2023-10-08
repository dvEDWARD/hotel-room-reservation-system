<?php
$servername = "localhost"; // change to your server name if different
$username = "root"; // change to your MySQL username
$password = ""; // change to your MySQL password
$dbname = "test1"; // change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>