<?php
require 'fpdf/fpdf.php';

if (isset($_POST['issue_book_receipt'])) {
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
    $validStudentQuery = "SELECT COUNT(*) AS count FROM issue_book WHERE student_number = '$studentNumber'";
    $validStudentResult = mysqli_query($link, $validStudentQuery);
    $validStudentRow = mysqli_fetch_assoc($validStudentResult);

    if ($validStudentRow['count'] == 0) {
        echo "<script>
        alert('Invalid ID Number');
        window.location.href = 'issued-books.php';
            
        </script>";
     
        exit;
    }

    // Fetch data from finezone table based on selected student number
    $query = "SELECT * FROM issue_book WHERE student_number = '$studentNumber'";
    $result = mysqli_query($link, $query);

    $pdf = new FPDF('P', 'mm', "A4");

    $pdf->AddPage();

    // Set position for the image and text
    $imageX = 100; // X position of the image
    $imageY = 5; // Y position of the image
    $imageWidth = 20; // Width of the image
    $imageHeight = 20; // Height of the image

    
    // Add the image
    $pdf->Image('inc/img/nbs-icon.png', $imageX, $imageY, $imageWidth, $imageHeight, 'PNG');
    $pdf->Ln(15); // Add some vertical space after the title

    // Set font and text alignment for the receipt title
    $pdf->SetFont('Arial', 'B', 20);

    $pdf->Cell(0, 10, 'LIBRARY LOAN RECEIPT', 0, 0, 'C'); // Center-aligned text
    
    $pdf->Ln(15); // Add some vertical space after the title

    // Retrieve student information
    $studentInfoQuery = "SELECT name, last_name, utype FROM issue_book WHERE student_number = '$studentNumber' LIMIT 1";
    $studentInfoResult = mysqli_query($link, $studentInfoQuery);
    $studentInfo = mysqli_fetch_assoc($studentInfoResult);

    $userTypeDisplay = ($studentInfo['utype'] == 'teacher') ? 'Faculty' : (($studentInfo['utype'] == 'student') ? 'Student' : 'Unknown');

    $pdf->SetFont('Arial', 'B', 15);
    $pdf->Cell(71,5,'Details',0,0);
    $pdf->Cell(59,5,'',0,0);
    $pdf->Cell(59,10,'',0,1);

    $pdf->SetFont('Arial', 'B', 10);

    $pdf->Cell(155,5,'ID Number: ' . $studentNumber ,0,0);
    $pdf->Cell(25,5,'User Type: ' . $userTypeDisplay,0,0,);
    $pdf->Cell(34,5,'',0,1);

    
    $receiptDate = date("m/d/Y");

    $pdf->Cell(155,5,"Borrower's name: " . $studentInfo['name'],0,0);
    $pdf->Cell(25,5,'Date: ' . $receiptDate,0,0);
    $pdf->Cell(34,5,'',0,1);

    $pdf->Cell(130,5,'',0,0);
    $pdf->Cell(25,5,'',0,0);
    $pdf->Cell(20,5,'',0,1);


    
    $pdf->SetFont('Arial', 'B', 10);

    $pdf->Cell(80, 6, 'Book Name', 1, 0, 'L');
    $pdf->Cell(40, 6, 'Accession Number', 1, 0, 'L');
    $pdf->Cell(35, 6, 'Date Borrowed', 1, 0, 'L');
    $pdf->Cell(33, 6, 'Date Due', 1, 1, 'L'); // Line break after this cell
    $pdf->SetFont('Arial', '', 10);
    // Add fetched data to PDF
    while ($row = mysqli_fetch_array($result)) {
        // Get the current Y position before adding the cells
        $yPos = $pdf->GetY();
        // Book Name (using MultiCell for potential text wrapping)
        $pdf->MultiCell(80, 6, $row['booksname'], 1, 'L');
    
        // Calculate the height of the MultiCell for Book Name
        $multiCellHeight = $pdf->GetY() - $yPos;
    
        // Save current X position to track column positions
        $xPos = $pdf->GetX();
    
        // Accession Number
        $pdf->SetXY($xPos + 80, $yPos); // Move to the next column at the same Y position
        $pdf->MultiCell(40, $multiCellHeight, $row['accession_number'], 1, 'L');
    
        // Date Borrowed
        $pdf->SetXY($xPos + 120, $yPos); // Move to the next column at the same Y position
        $pdf->MultiCell(35, $multiCellHeight, $row['booksissuedate'], 1, 'L');
    
        // Issued Date
        $pdf->SetXY($xPos + 155, $yPos); // Move to the next column at the same Y position
        $pdf->MultiCell(33, $multiCellHeight, $row['booksreturndate'], 1, 'L');
    
        // Move to the next row
        $pdf->SetXY($xPos, $yPos + $multiCellHeight);
    
        // Reset font to normal
        $pdf->SetFont('Arial', '', 10);
    }
    




        // Signature section
        $pdf->Ln(10); // Add a vertical space
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, '_______________________', 0, 1, 'R');
        $pdf->Cell(0, 0, 'Librarian Signature', 0, 1, 'R');
    
        $pdfFilename = 'loan_receipt_' . $studentInfo['last_name'] . '.pdf';

    $pdfFilename = 'loan_receipt_' . $studentInfo['last_name'] . '.pdf';
    $pdf->Output('', $pdfFilename);
}
?>
