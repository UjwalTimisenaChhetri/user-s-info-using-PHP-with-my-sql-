<?php
session_start(); // Start the PHP session, allowing access to session variables

// Check if user is logged in and session variables are set
if(isset($_SESSION['user_email'])) { // Check if user_email session variable is set
    $email = $_SESSION['user_email']; // Get user's email from session
    $firstName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : ''; // Get user's first name if set, otherwise set to empty string
    $lastName = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : ''; // Get user's last name if set, otherwise set to empty string
    $fullName = $firstName . ' ' . $lastName; // Concatenate first and last name to get full name
} else {
    // Handle the case where session variable is not set (user is not logged in)
    $email = 'Guest'; // Set default email to 'Guest' or any default value you want
    $firstName = ''; // Set default first name to empty string
    $lastName = ''; // Set default last name to empty string
}
$companyName = 'TechXpert Inc.'; // Set company name
$companyDescription = 'TechXpert Inc. is a leading technology company specializing in innovative solutions for businesses worldwide. We provide cutting-edge software, AI-powered applications, and expert consulting services to help businesses thrive in the digital age.'; // Set company description
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Specify character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Set viewport for responsiveness -->
    <title>Member Page</title> <!-- Set page title -->
    <link rel="stylesheet" href="css/memberstyle.css"> <!-- Link to external CSS file for styling -->
</head>
<body>
    <?php include 'templetes/header.php'; ?> <!-- Include the header template -->

    <div class="content">
        <h1>Welcome to the Member Page</h1> <!-- Heading -->
        <p>Your email: <?php echo $email; ?> is successfully connected with us.</p> <!-- Display user's email -->
        <p>Thank you <?php echo $fullName; ?> for trusting us</p> <!-- Display user's full name -->

        <h2>About <?php echo $companyName; ?></h2> <!-- Heading for company name -->
        <p><?php echo $companyDescription; ?></p> <!-- Display company description -->
    </div>

    <?php include 'templetes/footer.php'; ?> <!-- Include the footer template -->
</body>
</html>
