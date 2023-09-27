<?php
// Database configuration
$host = "localhost";
$username = "your_db_username";
$password = "your_db_password";
$database = "your_db_name";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $facultyName = $_POST["facultyName"];
    $course = $_POST["course"];
    $evaluationDate = $_POST["evaluationDate"];
    $teachingSkills = $_POST["teachingSkills"];
    $communication = $_POST["communication"];
    $knowledge = $_POST["knowledge"];
    $comments = $_POST["comments"];

    // Prepare and execute the database insert query
    $sql = "INSERT INTO evaluations (facultyName, course, evaluationDate, teachingSkills, communication, knowledge, comments) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiiss", $facultyName, $course, $evaluationDate, $teachingSkills, $communication, $knowledge, $comments);
    
    if ($stmt->execute()) {
        echo "Evaluation submitted successfully!";
    } else {
        echo "Error submitting evaluation: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>

    
