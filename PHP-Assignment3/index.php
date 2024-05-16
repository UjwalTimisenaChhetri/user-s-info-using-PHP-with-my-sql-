<?php
session_start(); // Start the PHP session

require_once 'templetes/header.php'; // Include the header template
include 'config/dbconfig.php'; // Include the database configuration file

// Redirect to member.php if user is already logged in
if(isset($_SESSION['user_email'])) {
    header("Location: member.php");
    exit();
}

// Check if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form inputs
    $email = $_POST['email']; // Get email from the form
    $password = $_POST['password']; // Get password from the form

    // Validation for all fields
    if(empty($email) || empty($password)) { // Check if email or password is empty
        $error = "Please fill in all fields."; // Set error message if empty
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Validate email format
        $error = "Invalid email format."; // Set error message if email format is invalid
    } else {
        // Check if user exists in the database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->execute([$email, $password]);
        $user = $stmt->fetch();

        if($stmt->rowCount() > 0) { // If user exists
            // Save user information into session variables
            $_SESSION['user_email'] = $email;
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
        
            // Redirect to member.php after successful login
            header("Location: member.php");
            exit();
        } else {
            $error = "Invalid email or password."; // Set error message for invalid credentials
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    
    <div class="main-content">
        <h2>Welcome to the Website</h2>
        <p>Please log in to continue:</p>
        <!-- Login form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="email" name="email" placeholder="Email"><br> <!-- Email input field -->
            <input type="password" name="password" placeholder="Password"><br> <!-- Password input field -->
            <input type="submit" value="Login"> <!-- Submit button -->
        </form>
        <!-- Link to registration page -->
        <a href="registor.php"> Sign Up </a>
        <?php if(isset($error)) { echo "<p>$error</p>"; } ?> <!-- Display error message if set -->
    </div>
    <?php include 'templetes/footer.php'; ?> <!-- Include the footer template -->
</body>
</html>
