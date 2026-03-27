<?php
// XAMPP Default Credentials
$host = 'localhost'; 
$username = 'root';      
$password = '';         
$dbname = 'core_db';     

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
