<?php
session_start(); // Start the PHP session

// Checking if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validating form inputs
    $fullname = $_POST['fullname']; // Getting the full name from the form
    $email = $_POST['email']; // Getting the email from the form
    $message = $_POST['message']; // Getting the message from the form

    // Validation for all fields
    if(empty($fullname) || empty($email) || empty($message)) { // Checking if any field is empty
        $error = "Please fill in all fields."; // Error message for empty fields
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Checking if email format is valid
        $error = "Invalid email format."; // Error message for invalid email format
    } else {
        // Send email to site administrator
        $to = 'uzalxettri10@gmail.com'; // Administrator's email address
        $subject = 'Contact Form Submission'; // Email subject
        $body = "Name: $fullname\n"; // Email body with full name
        $body .= "Email: $email\n"; // Adding email to email body
        $body .= "Message:\n$message"; // Adding message to email body
        $headers = "From: $email"; // Email header with sender's email

        // Attempt to send the email
        if(mail($to, $subject, $body, $headers)) { // Sending email using mail() function
            // Email sent successfully
            $success = "Thank you for your message! We will get back to you soon."; // Success message
        } else {
            // Error sending email
            $error = "Oops! Something went wrong. Please try again later."; // Error message
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"> <!-- Specify character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title> <!-- Page title -->
    <link rel="stylesheet" href="css/contactstyle.css"> <!-- Link to external CSS file -->
</head>
<body>
    <?php include 'templetes/header.php'; ?> <!-- Including the header template -->
    <div class="main-content">
        <h2>Contact Us</h2> <!-- Heading for the contact form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> <!-- Form with method and action -->
            <input type="text" name="fullname" placeholder="Full Name"><br> <!-- Input field for full name -->
            <input type="email" name="email" placeholder="Email"><br> <!-- Input field for email -->
            <textarea name="message" placeholder="Message"></textarea><br> <!-- Textarea for message -->
            <input type="submit" value="Send"> <!-- Submit button -->
        </form>
        <?php if(isset($error)) { echo "<p>$error</p>"; } ?> <!-- Display error message if set -->
        <?php if(isset($success)) { echo "<p>$success</p>"; } ?> <!-- Display success message if set -->
    </div>
    <?php include 'templetes/footer.php'; ?> <!-- Including the footer template -->
</body>
</html>
