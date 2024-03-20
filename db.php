<?php
// file db.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "online_coffee_ordering";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
