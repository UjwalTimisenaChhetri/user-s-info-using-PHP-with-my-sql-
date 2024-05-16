<!-- header.php -->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PHP Final Assignment</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="container">
<header id="banner">
<h1>Final Assignment</h1>
<h3>Users' Info Using PHP with MySQL</h3>
</header>
<div id="nav">
<ul>
<li><a href="index.php">Home</a></li>
<?php
session_start(); // Start the PHP session to access session variables

// Check if user is logged in and on the member.php page
if(isset($_SESSION['user_email']) && basename($_SERVER['PHP_SELF']) == 'member.php') {
    // Display "Logout" link if logged in and on member.php
    echo '<li><a href="logout.php">Logout</a></li>';
} 
// Check if user is not logged in and on index.php or contact.php
elseif(!isset($_SESSION['user_email']) && (basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == 'contact.php')) {
    // Display "Register" link if not logged in and on index.php or contact.php
    echo '<li><a href="registor.php">Register</a></li>';
} 
?>
<li><a href="contact.php">Contact</a></li>
</ul>
</div>
<div class="main-content">
