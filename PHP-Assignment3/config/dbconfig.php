<?php
// Database configuration
$host = 'localhost'; // Database server hostname
$dbname = 'accounts'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password (if any)

// Data Source Name (DSN) for PDO connection
$dsn = "mysql:host=$host;dbname=$dbname; port=3307";

try {
    // Attempt to establish a connection to the database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Additional code for database operations can be added here
    
} catch(PDOException $e) {
    // Handle database connection errors
    echo "Database Connection failed: " . $e->getMessage();
    // Throw a PDOException to propagate the error
    throw new PDOException($e->getMessage());
}
?>
