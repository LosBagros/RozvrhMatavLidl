<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lidlrozvrh";

// Připojení k databázi
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Připojení k databázi se nezdařilo: " . $conn->connect_error);
}
?>