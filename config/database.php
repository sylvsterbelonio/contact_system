<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'contact_system');
define('DB_PORT',4306);

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME,DB_PORT);

// Check connection
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// echo 'Connected successfully';
