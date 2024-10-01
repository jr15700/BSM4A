<?php
// Start the session (optional, if you want to use session variables)
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "evaluation";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and retrieve form data
    $name = $conn->real_escape_string(trim($_POST['name']));
    $course = $conn->real_escape_string(trim($_POST['course']));
    $year = $conn->real_escape_string(trim($_POST['year']));
    $section = $conn->real_escape_string(trim($_POST['section']));
    $guest_speakers = $conn->real_escape_string(trim($_POST['guest_speakers']));
    $flow_of_program = $conn->real_escape_string(trim($_POST['flow_of_program']));
    $internet_connection = $conn->real_escape_string(trim($_POST['internet_connection']));
    $comments = $conn->real_escape_string(trim($_POST['comments']));

    // Prepare and execute insert statement
    $sql = "INSERT INTO evaluations (name, course, year, section, guest_speakers, flow_of_program, internet_connection, comments) 
            VALUES ('$name', '$course', '$year', '$section', '$guest_speakers', '$flow_of_program', '$internet_connection', '$comments')";

    if ($conn->query($sql) === TRUE) {
        // Get the last inserted ID
        $lastId = $conn->insert_id;

        // Redirect to certificate generation page with ID
        header("Location: generate_certificate.php?id=" . $lastId);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information Form with Evaluation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Student Information Form</h1>
        <form action="index.php" method="post"> <!-- Updated to point to this PHP script -->
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            </div>
            <div class="form-group">
                <label for="course">Course:</label>
                <input type="text" id="course" name="course" placeholder="Enter your course" required>
            </div>
            <div class="form-group">
                <label for="year">Year:</label>
                <select id="year" name="year" required>
                    <option value="" disabled selected>Select your year</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                </select>
            </div>
            <div class="form-group">
                <label for="section">Section:</label>
                <input type="text" id="section" name="section" placeholder="Enter your section" required>
            </div>

            <!-- Program Evaluation Section -->
            <h2>Event Evaluation</h2>

            <div class="evaluation-group">
                <label for="guest-speakers">Guest Speakers:</label>
                <div class="rating-group">
                    <input type="radio" id="guest5" name="guest_speakers" value="5" required>
                    <label for="guest5" title="5 stars">★</label>
                    <input type="radio" id="guest4" name="guest_speakers" value="4">
                    <label for="guest4" title="4 stars">★</label>
                    <input type="radio" id="guest3" name="guest_speakers" value="3">
                    <label for="guest3" title="3 stars">★</label>
                    <input type="radio" id="guest2" name="guest_speakers" value="2">
                    <label for="guest2" title="2 stars">★</label>
                    <input type="radio" id="guest1" name="guest_speakers" value="1">
                    <label for="guest1" title="1 star">★</label>
                </div>
            </div>

            <div class="evaluation-group">
                <label for="flow">Flow of the Program:</label>
                <div class="rating-group">
                    <input type="radio" id="flow5" name="flow_of_program" value="5" required>
                    <label for="flow5" title="5 stars">★</label>
                    <input type="radio" id="flow4" name="flow_of_program" value="4">
                    <label for="flow4" title="4 stars">★</label>
                    <input type="radio" id="flow3" name="flow_of_program" value="3">
                    <label for="flow3" title="3 stars">★</label>
                    <input type="radio" id="flow2" name="flow_of_program" value="2">
                    <label for="flow2" title="2 stars">★</label>
                    <input type="radio" id="flow1" name="flow_of_program" value="1">
                    <label for="flow1" title="1 star">★</label>
                </div>
            </div>

            <div class="evaluation-group">
                <label for="internet">Internet Connection:</label>
                <div class="rating-group">
                    <input type="radio" id="internet5" name="internet_connection" value="5" required>
                    <label for="internet5" title="5 stars">★</label>
                    <input type="radio" id="internet4" name="internet_connection" value="4">
                    <label for="internet4" title="4 stars">★</label>
                    <input type="radio" id="internet3" name="internet_connection" value="3">
                    <label for="internet3" title="3 stars">★</label>
                    <input type="radio" id="internet2" name="internet_connection" value="2">
                    <label for="internet2" title="2 stars">★</label>
                    <input type="radio" id="internet1" name="internet_connection" value="1">
                    <label for="internet1" title="1 star">★</label>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="form-group">
                <label for="comments">What have you learned during the seminar?</label>
                <textarea id="comments" name="comments" placeholder="Write here" rows="4"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
