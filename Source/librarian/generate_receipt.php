<?php
require 'fpdf/fpdf.php';

if (isset($_POST['generate_receipt'])) {
    // Retrieve selected student number from form
    $studentNumber = $_POST['student_number'];

    // Connect to your database
    include 'inc/connection.php';

    // Fetch data from finezone table based on selected student number
    $query = "SELECT * FROM finezone WHERE student_number = '$studentNumber'";
    $result = mysqli_query($link, $query);

    // Create PDF document
    class PDF extends FPDF {
        function Header() {
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, 'Library Fine Receipt', 0, 1, 'C');
            $this->Ln(5);
        }

        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial', '', 8);
            $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
        }
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 10);

    // Retrieve student information
    $studentInfoQuery = "SELECT first_name, last_name FROM finezone WHERE student_number = '$studentNumber' LIMIT 1";
    $studentInfoResult = mysqli_query($link, $studentInfoQuery);
    $studentInfo = mysqli_fetch_assoc($studentInfoResult);

    // Add student information to PDF
    $pdf->Cell(0, 10, 'Student Number: ' . $studentNumber, 0, 1);
    $pdf->Cell(0, 10, 'Name: ' . $studentInfo['first_name'] . ' ' . $studentInfo['last_name'], 0, 1);
    $pdf->Ln(5);
    

    // Add table headers
    $pdf->Cell(30, 10, 'Accession Number', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Date Issued', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Books issue Date', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Books Return', 1, 0, 'C');
    $pdf->Cell(30, 10, 'Fine', 1, 1, 'C');

    // Add fetched data to PDF
    while ($row = mysqli_fetch_array($result)) {
        $pdf->Cell(30, 10, $row['accession_number'], 1, 0);
        $pdf->Cell(30, 10, $row['date_issued'], 1, 0);
        $pdf->Cell(30, 10, $row['booksissuedate'], 1, 0);
        $pdf->Cell(30, 10, $row['booksreturndate'], 1, 0);
        $pdf->Cell(30, 10, $row['fine'], 1, 1);
    }

    // Calculate and add total fine
    $totalFineQuery = "SELECT SUM(fine) AS total_fine FROM finezone WHERE student_number = '$studentNumber'";
    $totalFineResult = mysqli_query($link, $totalFineQuery);
    $totalFineRow = mysqli_fetch_assoc($totalFineResult);
    $totalFine = $totalFineRow['total_fine'];

    $pdf->Cell(120, 10, 'TOTAL:', 1, 0, 'R');
    $pdf->Cell(30, 10, $totalFine, 1, 1);

    // Output PDF
    $pdf->Output('D', 'receipt.pdf'); // 'D' will force download, 'I' will display in browser
}
?>
