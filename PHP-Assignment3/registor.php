<?php
session_start(); // Start the PHP session

// Checking if the user is already logged in
if(isset($_SESSION['user_email'])) { // Check if user_email session variable is set
    header("Location: member.php"); // Redirect to member.php if user is already logged in
    exit(); // Exit the script
}

// Including database configuration
include 'config/dbconfig.php'; // Include the database configuration file

// Checking if the form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") { // Check if the form is submitted
    // Validating form inputs
    $firstname = $_POST['firstname']; // Get first name from the form
    $lastname = $_POST['lastname']; // Get last name from the form
    $email = $_POST['email']; // Get email from the form
    $password = $_POST['password']; // Get password from the form

    // Validating for all fields
    if(empty($firstname) || empty($lastname) || empty($email) || empty($password)) { // Check if any field is empty
        $error = "Please fill in all fields."; // Set error message if any field is empty
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Validate email format
        $error = "Invalid email format."; // Set error message if email format is invalid
    } else {
        // Checking if email already exists in the database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?"); // Prepare SQL statement
        $stmt->execute([$email]); // Execute SQL statement with email parameter
        $existingUser = $stmt->fetch(); // Fetch the result

        if($existingUser) { // If email already exists in the database
            $error = "Email already exists. Please choose a different one."; // Set error message
        } else {
            // Inserting new user into the database
            $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)"); // Prepare SQL statement
            $stmt->execute([$firstname, $lastname, $email, $password]); // Execute SQL statement with user data

            // Save user information into session
            $_SESSION['user_email'] = $email; // Set user_email session variable
            $_SESSION['first_name'] = $firstname; // Save first name in session
            $_SESSION['last_name'] = $lastname; // Save last name in session

            // Redirect to member.php
            header("Location: member.php"); // Redirect to member.php page
            exit(); // Exit the script
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8"> <!-- Specify character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title> <!-- Set page title -->
    <link rel="stylesheet" href="css/registorstyle.css"> <!-- Link to external CSS file for styling -->
</head>
<body>
    <?php include 'templetes/header.php'; ?> <!-- Include the header template -->
    <div class="main-content">
        <h2>Registration Form</h2> <!-- Heading for registration form -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> <!-- Form for user registration -->
            <input type="text" name="firstname" placeholder="First Name"><br> <!-- First name input field -->
            <input type="text" name="lastname" placeholder="Last Name"><br> <!-- Last name input field -->
            <input type="email" name="email" placeholder="Email"><br> <!-- Email input field -->
            <input type="password" name="password" placeholder="Password"><br> <!-- Password input field -->
            <input type="submit" value="Register"> <!-- Submit button for registration -->
        </form>
        <?php if(isset($error)) { echo "<p>$error</p>"; } ?> <!-- Display error message if set -->
    </div>
    <?php include 'templetes/footer.php'; ?> <!-- Include the footer template -->
</body>
</html>
