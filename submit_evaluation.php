<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_end_clean(); // Clear output buffer

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

// Get form data and sanitize input
$name = $conn->real_escape_string(trim($_POST['name']));
$course = $conn->real_escape_string(trim($_POST['course']));
$year = $conn->real_escape_string(trim($_POST['year']));
$section = $conn->real_escape_string(trim($_POST['section']));
$guest_speakers = (int)$_POST['guest_speakers'];
$flow_of_program = (int)$_POST['flow_of_program'];
$internet_connection = (int)$_POST['internet_connection'];
$comments = $conn->real_escape_string(trim($_POST['comments']));

// Prepare and execute the insert statement
$sql = "INSERT INTO evaluations (name, course, year, section, guest_speakers, flow_of_program, internet_connection, comments) VALUES ('$name', '$course', '$year', '$section', $guest_speakers, $flow_of_program, $internet_connection, '$comments')";

if ($conn->query($sql) === TRUE) {
    // Get the last submitted evaluation to generate the certificate
    $lastId = $conn->insert_id;
    $certificateUrl = "generate_certificate.php?id=" . $lastId; // Pass the ID to generate the certificate
    header("Location: $certificateUrl");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
