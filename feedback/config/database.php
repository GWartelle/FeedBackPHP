<?php
define("DB_HOST", "localhost");
define("DB_USER", "gabriel");
define("DB_PASS", "123456");
define("DB_NAME", "FeedBackPHP");

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection Failed " . $conn->connect_error);
}
