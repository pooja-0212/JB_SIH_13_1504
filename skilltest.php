<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["assessmentType"])) {
    $selectedAssessmentType = $_POST["assessmentType"];

    switch ($selectedAssessmentType) {
        case "teachingskills":
            // Redirect to the Teaching Skills assessment page
            header("Location: teachingskills.html");
            exit;
        case "communication":
            // Redirect to the Communication Skills assessment page
            header("Location: communication.html");
            exit;
        case "subjectknowledge":
            // Redirect to the Subject Knowledge assessment page
            header("Location: subjectknowledge.html");
            exit;
        // default:
        //     echo "Invalid assessment type selected.";
        //     break;
    }
}
?>
