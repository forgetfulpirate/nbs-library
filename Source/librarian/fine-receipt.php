<?php
require 'fpdf/fpdf.php';

if (isset($_POST['generate_receipt'])) {
    // Retrieve selected student number from form
    $studentNumber = $_POST['student_number'];

    // Check if the student number field is empty
    if (empty($studentNumber)) {
        echo "Error: Student number field cannot be empty.";
     
        exit;
    }

    // Connect to your database
    include 'inc/connection.php';

    // Check if the student number is valid (exists in the database)
    $validStudentQuery = "SELECT COUNT(*) AS count FROM finezone WHERE student_number = '$studentNumber'";
    $validStudentResult = mysqli_query($link, $validStudentQuery);
    $validStudentRow = mysqli_fetch_assoc($validStudentResult);

    if ($validStudentRow['count'] == 0) {
        echo "<script>
        alert('Invalid ID Number');
        window.location.href = 'fine.php';
            
        </script>";
     
        exit;
    }

    // Fetch data from finezone table based on selected student number
    $query = "SELECT * FROM finezone WHERE student_number = '$studentNumber'";
    $result = mysqli_query($link, $query);

    $pdf = new FPDF('P', 'mm', "A4");

    $pdf->AddPage();
    // $pdf->Image('inc/img/nbs-icon.png', 60, 5, 20, 20); // Adjust the parameters as needed
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Cell(71,10,'',0,0);
    $pdf->Cell(59,5,'Library Receipt',0,0);
    $pdf->Cell(59,10,'',0,1);

    // Retrieve student information
    $studentInfoQuery = "SELECT first_name, last_name FROM finezone WHERE student_number = '$studentNumber' LIMIT 1";
    $studentInfoResult = mysqli_query($link, $studentInfoQuery);
    $studentInfo = mysqli_fetch_assoc($studentInfoResult);

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(71,5,'Details',0,0);
    $pdf->Cell(59,5,'',0,0);
    $pdf->Cell(59,10,'',0,1);

    $pdf->SetFont('Arial', 'B', 10);

    $pdf->Cell(130,5,'ID Number: ' . $studentNumber ,0,0);
    $pdf->Cell(25,5,'',0,0);
    $pdf->Cell(34,5,'',0,1);

    $pdf->Cell(130,5,'Name: ' . $studentInfo['first_name'] . ' ' . $studentInfo['last_name'],0,0);
    $pdf->Cell(25,5,'',0,0);
    $pdf->Cell(34,5,'',0,1);

    $pdf->Cell(130,5,'Total Books Borrowed:',0,0);
    $pdf->Cell(25,5,'',0,0);
    $pdf->Cell(34,5,'',0,1);

    $receiptDate = date("m/d/Y");

    $pdf->Cell(130, 5, 'Receipt Date: ' . $receiptDate, 0, 0);
    $pdf->Cell(25,5,'',0,0);
    $pdf->Cell(34,5,'',0,1);
    
    $pdf->Cell(130,5,'',0,0);
    $pdf->Cell(25,5,'',0,0);
    $pdf->Cell(34,5,'',0,1);

    $pdf->SetFont('Arial', 'B', 10);
    
    $pdf->Cell(50, 6, 'Book Accession Number',1,0,'C');
    $pdf->Cell(30, 6, 'Date Borrowed',1,0,'C');
    $pdf->Cell(23, 6, 'Issued Date',1,0,'C');
    $pdf->Cell(30, 6, 'Date Returned',1,0,'C');
    $pdf->Cell(30, 6, 'Remarks',1,0,'C');
    $pdf->Cell(20, 6, 'Fine',1,1,'C');

    $pdf->SetFont('Arial', '', 10);
    // Add fetched data to PDF
    while ($row = mysqli_fetch_array($result)) {
        $pdf->Cell(50, 6, $row['accession_number'], 1, 0);
        $pdf->Cell(30, 6, $row['date_issued'], 1, 0);
        $pdf->Cell(23, 6, $row['booksissuedate'], 1, 0);
        $pdf->Cell(30, 6, $row['booksreturndate'], 1, 0);
        $pdf->Cell(30, 6, $row['remarks'], 1, 0);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 6, $row['fine'], 1, 1);

        // Reset font to normal
        $pdf->SetFont('Arial', '', 10);
    }

    // Calculate and add total fine
    $totalFineQuery = "SELECT SUM(fine) AS total_fine FROM finezone WHERE student_number = '$studentNumber'";
    $totalFineResult = mysqli_query($link, $totalFineQuery);
    $totalFineRow = mysqli_fetch_assoc($totalFineResult);
    $totalFine = $totalFineRow['total_fine'];

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(163, 6, 'TOTAL:', 1, 0, 'R');
    $pdf->Cell(20, 6, $totalFine, 1, 1);

    $pdfFilename = 'receipt_' . $studentInfo['last_name'] . '.pdf';
    $pdf->Output('', $pdfFilename);
}
?>
