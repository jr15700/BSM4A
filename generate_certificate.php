<?php
// Include the FPDF library
require('fpdf.php'); // Adjust the path if necessary

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

// Get the ID from the URL
$id = (int)$_GET['id'];

// Fetch the evaluation data
$sql = "SELECT * FROM evaluations WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $course = $row['course'];
    $year = $row['year'];
    $section = $row['section'];
    $guest_speakers = $row['guest_speakers'];
    $flow_of_program = $row['flow_of_program'];
    $internet_connection = $row['internet_connection'];
    $comments = $row['comments'];
} else {
    die("No evaluation found for ID: $id");
}

// Create PDF document in landscape orientation
$pdf = new FPDF('L', 'mm', 'A4'); // 'L' for landscape, 'A4' for page size
$pdf->AddPage();

// Add background image for landscape orientation
$backgroundImagePath = 'certificate_template.png'; // Correct path to your image
$pdf->Image($backgroundImagePath, 0, 0, 297, 210); // 297 mm wide, 210 mm tall for full A4 landscape


$pdf->Ln(20);

// Set text color to white
$pdf->SetTextColor(255, 255, 255); // RGB color for white text

// Set font for the certificate title
$pdf->SetFont('Times', 'B', 50); // Font style and size for "CERTIFICATE"
$pdf->Cell(0, 10, 'CERTIFICATE', 0, 1, 'C');

// Add a line break for spacing
$pdf->Ln(10); // Adjust the number for more or less space

$pdf->SetFont('Times', 'B', 35); // Font style and size for "OF APPRECIATION"
$pdf->Cell(0, 10, 'OF APPRECIATION', 0, 1, 'C');
$pdf->Ln(10); // Add additional spacing below

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'This award was given to', 0, 1, 'C');

// Increase the font size for the student's name
$pdf->SetFont('Arial', 'I', 30); // Changed size to 30
$pdf->Cell(0, 10, $name, 0, 1, 'C');

// Get the width of the name to draw the underline
$nameWidth = $pdf->GetStringWidth($name);

// Get the current Y position for the underline
$currentY = $pdf->GetY();

// Set the line color to light blue (RGB)
$pdf->SetDrawColor(173, 216, 230); // Light blue color

// Draw an underline below the name
$pdf->Line((297 - $nameWidth) / 2, $currentY, (297 + $nameWidth) / 2, $currentY);

$pdf->SetFont('Arial', '', 15);
$pdf->Cell(0, 10, "Seminar 2024", 0, 5, 'C');

// Add quotation marks around the text
$pdf->Cell(0, 10, '"Navigating the Digital Frontier: Evolving Marketing Strategies in the Age of Data and AI"', 0, 1, 'C');

// Set position for the names and titles
$pdf->Ln(20); // Add space before the names

// Set font and size for names
$pdf->SetFont('Arial', '', 12);

// Left side: Mrs. Ronna Endrozo (Adviser)
$pdf->SetX(20); // Adjust X position for left alignment
$pdf->Cell(80, 10, "Mrs. Ronna Endrozo", 0, 0, 'L'); // Add name with fixed width

// Right side: Xyrah Nel Capablanca (Class President)
// Move X position to the right side
$pdf->SetX(200); // Adjust X position for right alignment
$pdf->Cell(80, 10, "Xyrah Nel Capablanca", 0, 1, 'R'); // Add name on the right side

// Move to the next line for titles
$pdf->SetX(20); // Reset position to the left for the title
$pdf->Cell(80, 10, "Adviser", 0, 0, 'L'); // Add title for left side

// Right side: Move to the right for the title
$pdf->SetX(200); // Adjust X position for right alignment
$pdf->Cell(80, 10, "Class President", 0, 1, 'R'); // Add title for right side

// Output the PDF to the browser
$pdf->Output('D', 'certificate_' . $id . '.pdf'); // Forces download
$conn->close();
?>
