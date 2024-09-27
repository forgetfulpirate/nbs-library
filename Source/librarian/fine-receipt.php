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

    // Connect to database
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

    $imageX = 100; 
    $imageY = 5; 
    $imageWidth = 20; 
    $imageHeight = 20; 

    
    // Add the image
    $pdf->Image('inc/img/nbs-icon.png', $imageX, $imageY, $imageWidth, $imageHeight, 'PNG');
    $pdf->Ln(15); // Add some vertical space after the title

    // Set font and text alignment for the receipt title
    $pdf->SetFont('Arial', 'B', 20);

    $pdf->Cell(0, 10, 'Library Overdue Receipt', 0, 0, 'C'); // Center-aligned text
    
    $pdf->Ln(15); // Add some vertical space after the title

    // Retrieve student information
    $studentInfoQuery = "SELECT first_name, last_name, utype FROM finezone WHERE student_number = '$studentNumber' LIMIT 1";
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

    $pdf->Cell(155,5,"Borrower's name: " . $studentInfo['first_name'],0,0);
    $pdf->Cell(25,5,'Date: ' . $receiptDate,0,0);
    $pdf->Cell(34,5,'',0,1);

    $pdf->Cell(130,5,'',0,0);
    $pdf->Cell(25,5,'',0,0);
    $pdf->Cell(20,5,'',0,1);

    $pdf->SetFont('Arial', 'B', 10);
    
    $pdf->Cell(35, 6, 'Book Name',1,0,'C');
    $pdf->Cell(35, 6, 'Accession Number',1,0,'C');
    $pdf->Cell(30, 6, 'Date Borrowed',1,0,'C');
    $pdf->Cell(23, 6, 'Date Due',1,0,'C');
    $pdf->Cell(30, 6, 'Date Returned',1,0,'C');
    $pdf->Cell(20, 6, 'Remarks',1,0,'C');
    $pdf->Cell(15, 6, 'Overdue',1,1,'C');

    $pdf->SetFont('Arial', '', 10);
    // Add fetched data to PDF
   // Add fetched data to PDF
while ($row = mysqli_fetch_array($result)) {
    // Get the current Y position before adding the cells
    $yPos = $pdf->GetY();

    // Use MultiCell for the Book Name column to allow text wrapping
    $pdf->MultiCell(35, 6, $row['booksname'], 1, 'L');

    // Calculate the height of the MultiCell for Book Name
    $multiCellHeight = $pdf->GetY() - $yPos;

    // Save current X position to track column positions
    $xPos = $pdf->GetX();

    // Accession Number
    $pdf->SetXY($xPos + 35, $yPos); // Move to the next column at the same Y position
    $pdf->MultiCell(35, $multiCellHeight, $row['accession_number'], 1, 'L');

    // Date Borrowed
    $pdf->SetXY($xPos + 70, $yPos); // Move to the next column at the same Y position
    $pdf->MultiCell(30, $multiCellHeight, $row['date_issued'], 1, 'L');

    // Issued Date
    $pdf->SetXY($xPos + 100, $yPos); // Move to the next column at the same Y position
    $pdf->MultiCell(23, $multiCellHeight, $row['booksissuedate'], 1, 'L');

    // Date Returned
    $pdf->SetXY($xPos + 123, $yPos); // Move to the next column at the same Y position
    $pdf->MultiCell(30, $multiCellHeight, $row['booksreturndate'], 1, 'L');

    // Remarks
    $pdf->SetXY($xPos + 153, $yPos); // Move to the next column at the same Y position
    $pdf->MultiCell(20, $multiCellHeight, $row['remarks'], 1, 'L');

    // Fine
    $pdf->SetXY($xPos + 173, $yPos); // Move to the next column at the same Y position
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(15, $multiCellHeight, $row['fine'], 1, 'L'); // Move to the next row and reset X position

    // Reset font to normal
    $pdf->SetFont('Arial', '', 10);
}


    // Calculate and add total fine
    $totalFineQuery = "SELECT SUM(fine) AS total_fine FROM finezone WHERE student_number = '$studentNumber'";
    $totalFineResult = mysqli_query($link, $totalFineQuery);
    $totalFineRow = mysqli_fetch_assoc($totalFineResult);
    $totalFine = $totalFineRow['total_fine'];

    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(173, 6, 'TOTAL:', 1, 0, 'R');
    $pdf->Cell(15, 6, $totalFine, 1, 1);

        // Signature section
        $pdf->Ln(10); // Add a vertical space
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 10, '_______________________', 0, 1, 'R');
        $pdf->Cell(0, 0, 'Librarian Signature', 0, 1, 'R');

        $pdf->SetY(-40);

        // Width of the page
        $pageWidth = $pdf->GetPageWidth();
        // Image width
        $imageWidth = 20;
        // Calculate total width of the footer content
        $totalWidth = $imageWidth + 5 + 90; // 90 is the approximate width of the text block

        // Calculate starting X position to center the footer content
        $startX = ($pageWidth - $totalWidth) / 2;

        // Add the image to the left of the text
        $pdf->Image('inc/img/NBS-LOGO.png', $startX, $pdf->GetY(), $imageWidth, 15, 'PNG');

        $pdf->SetFont('Arial', '', 8);
        $pdf->SetXY($startX + $imageWidth + 0, $pdf->GetY() + 2); // Adjust the Y position to align with the image
        $pdf->MultiCell(90, 3, "3rd & 4th floors, Sct. Borromeo corner Quezon Avenue, Diliman, Lungsod Quezon, Kalakhang Maynila\nPhone: (02) 8376 5090\nlibrary@nbscollege.edu.ph", 0, 'L');
        
        $pdfFilename = 'receipt_' . $studentInfo['last_name'] . '.pdf';

    $pdfFilename = 'receipt_' . $studentInfo['last_name'] . '.pdf';
    $pdf->Output('', $pdfFilename);
}
?>
