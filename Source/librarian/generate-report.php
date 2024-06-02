<?php
session_start();
if (!isset($_SESSION["username"])) {
    ?>
    <script type="text/javascript">
        window.location="login.php";
    </script>
    <?php
    exit;
}

include 'inc/connection.php';

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$query = "SELECT * FROM issue_book_archive WHERE booksreturndate BETWEEN '$start_date' AND '$end_date'";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) > 0) {
    // Set the headers to indicate a file download
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="issued_books_report.xls"');
    header('Cache-Control: max-age=0');
    header('Pragma: public');

    // Open the output stream
    $output = fopen('php://output', 'w');

    // Output the title
    $title = "Generated Report For Borrowed Books in $start_date to $end_date";
    fwrite($output, "\"$title\"\n");
    // Output the column headings
    fputcsv($output, array('User Type', 'ID Number', 'Name', 'Department/Course', 'Email', 'Books Name', 'Accession Number', 'Book Issued Date', 'Books Return Date'), "\t");

    // Fetch and output each row of the data
    while ($row = mysqli_fetch_assoc($result)) {
        $combined_name = $row['name'] . ' ' . $row['last_name'];
        $row_to_output = array(
            $row['utype'],
            $row['student_number'],
            $combined_name,
            $row['dept'],
            $row['email'],
            $row['booksname'],
            $row['accession_number'],
            $row['booksissuedate'],
            $row['booksreturndate']
        );
        fputcsv($output, $row_to_output, "\t");
    }

    // Close the output stream
    fclose($output);

    exit;
} else {
    echo "<script> alert('No records found');  window.location='generate-report-borrowed.php';</script>";
}

mysqli_close($link);
?>
