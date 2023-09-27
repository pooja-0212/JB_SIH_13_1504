<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"]; // No need to sanitize password
    $confirmPassword = $_POST["Confirm_password"]; // Corrected the name attribute

    // Validate user input (add more validation as needed)
    $errors = [];

    if (empty($name) || empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    if (count($errors) === 0) {
        // Database configuration
        $host = "localhost"; // Your database host
        $dbUsername = "your_db_username"; // Your database username
        $dbPassword = "your_db_password"; // Your database password
        $dbName = "your_db_name"; // Your database name

        // Create a database connection
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Hash the password securely using password_hash (recommended for production)
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert the user data into the database using prepared statements
        $sql = "INSERT INTO users (name, username, email, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $username, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "Signup successful! You can now <a href='login.html'>login</a>.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        // Display validation errors to the user
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>